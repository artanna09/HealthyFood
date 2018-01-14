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
/*
Route::get('/', function () {
    return view('welcome');
});

Route::get('/users/{name}/{id}', function ($name, $id) {
    return 'This is user '.$name. ' with an id of '.$id;
});
*/

Route::get('/', 'PagesController@index' );
Route::get('/consists', 'PagesController@consists' );
Route::get('/methods', 'PagesController@methods' );
Route::resource('posts','PostsController');
Auth::routes();
Route::get('/dashboard', 'DashboardController@index');
Route::get('/consists', 'ConsistsController@index');
Route::get('/consists/{id}', 'ConsistsController@find');
Route::get('/methods', 'MethodsController@index');
Route::get('/methods/{id}', 'MethodsController@find');