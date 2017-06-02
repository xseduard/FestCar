<?php

namespace App\Repositories;

use App\Models\ContratoVinculacion;
use InfyOm\Generator\Common\BaseRepository;
use Anouar\Fpdf\Fpdf as baseFpdf;

//Models
use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\Natural;
use App\Models\Juridico;
use App\Models\Vehiculo;
use App\Models\ContratoPrestacionServicio;
use App\Models\LicenciaConduccion;

use App\Repositories\scriptFPDF;


class ContratoVinculacionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'tipo_contrato',
        'tipo_proveedor',
        'natural_id',
        'juridico_id',
        'vehiculo_id',
        'servicio',
        'fecha_inicio',
        'fecha_final',
        'user_id',
        'aprobado',
        'fecha_aprobacion',
        'usuario_aprobacion'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ContratoVinculacion::class;
    }

    function print_contratos($id){
         //pdf
        $contrato = $this->findWithoutFail($id);
        global $codigo;
        $codigo = $contrato->tipo_contrato.str_pad($contrato->id, 4, "0", STR_PAD_LEFT);
        
        $data = [
        'representante_transeba' => strtoupper($contrato->rl_name).' '.strtoupper ($contrato->rl_lastname),
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
       
        ];

        $pdf = new scriptFPDF('P','mm','A4');

        $pdf->header();
        //$pdf->Cell(Ancho,Alto,"Texto",borde,Ln 0=derecha 1=siguiente linea 2=debajo,'L/C/R',relleno true/false);
        $pdf->AddPage();
        $pdf->SetTitle($codigo." | Contrato Transeba S.A.S",true);
        $pdf->SetSubject('Copia Contrato Transeba S.A.S');
        $pdf->SetCreator('FestCar Project');
        $pdf->SetAuthor('xsEduard');
        //$pdf->SetAutoPageBreak(true);
        $pdf->SetFont('Arial','B',15);
        $pdf->Cell(160,8,utf8_decode("CONTRATO ADMINISTRACIÓN DE FLOTA"),0,1,"C");
        $pdf->Cell(160,8,utf8_decode($codigo),0,1,"C");
        $pdf->SetFont('Arial','',12);
        $pdf->Ln();
        $pdf->Ln();

        // Stylesheet
        $pdf->SetStyle("p","Arial","N",12,"50,50,50",0);
        $pdf->SetStyle("b","Arial","B",0,"102,153,153");

        $pdf->SetLineWidth(0.5);

// Text
$af = \View::make('pdf.af')->render(); 
// $view =  \View::make('pdf.invoice', compact('data', 'date', 'invoice'))->render(); 

        $pdf->WriteTag(0,6,utf8_decode($af),0,"J",0,0);
        $pdf->Ln();
        $pdf->Ln();
        $pdf->AliasNbPages();
        $pdf->Output();
    exit;
    } //termina funcion print_contratos


} //TERMINA CLASE REPOSITORIO
