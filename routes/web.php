<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/admin', function () {
    return view('admin.layouts.index');
})->middleware('auth')->name('admin.dashboard');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin'], function () {

    Route::group(['prefix' => 'product'], function () {
        Route::get('/list', 'ProductController@index')->name('product.list');
        Route::get('/getList', 'ProductController@getList');
        Route::post('/create', 'ProductController@create');
        Route::get('/edit/{id}', 'ProductController@edit');
        Route::post('/update/{id}', 'ProductController@update');
        Route::delete('/destroy/{id}', 'ProductController@destroy');
        Route::get('/getCar/{id}', 'ProductController@getCar');
        Route::get('/search', 'ProductController@search')->name('product.search');
        Route::post('/getDataSearch', 'ProductController@getDataSearch');

    });

    Route::group(['prefix' => 'maker'], function () {
        Route::get('/list', 'MakerController@index')->name('maker.list');
        Route::get('/getList', 'MakerController@getList');
        Route::post('/create', 'MakerController@create');
        Route::get('/edit/{id}', 'MakerController@edit');
        Route::post('/update/{id}', 'MakerController@update');
        Route::delete('/destroy/{id}', 'MakerController@destroy');
    });

    Route::group(['prefix' => 'classCar'], function () {
        Route::get('/list', 'ClassCarController@index')->name('classCar.list');
        Route::get('/getList', 'ClassCarController@getList');
        Route::post('/create', 'ClassCarController@create');
        Route::get('/edit/{id}', 'ClassCarController@edit');
        Route::post('/update/{id}', 'ClassCarController@update');
        Route::delete('/destroy/{id}', 'ClassCarController@destroy');
    });

    Route::group(['prefix' => 'car'], function () {
        Route::get('/list', 'CarController@index')->name('car.list');
        Route::get('/getList', 'CarController@getList');
        Route::post('/create', 'CarController@create');
        Route::get('/edit/{id}', 'CarController@edit');
        Route::post('/update/{id}', 'CarController@update');
        Route::delete('/destroy/{id}', 'CarController@destroy');
    });

    Route::group(['prefix' => 'category'], function () {
        Route::get('/list', 'CategoryController@index')->name('category.list');
        Route::get('/getList', 'CategoryController@getList');
        Route::post('/create', 'CategoryController@create');
        Route::get('/edit/{id}', 'CategoryController@edit');
        Route::post('/update/{id}', 'CategoryController@update');
        Route::delete('/destroy/{id}', 'CategoryController@destroy');
    });

});
