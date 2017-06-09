<?php
use Illuminate\Support\Facades\Input;
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
            
            Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder');
            Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate');

            Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate');

     // Central rutas       
    Route::get('central/departamentos', [
            'as' => 'central.sdepa',
            'uses' => 'CentralController@sdepa',
        ]);

    Route::get('contratoVinculacions/print/{id}', [
            'as' => 'contratoVinculacions.print',
            'uses' => 'ContratoVinculacionController@print_space',
        ]);
    Route::get('contratoPrestacionServicios/print/{id}', [
            'as' => 'contratoPrestacionServicios.print',
            'uses' => 'ContratoPrestacionServicioController@print_space',
        ]);
    Route::get('extractos/print/{id}', [
            'as' => 'extractos.print',
            'uses' => 'ExtractoController@print_space',
        ]);
/*
    Route::get('contratoVinculacions/print/{id}', [
            'as' => 'contratoVinculacions.print',
            'uses' => 'PdfController@vinculacion_print',
        ]);
*/
    Route::resource('triangulos', 'trianguloController');
    Route::resource('cuadros', 'cuadroController');
    Route::resource('departamentos', 'DepartamentoController');
    Route::resource('municipios', 'MunicipioController');
    Route::resource('naturals', 'NaturalController');
    Route::resource('juridicos', 'JuridicoController');
    Route::resource('vehiculos', 'VehiculoController');
    Route::resource('tarjetaPropiedads', 'Tarjeta_PropiedadController');
    Route::resource('soats', 'SoatController');
    Route::resource('tecnicomecanicas', 'TecnicomecanicaController');
    Route::resource('tarjetaOperacions', 'TarjetaOperacionController');
    Route::resource('polizaResponsabilidads', 'PolizaResponsabilidadController');
    Route::resource('revisionPreventivas', 'RevisionPreventivaController');
    Route::resource('contratoVinculacions', 'ContratoVinculacionController');
    Route::resource('contratoPrestacionServicios', 'ContratoPrestacionServicioController');
    Route::resource('licenciaConduccions', 'LicenciaConduccionController');
    Route::resource('extractos', 'ExtractoController');
    
});



