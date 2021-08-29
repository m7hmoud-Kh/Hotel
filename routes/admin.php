<?php

use Illuminate\Support\Facades\Route;

define('ADMIN', App\Http\Controllers\Auth\AdminLoginController::class);

define('EMP', App\Http\Controllers\Admin\EmployeesController::class);
define('ROOM', App\Http\Controllers\Admin\RoomController::class);
define('TYPE_ROOM', App\Http\Controllers\Admin\RoomTypeController::class);
define('ROOM_STATUS', App\Http\Controllers\Admin\RoomStatusController::class);
define('DASH', App\Http\Controllers\Admin\DashbordController::class);
define('CLIENT', App\Http\Controllers\Admin\ClientController::class);







Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', [ADMIN, 'showLoginForm']);
    Route::post('/login', [ADMIN, 'login'])->name('admin.login');
});

Route::group(['middleware' => 'assign.guard:admin,admin/login'], function () {

    //Dasbord Controller
    Route::get('admin/dashbord', [DASH, 'index']);

    //Room Controller
    Route::group(['prefix' => 'admin/room'], function () {
        Route::get('/all', [ROOM, 'index']);
        Route::get('/add', [ROOM, 'add']);
        Route::get('/type_info/{id}', [ROOM, 'type_info']);
        Route::post('/store', [ROOM, 'store']);
        Route::post('/delete', [ROOM, 'delete']);
        Route::get('/edit/{id}', [ROOM, 'edit']);
        Route::post('/update', [ROOM, 'update']);
        Route::post('/change_status_room', [ROOM, 'change_status_room']);
    });

    //Room_Type Controller
    Route::group(['prefix' => 'admin/room_type'], function () {
        Route::get('/all', [TYPE_ROOM, 'index']);
        Route::get('/add', [TYPE_ROOM, 'add']);
        Route::post('/store', [TYPE_ROOM, 'store']);
        Route::get('/edit/{id}', [TYPE_ROOM, 'edit']);
        Route::post('/update', [TYPE_ROOM, 'update']);
        Route::post('/delete', [TYPE_ROOM, 'delete']);
        Route::post('/Archive', [TYPE_ROOM, 'Archive']);
        Route::get('/all_archive', [TYPE_ROOM, 'all_archive']);
        Route::post('/cancel_archive', [TYPE_ROOM, 'cancel_archive']);
        Route::post('/delete_archive', [TYPE_ROOM, 'delete_archive']);
    });


    //Room_statusController
    Route::group(['prefix' => 'admin/room_status'], function () {
        Route::get('/not_reservation', [ROOM_STATUS, 'not_reservation']);
        Route::get('/reservation', [ROOM_STATUS, 'reservation']);
    });



    //EmployeesController
    Route::group(['prefix' => 'admin/employees'], function () {
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


    //CLientController
    Route::group(['prefix' => 'admin/client'], function () {

        Route::get('/all',[CLIENT,'all']);
        Route::post('/delete',[CLIENT,'delete']);

    });
});
