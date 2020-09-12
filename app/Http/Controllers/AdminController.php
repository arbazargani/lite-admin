<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\User;
use App\Transaction;
use App\Alert;
use App\AlertTrait;
use App\Receipt;

use Auth;

class AdminController extends Controller
{
    use AlertTrait;

    public function GetPrice($locale = 'irr')
    {
        $api_url = "https://api.coindesk.com/v1/bpi/currentprice/$locale.json";

        // Read JSON file
        $json_data = file_get_contents($api_url);

        // Decode JSON data into PHP array
        $response_data = json_decode($json_data);

        $price = $response_data->bpi;
        $price = $price->IRR->rate;

        return $price;
    }

    public function Index()
    {
        $payments = null;
        // $BTC_IRR = $this->GetPrice();
        $alerts = User::find(Auth::id())->alert->where('read', 0)->count();
        $today_sells = Receipt::whereDate('created_at', Carbon::today())->where('status', 'paid')->get()->sum('payable');

        return view('admin.dashboard.index', compact(['payments', 'alerts', 'today_sells']));
    }

    public function ManageUsers()
    {
        $users = User::latest()->paginate(15);
        return view("admin.dashboard.users.manage", compact(['users']));
    }

    public function EditUser($id)
    {
        $user = User::findOrFail($id);
        $transactions_count = $user->receipt()->where('status', 'paid')->count();
        $latest_transactions = $user->payment()->latest()->paginate(7);

        return view("admin.dashboard.users.edit", compact(['user', 'transactions_count', 'latest_transactions']));
    }

    public function UpdateUser(Request $request, $id)
    {
        User::where('id', $id)->update([
            'home_address' => $request['home_address'],
            'credit_card' => $request['credit_card'],
            'credit_account' => $request['credit_account']
        ]);
        return back();
    }

    public function Verification(Request $request, $id = 0)
    {

        if ($request->isMethod('get')) {
            $users = User::where('status', 'waiting')->paginate(10);
            return view("admin.dashboard.users.verification", compact(['users']));
        }
        if ($request->isMethod('post')) {

            $user = User::find($id);

            if ($request->has('action') && $request['action'] == 'accept') {
                $user->status = 'verified';
                $message = 'کاربر با موفقیت تایید شد.';
                session(['status' => 'accepted', 'message' => $message]);
                $this->MakeAlert($id, 'اکانت شما به تایید کارشناس سامانه رسید.', 'success');
            } elseif ($request->has('action') && $request['action'] == 'reject') {
                $user->status = 'suspended';
                $message = 'کاربر موردنظر تایید نشد.';
                session(['status' => 'rejected', 'message' => $message]);
                $this->MakeAlert($id, 'اکانت شما به تایید کارشناس سامانه نرسیده است. لطفا دوباره مدارک خود را بارگزاری نمایید.', 'danger');
            } else {
                return abort(403, 'Unauthorized action.');
            }

            $user->save();

            return redirect()->back();
        }

    }

    public function NotEmpty($fileds = [])
    {
        foreach ($fileds as $filed) {
            if ($filed == null) {
                return false;
            }
        }
        return true;
    }

    public function QuickVerify($id)
    {
        $user = User::find($id);

        if ($this->NotEmpty([$user->national_card, $user->person_national_card, $user->birth_certificate, $user->person_birth_certificate])) {
            $user->where('id', $id)->update(['status' => 'verified']);
            $message = 'کاربر با موفقیت تایید شد.';
            session(['status' => 'accepted', 'message' => $message]);
            $this->MakeAlert($id, 'اکانت شما به تایید کارشناس سامانه رسید.', 'success');
        } else {
            return abort(403, 'Unauthorized action. user info has a problem.');
        }

        return back();
    }

    public function ShowMessages()
    {
        $alerts = User::find(Auth::id())->alert()->paginate(10);
        return view("admin.dashboard.messages.index", compact(['alerts']));
    }

    public function VerifyTransaction(Request $request, $id = 0)
    {
        if ($request->isMethod('get')) {
            $transactions = Transaction::where('status', 'waiting')->paginate(10);
            return view('admin.dashboard.transactions.verification', compact(['transactions']));
        } elseif ($request->isMethod('post')) {
            $transaction = Transaction::find($id);

            if ($request->has('action') && $request['action'] == 'accept') {
                $transaction->status = 'verified';
                $transaction->pay_tracking_id = $request['pay_tracking_id'];
                $message = 'تراکنش با موفقیت تایید شد.';
                session(['status' => 'accepted', 'message' => $message]);
                $this->MakeAlert($transaction->user->id, 'درخواست فروش شما به تایید کارشناس سامانه رسید.', 'success');
                $transaction->save();
                $transaction->paid_at = $transaction->updated_at;

            } elseif ($request->has('action') && $request['action'] == 'reject') {
                $transaction->status = 'rejected';
                $message = 'تراکنش موردنظر تایید نشد.';
                session(['status' => 'factored', 'message' => $message]);
                $this->MakeAlert($transaction->user->id, 'درخواست فروش شما توسط کارشناسان سامانه تایید نشده است.', 'danger');
            } else {
                return abort(403, 'Unauthorized action.');
            }

            $transaction->save();

            return redirect()->back();
        }
    }

    public function ShowPayments()
    {
        $receipts = Receipt::where('status', 'paid')->latest()->paginate(10);
        return view("admin.dashboard.receipts.index", compact(['receipts']));
    }

    public function PaymentDoAction(Request $request, $id)
    {
        $request->validate([
            'admin_action' => 'required'
        ]);

        if ($request['admin_action'] == 'accept') {
            $request->validate([
                'tx_id' => 'required:min:7'
            ]);
            $receipt = Receipt::where('id', $id)->update([
                'admin_action' => $request['admin_action'],
                'admin_tx' => $request['tx_id']
            ]);
    
        } else {
            $receipt = Receipt::where('id', $id)->update([
                'admin_action' => $request['admin_action']
            ]);
        }
        return back();
    }

    public function BlockUser($id)
    {
        $user = User::where('id', $id)->update(['status' => 'suspended']);
        return back();
    }

    public function UnblockUser($id)
    {
        $user = User::where('id', $id)->update(['status' => 'verified']);
        return back();
    }
}
