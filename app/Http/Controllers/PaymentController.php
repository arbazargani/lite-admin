<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Shetabit\Payment\Invoice;
use Shetabit\Payment\Facade\Payment;
use Shetabit\Payment\Exceptions\InvalidPaymentException;

use Illuminate\Support\Facades\Mail;
use App\Mail\ReceiptPaid;

use App\Jobs\SendReceiptPaidMail;

use Auth;
use App\Payment as Pay;
use App\Receipt;
use App\StringTrait;
use App\User;
use App\AlertTrait;
use App\Coin;

class PaymentController extends Controller
{
    use StringTrait;
    use AlertTrait;

    public function Request(Request $request, $hash)
    {
        // validate receipt
        // if ($receipt_id != $request['receipt_id']) {
        //     return abort(403, 'Unauthorized action.');
        // }

        // $receipt = Receipt::findOrFail($receipt_id);
        $receipt = Receipt::where('hash', $hash)->first();
        $receipt_id = $receipt->id;

        $amount = (int)$this->NormalizePrice($receipt->payable);
        $description = $receipt->description;
        $selected_coin = $receipt->selected_coin;

        // Create new invoice.
        $invoice = new Invoice;

        // Set invoice amount.
        $invoice->amount($amount);

        // Set invoice uuid
        $invoice->uuid(date('Y-m-d-H-i-s') . '-' . Auth::user()->id);

        // Add invoice details: There are 4 syntax available for this. check the docs at shetabit/payment.
        $invoice->detail([
            'subject' => $description,
            'date' => date('Y-m-d H:i:s')
        ]);

        // Purchase the given invoice.
        // Payment::purchase($invoice, function($driver, $transactionId) {
        //     // We can store $transactionId in database.
        //     $transaction = new Pay;
        //     $transaction->trans_id = $transactionId;
        //     // $transaction->trans_id = $invoice->getTransactionId();
        //     $transaction->user_id = Auth::user()->id;
        //     $transaction->save();
        // });

        // Purchase method accepts a callback function.
        // Payment::purchase($invoice, function($driver, $transactionId) {
        //     echo "transID: $transactionId<br/>";
        // });

        // You can specify callbackUrl
        // Payment::callbackUrl('http://localhost:8000/pay/callback.php')->purchase(
        //     $invoice,
        //     function($driver, $transactionId) {
        //         echo "transID: $transactionId<br/>";
        //     }
        // );

        // Pay on the fly, redirect to gateway
        return Payment::purchase($invoice, function ($driver, $transactionId) use ($amount, $description, $receipt_id, $selected_coin) {
            echo "transID: $transactionId<br/>";
            // We can store $transactionId in database.
            $transaction = new Pay;
            $transaction->trans_id = $transactionId;
            $transaction->amount = $amount;
            $transaction->user_id = Auth::user()->id;
            $transaction->receipt_id = $receipt_id;
            $transaction->save();
        })->pay();
    }

    public function Callback(Request $request)
    {
        /**
         * to make use future,  the $request includes 3 prop as continue:
         * {
         * "trans_id": "016d7d23-2d83-49c1-a7cd-17deeabafbf4",
         * "order_id": "12201493880",
         * "card_holder": "6037-99**-****-1643"
         * }
         * and we can use this data as a method on $request or as an array index.
         **/
        // You need to verify the payment to ensure the invoice has been paid successfully.
        // We use transaction id to verify payments
        // It is a good practice to add invoice amount as well.

        $transaction_id = $request['trans_id'];
        $amount = Pay::where('trans_id', $transaction_id)->first();
        try {
            $receipt = Payment::amount($amount->amount)->transactionId($transaction_id)->verify();

            // You can show payment referenceId to the user.
            // echo '<pre>payment done. id:' .  $receipt->getReferenceId() . '<hr>';

            $transaction = Pay::where('trans_id', $transaction_id)->update([
                'order_id' => $request['order_id'],
                'card_holder' => $request['card_holder'],
                'status' => 'paid'
            ]);
            $receipt_id = Pay::where('trans_id', $transaction_id)->first()->receipt_id;
            $selected_coin = Receipt::where('id', $receipt_id)->first()->selected_coin;
            $receipt = Receipt::where('id', $receipt_id)->update([
                'status' => 'paid',
                'paid_at' => now()
            ]);
            $coins = Coin::all();
            foreach ($coins as $coin) {
                if (strtolower($coin->name) == strtolower($selected_coin)) {
                    $coin_amount = Receipt::where('id', $receipt_id)->first()->amount;
                    Coin::where('name', $coin->name)->update([
                        'balance' => $coin->balance-$coin_amount,
                    ]);
                }
            }
            $message = 'پرداخت موردنظر با موفقیت انجام شد.';
            session(['status' => 'factored', 'message' => $message]);
            $this->MakeAlert(1, "یک فاکتور پرداخت شد.", 'successss');

            $user = Auth::user();
            $receipt = Receipt::findOrFail($receipt_id);
            // Mail::to($user->email)->send(new ReceiptPadi($receipt, $user));
            // SendReceiptPadiMail::dispatch($receipt, $user);
            $emailJob = (new  SendReceiptPaidMail($receipt, $user))->delay(Carbon::now()->addMinutes(2));
            dispatch($emailJob);
            
            return back();

        } catch (InvalidPaymentException $exception) {
            /**
             * when payment is not verified, it will throw an exception.
             * We can catch the exception to handle invalid payments.
             * getMessage method, returns a suitable message that can be used in user interface.
             **/
            echo 'خطا: ' . $exception->getMessage();
        }
    }

    public function Test()
    {
        $transaction_id = 'f2df67ad-c6d5-4d4c-9705-376bea467c79';
        $transaction = Pay::where('trans_id', $transaction_id)->get();
        $user = User::find(Auth::user()->id);
        return $user->receipt->first()->payment;
    }
}
