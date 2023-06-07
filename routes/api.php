<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DesignationController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\RoleController;

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

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () 
{
    Route::post('logout', [AuthController::class, 'logout']);

    //Designation Api
    Route::resource('designation-details', DesignationController::class)
        ->only('index', 'store', 'update', 'show', 'destroy');

    //Employee Api
    Route::resource('employee-details', EmployeeController::class)
        ->only('index', 'store', 'update', 'show', 'destroy');

    //User Role Api
    Route::get('users/role', [RoleController::class, 'getRole']);
});
