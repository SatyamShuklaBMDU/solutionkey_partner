<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\ProjectDocumentController;
use App\Http\Controllers\ProjectTechnicalController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserManagerController;
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
    Route::post('/updateAdminStatus', [AdminController::class, 'changeStatus']);
    Route::post('/deleteUser', [UserController::class, 'deleteUser']);
    Route::post('/deleteAdmin', [AdminController::class, 'deleteAdmin']);
    Route::post('/filter-user', [UserController::class, 'filter'])->name('filter-user');
    Route::get('/add-admin', [AdminController::class,'index'])->name('admin.index');
    Route::get('/all-admin', [AdminController::class,'showadmin'])->name('admin.all.index');
    Route::post('/add-admin', [AdminController::class, 'store']);
    Route::get('/edit-admin/{id}', [AdminController::class, 'editAdmin']);
    Route::put('/update-admin/{id}', [AdminController::class, 'update_admin']);

    // Project Document
    Route::get('project-document', [ProjectDocumentController::class,'index'])->name('project-document');

    // Project Technical
    Route::get('project-technical', [ProjectTechnicalController::class, 'index'])->name('project-technical.index');

    // User Master ROute
    Route::get('add-user-master', [UserManagerController::class,'index'])->name('add.user.master.index');
    Route::post('add-user-master', [UserManagerController::class,'store'])->name('add.user.master.store');
    Route::get('edit-user-master/{id}', [UserManagerController::class,'edit'])->name('edit.user.master');
    Route::get('all-user-master', [UserManagerController::class,'show'])->name('add.user.master.show');
    Route::post('/updateUserMasterStatus', [UserManagerController::class, 'changeStatus']);
    Route::post('/update-user-master/{id}', [UserManagerController::class, 'update'])->name('update-user-master');
    Route::post('/deleteUserMaster', [UserManagerController::class, 'destroy']);
    Route::post('/filter-user-master', [UserManagerController::class, 'filter'])->name('filter-user-master');

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
