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
// Ver SQL Optimizador
/*
DB::Listen(Function($query){
    echo "<pre>{ $query->sql }</pre>";
    //echo "<pre>{ $query->time }</pre>";
});
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

        Route::get('register', function () { abort(403); });  //Desactivar Registro
        Route::post('register', function () { abort(403); });  //Desactivar Registro
        /*
        Route::get('register', 'Auth\AuthController@showRegistrationForm');
        Route::post('register', 'Auth\AuthController@register');
        */

        // Password Reset Routes...
        Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
        Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
        Route::post('password/reset', 'Auth\PasswordController@reset');

        //Rutas del generador
        /*    
        Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder');
        Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate');
        Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate');
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
    Route::resource('hojaVidas', 'HojaVidaController');
    Route::resource('empresas', 'EmpresaController');
    Route::resource('simuladorGastos', 'SimuladorGastoController');
    Route::resource('pqrsWebs', 'PqrsWebController');
    Route::resource('pqrsSeguimientos', 'PqrsSeguimientoController');

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

    //Emdisalud
    Route::resource('emdiPacientes', 'EmdiPacienteController');
    Route::resource('emdiLugars', 'EmdiLugarController');
    Route::resource('emdiConductors', 'EmdiConductorController');
    Route::resource('emdiAutorizacions', 'EmdiAutorizacionController');
    
    /**
    *  Central rutas       
    */
    Route::get('central/departamentos', [
            'as' => 'central.sdepa',
            'uses' => 'CentralController@sdepa',
        ]);

    /*
    Route::get('contratoVinculacions/print/{id}', [
            'as' => 'contratoVinculacions.print',
            'uses' => 'PdfController@vinculacion_print',
        ]);
    */
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

    Route::get('emdiAutorizacions/print/{id}', [
            'as' => 'emdiAutorizacions.print',
            'uses' => 'EmdiAutorizacionController@print_space',
        ]);
    Route::get('pagos/print/{id}', [
            'as' => 'pagos.print',
            'uses' => 'PagoController@print_space',
        ]);

    Route::post('ruta/buscar_id', [
            'as' => 'ruta.buscarid',
            'uses' => 'RutaController@buscar_by_id',
        ]);
    Route::post('vehiculos/cont_show_profile', [
            'as' => 'vehiculo.cont_show_profile',
            'uses' => 'VehiculoController@cont_show_profile',
        ]);

    /**
     * Informes Excel
    */
    Route::get('informes', [
            'as' => 'informes.index',
            'uses' => 'ExcelController@index',
        ]);

    Route::post('informes/generate', [
            'as' => 'informes.generate',
            'uses' => 'ExcelController@generate',
        ]);

    /**
     * Rutas Publicas
     */


    Route::get('pqrsPublic/create', [
            'as' => 'pqrsPublic.create',
            'uses' => 'PqrsPublicController@create',
        ]);
    Route::get('pqrsPublic/create', [
            'as' => 'pqrsPublic.create',
            'uses' => 'PqrsPublicController@create',
        ]);
    Route::get('pqrsPublic/store', [
            'as' => 'pqrsPublic.store',
            'uses' => 'PqrsPublicController@store',
        ]);
    Route::get('pqrsSeguimientos/create_with/{id}', [
            'as' => 'pqrsSeguimientos.create_with',
            'uses' => 'PqrsSeguimientoController@create_with',
        ]);


}); //End Route group

