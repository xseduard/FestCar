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