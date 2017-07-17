<?php

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

Route::get('/', function () {return view('welcome');});

/// ログイン・ログアウト
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
 
/* ユーザー登録画面の表示 */
Route::get('auth/register', 'Auth\AuthController@getRegister');
/* ユーザー登録処理 */
Route::post('auth/register', 'Auth\AuthController@postRegister');
//会員登録後、ログイン後に飛ばされるホーム画面
Route::get('/home', [
            'middleware' => 'auth', 
            'uses' => 'ProjectController@index',
            ]);
// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');
// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

//プロジェクトに対する操作
Route::post('project/destroy/{uuid}', 'ProjectController@destroy');
Route::post('project/create', 'ProjectController@create');


//Mindmap
//Route::post('project/editmm/{uuid}', [
//            'middleware' => 'auth', 
//            'uses' => 'ProjectController@editMindmap',
//            ]);
Route::get('project/editmm/{uuid}', [
            'middleware' => 'auth', 
            'uses' => 'ProjectController@editMindmap',
            ]);

Route::post('project/postmm', 'ProjectController@postMindmap');
Route::post('project/tomm', 'ProjectController@toMindmap');

//Gantt chart
//Route::post('project/editga/{uuid}', [
//            'middleware' => 'auth', 
//            'uses' => 'ProjectController@editGantt',
//            ]);
Route::get('project/editga/{uuid}', [
            'middleware' => 'auth', 
            'uses' => 'ProjectController@editGantt',
            ]);
Route::post('project/postga', 'ProjectController@postGantt');
Route::post('project/toga','ProjectController@toGantt');

Route::get('/', 'ProjectController@index')->middleware('auth');
//Route::get('/', ['middleware' => 'auth','uses' => 'ProjectController@index',]);


