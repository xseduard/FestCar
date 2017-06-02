<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Flash;
use App\Repositories\ContratoVinculacionRepository;
use Illuminate\Support\Facades\Auth;
use Response;
use App\Http\Requests;
use Pdf;

//modelos

use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\Natural;
use App\Models\Juridico;
use App\Models\Vehiculo;
use App\Models\ContratoPrestacionServicio;
use App\Models\LicenciaConduccion;
use App\Models\ContratoVinculacion;

class PdfController extends AppBaseController
{
	private $contratoVinculacionRepository;
    

    public function __construct(ContratoVinculacionRepository $contratoVinculacionRepo)
    {
        $this->middleware('auth');
        $this->contratoVinculacionRepository = $contratoVinculacionRepo;
    }

     public function crearPDF($datos,$vistaurl,$tipo)
    {

        $data = $datos;
        $date = date('Y-m-d');
        $view =  \View::make($vistaurl, compact('data', 'date'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        
        if($tipo==1){return $pdf->stream('reporte');}
        if($tipo==2){return $pdf->download('reporte.pdf'); }
    }


    public function crear_reporte_porpais($tipo){

     $vistaurl="pdf.reporte_por_pais";
     $paises=Pais::all();
     
     return $this->crearPDF($paises, $vistaurl,$tipo);

    }

    public function invoice() 
    {


        $data = $this->getData();
        $date = date('Y-m-d');
        $invoice = "2222";
        $view =  \View::make('pdf.invoice', compact('data', 'date', 'invoice'))->render();        
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        dd($pdf->stream('invoice'));
        return $pdf->stream('invoice');
    }

    public function getData() 
    {
        $data =  [
            'quantity'      => '1' ,
            'description'   => 'some ramdom text',
            'price'   => '500',
            'total'     => '500'
        ];
        return $data;
    }

    public function vinculacion_print($id){
    	
    	$contratoVinculacion = $this->contratoVinculacionRepository->findWithoutFail($id);

        if (empty($contratoVinculacion)) {
            Flash::error('Contrato de Vinculación No se encuentra registrado.');

            return redirect(route('contratoVinculacions.index'));
        }

        return $this->invoice();
    }
}
