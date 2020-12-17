<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/tasks/test1', 'TasksController@test1');
Route::resource('tasks', 'TasksController');

/**************************************
 * API
 **************************************/
Route::prefix('api')->group(function(){
    //tasks
    Route::get('/apitasks/get_tasks', 'ApiTasksController@get_tasks');
    Route::post('/apitasks/get_item', 'ApiTasksController@get_item');
});
