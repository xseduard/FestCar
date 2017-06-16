<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where all API routes are defined.
|
*/

















Route::resource('triangulos', 'trianguloAPIController');

Route::resource('cuadros', 'cuadroAPIController');

Route::resource('departamentos', 'DepartamentoAPIController');

Route::resource('municipios', 'MunicipioAPIController');

Route::resource('naturals', 'NaturalAPIController');

Route::resource('juridicos', 'JuridicoAPIController');



Route::resource('vehiculos', 'VehiculoAPIController');

Route::resource('tarjeta__propiedads', 'Tarjeta_PropiedadAPIController');

Route::resource('soats', 'SoatAPIController');

Route::resource('tecnicomecanicas', 'TecnicomecanicaAPIController');

Route::resource('tarjeta_operacions', 'TarjetaOperacionAPIController');

Route::resource('poliza_responsabilidads', 'PolizaResponsabilidadAPIController');

Route::resource('revision_preventivas', 'RevisionPreventivaAPIController');

Route::resource('contrato_vinculacions', 'ContratoVinculacionAPIController');

Route::resource('contrato_prestacion_servicios', 'ContratoPrestacionServicioAPIController');

Route::resource('licencia_conduccions', 'LicenciaConduccionAPIController');

Route::resource('extractos', 'ExtractoAPIController');



Route::resource('hoja_vidas', 'HojaVidaAPIController');

Route::resource('empresas', 'EmpresaAPIController');

Route::resource('simulador_gastos', 'SimuladorGastoAPIController');