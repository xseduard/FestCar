<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return redirect('/home');
});
/*
Route::get('/', function () {
    return view('auth.login');
});
*/

/*
|--------------------------------------------------------------------------
| API routes
|--------------------------------------------------------------------------
*/
/*
Route::group(['prefix' => 'api', 'namespace' => 'API'], function () {
    Route::group(['prefix' => 'v1'], function () {
        require config('infyom.laravel_generator.path.api_routes');
    });
});
*/
Route::group(['middleware' => 'web'], function() {
	//Route::auth();

	Route::get('/home', 'HomeController@index');
    // RUTAS DE CONTROL DE USUARIOS
	    Route::get('login', 'Auth\AuthController@showLoginForm');
        Route::post('login', 'Auth\AuthController@login');
        Route::get('logout', 'Auth\AuthController@logout');

        // Registration Routes...
            Route::get('register', 'Auth\AuthController@showRegistrationForm');
            Route::post('register', 'Auth\AuthController@register');

        // Password Reset Routes...
            Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
            Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
            Route::post('password/reset', 'Auth\PasswordController@reset');

     // Central rutas       
    Route::get('central/departamentos', [
            'as' => 'central.sdepa',
            'uses' => 'CentralController@sdepa',
        ]);

    Route::resource('triangulos', 'trianguloController');
    Route::resource('cuadros', 'cuadroController');
    Route::resource('departamentos', 'DepartamentoController');
    Route::resource('municipios', 'MunicipioController');
});
