<?php

use App\Http\Controllers\Api\v1\CustomerController;
use App\Http\Controllers\Api\v1\MedicineController;
use App\Http\Controllers\Api\v1\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::prefix('v1')->group(function () {

    //Users
    Route::prefix('users')->group(function () {

        Route::post('register', [UserController::class, 'register'])->name('user.register');
        Route::post('login', [UserController::class, 'login'])->name('user.login');
        Route::post('logout', [UserController::class, 'logout'])->name('user.logout')->middleware('auth:sanctum');
    });

    //Medicines
    Route::apiResource('medicines', MedicineController::class)->middleware(['auth:sanctum',]);
    Route::post('medicines/restore/{id}', [MedicineController::class, 'restore'])->name('medicine.restore')->middleware('auth:sanctum');
    Route::delete('medicines/forcedelete/{id}', [MedicineController::class, 'forceDelete'])->name('medicine.forcedelete')->middleware('auth:sanctum');

    //Customer
    Route::apiResource('customers', CustomerController::class)->middleware(['auth:sanctum',]);
    Route::post('customers/restore/{id}', [CustomerController::class, 'restore'])->name('customer.restore')->middleware('auth:sanctum');
    Route::delete('customers/forcedelete/{id}', [CustomerController::class, 'forceDelete'])->name('customer.forcedelete')->middleware('auth:sanctum');
});
