<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PackageController;

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

Route::get('admin/register',[AdminController::class, 'Admin_Register_Form'])->name('admin.register-form');
Route::post('admin/register',[AdminController::class, 'Admin_register'])->name('admin.register');

Route::get('admin/login',[AdminController::class, 'Admin_Login_Form'])->name('admin.login-form');
Route::post('admin/login',[AdminController::class, 'Admin_Login'])->name('admin.login');
//user login/register
Route::get('/register',[AuthController::class, 'register_form'])->name('register-form');
Route::post('/register',[AuthController::class, 'register'])->name('register');

Route::get('/login',[AuthController::class, 'login_form'])->name('login-form');
Route::post('/login',[AuthController::class, 'login'])->name('login');
Route::post('/logout',[AuthController::class, 'user_logout'])->name('logout');
Route::get('/dash',[Controller::class, 'dashboard'])->name('home');
//packge crud
Route::get('/package',[PackageController::class, 'create']);
Route::post('/package/store',[PackageController::class, 'store'])->name('package.store');
Route::get('package/edit/{id}',[PackageController::class, 'edit'])->name('package.edit');
Route::put('package/update/{id}',[PackageController::class, 'update'])->name('package.update');
Route::delete('package/



Route::group(['prefix' => 'my_account'], function() {
    Route::get('/', [AuthController::class, 'account'])->name('my_account');
    Route::put('/', [AuthController::class, 'update_profile'])->name('my_account.update');
    Route::put('/change_password', [AuthController::class, 'change_pass'])->name('change_password');
});
