<?php

//header('Access-Control-Allow-Origin', '*');
//header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Origin: *');
header( 'Access-Control-Allow-Headers: Authorization, Content-Type, x-xsrf-token, x-csrf-token' );
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS, PATCH');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//
Route::get('/', function () {
    echo ("<form action='tasks' method='POST' >");
    echo ("<input type='submit' value='submit'>");
    echo ("<input type='hidden' value='DELETE', name='_method'>");
    echo ("</form");
});

Route::group(['middleware' => 'web'],function(){
    Route::get('tasks','taskController@showAll');
    Route::get('tasks/{id}','taskController@show');
    Route::post('tasks', 'taskController@create');
    Route::patch('tasks/{id}', 'taskController@update');
    Route::delete('tasks/{id}', 'taskController@destroy' );
});