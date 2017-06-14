<?php

namespace App\Repositories;

use App\Models\Extracto;
use App\Models\Empresa;
use InfyOm\Generator\Common\BaseRepository;
use Carbon\Carbon;
use Jenssegers\Date\Date;
use App\Repositories\FPDF_EXTRACTOS;

use Anouar\Fpdf\Fpdf as baseFpdf;

class ExtractoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'codigo',
        'ContratoPrestacionServicio_id',
        'recorrido',
        'conductor_uno',
        'conductor_dos',
        'conductor_tres',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Extracto::class;
    }
    function traducir_fecha($date){
            return new Date($date);
        }
    
    function print_extractos($id){
        $empresa = Empresa::first();
        $extracto =  Extracto::with('cps.natural')
        ->with('cps.juridico.natural')
        ->with('vehiculo.tarjetaoperacion')
        ->with('cps.origen.departamento')
        ->with('cps.destino.departamento')
        ->with('tarjetaoperacion')
        ->with('conductoruno')
        ->with('conductordos')
        ->with('conductortres')
        ->where('id',$id)
        ->first();

        //dd($extracto->vehiculo->tarjetaoperacion[0]->vigente);
        //dd($extracto->vehiculo->tarjetaoperacion);
        /*
        foreach ($modelo as $key => $value) {
            if ($value->vigente) {
                return $value;
            }                
        }
        */
        //dd($extracto->vehiculo);
        $tar_operacion_vigente = $extracto->vehiculo->tarjetaoperacion;

        $fecha_test = Carbon::createFromFormat('Y-m-d', '2017-06-06');
        //dd($fecha_test);
        //dd($extracto->created_at->format('l j F Y H:i:s'));
        //dd($tar_operacion_vigente->where('fecha_vigencia_final', '<', $fecha_test));
        //dd($tar_operacion_vigente[0]->fecha_vigencia_final->format('l j F Y H:i:s'));


        $codigo_cont = 'CPS'.str_pad($extracto->id, 4, "0", STR_PAD_LEFT);
        $codigo = 'CPS'.str_pad($extracto->id, 4, "0", STR_PAD_LEFT);
        global $codigo_cont; 
        
        

        $data = [
        'mi_empresa_nombre' => $empresa->razon_social,
        'mi_empresa_nombre_corto' => $empresa->nombre_corto,
        'mi_empresa_nit' => $empresa->nit,
        ];
        $objeto_contrato_cps = "";
        if ($extracto->cps->s1) {
            if (!empty($objeto_contrato_cps)) {
                $objeto_contrato_cps .= ", ";
            }
            $objeto_contrato_cps .= "Transporte de funcionarios, empleados o contratistas, incluyendo traslados a lugares no previstos en los recorridos diarios";
        }
        if ($extracto->cps->s2) {
            if (!empty($objeto_contrato_cps)) {
                $objeto_contrato_cps .= ", ";
            }
            $objeto_contrato_cps .= "Transporte de estudiantes entre el lugar de residencia y el establecimiento educativo u otros destinos que se requieran en razón de las actividades programadas por el plantel educativo";
        }
        if ($extracto->cps->s3) {
            if (!empty($objeto_contrato_cps)) {
                $objeto_contrato_cps .= ", ";
            }
            $objeto_contrato_cps .= "Transporte expreso para trasladar a todas las personas que hacen parte del grupo";
        }
        if ($extracto->cps->s4) {
            if (!empty($objeto_contrato_cps)) {
                $objeto_contrato_cps .= ", ";
            }
            $objeto_contrato_cps .= "Transporte de usuarios, que por su condición o estado no requieran de una ambulancia de traslado asistencial básico o medicalizado";
        }
        if ($extracto->cps->s5) {
            if (!empty($objeto_contrato_cps)) {
                $objeto_contrato_cps .= ", ";
            }
            $objeto_contrato_cps .= "Transporte expreso con fines Turisticos";
        }


       if ($extracto->cps->tipo_cliente == 'Natural') {
           $data['contratante_nombre'] = mb_strtoupper($extracto->cps->natural->nombres." ".$extracto->cps->natural->apellidos,'utf-8');
           $data['documento_contratante'] = $extracto->cps->natural->cedula; 
        } elseif ($extracto->cps->tipo_cliente == 'Juridico') {
            $data['contratante_nombre'] = mb_strtoupper($extracto->cps->juridico->nombre,'utf-8');
            $data['documento_contratante'] = $extracto->cps->juridico->nit; 
        }
            $c2_nombre      = "";
            $c2_apellidos   = "";
            $c2_cedula      = "";
            $c2_licencia    = "";
            $c2_vigencia    = "";
            $c3_nombre      = "";
            $c3_apellidos   = "";
            $c3_cedula      = "";
            $c3_licencia    = "";
            $c3_vigencia    = "";

            $r_nombre      = "";
            $r_apellidos    = "";
            $r_cedula       = "";
            $r_telefono     = "";
            $r_direccion    = "";

        if (!is_null($extracto->conductordos)) {
            $c2_nombre      = mb_strtoupper($extracto->conductordos->nombres,'utf-8');
            $c2_apellidos   = mb_strtoupper($extracto->conductordos->apellidos,'utf-8');
            $c2_cedula      = number_format($extracto->conductordos->cedula, 0, '.', '.' );
            $c2_licencia    = $extracto->conductordos->cedula;
            $c2_vigencia    = $extracto->f_licencia_dos;
        }
        if (!is_null($extracto->conductortres)) {
            $c3_nombre      = mb_strtoupper($extracto->conductortres->nombres,'utf-8');
            $c3_apellidos   = mb_strtoupper($extracto->conductortres->apellidos,'utf-8');
            $c3_cedula      = number_format($extracto->conductortres->cedula, 0, '.', '.' );
            $c3_licencia    = $extracto->conductortres->cedula;
            $c3_vigencia    = $extracto->f_licencia_tres;
        }
        if (!is_null($extracto->cps->responsable)) {
            $r_nombre      = mb_strtoupper($extracto->cps->responsable->nombres,'utf-8');
            $r_apellidos    = mb_strtoupper($extracto->cps->responsable->apellidos,'utf-8');
            $r_cedula       = number_format($extracto->cps->responsable->cedula, 0, '.', '.' );
            $r_telefono     = $extracto->cps->responsable->telefono;
            $r_direccion    = substr($extracto->cps->responsable->direccion, 0, 73);
        }
        

        $pdf = new PDF('P','mm',array(216,279));

        //$pdf->Cell(Ancho,Alto,"Texto",borde,Ln 0=derecha 1=siguiente linea 2=debajo,'L/C/R',relleno true/false);
        $pdf->AddPage();
        $pdf->SetTitle("$codigo | EXTRACTO ".$data['mi_empresa_nombre_corto'],true);
        $pdf->SetSubject('Copia Contrato '.$data['mi_empresa_nombre_corto']);
        $pdf->SetCreator('FestCar Project');
        $pdf->SetAuthor('@xsED');

        //$pdf->SetMargins(25,35,5);
        $pdf->SetLeftMargin(15);
        $pdf->SetTopMargin(35);
        $pdf->SetRightMargin(5);        
        $pdf->SetTextColor(50);

        $HC=8; // "6" PARA VISTA NORMAL "8" PARA VISTA MEMBRETEADA EXPECIAL

        /**
         * INICIO CUERPO
         */
        $pdf->SetFont('helvetica','',12);
        $pdf->Cell(0,6,utf8_decode("FORMATO ÚNICO DE EXTRACTO DEL CONTRATO DEL SERVICIO PÚBLICO DE"),0,1,"C");
        $pdf->Cell(0,6,utf8_decode("TRANSPORTE TERRESTRE AUTOMOTOR ESPECIAL"),0,1,"C");
        $pdf->SetFont('helvetica','B',12);
        $pdf->Cell(0,6,utf8_decode("No. 305-075-12-".$extracto->created_at->year."-".str_pad($extracto->cps->id, 4, "0", STR_PAD_LEFT)."-".str_pad($extracto->codigo, 4, "0", STR_PAD_LEFT)),0,1,"C");
        $pdf->ln();
        $pdf->SetFont('helvetica','',10);
        $pdf->Cell(146,5,utf8_decode("RAZÓN SOCIAL DE LA EMPRESA DE TRANSPORTE EPECIAL"),"LT",0,"L");
        $pdf->Cell(50,5,utf8_decode("NIT"),"TR",1,"L");
        $pdf->Cell(146,$HC,utf8_decode("".$data['mi_empresa_nombre']),"LB",0,"L");
        $pdf->Cell(50,$HC,utf8_decode("".$data['mi_empresa_nit']),"BR",1,"L");
        $pdf->Cell(0,$HC,utf8_decode("CONTRATO No: CPS".str_pad($extracto->cps->id, 4, "0", STR_PAD_LEFT)),1,1,"L");        
        $pdf->Cell(146,5,utf8_decode("CONTRATANTE"),"LT",0,"L");
        $pdf->Cell(50,5,utf8_decode("NIT/CC"),"TR",1,"L");
        $pdf->Cell(146,$HC,utf8_decode("".substr($data['contratante_nombre'], 0, 73)),"LB",0,"L");

        $pdf->Cell(50,$HC,utf8_decode("".$data['documento_contratante']),"BR",1,"L");
        $pdf->Cell(0,4,utf8_decode('OBJETO CONTRATO: '),"LR",1,"L");
        $pdf->Multicell(0,4,utf8_decode(mb_strtoupper($objeto_contrato_cps,'utf-8')),"LBR",'L');
        $pdf->Cell(0,$HC,utf8_decode("ORIGEN-DESTINO, DESCRIBIENDO EL RECORRIDO:"),"LTR",1,"L");
        $pdf->Cell(0,$HC,utf8_decode(mb_strtoupper($extracto->recorrido,'utf-8')),"LBR",1,"L");

        $pdf->Cell(28,$HC,utf8_decode('CONVENIO'),"LB",0,"L");
        $pdf->Cell(30,$HC,utf8_decode('CONSORCIO'),"B",0,"L");
        $pdf->Cell(38,$HC,utf8_decode('UNION TEMPORAL'),"B",0,"L");
        $pdf->Cell(100,$HC,utf8_decode('CON:'),"RB",1,"L");

        /**
         * VIGENCIA CONTRATO
         */
        $pdf->ln(3);
        $pdf->SetFont('helvetica','B',10);
        $pdf->Cell(0,6,utf8_decode("VIGENCIA DEL CONTRATO"),0,1,"C");        
     
        $pdf->SetFont('helvetica','',6);
        $pdf->Cell(106,4,"","LTR",0,"C");
        $pdf->Cell(25,4,utf8_decode("DÍA"),"TR",0,"C");
        $pdf->Cell(40,4,utf8_decode("MES"),"LTR",0,"C");
        $pdf->Cell(25,4,utf8_decode("AÑO"),"LTR",1,"C");

        $pdf->SetFont('helvetica','',10);
        $pdf->Cell(106,5,utf8_decode('FECHA INICIAL'),"LR",0,"L");
        $pdf->Cell(25,5,utf8_decode($extracto->cps->fecha_inicio->day),"R",0,"C");
        $pdf->Cell(40,5,utf8_decode(mb_strtoupper($extracto->cps->fecha_inicio->format('F'),'utf-8')),"LR",0,"C");
        $pdf->Cell(25,5,utf8_decode($extracto->cps->fecha_inicio->year),"LR",1,"C");

         $pdf->SetFont('helvetica','',6);
        $pdf->Cell(106,4,utf8_decode(''),"LTR",0,"C");
        $pdf->Cell(25,4,utf8_decode("DÍA"),"TR",0,"C");
        $pdf->Cell(40,4,utf8_decode("MES"),"LTR",0,"C");
        $pdf->Cell(25,4,utf8_decode("AÑO"),"LTR",1,"C");

        $pdf->SetFont('helvetica','',10);
        $pdf->Cell(106,5,utf8_decode('FECHA FINAL'),"LBR",0,"L");
        $pdf->Cell(25,5,utf8_decode("".$extracto->cps->fecha_final->day),"BR",0,"C");
        $pdf->Cell(40,5,utf8_decode("".mb_strtoupper($extracto->cps->fecha_final->format('F'),'utf-8')),"LBR",0,"C");
        $pdf->Cell(25,5,utf8_decode("".$extracto->cps->fecha_final->year),"LBR",1,"C");

        /**
         * DESCRIPCCIÓN VEHÍCULO
         */

        $pdf->ln(3);
        $pdf->SetFont('helvetica','B',10);
        $pdf->Cell(0,6,utf8_decode("CARACTERISITCAS DEL VEHÍCULO"),0,1,"C"); 

        $pdf->SetFont('helvetica','',6);
        $pdf->Cell(50,3,utf8_decode("PLACA"),"LTR",0,"C");
        $pdf->Cell(56,3,utf8_decode("MODELO"),"LTR",0,"C");
        $pdf->Cell(25,3,utf8_decode("MARCA"),"TR",0,"C");
        $pdf->Cell(65,3,utf8_decode("CLASE"),"LTR",1,"C");

        $pdf->SetFont('helvetica','',10);
        $pdf->Cell(50,6,utf8_decode("".mb_strtoupper($extracto->vehiculo->placa,'utf-8')),"LBR",0,"C");
        $pdf->Cell(56,6,utf8_decode("".mb_strtoupper($extracto->vehiculo->modelo,'utf-8')),"LBR",0,"C");
        $pdf->Cell(25,6,utf8_decode("".mb_strtoupper($extracto->vehiculo->marca,'utf-8')),"BR",0,"C");
        $pdf->Cell(65,6,utf8_decode("".mb_strtoupper($extracto->vehiculo->clase,'utf-8')),"LBR",1,"C");


        $pdf->ln(3);
        $pdf->SetFont('helvetica','B',10);
        $pdf->Cell(106,6,utf8_decode("NÚMERO INTERNO"),0,0,"C");
        $pdf->Cell(90,6,utf8_decode("NÚMERO TARJETA DE OPERACIÓN"),0,1,"C"); 

        $pdf->SetFont('helvetica','',10);
        $pdf->Cell(106,8,utf8_decode("".$extracto->vehiculo->numero_interno),1,0,"C");
        $pdf->Cell(90,8,$extracto->tarjetaoperacion->codigo,1,1,"C"); 

        /**
         * CONDUCTOR UNO (1)
         */
        $pdf->SetFont('helvetica','',6);
        $pdf->Cell(50,4,utf8_decode(""),"LTR",0,"C");
        $pdf->Cell(56,4,utf8_decode("NOMBRES Y APELLIDOS"),"LTR",0,"C");
        $pdf->Cell(25,4,utf8_decode("NÚMERO CÉDULA"),"TR",0,"C");
        $pdf->Cell(40,4,utf8_decode("NÚMERO LICENCIA CONDUCCIÓN"),"LTR",0,"C");
        $pdf->Cell(25,4,utf8_decode("VIGENCIA"),"LTR",1,"C");
        $pdf->SetFont('helvetica','',10);
        
        $pdf->Cell(50,4,utf8_decode("DATOS DEL CONDUCTOR 1"),"LR",0,"C");
        $pdf->Cell(56,4,utf8_decode("".mb_strtoupper($extracto->conductoruno->nombres,'utf-8')),"R",0,"C");
        $pdf->Cell(25,4,utf8_decode("".number_format($extracto->conductoruno->cedula, 0, '.', '.' )),"R",0,"C");
        $pdf->Cell(40,4,$extracto->conductoruno->cedula,"R",0,"C");
        $pdf->Cell(25,4,$extracto->f_licencia_uno,"R",1,"C");

        $pdf->Cell(50,5,utf8_decode(""),"LBR",0,"C");
        $pdf->Cell(56,5,utf8_decode("".mb_strtoupper($extracto->conductoruno->apellidos,'utf-8')),"BR",0,"C");
        $pdf->Cell(25,5,utf8_decode(""),"BR",0,"C");
        $pdf->Cell(40,5,utf8_decode(""),"BR",0,"C");
        $pdf->Cell(25,5,utf8_decode(""),"BR",1,"C");

        /**
         * CONDUCTOR DOS (2)
         */
        $pdf->SetFont('helvetica','',6);
        $pdf->Cell(50,4,utf8_decode(""),"LTR",0,"C");
        $pdf->Cell(56,4,utf8_decode("NOMBRES Y APELLIDOS"),"LTR",0,"C");
        $pdf->Cell(25,4,utf8_decode("NÚMERO CÉDULA"),"TR",0,"C");
        $pdf->Cell(40,4,utf8_decode("NÚMERO LICENCIA CONDUCCIÓN"),"LTR",0,"C");
        $pdf->Cell(25,4,utf8_decode("VIGENCIA"),"LTR",1,"C");
        $pdf->SetFont('helvetica','',10);

        $pdf->Cell(50,4,utf8_decode("DATOS DEL CONDUCTOR 2"),"LR",0,"C");
        $pdf->Cell(56,4,utf8_decode("".$c2_nombre),"R",0,"C");
        $pdf->Cell(25,4,utf8_decode("".$c2_cedula),"R",0,"C");
        $pdf->Cell(40,4,utf8_decode("".$c2_licencia),"R",0,"C");
        $pdf->Cell(25,4,utf8_decode("".$c2_vigencia),"R",1,"C");

        $pdf->Cell(50,4,utf8_decode(""),"LBR",0,"C");
        $pdf->Cell(56,4,utf8_decode("".$c2_apellidos),"BR",0,"C");
        $pdf->Cell(25,4,utf8_decode(""),"BR",0,"C");
        $pdf->Cell(40,4,utf8_decode(""),"BR",0,"C");
        $pdf->Cell(25,4,utf8_decode(""),"BR",1,"C");

        /**
         * CONDUCTOR TRES (3)
         */
        $pdf->SetFont('helvetica','',6);
        $pdf->Cell(50,4,utf8_decode(""),"LTR",0,"C");
        $pdf->Cell(56,4,utf8_decode("NOMBRES Y APELLIDOS"),"LTR",0,"C");
        $pdf->Cell(25,4,utf8_decode("NÚMERO CÉDULA"),"TR",0,"C");
        $pdf->Cell(40,4,utf8_decode("NÚMERO LICENCIA CONDUCCIÓN"),"LTR",0,"C");
        $pdf->Cell(25,4,utf8_decode("VIGENCIA"),"LTR",1,"C");
        $pdf->SetFont('helvetica','',10);

        $pdf->Cell(50,4,utf8_decode("DATOS DEL CONDUCTOR 3"),"LR",0,"C");
        $pdf->Cell(56,4,utf8_decode("".$c3_nombre),"R",0,"C");
        $pdf->Cell(25,4,utf8_decode("".$c3_cedula),"R",0,"C");
        $pdf->Cell(40,4,utf8_decode("".$c3_licencia),"R",0,"C");
        $pdf->Cell(25,4,utf8_decode("".$c3_vigencia),"R",1,"C");

        $pdf->Cell(50,4,utf8_decode(""),"LBR",0,"C");
        $pdf->Cell(56,4,utf8_decode("".$c3_apellidos),"BR",0,"C");
        $pdf->Cell(25,4,utf8_decode(""),"BR",0,"C");
        $pdf->Cell(40,4,utf8_decode(""),"BR",0,"C");
        $pdf->Cell(25,4,utf8_decode(""),"BR",1,"C");

        /**
         * RESPONSABLE (3)
         */
        $pdf->SetFont('helvetica','',6);
        $pdf->Cell(50,4,utf8_decode(""),"LTR",0,"C");
        $pdf->Cell(56,4,utf8_decode("NOMBRES Y APELLIDOS"),"LTR",0,"C");
        $pdf->Cell(25,4,utf8_decode("NÚMERO CÉDULA"),"TR",0,"C");
        $pdf->Cell(40,4,utf8_decode("DIRECCIÓN"),"LTR",0,"C");
        $pdf->Cell(25,4,utf8_decode("TELÉFONO"),"LTR",1,"C");
        $pdf->SetFont('helvetica','',10);

        $pdf->Cell(50,4,utf8_decode("RESPONSABLE DEL"),"LR",0,"C");
        $pdf->Cell(56,4,utf8_decode("".$r_nombre),"R",0,"C");
        $pdf->Cell(25,4,utf8_decode("".$r_cedula),"R",0,"C");
        $pdf->Cell(40,4,utf8_decode("".$r_direccion),"R",0,"C");
        $pdf->Cell(25,4,utf8_decode("".$r_telefono),"R",1,"C");

        $pdf->Cell(50,4,utf8_decode("CONTRATANTE"),"LBR",0,"C");
        $pdf->Cell(56,4,utf8_decode("".$r_apellidos),"BR",0,"C");
        $pdf->Cell(25,4,utf8_decode(""),"BR",0,"C");
        $pdf->Cell(40,4,utf8_decode(""),"BR",0,"C");
        $pdf->Cell(25,4,utf8_decode(""),"BR",1,"C");

        

        // Estilos para etiquetas
        
        $pdf->ln();
        //dd($pdf);

        $pdf->AliasNbPages();
        $pdf->Output();
        }
}


class PDF extends baseFpdf
{
       function Header()
    {
        // Logo
        $this->Image('pdf-templates/extractos-96pp.jpg',0,0,0);
        $this->ln(30);
        // helvetica bold 15

        // Move to the right
        
        // Title
        // Line break  
    }
}
