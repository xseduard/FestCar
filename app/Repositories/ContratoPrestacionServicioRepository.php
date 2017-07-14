<?php

namespace App\Repositories;

use App\Models\ContratoPrestacionServicio;
use App\Models\Empresa;
use InfyOm\Generator\Common\BaseRepository;

use App\Repositories\FPDF_CPS;

class ContratoPrestacionServicioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'tipo_cliente',
        'natural_id',
        'juridico_id',
        'origen_id',
        'destino_id',
        'servicio',
        'tipo_cuenta_bancaria',
        'numero_cuenta_bancaria',
        'entidad_bancaria',
        'aprobado',
        'fecha_aprobacion',
        'usuario_aprobacion',
        'fecha_inicio',
        'fecha_final'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ContratoPrestacionServicio::class;
    }

     function print_contratos($id){

        $contrato = $this->findWithoutFail($id);
        $codigo_cont = 'CPS'.str_pad($contrato->id, 4, "0", STR_PAD_LEFT);
        $codigo = 'CPS'.str_pad($contrato->id, 4, "0", STR_PAD_LEFT);
        global $codigo_cont; 
        
        $empresa = Empresa::first();
        $contrato =  ContratoPrestacionServicio::with(['natural',
        'juridico.natural',
        'origen.departamento',
        'destino.departamento'])
        ->where('id',$id)
        ->first(); 

        $contratista_nombre     = "";
        $contratista_cedula_ref = "";
        $contratista_cedula     = "";
        if ($contrato->tipo_cliente == 'Natural') {
            $contratista_nombre     = $contrato->natural->fullname;    
            $contratista_cedula     = $contrato->natural->cedula;
            $contratista_cedula_ref = $contrato->natural->municipio->nombre.", ".$contrato->natural->municipio->departamento->nombre;
        } elseif ($contrato->tipo_cliente == 'Juridico') {
            $contratista_nombre     = $contrato->juridico->natural->fullname;    
            $contratista_cedula     = $contrato->juridico->natural->cedula;
            $contratista_cedula_ref = $contrato->juridico->natural->municipio->nombre.", ".$contrato->natural->municipio->departamento->nombre;
        }
        $data = [        
        'mi_empresa_nit'                =>  $empresa->nit,
        'mi_empresa_nombre'             =>  $empresa->razon_social,
        'mi_empresa_nombre_corto'       =>  $empresa->nombre_corto,
        'mi_empresa_domicilio'          =>  $empresa->domicilio,
        'mi_empresa_contacto'           =>  $empresa->direccion.' '.$empresa->telefono.' '.$empresa->correo,
        'mi_empresa_rt_nombre'          =>  mb_strtoupper($contrato->rlfullname,'utf-8'),
        'mi_empresa_rt_cedula'          =>  number_format($contrato->rl_id, 0, '.', '.' ),
        'mi_empresa_rt_cedula_ref'      =>  $contrato->rl_id_ref,
        'contratista_nombre'            =>  mb_strtoupper($contratista_nombre,'utf-8'),
        'contratista_residencia_actual' => "",
        'contratista_cedula_ref'        =>  mb_strtoupper($contratista_cedula_ref,'utf-8'),
        'contratista_cedula'            =>  number_format($contratista_cedula, 0, '.', '.' ),
        'valor'                         =>  number_format($contrato->valor, 0, '.', '.' ),
        'valor_letras'                  =>  \NumeroALetras::convertir($contrato->valor),
        'origen'                        =>  mb_strtoupper($contrato->origen->nombre." ".$contrato->origen->departamento->nombre,'utf-8'),
        'destino'                       =>  mb_strtoupper($contrato->destino->nombre." ".$contrato->destino->departamento->nombre,'utf-8'),
        'fecha_inicio'                  =>  $contrato->fecha_inicio->day." de ".$contrato->fecha_inicio->format('F')." del ".$contrato->fecha_inicio->year,
        'fecha_final'                   =>  $contrato->fecha_final->day." de ".$contrato->fecha_final->format('F')." del ".$contrato->fecha_final->year,
        'fecha_creacion'                =>  $contrato->created_at->day." días del mes de ".$contrato->created_at->format('F')." de ".$contrato->created_at->year,
        ];

         

       
$text = "
<p>Entre los suscritos a saber, por una parte,  ".$data['mi_empresa_rt_nombre']."  mayor de edad, identificado con la cédula de ciudadanía número ".$data['mi_empresa_rt_cedula']." , con domicilio en la ciudad de Apartado, actuando en mi condición de Representante Legal de la empresa. ".$data['mi_empresa_nombre'].", entidad con domicilio principal en la ciudad ".$data['mi_empresa_domicilio']." identificada con el NIT ".$data['mi_empresa_nit']." , Empresa domiciliada en Apartado y que en adelante se denominara EL CONTRATISTA, y de otra parte  ".$data['contratista_nombre']." , mayor de edad identificado(a) con número de cédula ".$data['contratista_cedula'].", expedida en el municipio de ".$data['contratista_cedula_ref'].", quien obra en su propio nombre y en representación de un grupo específico de usuarios quien en adelante se denominara simplemente el CONTRATANTE,  hemos convenido en suscribir mediante este documento CONTRATO PARA  TRANSPORTE DE    GRUPO ESPECÍFICO DE USUARIOS (TRANSPORTE DE PARTICULARES) dando cumplimiento al  ARTICULO  2.2.6.3.2 DECRETO 431 DE 2017.  Declaramos que :  
</p>

<p> 1. Que ".$data['mi_empresa_nombre']." es una empresa debidamente habilitada y reconocida en el sector del transporte.
</p>
<p>2. Que las partes tienen la suficiente solvencia técnica, administrativa y financiera para cumplir las obligaciones derivadas de la suscripción y ejecución del presente contrato. 
</p>
<p>3. Que el CONTRATANTE es el representante del grupo de usuarios que hacen uso del servicio.
</p>
<p>4. Que el CONTRATANTE están plenamente autorizado y tiene la capacidad necesaria para obligarse de acuerdo a lo establecido en el artículo 2.2.1.6.3.2 numeral cuarto del Decreto 431 de marzo de 2017 (suscribe el contrato de transporte y se obliga al pago de la totalidad del valor del servicio).
</p>
<p>Este contrato se regirá por las siguientes clausulas.</p>
<p>OBJETO DEL CONTRATO: La realización de un servicio de transporte expreso por parte del CONTRATISTA para trasladar a las personas que hacen parte del grupo de usuarios del CONTRATANTE.  desde ".$data['origen'].", hasta ".$data['destino'].", Servicio que se prestará con un vehículo Clase Microbús
</p> 
<p>DURACIÓN DEL CONTRATO: La prestación de este servicio tiene como fecha de inicio, ".$data['fecha_inicio']." y fecha de terminación, ".$data['fecha_final'].". La hora de salida y de regreso será fijada por EL CONTRATANTE.
</p>
<p>CONDICIONES DEL CONTRATO: EL CONTRATISTA se compromete a transportar de manera diligente y con toda la documentación exigida por las autoridades gubernamentales, al grupo de usuarios. En caso de algún inconveniente mecánico, suministrará un vehículo de similares condiciones en un tiempo prudencial de acuerdo al tiempo de distancia entre su sede y el lugar donde el vehículo se encuentre. Así mismo, EL CONTRATISTA será responsable por pérdida de objetos que mediante documento se pruebe que han sido confiadas a su custodia. MODIFICACIÓN CONDICIONES: Cualquier cambio de destino o de horario al inicialmente contratado, tendrá tarifa adicional que será acordada entre las partes. 
</p>
<p>VALOR DEL CONTRATO Y FORMA DE PAGO: El presente contrato tiene un valor de ".$data['valor_letras']." PESOS ( <b>".$data['valor']." </b>) El valor total del contrato deberá estar cancelado al momento de iniciarse el servicio. Para los efectos del presente contrato, no se entenderá que existe incumplimiento por parte del CONTRATISTA en caso de que se presenten retrasos en la salida y/o regreso cuando estos provengan de incumplimientos o retrasos en de alguno de los usuarios y/o de la autoridad, retrasos en las vías, aquellos que se presente con ocasión a derrumbes y/o cierres, así como, eventos de fuerza mayor o caso fortuitos o hechos de terceros, tales como incendio, huelgas, paros forzosos, epidemia, conflictos laborales, reglamentos o disposiciones gubernamentales, guerra, motín, conmoción civil, terremoto, inundación, accidente, siniestro o cualquier otra causa ajena al control de la voluntad del CONTRATISTA. En tales eventos, el CONTRATISTA pondrá todo su diligencia, esfuerzo y capacidad para ejecutar las prestaciones derivadas del presente contrato en las mejores condiciones. 
</p>
<p>CAUSALES DE TERMINACIÓN: El presente contrato terminará en cualquiera de los siguientes eventos: 1. Por orden de autoridad competente. 2 .Vencimiento del término de duración. 3. Por mutuo acuerdo que conste por escrito. 4. Por incumplimiento y/o daños al vehículo por parte del contratante y/o cualquiera del grupo de usuarios. 5. Por las demás causas establecidas en la ley. 
</p>
<p>DIRECCIONES: Para todos los efectos de este contrato,  cualquier aviso o notificación entre las partes para que tenga validez se enviará a las siguientes direcciones: Contratista:   ".$data['mi_empresa_contacto'].". 
</p>
<p>MERITO EJECUTIVO. Las obligaciones aquí establecidas prestarán merito ejecutivo. 
El presente contrato se firma a los ".$data['fecha_creacion']."
</p>


        ";

        $pdf = new FPDF_CPS('P','mm','A4');

        $pdf->header();
        //$pdf->Cell(Ancho,Alto,"Texto",borde,Ln 0=derecha 1=siguiente linea 2=debajo,'L/C/R',relleno true/false);
        $pdf->AddPage();
        $pdf->SetTitle($codigo." | CONTRATO ".$data['mi_empresa_nombre_corto'],true);
        $pdf->SetSubject('Copia Contrato '.$data['mi_empresa_nombre_corto']);
        $pdf->SetCreator('FestCar Project');
        $pdf->SetAuthor('@xsED');
        $pdf->SetFont('helvetica','B',15);
        $pdf->Cell(160,8,utf8_decode("CONTRATO PARA TRANSPORTE DE GRUPO ESPECÍFICO DE USUARIOS"),0,1,"C");

        $pdf->SetFont('helvetica','',10); 
        $pdf->Cell(160,5,utf8_decode("ARTÍCULO 2.2.6.3.2 DECRETO 431 DE 2017"),0,1,"C");
        $pdf->SetFont('helvetica','B',15);
        $pdf->Cell(160,8,utf8_decode($codigo),0,1,"C");

        $pdf->SetFont('helvetica','',10);
        // Estilos para etiquetas
        $pdf->SetStyle("p","helvetica","N",10,"50,50,50",0);
        $pdf->SetStyle("b","helvetica","B",0,"102,153,153");
        $pdf->ln();
        $pdf->WriteTag(0,6,utf8_decode($text),0,"J",0,0);
/**
 * area firmas
 */
        $pdf->SetFont('helvetica','',10); 
        $pdf->Ln(30);
        $pdf->Cell(65,5,'________________________',0,0,"L");
        $pdf->Cell(30,5,'',0,0,"L");
        $pdf->Cell(65,5,'________________________',0,1,"L");
        $pdf->Cell(65,5,utf8_decode($data['mi_empresa_nombre_corto']),0,0,"L");
        //$pdf->Cell(65,5,utf8_decode($data['contratista_nombre']),0,0,"L");
        $pdf->Cell(30,5,'',0,0,"L");
        $pdf->Multicell(65,5,utf8_decode($data['contratista_nombre']),0,'L',0);
        $pdf->Cell(65,5,utf8_decode("CC ".$data['mi_empresa_nit']),0,0,"L");        
        $pdf->Cell(30,5,'',0,0,"L");
        $pdf->Cell(65,5,utf8_decode("CC ".$data['contratista_cedula']),0,1,"L"); 
        

        $pdf->AliasNbPages();
        $pdf->Output();



        }
}
