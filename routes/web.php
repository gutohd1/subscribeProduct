<?php

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
Route::name('subscription.add')->post('/subscription', ['as' => 'put', 'uses' => 'SubscriptionController@subscribe']);
Route::name('subscription.delete')->delete('/subscription', ['as' => 'delete', 'uses' => 'SubscriptionController@unsubscribe']);