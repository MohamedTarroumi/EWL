<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware(['api', 'cors'])
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
        // Route::group([
        //     'middleware' => ['api', 'cors'],
        //     'namespace' => $this->namespace,
        //     'prefix' => 'api',
        // ], function ($router) {
        //      //Add you routes here, for example:
        //      Route::apiResource('/products','Admin\ProductController');
        //      Route::post('/uploadFile' ,'Admin\ProductController@store');

        //      Route::get('/downloads','Admin\ProductController@getAllFiles');
        //      Route::get('/downloads/{name}', 'Admin\ProductController@download');

        //      Route::apiResource('/brands','Admin\ProductController');
        //      Route::get('/brands','Admin\BrandController@getallbrands');
        //      Route::get('/brands/getCategorybrand/{brandId}','Admin\BrandController@getCategoryBrand');
        //      Route::get('/brands/getbrandsBasedOnCategory/{categoryId}', 'Admin\BrandController@getbrandsBasedOnCategory');

        //     Route::get('/categories', 'Admin\CategoryController@getallcategories');
        //     Route::get('/categories/getCategoryWithId/{id}', 'Admin\CategoryController@getCategoryWithId');
        //     Route::get('/categories/getbrandsBasedOnCategory/{id}', 'Admin\CategoryController@getbrandsBasedOnCategory');

        //     Route::get('/models','Admin\ModelController@getAllModels');
        //     Route::get('/models/getBrandModel/{brandId}','Admin\ModelController@getBrandModel');
        //     Route::get('/models/getModelsBasedOnBrand/{brandId}', 'Admin\ModelController@getModelsBasedOnBrand');
        //     Route::get('/models/getModelsBasedOnBrandAndCategory/{brandId}/{categoryId}','Admin\ModelController@getModelsBasedOnBrandAndCategory');


           
           
        // });
    }
}
