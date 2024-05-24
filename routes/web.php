<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Models\Appointement;
use Illuminate\Support\Facades\Auth;
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

    Route::get('users', [UserController::class,'index'])->name('user.index');
    Route::get('/getCityState', [UserController::class, 'getCityState']);
    Route::post('/updateUserStatus', [UserController::class, 'changeStatus']);
    
    // Appointment Route 
    Route::get('appointment-index',[AppointmentController::class,'index'])->name('appointment.index');
    Route::get('/api/appointments', [AppointmentController::class,'getdynamically']);
    Route::get('get-appointment-history',[AppointmentController::class,'getHistory'])->name('get.appointment.history');

    // Project Profile Route 
    Route::get('project-profile',[ProfilesController::class,'index'])->name('project.profile.index');

    // Setting Route
    Route::get('setting',[SettingController::class,'index'])->name('setting.index');
    Route::post('/setting/time-slots/store', [SettingController::class, 'storeTimeSlots'])->name('setting.time_slots.store');
    Route::post('/setting/bank-info/store', [SettingController::class, 'storeBankInfo'])->name('setting.bank-info.store');

});

Route::get('logout-user',function(){
    Auth::logout();
    return redirect()->route('login');
});

require __DIR__.'/auth.php';
