<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group([
    'middleware' => ['api','jwt.verify']
  
], function ($router) {
Route::apiResource('/products', 'Admin\ProductController');
});

//Route::apiResource('/products', 'Admin\ProductController');
Route::post('/uploadFile', 'Admin\ProductController@store');

Route::get('/downloads', 'Admin\ProductController@getAllFiles');
Route::get('/downloads/{name}', 'Admin\ProductController@download');

Route::apiResource('/brands', 'Admin\ProductController');
Route::get('/brands', 'Admin\BrandController@getallbrands');
Route::get('/brands/getCategorybrand/{brandId}', 'Admin\BrandController@getCategoryBrand');
Route::get('/brands/getbrandsBasedOnCategory/{categoryId}', 'Admin\BrandController@getbrandsBasedOnCategory');

Route::get('/categories', 'Admin\CategoryController@getallcategories');
Route::get('/categories/getCategoryWithId/{id}', 'Admin\CategoryController@getCategoryWithId');
Route::get('/categories/getbrandsBasedOnCategory/{id}', 'Admin\CategoryController@getbrandsBasedOnCategory');

Route::get('/models', 'Admin\ModelController@getAllModels');
Route::get('/models/getBrandModel/{brandId}', 'Admin\ModelController@getBrandModel');
Route::get('/models/getModelsBasedOnBrand/{brandId}', 'Admin\ModelController@getModelsBasedOnBrand');
Route::get('/models/getModelsBasedOnBrandAndCategory/{brandId}/{categoryId}', 'Admin\ModelController@getModelsBasedOnBrandAndCategory');

Route::apiResource('/attachements', 'Admin\AttachementController');
//Route::get('/attachements', 'Admin\AttachementController@getallattachements');
Route::get('/attachements/{brandId}', 'Admin\AttachementController@getByID');


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('register', 'Auth\JWTAuthController@register');
    Route::post('login', 'Auth\JWTAuthController@login');
    Route::post('logout', 'Auth\JWTAuthController@logout');
    Route::get('refresh', 'Auth\JWTAuthController@refresh');
    Route::get('profile', 'Auth\JWTAuthController@profile');

});
