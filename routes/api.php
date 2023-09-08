<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('employees/create', [App\Http\Controllers\API\EmployeeController::class, 'store']);
Route::get('employees', [App\Http\Controllers\API\EmployeeController::class, 'index']);
Route::get('employees/{id}', [App\Http\Controllers\API\EmployeeController::class, 'show']);
Route::put('employees/{id}/update', [App\Http\Controllers\API\EmployeeController::class, 'update']);

Route::post('webhook', [\App\Http\Controllers\Admin\PaymentController::class, 'webhook'])->name('uddoktapay.webhook');
