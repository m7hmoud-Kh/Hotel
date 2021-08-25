<?php

use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



define('EMP', App\Http\Controllers\Admin\EmployeesController::class);
define('ROOM', App\Http\Controllers\Admin\RoomController::class);
define('TYPE_ROOM', App\Http\Controllers\Admin\RoomTypeController::class);


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
        Route::get('/all', [ROOM, 'index']);
        Route::get('/add', [ROOM, 'add']);
        Route::get('/type_info/{id}', [ROOM, 'type_info']);
        Route::post('/store', [ROOM, 'store']);
        Route::post('/delete', [ROOM, 'delete']);
        Route::get('/edit/{id}', [ROOM, 'edit']);
        Route::post('/update', [ROOM, 'update']);
        Route::post('/change_status_room', [ROOM, 'change_status_room']);
    });

    Route::group(['prefix' => 'room_type'], function () {
        Route::get('/all', [TYPE_ROOM, 'index']);
        Route::get('/add',[TYPE_ROOM,'add']);
        Route::post('/store',[TYPE_ROOM,'store']);
        Route::get('/edit/{id}',[TYPE_ROOM,'edit']);
        Route::post('/update',[TYPE_ROOM,'update']);
        Route::post('/delete',[TYPE_ROOM,'delete']);

    });
});
