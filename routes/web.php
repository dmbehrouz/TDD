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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');

// Authentication Admin Routes...
Route::get('/adminlogin',function(){
    return view('admin.login');
})->name('admin.login');

//Route::get('adminlogin', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/adminlogin', 'Auth\AdminLoginController@login')->name('admin.post.login');
Route::post('/adminlogout', 'Auth\AdminLoginController@logout')->name('admin.logout');
Route::post('/profileupdate','UserController@update')->name('profile.update');

