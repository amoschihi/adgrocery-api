<?php


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

Route::group([

    'middleware' => 'api',

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('loginWithGoogle', 'AuthController@loginWithGoogle');
    Route::post('loginWithFacebook', 'AuthController@loginWithFacebook');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');

    Route::post('sendRestPasswordLink', 'RestPasswordController@sendMail');
    Route::post('resetPassword', 'RestPasswordController@process');
    Route::get('me', 'AuthController@me');

    Route::get('GInfoSite', 'InfoSiteController@get');
    Route::put('UInfoSite', 'InfoSiteController@update');

    Route::get('GAR', 'RegionController@getRegions');
    Route::put('UR', 'RegionController@update');
    Route::post('SR', 'RegionController@save');
    Route::delete('DR/{id}', 'RegionController@delete');

    Route::get('GACAT', 'CategoryController@getCategories');
    Route::put('UCAT', 'CategoryController@update');
    Route::post('SCAT', 'CategoryController@save');
    Route::delete('DCAT/{id}', 'CategoryController@delete');

    Route::get('GASCAT', 'SubCategoryController@getSubCategories');
    Route::put('USCAT', 'SubCategoryController@update');
    Route::post('SSCAT', 'SubCategoryController@save');
    Route::delete('DSCAT/{id}', 'SubCategoryController@delete');

    Route::get('GAMAR', 'BrandController@getBrands');
    Route::put('UMAR', 'BrandController@update');
    Route::post('SMAR', 'BrandController@save');
    Route::delete('DMAR/{id}', 'BrandController@delete');

    Route::get('GAPRODBID/{id}', 'ProductController@getById');
    Route::get('GAPRODBLID', 'ProductController@getByListId');
    Route::get('GAPRODNA', 'ProductController@getNewArrival');
    Route::get('GAPRODOS', 'ProductController@getOnSale');
    Route::get('GAPRODBN', 'ProductController@getByName');
    Route::get('GAPRODBLIDWP', 'ProductController@getByListIdWithoutPaginator');
    Route::get('GAPROD', 'ProductController@get');
    Route::put('UPROD', 'ProductController@update');
    Route::post('SPROD', 'ProductController@save');
    Route::delete('DPROD/{id}', 'ProductController@delete');
    Route::delete('DIPROD/{id}/{name}', 'ProductController@deleteImage');

    Route::get('GACOL', 'ColorController@getColors');
    Route::put('UCOL', 'ColorController@update');
    Route::post('SCOL', 'ColorController@save');
    Route::delete('DCOL/{id}', 'ColorController@delete');


    Route::get('GARED', 'DiscountController@get');
    Route::put('URED', 'DiscountController@update');
    Route::post('SRED', 'DiscountController@save');
    Route::delete('DRED/{id}', 'DiscountController@delete');

    Route::get('GACMDA', 'OrderAdminController@get');
    Route::put('UCMDA', 'OrderAdminController@update');
    Route::delete('DCMDA/{id}', 'OrderAdminController@delete');
    Route::get('GCMDA/{id}', 'OrderAdminController@getById');


    Route::get('GACMD', 'OrderController@get');
    Route::post('SCMD', 'OrderController@saveCash');

    Route::get('GATL', 'DeliveryTypeController@get');
    Route::put('UTL', 'DeliveryTypeController@update');
    Route::post('STL', 'DeliveryTypeController@save');
    Route::delete('DTL/{id}', 'DeliveryTypeController@delete');

    Route::get('GACT', 'NewsController@get');
    Route::get('GAACT', 'NewsController@getAll');
    Route::put('UACT', 'NewsController@update');
    Route::post('SACT', 'NewsController@save');
    Route::delete('DACT/{id}', 'NewsController@delete');

    Route::get('GATAR/{id}', 'rateController@get');
    Route::get('GTAR', 'rateController@get2');
    Route::put('UTAR', 'rateController@update');
    Route::post('STAR', 'rateController@save');
    Route::delete('DTAR/{id}', 'rateController@delete');


    Route::get('GAPWL', 'wishlistController@get');
    Route::post('SPWL', 'wishlistController@save');
    Route::post('SPUWL', 'wishlistController@save2');
    Route::delete('DPWL/{id}', 'wishlistController@delete');
    Route::delete('DAPWL', 'wishlistController@deleteAll');

    Route::get('GAPCOM', 'compareController@get');
    Route::post('SPCOM', 'compareController@save');
    Route::post('SPUCOM', 'compareController@save2');
    Route::delete('DPCOM/{id}', 'compareController@delete');
    Route::delete('DAPCOM', 'compareController@deleteAll');

    Route::get('GAPSC', 'shoppingCartController@get');
    Route::post('SPSC', 'shoppingCartController@save');
    Route::put('UPSC', 'shoppingCartController@update');
    Route::delete('DPSC/{id}', 'shoppingCartController@delete');
    Route::delete('DAPSC', 'shoppingCartController@deleteAll');


    Route::get('GAMAT', 'MaterialController@getMaterials');
    Route::put('UMAT', 'MaterialController@update');
    Route::post('SMAT', 'MaterialController@save');
    Route::delete('DMAT/{id}', 'MaterialController@delete');


    Route::get('GAV', 'CityController@getCities');
    Route::put('UV', 'CityController@update');
    Route::post('SV', 'CityController@save');
    Route::delete('DV/{id}', 'CityController@delete');

    Route::get('GP', 'ProfileController@get');
    Route::put('UP', 'ProfileController@update');
    Route::post('CHP', 'ProfileController@changePassword');


    Route::post('SC', 'contactController@sendContact');

    Route::get('GA', 'AddressController@get');
    Route::get('GAPer', 'AddressController@getAPer');
    Route::get('GAPro', 'AddressController@getAPro');
    Route::put('UA', 'AddressController@update');


});