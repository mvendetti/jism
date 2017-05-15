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

Route::resource('group.status', 'GroupStatusController', ['only' => ['index']]);
Route::resource('pod.status', 'PodStatusController', ['only' => ['index']]);
Route::resource('camera.status', 'CameraStatusController', ['only' => ['index']]);
Route::resource('group.record', 'GroupRecordController', ['only' => ['store']]);
Route::resource('pod.record', 'PodRecordController', ['only' => ['store']]);
Route::resource('camera.record', 'CameraRecordController', ['only' => ['store']]);
Route::resource('group.stop', 'GroupStopRecordController', ['only' => ['store']]);
Route::resource('pod.stop', 'PodStopRecordController', ['only' => ['store']]);
Route::resource('camera.stop', 'CameraStopRecordController', ['only' => ['store']]);
Route::resource('group.sleep', 'GroupSleepController', ['only' => ['store']]);
Route::resource('pod.sleep', 'PodSleepController', ['only' => ['store']]);
Route::resource('camera.sleep', 'CameraSleepController', ['only' => ['store']]);
Route::resource('group.wake', 'GroupWakeController', ['only' => ['store']]);
// Route::resource('pod.wake', 'PodWakeController', ['only' => ['store']]);
// Route::resource('camera.wake', 'CameraWakeController', ['only' => ['store']]);
Route::resource('pod', 'PodController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
Route::resource('camera', 'CameraController', ['only' => ['index', 'show']]);
