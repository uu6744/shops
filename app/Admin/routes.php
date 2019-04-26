<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/specValue/create/{id}', 'ProductSpecValueController@create');// 商品规格值添加

    $router->get('/product/spec/{id}', 'ProductController@productSpec');
    $router->get('/', 'HomeController@index');




    $router->resource('/category', CategoryController::class);
    $router->resource('/product', ProductController::class);
    $router->resource('/ceshi', CeshiController::class);
    $router->resource('/spec', SpecController::class);
    // $router->resource('/specValue', ProductSpecValueController::class);
});
