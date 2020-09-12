<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/logout', function () {
    if (Auth::check()) {
        Auth::logout();
        return redirect('/');
    }
    return abort('404');
});

Route::get('/', 'PublicController@Index')->name('Public > Home');
// Route::get('/', function() {
//     return view('public.home.soon');
// });

Route::middleware(['auth', 'HasAdminAccess'])->group(function () {

    Route::prefix('cfx63/dashboard')->group(function () {
        Route::get('/', 'AdminController@Index')->name('Admin > Dashboard');
        Route::get('/messages', 'AdminController@ShowMessages')->name('Admin > Messages');

        Route::get('/users/manage', 'AdminController@ManageUsers')->name('Admin > Users > Manage');

        Route::get('/users/edit/{id}', 'AdminController@EditUser')->name('Admin > User > Edit');
        Route::post('/users/update/{id}', 'AdminController@UpdateUser')->name('Admin > User > Update');

        Route::get('/users/verify', 'AdminController@Verification')->name('Admin > Users > Verification List');
        Route::post('/users/verify/{id}', 'AdminController@Verification')->name('Admin > Users > Verify Person');

        Route::post('/users/quick_verify/{id}', 'AdminController@QuickVerify')->name('Admin > Users > Quick Verify Person');

        Route::post('/users/block/{id}', 'AdminController@BlockUser')->name('Admin > Users > Block User');
        Route::post('/users/unblock/{id}', 'AdminController@UnblockUser')->name('Admin > Users > Unblock User');

        Route::get('/receipts/paid', 'AdminController@ShowPayments')->name('Admin > Receipts > List');
        Route::post('/receipts/action/{id}', 'AdminController@PaymentDoAction')->name('Admin > Receipts > Action');

        Route::get('/transactions/verify', 'AdminController@VerifyTransaction')->name('Admin > Transactions > Verification List');
        Route::post('/transactions/verify/{id}', 'AdminController@VerifyTransaction')->name('Admin > Transactions > Verify Transaction');

        Route::get('/settings', 'SettingsController@Show')->name('Admin > Settings > Show');
        Route::post('/settings/update', 'SettingsController@Update')->name('Admin > Settings > Update');

        Route::get('/storage/uploads/certifications/{slug}', 'AssetsController@SafeAssetsRender')->name('Admin > Images > Show');
    });

});

Route::middleware(['auth'])->group(function () {

    Route::prefix('panel')->group(function () {
        Route::get('/', 'UserController@Index')->name('User > Panel');
        Route::any('/verification', 'UserController@Verfication')->name('User > Verification');

        Route::get('/messages', 'UserController@ShowMessages')->name('User > Messages');

        Route::get('/messages/check/{id}', 'AlertController@SetAsRead')->name('Alert > Check');

        Route::middleware(['IsVerified'])->group(function () {
            Route::get('/buy', 'UserController@BuyCoin')->name('User > Buy Coin');
            Route::get('/buy/history', 'UserController@BuyHistory')->name('User > Buy History');
            Route::get('/sell', 'UserController@SellCoin')->name('User > Sell Coin');
            Route::get('/sell/history', 'UserController@SellHistory')->name('User > Sell History');
            Route::get('/transaction/verify');

            Route::get('/exchange', 'ExchangeController@ExchangeCoin')->name('User > Exchange Coin');
            Route::post('/exchange/make', 'ExchangeController@MakeExchange')->name('User > Exchange > Make');


            Route::post('/receipt/make', 'ReceiptController@MakeReceipt')->name('User > Receipt > Make');
            Route::get('/receipt/manage', 'ReceiptController@Manage')->name('User > Receipt > Archive');
            Route::get('/receipt/show/{id}', 'ReceiptController@ShowReceipt')->name('User > Receipt > Show');
            Route::post('/receipt/pay/{id}', 'ReceiptController@PayReceipt')->name('User > Receipt > Pay');
            // Route::post('/receipt/pay/{id}', 'PaymentController@Reques')->name('User > Receipt > Pay');
            Route::get('/receipt/raw/tx/{hash}', 'UserController@RawTx')->name('User > Receipt > Raw');

            Route::post('/transaction/make', 'TransactionController@MakeTransaction')->name('User > Transaction > Make');
            Route::get('/transaction/manage', 'TransactionController@Manage')->name('User > Transaction > Archive');
            // Route::get('/transaction/show/{id}', 'TransactionController@ShowTransaction')->name('User > Transaction > Show');
            Route::get('/transaction/show/{hash}', 'TransactionController@ShowTransaction')->name('User > Transaction > Show');
            // Route::any('/transaction/add_tx/{id}', 'TransactionController@AddTX')->name('User > Transaction > ADD Tx ID');
            Route::any('/transaction/add_tx/{hash}', 'TransactionController@AddTX')->name('User > Transaction > ADD Tx ID');
            Route::get('/transaction/raw/tx/{hash}', 'TransactionController@RawTx')->name('User > Transaction > Raw');
            Route::get('/transaction/raw/tracking_id/{hash}', 'TransactionController@RawTrackingID')->name('User > Transaction > Tracking ID > Raw');
        });
    });

});

Route::prefix('pay')->group(function () {
    Route::post('/request/{receipt_id}', 'PaymentController@Request')->name('Payment > Request');
    Route::any('/callback.php', 'PaymentController@Callback')->name('Payment > Callback');
    Route::any('/receipt', 'PaymentController@PayReceipt')->name('MakeReceipt');
});

Route::post('/push-chat', 'ChatController@triggerChannel')->name('Chat');

Route::get('/server-info', function () {
    return phpinfo();
});

Route::get('coin', 'CoinController@ExchangeSell')->name('CoinExchange');
