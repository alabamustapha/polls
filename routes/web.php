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

Route::group(['middleware' => ['auth', 'admin']], function(){
    Route::get('/admin', 'AdminController@dashboard')->name('dashboard');
    Route::get('/admin/polls', 'PollController@index')->name('manage_polls');
    Route::get('/admin/users', 'AdminController@showUsers')->name('manage_users');
    Route::get('/admin/polls/create', 'PollController@create')->name('create_poll');
    Route::get('/admin/polls/{poll}/edit', 'PollController@edit')->name('edit_poll');
    Route::put('/admin/polls/{poll}', 'PollController@update')->name('update_poll');
    Route::get('/admin/polls/{poll}', 'PollController@show')->name('poll_page');
    Route::delete('/admin/polls/{poll}', 'PollController@create')->name('delete_poll');
    Route::post('/admin/polls', 'PollController@store')->name('store_poll');
    Route::post('/{user}/toggle_status', 'AdminController@toggleUserStatus')->name('toggle_user_status');
    Route::get('admin/settings', 'SettingController@index')->name('setting');
    Route::put('admin/settings', 'SettingController@update')->name('update_setting');
    Route::put('admin/poll/{poll}', 'PollController@update')->name('update_poll');
    Route::put('admin/poll/{poll}/close_poll', 'PollController@closePoll')->name('close_poll');
    Route::delete('admin/poll/{poll}/delete', 'PollController@destroy')->name('delete_poll');
});
   



Route::group(['middleware' => ['auth','activated']], function(){
    Route::get('account_activation', 'ActivationController@showMessage')->name('account_activation');
    Route::get('/polls', 'HomeController@index')->name('home');
    Route::get('/polls/{poll}', 'HomeController@poll')->name('view_poll');
    Route::post('/polls/{poll}/votes', 'VoteController@store')->name('vote');
    Route::get('/user/security', 'HomeController@showUpdatePasswordForm')->name('update_password');
    Route::get('/user/history', 'HomeController@voteHistory')->name('history');
    Route::put('/user/{user}/update_password', 'HomeController@updatePassword')->name('update_security');
});
