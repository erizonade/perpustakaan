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

Route::get('/', 'AuthController@index', 'login');
Route::get('logout', 'AuthController@logout', 'auth.logout');
Route::get('/profil', 'AuthController@profil')->name('profil');
Route::post('login', 'AuthController@login', 'auth.login');
Route::post('/reset_password', 'AuthController@reset_password')->name('reset_password');

Route::prefix('admin')->middleware(['akses:A'])->group(function () {
    Route::get('/', 'admin\AdminController@index')->name('admin.index');
    Route::resource('creator_book', 'admin\CreatorBooksController')->names('creator_book');
    Route::resource('book', 'admin\BooksController')->names('book');
    Route::resource('user', 'admin\UserController')->names('users');
});
Route::prefix('guest')->middleware(['akses:G'])->group(function () {
    Route::get('/', 'guest\GuestController@index')->name('guest.index');
    Route::get('/filter_book/{search}', 'guest\GuestController@filter_book')->name('guest.filter_book');
});
