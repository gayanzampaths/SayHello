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

Route::group(['middleware' => ['web']], function (){
    Route::get('/','PagesController@index', ['as' => '/']) -> name('/');
    Route::get('/about','PagesController@about')->name('about')->middleware('auth');
    Route::get('/timeline','PagesController@timeline', ['as' => 'timeline'])->middleware('auth')->name('timeline');
    Route::post('/signup', 'UsersController@postSignUp', ['as' => 'signup'])->name('signup');
    Route::post('/signin', 'UsersController@postSignIn', ['as' => 'signin']) ->name('signin');
    Route::post('/createpost', 'PostController@postCreatePost', ['as' => 'post.create'])-> name('post.create')->middleware('auth');
    Route::get('/deletepost/{post_id}', 'PostController@getDeletePost', ['as' => 'post.delete'])->name('post.delete')->middleware('auth');
    Route::get('/logout', 'UsersController@getLogout', ['as' => 'logout']) -> name('logout');
    Route::post('/edit', 'PostController@postEditPost')->name('edit')->middleware('auth');
    Route::get('/profile', 'PagesController@profile')->name('profile')->middleware('auth');
    Route::get('profileedit', 'PagesController@editProfile')->name('profile.edit')->middleware('auth');
    Route::post('/profilesave', 'UsersController@saveProfile')->name('profile.save')->middleware('auth');
    Route::get('/userimage/{filename}', 'UsersController@fetchImage')->name('profile.image')->middleware('auth');
    Route::post('/like', 'PostController@likePost')->name('post.like')->middleware('auth');
});


