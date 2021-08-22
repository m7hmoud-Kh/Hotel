<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



define('EMP', App\Http\Controllers\Admin\EmployeesController::class);
define('ROOM', App\Http\Controllers\Admin\RoomController::class);

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    Route::group(['prefix' => 'employees'], function () {
        Route::get('/all', [EMP, 'index']);
        Route::get('/add', [EMP, 'add']);
        Route::post('/store', [EMP, 'store']);
        Route::post('/delete', [EMP, 'delete']);
        Route::get('/edit/{id}', [EMP, 'edit']);
        Route::post('/update', [EMP, 'update']);
        Route::get('/receptionist', [EMP, 'receptionist']);
        Route::get('/room_attendant', [EMP, 'room_attendant']);
        Route::get('/doorman', [EMP, 'doorman']);
        Route::get('/poter', [EMP, 'poter']);
        Route::get('/chefs', [EMP, 'chefs']);
    });

    Route::group(['prefix' => 'room'], function () {
        //comment
    });
});
