<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Payment as Pay;
use Illuminate\Http\Request;
use Shetabit\Payment\Exceptions\InvalidPaymentException;
use Shetabit\Payment\Facade\Payment;
use Shetabit\Payment\Invoice;

trait PaymentTrait {

    public function Request(Request $request, $price = 1000, $description = null)
    {
        // Create new invoice.
        $invoice = new Invoice;

        // Set invoice amount.
        $invoice->amount($price);

        // Set invoice uuid
        $invoice->uuid(date('Y-m-d-H-i-s')."sUjOlP");

        // Add invoice details: There are 4 syntax available for this. check the docs at shetabit/payment.
        $invoice->detail([
            'subject' => '//',
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
        return Payment::purchase($invoice, function($driver, $transactionId) use ($price, $description) {
            echo "transID: $transactionId<br/>";
            // We can store $transactionId in database.
            $transaction = new Pay;
            $transaction->trans_id = $transactionId;
            $transaction->amount = $price;
            $transaction->user_id = Auth::user()->id;
            $transaction->save();
        })->pay();
    }

    public function Callback(Request $request)
    {
        /**
        to make use future,  the $request includes 3 prop as continue:
        {
        "trans_id": "016d7d23-2d83-49c1-a7cd-17deeabafbf4",
        "order_id": "12201493880",
        "card_holder": "6037-99**-****-1643"
        }
        and we can use this data as a method on $request or as an array index.
         **/
        // You need to verify the payment to ensure the invoice has been paid successfully.
        // We use transaction id to verify payments
        // It is a good practice to add invoice amount as well.

        $transaction_id = $request['trans_id'];
        try {
            $receipt = Payment::amount(1000)->transactionId($transaction_id)->verify();

            // You can show payment referenceId to the user.
            // echo '<pre>payment done. id:' .  $receipt->getReferenceId() . '<hr>';

            $transaction = Pay::where('trans_id', $transaction_id)->update([
                'order_id' => $request['order_id'],
                'card_holder' => $request['card_holder']
            ]);
            echo '<pre>payment done. info:<hr>';
            return back();

        } catch (InvalidPaymentException $exception) {
            /**
            when payment is not verified, it will throw an exception.
            We can catch the exception to handle invalid payments.
            getMessage method, returns a suitable message that can be used in user interface.
             **/
            echo $exception->getMessage();
        }
    }
}
