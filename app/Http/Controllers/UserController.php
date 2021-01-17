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
use App\Coin;

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
            $fileName = str_shuffle($imageName) . '_' . time() . '-' . Auth::user()->id . '.' . $imageExtention;
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
                // 'person_birth_certificate' => 'required|mimes:jpg,jpeg,png|max:1024',
                'national_card' => 'required|mimes:jpg,jpeg,png|max:1024',
                // 'person_national_card' => 'required|mimes:jpg,jpeg,png|max:1024',
                'phone_number' => 'required|digits:11',
                'home_number' => 'required|min:8',
                'national_code' => 'required|digits:10',
                'credit_card' => 'required|digits:16',
                'credit_account' => 'required|digits:13',
                'sheba_account' => 'required|digits:24',
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
            // $user->person_national_card = $this->StorePublicFile($request, 'person_national_card' );

            $user->birth_certificate = $this->StorePublicFile($request, 'birth_certificate' );
            // $user->person_birth_certificate = $this->StorePublicFile($request, 'person_birth_certificate' );

            $user->status = 'waiting';
            $user->phone_number = $request['phone_number'];
            $user->national_code = $request['national_code'];
            $user->home_number = $request['home_number'];
            $user->credit_card = $request['credit_card'];
            $user->credit_account = $request['credit_account'];
            $user->sheba_account = $request['sheba_account'];
            $user->home_address = $request['home_address'];
            $user->gender = $request['gender'];
            $user->save();

            $this->MakeAlert(User::where('rule', 'admin')->first()->id, 'کاربر' . "|" .$user->id. "|" . 'برای احراز هویت درخواست داده است.', 'success');

            return redirect()->back();
        }
    }

    public function BuyCoin()
    {
        $coins = Coin::whereRaw('balance > 0 AND max_ex_limit <= balance')->get();
        $usd_price = Settings::where('name', 'dollar_price_buy')->first();
        return view("user.panel.buy", compact('usd_price', 'coins'));
    }

    public function SellCoin()
    {
        // $coins = Coin::all();
        $coins = Coin::whereRaw('balance > 0 AND max_ex_limit <= balance')->get();
        $usd_price = Settings::where('name', 'dollar_price_sell')->first();
        return view("user.panel.sell", compact('usd_price', 'coins'));
    }

    public function VerifyTransaction()
    {
        //
    }

    public function ShowMessages()
    {
        $alerts = User::find(Auth::id())->alert()->paginate(10);;
        return view("user.panel.messages", compact(['alerts']));
    }

    Public function RawTx($hash) {
        $receipt = Receipt::where('hash', $hash)->whereNotNull('admin_tx')->first();
        
        return (!is_null($receipt) == 1) ? '<html><head><body><pre>'. $receipt->admin_tx .'</pre></body></head></html>' : abort('403', 'make screenshot and contact this state to system administrator.');
    }

    public function RawWallet($hash) {
        $receipt = Receipt::where('hash', $hash)->whereNotNull('wallet')->first();
        
        return (!is_null($receipt) == 1) ? '<html><head><body><pre>'. $receipt->wallet .'</pre></body></head></html>' : abort('403', 'make screenshot and contact this state to system administrator.');
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

    public function Profile(Request $request) {
        $user = User::find(Auth::id());
        $transactions_count = $user->receipt()->where('status', 'paid')->count();
        $latest_transactions = $user->payment()->latest()->paginate(7);
        return view('user.panel.profile', compact(['user', 'transactions_count', 'latest_transactions']));
    }

    public function UpdateProfile(Request $request) {
        $request->validate([
            'phone_number' => 'required|digits:11',
            'home_number' => 'required|digits:11',
            'national_code' => 'required|digits:10',
            'credit_card' => 'required|digits:16',
            'credit_account' => 'required|digits:10',
            'sheba_account' => 'required|digits:24',
            'home_address' => 'required|min:5',
        ]);

        User::where('id', Auth::id())->update([
            'phone_number' => $request['phone_number'],
            'home_number' => $request['home_number'],
            'home_address' => $request['home_address'],
            'national_code' => $request['national_code'],
            'credit_card' => $request['credit_card'],
            'credit_account' => $request['credit_account'],
            'sheba_account' => $request['sheba_account']
        ]);
        return back();
    }
    public function SendRegistrationSms($information) {
        if (!array_key_exists('to', $information) || !array_key_exists('text', $information)) {
            return;
        }

        try{
            ini_set("soap.wsdl_cache_enabled",0);
            $sms = new \SoapClient("http://api.payamak-panel.com/post/Send.asmx?wsdl",array("encoding"=>"UTF-8"));
            $data = array(
                "username"=>"09213840980" ,
                "password"=>"8218",
                "to"=>array($information['to']),
                "from"=>"30008666840980",
                "text"=>$information['text'],
                "isflash"=>false
            );
            $result = $sms->SendSimpleSMS($data)->SendSimpleSMSResult;
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
}
