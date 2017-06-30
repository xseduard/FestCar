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
use App\Models\ContratoVinculacion;
use App\Models\LicenciaConduccion;
use App\Models\Tarjeta_Propiedad;
use Carbon\Carbon;
use Flash;
use Auth;

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


        $cont  = [];
        $datos = [];

        if (Auth::user()->role == 'autorizador_emdisalud') {
            
          return view('home_emdisalud')->with(['cont' => $cont, 'datos' => $datos]);
        }

        $cont['natural']  = Natural::get()->count();
        $cont['juridico'] = Juridico::get()->count();
        $cont['vehiculo'] = Vehiculo::get()->count();

        $cv = ContratoVinculacion::get();

        $cont['cv-total']      = $cv->count();
        $cont['cv-vigente']    = $cv->where('vigente',true)->count();
        $cont['cv-cv-vigente'] = $cv->where('tipo_contrato','CV')->where('vigente',true)->count();
        $cont['cv-cp-vigente'] = $cv->where('tipo_contrato','CP')->where('vigente',true)->count();
        $cont['cv-cc-vigente'] = $cv->where('tipo_contrato','CC')->where('vigente',true)->count();
        $cont['cv-af-vigente'] = $cv->where('tipo_contrato','AF')->where('vigente',true)->count();

        //dd($cont);
        return view('home')->with(['cont' => $cont, 'datos' => $datos]);
    }

        public function indexEmdisalud()
    {
        $cont  = [];
        $datos = [];
        

        //dd($cont);
        return view('home_emdisalud')->with(['cont' => $cont, 'datos' => $datos]);
    }
}
