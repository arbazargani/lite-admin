<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function Composer\Autoload\includeFile;

use Auth;
use App\User;
use App\Receipt;
use App\Alert;
use App\Settings;
Use App\AlertTrait;

class UserController extends Controller
{
    use AlertTrait;

    public function StorePublicFile($request, $userFile) {

        if ($request->hasFile($userFile)) {

            // Get filename.extention
            $image = $request->file($userFile)->getClientOriginalName();
            // Get just file name
            $imageName = pathinfo($image, PATHINFO_FILENAME);
            // Get just file extention
            $imageExtention = $request->file($userFile)->getClientOriginalExtension();
            // Make unique file name
            $fileName = $imageName . '_' . time() . '-' . Auth::user()->id . '.' . $imageExtention;
            // Store for public uses
            $path = $request->file($userFile)->storeAs('public/uploads/certifications', $fileName);

            return $fileName;

        }

    }

    public function Index()
    {
        $receipts = User::find(Auth::id())->receipt;
        $transactions = User::find(Auth::id())->transaction;
        // return $transactions;
        $unpaid_receipts = User::find(Auth::id())->receipt->sum('payable');
        $sell_requests = User::find(Auth::id())->transaction;
        $alerts = User::find(Auth::id())->alert->where('read', 0);
        return view("user.panel.index", compact(['receipts', 'unpaid_receipts', 'alerts', 'sell_requests', 'transactions']));
    }

    public function Verfication(Request $request)
    {
        if ($request->isMethod('get')) {
            return view("user.panel.verification");
        }
        if ($request->isMethod('post')) {

            $request->validate([
                'birth_certificate' => 'required|mimes:jpg,jpeg,png|max:1024',
                'person_birth_certificate' => 'required|mimes:jpg,jpeg,png|max:1024',
                'national_card' => 'required|mimes:jpg,jpeg,png|max:1024',
                'person_national_card' => 'required|mimes:jpg,jpeg,png|max:1024',
                'phone_number' => 'required|digits:11',
                'home_number' => 'required|digits:11',
                'national_code' => 'required|digits:10',
                'credit_card' => 'required|digits:16',
                'credit_account' => 'required|digits:10',
//                'sheba_account' => 'required|digits:24',
                'home_address' => 'required|min:5',
            ]);

            $user = User::find(Auth::id());

            /**
            if ($request->hasFile('birth_certificate')) {

                // Get filename.extention
                $image = $request->file('birth_certificate')->getClientOriginalName();
                // Get just file name
                $imageName = pathinfo($image, PATHINFO_FILENAME);
                // Get just file extention
                $imageExtention = $request->file('birth_certificate')->getClientOriginalExtension();
                // Make unique file name
                $fileName = $imageName . '_' . time() . '-' . Auth::user()->id . '.' . $imageExtention;
                // Store for public uses
                $path = $request->file('birth_certificate')->storeAs('public/uploads/certifications', $fileName);

                $user->birth_certificate = $fileName;

            }

            if ($request->hasFile('national_card')) {

                // Get filename.extention
                $image = $request->file('national_card')->getClientOriginalName();
                // Get just file name
                $imageName = pathinfo($image, PATHINFO_FILENAME);
                // Get just file extention
                $imageExtention = $request->file('national_card')->getClientOriginalExtension();
                // Make unique file name
                $fileName = $imageName . '_' . time() . '-' . Auth::user()->id . '.' . $imageExtention;
                // Store for public uses
                $path = $request->file('national_card')->storeAs('public/uploads/certifications', $fileName);

                $user->national_card = $fileName;

            }
            **/

            $user->national_card = $this->StorePublicFile($request, 'national_card' );
            $user->person_national_card = $this->StorePublicFile($request, 'person_national_card' );

            $user->birth_certificate = $this->StorePublicFile($request, 'birth_certificate' );
            $user->person_birth_certificate = $this->StorePublicFile($request, 'person_birth_certificate' );

            $user->status = 'waiting';
            $user->phone_number = $request['phone_number'];
            $user->national_code = $request['national_code'];
            $user->home_number = $request['home_number'];
            $user->credit_card = $request['credit_card'];
            $user->credit_account = $request['credit_account'];
            $user->home_address = $request['home_address'];
            $user->save();

            $this->MakeAlert(User::where('rule', 'admin')->first()->id, 'کاربری برای احراز حویت درخواست داده است.', 'success');

            return redirect()->back();
        }
    }

    public function BuyCoin()
    {
        return view("user.panel.buy");
    }

    public function SellCoin()
    {
        $usd_price = Settings::where('name', 'dollar_price')->first();
        return view("user.panel.sell", compact('usd_price'));
    }

    public function VerifyTransaction()
    {
        //
    }

    public function ShowMessages()
    {
        $alerts = User::find(Auth::id())->alert;
        return view("user.panel.messages", compact(['alerts']));
    }

    Public function RawTx($hash) {
        $receipt = Receipt::where('hash', $hash)->whereNotNull('admin_tx')->first();
        
        return (!is_null($receipt) == 1) ? '<html><head><body><pre>'. $receipt->admin_tx .'</pre></body></head></html>' : abort('403', 'make screenshot and contact this state to system administrator.');
    }


    public function BuyHistory() {
        $receipts = User::find(Auth::id())->receipt;
        $unpaid_receipts = User::find(Auth::id())->receipt->sum('payable');
        $sell_requests = User::find(Auth::id())->transaction;
        $alerts = User::find(Auth::id())->alert->where('read', 0);
        return view("user.receipts.history", compact(['receipts', 'unpaid_receipts', 'alerts', 'sell_requests']));
    }

    public function SellHistory() {

    }
}
