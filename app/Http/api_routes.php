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