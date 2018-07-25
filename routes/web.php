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

//Route::get('/','PagesController@index');
//Route::get('/about','PagesController@about');
//Route::get('/timeline','PagesController@timeline', ['as' => 'timeline']);
//Route::post('/signup', 'UsersController@postSignUp', ['as' => 'signup']);
//Route::post('/signin', 'UsersController@postSignIn', ['as' => 'signin']);

Route::group(['middleware' => ['web']], function (){
    Route::get('/','PagesController@index', ['as' => '/']) -> name('/');
    Route::get('/about','PagesController@about')->middleware('auth');
    Route::get('/timeline','PagesController@timeline', ['as' => 'timeline'])->middleware('auth')->name('timeline');
    Route::post('/signup', 'UsersController@postSignUp', ['as' => 'signup']);
    Route::post('/signin', 'UsersController@postSignIn', ['as' => 'signin']);
    Route::post('/createpost', 'PostController@postCreatePost', ['as' => 'post.create'])->middleware('auth');
    Route::get('/deletepost/{post_id}', 'PostController@getDeletePost', ['as' => 'post.delete'])->middleware('auth')->name('post.delete');
    Route::get('/logout', 'UsersController@getLogout', ['as' => 'logout']) -> name('logout');
});


