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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/brands', 'Admin\BrandController@getallbrands')->name('brands');
Route::get('/products', 'Admin\ProductController@index')->name('products');
Route::get('/products/file', 'Admin\ProductController@uploadFile')->name('uploadfile');
Route::post('/products/store', 'Admin\ProductController@store')->name('books.store');
Route::get('/products/download/', 'Admin\ProductController@getAllFiles')->name('EMS.downloads');
Route::get('/products/download/{name}', 'Admin\ProductController@download')->name('getfile');

Route::get('/brands/getCategorybrand/{brandId}', 'Admin\BrandController@getCategoryBrand')->name('getCategoryBrand');
Route::get('/brands/getbrandsBasedOnCategory/{categoryId}', 'Admin\BrandController@getbrandsBasedOnCategory')->name('getbrandsBasedOnCategory');

Route::get('/categories', 'Admin\CategoryController@getallcategories')->name('categories');
Route::get('/categories/getCategoryWithId/{id}', 'Admin\CategoryController@getCategoryWithId')->name('getCategoryWithId');
Route::get('/categories/getbrandsBasedOnCategory/{id}', 'Admin\CategoryController@getbrandsBasedOnCategory')->name('getbrandsBasedOnCategory');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


