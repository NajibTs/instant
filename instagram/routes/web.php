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



Auth::routes();

Route::get('/search','ProfilesController@search')->name('search.store');

Route::get('/', 'PostsController@index');

Route::get('/p/create', 'PostsController@create');
Route::post('/p', 'PostsController@store');
Route::get('/p/{post}', 'PostsController@show');
Route::get('/delete/{post}', 'PostsController@destroy')->name('delete');


Route::post('/like','HomeController@LikePost')->name('like');

Route::get('/role', function () {    
    
    $user = \App\User::first();   
    
    $user->roles()->sync([3]);

});

Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');


Route::resource('/user', 'UsersController');

// Route::post('/follow/{user}', 'UsersController@followUser')->name('user.follow');

 Route::get('users', 'HomeController@users')->name('users');

 Route::get('user/{id}', 'HomeController@user')->name('user.view');

 Route::resource("comments", "CommentController");



 Route::post('ajaxRequest', 'HomeController@ajaxRequest')->name('ajaxRequest');
 
 Route::post('ajaxRequest2', 'HomeController@ajaxRequest2')->name('ajaxRequest2');

Route::post('/like','PostsController@postLikePost')->name('like');
