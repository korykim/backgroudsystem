<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use App\Models\address;
use Illuminate\Routing\Router;
use App\Http\Controllers\API\AuthController;



Admin::routes();


//Laravel 8路由配置方式
Route::any('/login', [AuthController::class, 'index']);
Route::post('/postLogin', [AuthController::class, 'postLogin']);

Route::any('/user/index',[UserController::class,'index']);
Route::post('/user/add',[UserController::class,'store']);
Route::get('/user/create',[UserController::class,'create']);

Route::get('/userprofile/index',[UserProfileController::class,'index']);
Route::get('/userprofile/add',[UserProfileController::class,'store']);


Route::get('/address/add',[AddressController::class,'store']);


Route::any('/product/index',[ProductController::class,'index']);
Route::any('/product/create',[ProductController::class,'create']);

Route::any('/tag/index',[TagController::class,'index']);


Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('cms-articles', CmsArticleController::class);


});
