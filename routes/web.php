<?php

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

//Authentication Routes
Route::get('/', 'AuthController@showLogin')->name('showLogin');
Route::post('login', 'AuthController@login')->name('login');
Route::get('logout', 'AuthController@logout')->name('logout');

//Admin Routes
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::resource('employee-details', EmployeeController::class);
    Route::resource('designation-details', DesignationController::class);
    Route::get('dashboard', 'EmployeeController@dashboard')->name('dashboard');
    Route::post('users/update-status', 'EmployeeController@updateStatus')->name('users.updateStatus');
    Route::post('designation/select-all', 'DesignationController@deleteSelected')->name('designation.select-all');
    Route::post('user/select-all', 'EmployeeController@deleteSelected')->name('user.select-all');
    Route::get('designations/csv', 'DesignationController@exportDesignationsCSV')->name('designations.csv');
    Route::get('users/csv', 'EmployeeController@exportUsersCSV')->name('users.csv');
    Route::get('users/roles','Rolecontroller@getRole');
});

//User Routes
Route::prefix('user')->middleware('user')->group(function () {
    Route::get('profile', 'UserController@profile')->name('profile');
});
