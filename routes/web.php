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

//Route::get('/', function () {
//    return view('welcome');
//});
//测试翻译用
Route::get('testTranslate/{q}', 'UsersController@testTranslate')->name('testTranslate');

Route::get('/', 'PagesController@root')->name('root');
Route::get('/home', 'PagesController@root')->name('home');

//这一句牛逼了, 相当于定义了用户身份验证路由, 注册相关路由, 密码重置相关路由, email验证相关路由.
Auth::routes();

//等于下面:
//// 用户身份验证相关的路由
//Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
//Route::post('login', 'Auth\LoginController@login');
//Route::post('logout', 'Auth\LoginController@logout')->name('logout');
//
//// 用户注册相关路由
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//Route::post('register', 'Auth\RegisterController@register');
//
//// 密码重置相关路由
//Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
//
//// Email 认证相关路由
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

//这一句跟上面的首页冲突, 直接铲掉
//Route::get('/home', 'HomeController@index')->name('home');

//资源路由, 相当于
//Route::get('/users/{user}', 'UsersController@show')->name('users.show');
//Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');
//Route::patch('/users/{user}', 'UsersController@update')->name('users.update');

Route::resource('users', 'UsersController', ['only' => ['show', 'update', 'edit']]);

Route::resource('topics', 'TopicsController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);

//分类的路由
Route::resource('categories', 'CategoriesController', ['only' => ['show']]);

//给帖子增加图片
Route::post('upload_image', 'TopicsController@uploadImage')->name('topics.upload_image');

//参数表达式 {slug?} ，? 意味着参数可选，这是为了兼容我们数据库中 Slug 为空的话题数据。这种写法可以同时兼容以下两种链接：
//http://larabbs.test/topics/115
//http://larabbs.test/topics/115/slug-translation-test

Route::get('topics/{topic}/{slug?}', 'TopicsController@show')->name('topics.show');

//reply的路由, 只需要store跟destroy, 其他不重要
Route::resource('replies', 'RepliesController', ['only' => ['store', 'destroy']]);

