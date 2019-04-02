<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('devices', 'OnosController@devices');
Route::post('devices/id', 'OnosController@getDevicesById');
Route::post('devices/ports', 'OnosController@getDevicePorts');
Route::post('links', 'OnosController@getLinks');
Route::post('hosts', 'OnosController@getHosts');
Route::post('topology', 'OnosController@getTopology');
Route::post('intents', 'OnosController@getIntents');
Route::post('intents/add', 'OnosController@addIntents');
Route::post('intents/delete', 'OnosController@deleteIntent');
Route::post('flows', 'OnosController@getFlows');
Route::post('flows/delete', 'OnosController@deleteFlows');
Route::post('applications', 'OnosController@getApplications');
Route::post('applications/active', 'OnosController@activeApp');
Route::post('applications/deactivate', 'OnosController@deactivateApp');
Route::post('statistics', 'OnosController@getStatByDevice');
Route::post('statistics/port', 'OnosController@getStatsByPORT');
Route::post('qos', 'OnosController@createQosFlow');