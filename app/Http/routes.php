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


Route::get('token/error', [
            'as' => 'token.error',
            'uses' => function () {
                return view('errors.token_error');
            },
        ]);

Route::get('400', function () { abort(400); });
Route::get('401', function () { abort(401); });
Route::get('403', function () { abort(403); });
Route::get('404', function () { abort(404); });
Route::get('500', function () { abort(500); });
Route::get('504', function () { abort(504); });
Route::get('509', function () { abort(509); });


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

    Route::get('contratoVinculacions/aprobar/{id}', [
            'as' => 'contratoVinculacions.aprobar',
            'uses' => 'ContratoVinculacionController@aprobar',
        ]);

    Route::get('contratoPrestacionServicios/aprobar/{id}', [
            'as' => 'contratoPrestacionServicios.aprobar',
            'uses' => 'ContratoPrestacionServicioController@aprobar',
        ]);

    Route::get('recibos/print/{id}', [
            'as' => 'recibos.print',
            'uses' => 'ReciboController@print_space',
        ]);

    Route::post('ruta/buscar_id', [
            'as' => 'ruta.buscarid',
            'uses' => 'RutaController@buscar_by_id',
        ]);
/*
    Route::get('contratoVinculacions/print/{id}', [
            'as' => 'contratoVinculacions.print',
            'uses' => 'PdfController@vinculacion_print',
        ]);
*/

        //Clear Cache facade value:
        Route::get('/clear-cache', function() {
            $exitCode = Artisan::call('cache:clear');
            return '<h1>Cache facade value cleared</h1>';
        });

        //Reoptimized class loader:
        Route::get('/optimize', function() {
            $exitCode = Artisan::call('optimize');
            return '<h1>Reoptimized class loader</h1>';
        });

        //Clear Route cache:
        Route::get('/route-cache', function() {
            $exitCode = Artisan::call('route:cache');
            return '<h1>Route cache cleared</h1>';
        });

        //Clear View cache:
        Route::get('/view-clear', function() {
            $exitCode = Artisan::call('view:clear');
            return '<h1>View cache cleared</h1>';
        });

        //Clear Config cache:
        Route::get('/config-cache', function() {
            $exitCode = Artisan::call('config:cache');
            return '<h1>Clear Config cleared</h1>';
        });

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
    Route::resource('hojaVidas', 'HojaVidaController');
    Route::resource('empresas', 'EmpresaController');
    Route::resource('simuladorGastos', 'SimuladorGastoController');

    // Recibos
    Route::resource('reciboProductos', 'ReciboProductoController');
    Route::resource('recibos', 'ReciboController');
    Route::resource('reciboDetalles', 'ReciboDetalleController');

    // Pagos
    Route::resource('descuentos', 'DescuentoController');
    Route::resource('facturas', 'FacturaController');
    Route::resource('rutas', 'RutaController');
    Route::resource('pagos', 'PagoController');
    Route::resource('pagoRelFacturas', 'PagoRelFacturaController');
    Route::resource('pagoRelDescuentos', 'PagoRelDescuentoController');
    Route::resource('pagoRelRutas', 'PagoRelRutaController');
    
});


