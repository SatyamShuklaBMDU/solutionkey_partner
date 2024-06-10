<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\EarningController;
use App\Http\Controllers\IncomeWalletController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\WithdrawController;
use App\Models\Appointement;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

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
// Hash::make('1234');
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware('authenticate_both')->group(function () {

    // Profile Route
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('store-basic',[ProfileController::class, 'storebasic'])->name('profile.basic.store');
    Route::post('store-contact',[ProfileController::class, 'storeContact'])->name('profile.contact.store');
    Route::post('store-password',[ProfileController::class, 'storePassword'])->name('profile.password.store');
    Route::post('/change-status', [ProfileController::class, 'changeStatus'])->name('user.changeStatus');
    // Appointment Route 
    Route::get('appointment-index',[AppointmentController::class,'index'])->name('appointment.index');
    Route::get('/api/appointments', [AppointmentController::class,'getdynamically']);
    Route::get('get-appointment-history',[AppointmentController::class,'getHistory'])->name('get.appointment.history');
    // Total Earning Route
    Route::get('/total-earning', [EarningController::class, 'index'])->name('total.earning');
    // Withdraw Route
    Route::get('/withdraw', [WithdrawController::class, 'index'])->name('withdraw.index');
    // Income Wallet Route
    Route::get('/income-wallet', [IncomeWalletController::class, 'index'])->name('income.wallet');
    // Project Profile Route 
    Route::get('project-profile',[ProfilesController::class,'index'])->name('project.profile.index');
    // Setting Route
    Route::get('setting',[SettingController::class,'index'])->name('setting.index');
    Route::post('/setting/time-slots/store', [SettingController::class, 'storeTimeSlots'])->name('setting.time_slots.store');
    Route::post('/setting/bank-info/store', [SettingController::class, 'storeBankInfo'])->name('setting.bank-info.store');

    // Post Route
    Route::get('/post',[PostController::class,'index'])->name('post.index');
    Route::get('/posts/data', [PostController::class,'getData'])->name('posts.data');
    Route::post('/posts/update', [PostController::class,'update'])->name('posts.update');
    Route::post('/posts/delete', [PostController::class,'delete'])->name('posts.delete');
    Route::post('/posts/status', [PostController::class,'status'])->name('posts.status');

    // Blog Route
    Route::get('/blog',[BlogController::class,'index'])->name('blog.index');
    Route::get('/posts/data', [BlogController::class,'getData'])->name('blog.data');
    Route::post('/blog/update', [BlogController::class,'update'])->name('blog.update');
    Route::post('/blog/delete', [BlogController::class,'delete'])->name('blog.delete');
    Route::post('/blog/status', [BlogController::class,'status'])->name('blog.status');
});

Route::get('logout-user',function(){
    Auth::logout();
    return redirect()->route('login');
});

Route::get('clear-cache',function(){
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    return redirect()->back();
});
require __DIR__.'/auth.php';
