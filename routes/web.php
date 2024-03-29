<?php

use App\Models\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//admin login and register

Route::get('admin/register', [AdminController::class, 'Admin_Register_Form'])->name('admin.register-form');
Route::post('admin/register', [AdminController::class, 'Admin_register'])->name('admin.register');

Route::get('admin/login', [AdminController::class, 'Admin_Login_Form'])->name('admin.login-form');
Route::post('admin/login', [AdminController::class, 'Admin_Login'])->name('admin.login');
//user login/register
Route::get('/register/{referral?}', [AuthController::class, 'register_form'])->name('register-form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'login_form'])->name('login-form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'user_logout'])->name('logout');
Route::get('/dash', [Controller::class, 'dashboard'])->name('home');


//show package card
Route::get('/package/card', [PackageController::class, 'card'])->name('package.card');
Route::post('package/buy', [PackageController::class, 'buy'])->name('package.buy');

//
Route::get('get-link', [PackageController::class, 'link'])->name('show.link');
//wallet routes
Route::get('/wallet', [WalletController::class, 'show'])->name('show.wallet');
//payment
// web.php
Route::get('submit-payment', [PaymentController::class, 'payment_form'])->name('make.payment');
Route::post('/submit-payment', [PaymentController::class, 'submitPayment'])->name('submitPayment');
// web.php

Route::get('/payment-submitted', function () {
    // dd('kk');
    $user_id = Auth::user()->id;

    $payment = Payment::where('user_id', $user_id)->first();
    return view('payment_submitted', compact('payment'));
})->name('paymentSubmitted');
//payment for admin 
Route::get('payment/status', [PaymentController::class, 'viewPayments'])->name('show.payments');
Route::post('/admin/change-payment-status/{paymentId}/{newStatus}', [PaymentController::class, 'changePaymentStatus'])->name('admin.changePaymentStatus');

//POINT CONVERSION

Route::post('/convert-and-add-to-wallet', [PaymentController::class, 'convertAndAddToWallet'])
    ->name('convertAndAddToWallet');
    //withdraw
    Route::post('/withdrawAmount', [WalletController::class, 'withdrawAmount'])
    ->name('withdrawAmount');   
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/add-points/{user}', [PaymentController::class, 'showAddPointsForm'])->name('admin.showAddPointsForm');

    // Add a middleware 'admin' to check if the user is an admin
    Route::post('/admin/add-points/{user}', [PaymentController::class, 'addPoints'])->name('admin.addPoints');
    //user crud route
    Route::get('/user/all', [UserController::class, 'show'])->name('user.all');
    Route::get('/user/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/update/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/delete/{user}', [UserController::class, 'destroy'])->name('user.delete');

    //block user
    Route::get('/user/block', [UserController::class, 'block'])->name('user.block');
    Route::get('/user/review', [UserController::class, 'review'])->name('user.review');
    //change status
    Route::post('/user/update-status/{user}', [UserController::class, 'updateStatus'])->name('user.updateStatus');
    //all user wallet
    Route::get('all/user/wallet', [WalletController::class, 'AllUserWallet'])->name('show.all.wallets');
    //packge crud
    Route::get('/package', [PackageController::class, 'create'])->name('package.add');
    Route::post('/package/store', [PackageController::class, 'store'])->name('package.store');
    Route::get('/package/show', [PackageController::class, 'index'])->name('package.index');
    Route::get('package/edit/{package}', [PackageController::class, 'edit'])->name('package.edit');
    Route::put('/packages/{package}', [PackageController::class, 'update'])->name('package.update');
    Route::delete('package/delete/{package}', [PackageController::class, 'destroy'])->name('package.destroy');


});



Route::group(['prefix' => 'my_account'], function () {
    Route::get('/', [AuthController::class, 'account'])->name('my_account');
    Route::put('/', [AuthController::class, 'updateProfile'])->name('my_account.update');
    Route::put('/change_password', [AuthController::class, 'change_pass'])->name('change_password');
});
