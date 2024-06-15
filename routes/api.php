<?php

use App\Http\Controllers\API\BlogController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\VendorController;
use App\Http\Controllers\API\VendorFeedbackController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('vendor')->group(function () {
    Route::post('/sign-up', [VendorController::class, 'register']);
    Route::post('/login', [VendorController::class, 'login']);
    Route::post('/update', [VendorController::class, 'update'])->middleware('auth:sanctum');
    Route::get('/details', [VendorController::class, 'vendorDetails'])->middleware('auth:sanctum');
    Route::post('/logout', [VendorController::class, 'logout'])->middleware('auth:sanctum');
    Route::post('/change-password', [VendorController::class, 'changePassword'])->middleware('auth:sanctum');
    Route::post('/posts', [PostController::class, 'store'])->middleware('auth:sanctum');
    Route::post('/specific-vendor-all-posts',[PostController::class,'specificVendorPost'])->middleware('auth:sanctum');
    Route::post('/posts/update', [PostController::class, 'update'])->middleware('auth:sanctum');
    Route::get('get-all-posts', [PostController::class, 'allposts'])->middleware('auth:sanctum');
    Route::post('/feedback', [VendorFeedbackController::class, 'addFeedback'])->middleware('auth:sanctum');
    Route::get('/feedback', [VendorFeedbackController::class, 'GetFeedback'])->middleware('auth:sanctum');
    Route::post('/complaint', [VendorFeedbackController::class, 'addcomplaint'])->middleware('auth:sanctum');
    Route::get('/complaint', [VendorFeedbackController::class, 'Getcomplaint'])->middleware('auth:sanctum');
    Route::post('/blogs/register', [BlogController::class, 'register'])->middleware('auth:sanctum');
    // Route::post('/schedule_slots', [SlotController::class, 'scheduleSlot']);
});
