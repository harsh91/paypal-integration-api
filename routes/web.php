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

Route::get('/execute-payment', 'PaymentController@execute');
Route::post('/create-payment', 'PaymentController@create')->name('create-payment');

Route::get('/plan/create', 'SubscriptionController@createSimplePlan');
Route::get('/plan/list', 'SubscriptionController@listPlans');
Route::get('/plan/{id}', 'SubscriptionController@getPlan');
Route::get('/plan/delete', 'SubscriptionController@deletePlan');
Route::get('/plan/{id}/activate', 'SubscriptionController@activatePlan');
Route::post('/plan/{id}/agreement/create', 'SubscriptionController@createAgreement');
Route::get('/execute-agreement/{status}', 'SubscriptionController@executeAgreement');