<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\Natural;
use App\Models\Juridico;
use App\Models\Vehiculo;
use App\Models\ContratoPrestacionServicio;
use App\Models\LicenciaConduccion;
use App\Models\Tarjeta_Propiedad;
use Carbon\Carbon;
use Flash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos = [];
        $datos['contador_natural'] = Natural::get()->count();
        $datos['contador_juridico'] = Juridico::get()->count();
        $datos['contador_vehiculo'] = Vehiculo::get()->count();
        //dd($datos);
        return view('home')->with(['datos' => $datos]);
    }
}
