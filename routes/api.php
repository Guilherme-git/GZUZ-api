<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/', function(){
    return response()->json(['status' => 'SUCCESS']);
});

Route::post('auth','AuthController@auth');
Route::post('forgot-password-email','ForgotPasswordController@sendEmail');
Route::post('new-password','ForgotPasswordController@newPassword');

Route::prefix('user')->group(function (){
    Route::post('create','User\UserController@create');

    Route::prefix('order')->group(function (){
        Route::post('create','User\OrderController@create');
        Route::put('edit','User\OrderController@edit');
        Route::get('my-ordens/{idUser}','User\OrderController@myOrdens');
        Route::get('drivers-map','User\OrderController@driverMap');
    });

    Route::prefix('cancellations')->group(function (){
        Route::post('create','User\CancellationsController@create');
    });

    Route::prefix('messages')->group(function (){
        Route::put('view-messages','User\MessagesController@viewMessages');
    });

    Route::prefix('negotiation')->group(function (){
        Route::put('accept','User\NegotiationController@accept');
        Route::put('recused','User\NegotiationController@recused');
    });

    Route::prefix('user-secundary')->group(function (){
        Route::post('create','User\UserSecundary@create');
    });
});

Route::prefix('driver')->group(function (){
    Route::post('create','Driver\DriverController@create');

    Route::prefix('order')->group(function (){
        Route::get('list','Driver\OrderController@list');
        Route::get('my-ordens/{idDriver}','Driver\OrderController@myOrdens');
    });

    Route::prefix('refuse_order')->group(function (){
        Route::post('create','Driver\RefuseOrderController@create');
        Route::get('my-refuses/{idDriver}','Driver\RefuseOrderController@myRefuse');
    });

    Route::prefix('messages')->group(function (){
        Route::post('save','Driver\MessagesController@save');
        Route::post('quick-save','Driver\MessagesController@saveQuick');
    });

    Route::prefix('negotiation')->group(function (){
        Route::post('create','Driver\NegotiationController@create');
    });

    Route::prefix('cheack_order')->group(function (){
        Route::post('create','Driver\CheckOrderController@create');
    });
});

Route::prefix('number')->group(function (){
    Route::post('create','NumberController@create');
    Route::get('list','NumberController@list');
});

Route::prefix('vehicles')->group(function (){
    Route::post('create','VehiclesController@create');
    Route::get('list','VehiclesController@list');
});
