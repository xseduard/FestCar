<?php

namespace App\Repositories;

use App\Models\EmdiAutorizacion;
use App\Models\Empresa;
use InfyOm\Generator\Common\BaseRepository;

use App\Models\EmdiPaciente;
use App\Models\EmdiConductor;
use App\Models\EmdiLugar;
use Carbon\Carbon;
use Flash;

use Anouar\Fpdf\Fpdf as baseFpdf;


class EmdiAutorizacionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'ruta',
        'paciente_id',
        'cita_fecha',
        'cita_hora',
        'cita_lugar_id',
        'conductor_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return EmdiAutorizacion::class;
    }

    public function paciente_id(){
           $modelo = EmdiPaciente::all()->toArray();
            foreach ($modelo as $key => $value) {
                $array[$value['id']] = $value['cedula']." - ".$value['nombres']." ".$value['apellidos'];
            }
        return ($array);
    }

    public function cita_lugar_id(){                        
           return EmdiLugar::lists('nombre', 'id');
    }

    public function conductor_id(){                      
           $modelo = EmdiConductor::all()->toArray();
            foreach ($modelo as $key => $value) {
                $array[$value['id']] = $value['nombres']." ".$value['apellidos'];
            }
        return ($array);
    }

    function print_autorizaciones($id){
        $empresa = Empresa::first();
        $autorizacion  = EmdiAutorizacion::with('user')
        ->with('paciente')
        ->with('lugar')
        ->with('conductor')
        ->where('id',$id)
        ->first();

        $codigo = "37630-".str_pad($autorizacion->id, 4, "0", STR_PAD_LEFT);

        $pdf = new PDF_EMDI_AUTORIZACION('P','mm',array(216,279));
        $pdf->AddPage();
        $pdf->SetTitle($codigo." | AUTORIZACIÓN EMDISALUD",true);
        $pdf->SetSubject('Copia Autorización');
        $pdf->SetCreator('FestCar Project');
        $pdf->SetAuthor('@xsED');

        //$pdf->SetMargins(25,35,5);
        $pdf->SetLeftMargin(25);
        $pdf->SetTopMargin(20);
        $pdf->SetRightMargin(25);        
                

        $pdf->ln();

        $pdf->SetFont('helvetica','b',16);
        $pdf->SetTextColor(50);
        $pdf->Cell(0,9,utf8_decode("Autorización de Trasporte No. ".$codigo),"",1,"C");


        $pdf->ln(20);
        $pdf->SetFont('helvetica','',10);

        $pdf->Cell(0,9,utf8_decode("Fecha: ".$autorizacion->created_at->format('d')." de ".mb_strtoupper($autorizacion->created_at->format('F'),'utf-8')." de ".$autorizacion->created_at->format('Y')),"",1,"L");

        $pdf->Multicell(0,10,utf8_decode("EMDISALUD ESS EPS-S con nit  811004055-5 Autoriza a TRANSEBA S.A.S. con nit 900414811-9 a prestar el servicio de transporte de usuario, con los siguientes datos:"),"",'L');
        $pdf->ln();
        $pdf->SetFont('helvetica','B',10);
        $pdf->Cell(30,9,utf8_decode("Cédula"),"LTB",0,"C");
        $pdf->Cell(53,9,utf8_decode("Nombres y Apellidos"),"LTB",0,"C");
        $pdf->Cell(30,9,utf8_decode("Celular"),"LTB",0,"C");
        $pdf->Cell(53,9,utf8_decode("Ruta / Destino"),"LTBR",1,"C");

        $pdf->SetFont('helvetica','',10);
        $pdf->Cell(30,6,utf8_decode($autorizacion->paciente->cedula),"LT",0,"C");
        $pdf->Cell(53,6,utf8_decode($autorizacion->paciente->nombres),"LT",0,"C");
        $pdf->Cell(30,6,utf8_decode($autorizacion->paciente->celular),"LT",0,"C");
        $pdf->Cell(53,6,utf8_decode(substr($autorizacion->ruta, 0, 24)."-"),"LTR",1,"C");
        $pdf->Cell(30,6,"","LB",0,"L");
        $pdf->Cell(53,6,utf8_decode($autorizacion->paciente->apellidos),"LB",0,"L");
        $pdf->Cell(30,6,"","LB",0,"L");
        $pdf->Cell(53,6,utf8_decode(substr($autorizacion->ruta, 24, 49)),"LBR",1,"L");

        $pdf->ln(8);
        $pdf->SetFont('helvetica','B',10);
        $pdf->Cell(0,6,utf8_decode("Datos de la Cita"),"",1,"C");

        $pdf->Cell(30,9,utf8_decode("Dìa"),"LTB",0,"C");        
        $pdf->Cell(30,9,utf8_decode("Hora"),"LTB",0,"C");
        $pdf->Cell(53,9,utf8_decode("Lugar"),"LTB",0,"C");
        $pdf->Cell(53,9,utf8_decode("Dirección"),"LTBR",1,"C");

        $pdf->SetFont('helvetica','',10);
        $pdf->Cell(30,6,utf8_decode($autorizacion->cita_fecha->format('d-m-Y')),"LT",0,"C");        
        $pdf->Cell(30,6,utf8_decode($autorizacion->cita_hora),"LT",0,"C");
        $pdf->Cell(53,6,utf8_decode($autorizacion->lugar->nombre),"LT",0,"L");
        $pdf->Cell(53,6,utf8_decode(substr($autorizacion->lugar->direccion, 0, 24)."-"),"LTR",1,"L");
        $pdf->Cell(30,6,"","LB",0,"L");
        $pdf->Cell(30,6,"","LB",0,"L");
        $pdf->Cell(53,6,"","LB",0,"L");        
        $pdf->Cell(53,6,"","LBR",1,"L");

        $pdf->ln();
        $pdf->Multicell(0,10,utf8_decode("Conductor: ".$autorizacion->conductor->fullname." celular: ".$autorizacion->conductor->celular),"",'L');
        $pdf->ln();

        $pdf->ln(12);
        $pdf->Cell(70,4,"___________________________","",0,"C");
        $pdf->Cell(10,4,"","",0,"C"); //divisor
        $pdf->Cell(70,4,"___________________________","",1,"C");

        $pdf->Cell(70,5,"Firma Afiliado","",0,"C");       
        $pdf->Cell(10,4,"","",0,"C"); //divisor
        $pdf->Cell(70,5,$autorizacion->user->fullname,"",1,"C");
        $pdf->Cell(80,4,"","",0,"C"); //divisor
        $pdf->Cell(70,5,"CC: ".number_format($autorizacion->user->cedula, 0, '.', '.' ),"",1,"C");


        $pdf->Output();

    }
}

class PDF_EMDI_AUTORIZACION extends baseFpdf
{
       function Header()
    {
        // Logo
        $this->Image('pdf-templates/membrete-emdis-96ppp.jpg',0,0,0);
        $this->ln(45);
        // helvetica bold 15

        // Move to the right
        
        // Title
        // Line break  
    }
}
