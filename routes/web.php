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

/*
 |--------------------------------------------------------------------------
 | Front routes
 |--------------------------------------------------------------------------
 |
 */

Route::get('/', 'Front\PageController@index');

/*
 |--------------------------------------------------------------------------
 | Authentification routes
 |--------------------------------------------------------------------------
 |
 */

Auth::routes();

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

/*
 |--------------------------------------------------------------------------
 | Cart routes
 |--------------------------------------------------------------------------
 |
 */

Route::post('cart', 'Shop\CartController@add');
Route::patch('cart', 'Shop\CartController@update');
Route::delete('cart/coupon', 'Shop\CartController@removeCoupon');
Route::post('cart/get_price', 'Shop\CartController@getPrice');
Route::post('cart/coupon', 'Shop\CartController@addCoupon');
Route::delete('cart/{row_id}', 'Shop\CartController@remove');

/*
 |--------------------------------------------------------------------------
 | Auth routes
 |--------------------------------------------------------------------------
 |
 */

Route::group(['middleware' => 'auth'], function() {

    /*
    |--------------------------------------------------------------------------
    | Dev routes
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['prefix' => 'dev', 'as' => 'dev.', 'middleware' => 'role:dev'], function() {
        Route::get('/', 'Dev\HomeController@index')->name('index');
        Route::get('account', 'Dev\HomeController@account')->name('account');
        Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
        Route::get('user', 'Dev\UserController@index')->name('user');
        Route::get('user/login_as/{user}', 'Dev\UserController@loginAs');
        Route::resource('page', 'Dev\PageController');
        Route::resource('global', 'Dev\GlobalController', ['only' => [
            'edit', 'update'
        ]]);
    });

    /*
    |--------------------------------------------------------------------------
    | Admin routes
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'role:admin'], function() {
        Route::get('/', 'Admin\HomeController@index')->name('index');
        Route::get('account', 'Admin\HomeController@account')->name('account');
        Route::resource('page', 'Admin\PageController', ['only' => [
            'index', 'edit', 'update'
        ]]);
        Route::resource('global', 'Admin\GlobalController', ['only' => [
            'edit', 'update'
        ]]);
    });

    /*
    |--------------------------------------------------------------------------
    | Client routes
    |--------------------------------------------------------------------------
    |
    */

    Route::group(['prefix' => 'client', 'as' => 'client.', 'middleware' => 'role:client'], function() {
        Route::get('/', 'Client\ClientController@index')->name('index');
        Route::get('/account', 'Client\ClientController@account')->name('account');
    });

    /*
    |--------------------------------------------------------------------------
    | Account routes
    |--------------------------------------------------------------------------
    |
    | Devs, Admins and Clients all have an account which can be managed on these
    | routes.
    |
    */

    Route::group(['prefix' => 'account', 'as' => 'account.'], function() {
        Route::patch('/info', 'Misc\AccountController@updateInfo');
        Route::patch('/password', 'Misc\AccountController@updatePassword');
    });

    /*
    |--------------------------------------------------------------------------
    | Upload route
    |--------------------------------------------------------------------------
    |
    */

    Route::post('upload/temp', 'Misc\UploadController@toTemp');
    Route::post('upload/rich_text_image', 'Misc\UploadController@richTextImage');
});

/*
|--------------------------------------------------------------------------
| Front routes
|--------------------------------------------------------------------------
|
*/

Route::post('contact', 'Front\ContactController@contact');
