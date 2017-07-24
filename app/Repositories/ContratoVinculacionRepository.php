<?php

namespace App\Repositories;

use App\Models\ContratoVinculacion;
use App\Models\Empresa;
use InfyOm\Generator\Common\BaseRepository;

//Models
use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\Natural;
use App\Models\Juridico;
use App\Models\Vehiculo;
use App\Models\ContratoPrestacionServicio;
use App\Models\LicenciaConduccion;
use App\Models\Tarjeta_Propiedad;
use Carbon\Carbon;
use File;
use Jenssegers\Date\Date;

//script para texto fpdf
use App\Repositories\FPDF_VIN;


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

    function municipio_departamento($id){
            $dato = Municipio::where('id', $id)->first();
            $result = $dato->nombre.', '.$dato->departamento->nombre;
            return $result;
    }
    function tarjeta_propiedad_por_vehiculo($id){
           return Tarjeta_Propiedad::where('vehiculo_id', $id)->first();
    }
    function buscar_juridico($id){
           return Juridico::where('id', $id)->first();
    }
    function buscar_vehiculo($id){
           return Vehiculo::where('id', $id)->first();
    }

    function traducir_fecha($date){
        return new Date($date);
    }

    function print_contratos($id){
        
         //pdf
        $contrato = $this->findWithoutFail($id);
        $empresa = Empresa::first();
        $contrato =  ContratoVinculacion::with(['natural.municipio.departamento',
        'juridico.natural.municipio.departamento',
        'natural.residenciamunicipio.departamento',
        'vehiculo.tarjetapropiedad'])
        ->where('id',$id)
        ->first();

        global $codigo;
        $codigo = $contrato->tipo_contrato.str_pad($contrato->id, 4, "0", STR_PAD_LEFT);
        
        $fecha_actual = Carbon::now();
 

        $fecha_creacion = $this->traducir_fecha($contrato->created_at);       


            $contratista_nombre           = '';
            $contratista_cedula_ref       = '';
            $contratista_cedula           = '';
            $id_propietario_vehiculo      = '';
            $contratista_poseedor_or_prop      = '';
            $contratista_razonsocial      = '';
            $contratista_nit              = '';
            $NOMBRE_RTE_LEGAL_CONTRATISTA = '';
            $contratista_cedula             = '';
            $LUGAR_EXP_RTE_LEGAL          = '';
        

        if ($contrato->tipo_proveedor == 'Natural') {

           $contratista_nombre            =  $contrato->natural->fullname;
           $contratista_cedula_ref        =  $contrato->natural->municipio->nombre.", ".$contrato->natural->municipio->departamento->nombre;
           $contratista_cedula            =  $contrato->natural->cedula;           
           $id_propietario_vehiculo       =  $contrato->natural->id;
           $contratista_residencia_actual =  $contrato->natural->residenciamunicipio->nombre.", ".$contrato->natural->residenciamunicipio->departamento->nombre;
           
            if ($contrato->vehiculo->tipo_propietario == "Natural") {
                if ($contrato->natural_id == $contrato->vehiculo->natural_id) {
                   $contratista_poseedor_or_prop = 'PROPIETARIO';
                } else {
                    $contratista_poseedor_or_prop = 'POSEEDOR';
                }
            }
            else {
                 $contratista_poseedor_or_prop = 'POSEEDOR';
            }            
            

        } elseif ($contrato->tipo_proveedor == 'Juridico') {

            $contratista_razonsocial       = $contrato->juridico->nombre;
            $contratista_nit               = $contrato->juridico->nit;
            $contratista_nombre            = $contrato->juridico->natural->fullname;
            $contratista_cedula_ref        = $contrato->juridico->natural->municipio->nombre.", ".$contrato->juridico->natural->municipio->departamento->nombre;
            $contratista_cedula            = $contrato->juridico->natural->cedula;
            $id_propietario_vehiculo       = '';
            $contratista_residencia_actual =  $contrato->juridico->natural->residenciamunicipio->nombre.", ".$contrato->juridico->natural->residenciamunicipio->departamento->nombre; 

            if ($contrato->vehiculo->tipo_propietario == "Juridico") {
                if ($contrato->juridico_id == $contrato->vehiculo->juridico_id) {
                   $contratista_poseedor_or_prop = 'PROPIETARIO';
                } else {
                    $contratista_poseedor_or_prop = 'POSEEDOR';
                }
            }
            else {
                 $contratista_poseedor_or_prop = 'POSEEDOR';
            }  
            
        }
        // Determianr cuota
        if ($contrato->vehiculo->capacidad > 19) {
            $determinar_cuota_valor = $empresa->cuota_admin_valor;
        } else {
            $determinar_cuota_valor = $empresa->cuota_admin_valor_dos;
        }

        //Tipo de contrato
        switch ($contrato->tipo_contrato) {
            
            case 'AF':
                $tipo_contrato_nombre = 'Administración Flota';
                break;
            case 'CP':
                $tipo_contrato_nombre = 'DE SUMINISTRO DE VEHÍCULO';
                break;
            case 'CV':
                $tipo_contrato_nombre = 'DE VINCULACIÓN Y ADMINISTRACIÓN DELEGADA';
                break;
            case 'CC':
                $tipo_contrato_nombre = 'CONVENIO DE COLABORACIÓN EMPRESARIAL';
                break;
            default:
                $tipo_contrato_nombre = 'NO DEFINIDO';
                break;
        }
        

        $data = [        
          'mi_empresa_nit'                           =>  $empresa->nit,
          'mi_empresa_nombre'                        =>  $empresa->razon_social,
          'mi_empresa_nombre_corto'                  =>  $empresa->nombre_corto,
          'mi_empresa_rt_nombre'                     =>  mb_strtoupper($contrato->rlfullname,'utf-8'),
          'mi_empresa_rt_cedula'                     =>  number_format($contrato->rl_id, 0, '.', '.' ),
          'mi_empresa_rt_cedula_ref'                 => $contrato->rl_id_ref,
          'mi_empresa_domicilio'                     =>   $empresa->domicilio,
          'mi_empresa_admin_cuota_porcentaje'        =>  $empresa->cuota_admin,
          'mi_empresa_admin_cuota_porcentaje_letras' =>  strtolower(\NumeroALetras::convertir($empresa->cuota_admin)),
          'mi_empresa_admin_cuota_valor'             =>  number_format($determinar_cuota_valor, 0, '.', '.' ),
          
          'contratista_nombre'                       =>  mb_strtoupper($contratista_nombre,'utf-8'),
          'contratista_residencia_actual'            =>  $contratista_residencia_actual,
          'contratista_cedula_ref'                   =>  $contratista_cedula_ref,
          'contratista_cedula'                       =>  number_format($contratista_cedula, 0, '.', '.' ),
          'contratista_poseedor_or_prop'             =>  $contratista_poseedor_or_prop,
          'contratista_razonsocial'                  =>  $contratista_razonsocial,
          'contratista_nit'                          =>  $contratista_nit,
          'tipo_proveedor'                           =>  $contrato->tipo_proveedor,
          
          'contrato_duracion'                        =>  $this->traducir_fecha($contrato->fecha_inicio)->timespan($contrato->fecha_final),
          'FECHA_INICIO'                             =>  $this->traducir_fecha($contrato->fecha_inicio)->format('l d, F Y'),
          'FECHA_FINAL'                              =>  $this->traducir_fecha($contrato->fecha_final)->subDay()->format('l d, F Y'), 
          'FECHA_PERFEC_DIA'                         =>  $fecha_creacion->day,
          'FECHA_PERFEC_MES'                         =>  $fecha_creacion->format('F'),
          'FECHA_PERFEC_ANO'                         =>  $fecha_creacion->year,
          'FECHA_PERFEC_ANO_LETRAS'                  =>  strtolower(\NumeroALetras::convertir($fecha_creacion->year)),
          'FECHA_PERFECCIONAMIENTO'                  =>  $this->traducir_fecha($contrato->created_at)->format('l d, F Y'),          
          
        ];
        $pdf = new FPDF_VIN('P','mm','A4');

        $pdf->header();
        //$pdf->Cell(Ancho,Alto,"Texto",borde,Ln 0=derecha 1=siguiente linea 2=debajo,'L/C/R',relleno true/false);
        $pdf->AddPage();
        $pdf->SetTitle($codigo." | CONTRATO ".$data['mi_empresa_nombre'],true);
        $pdf->SetSubject('Copia Contrato '.$data['mi_empresa_nombre']);
        $pdf->SetCreator('FestCar Project');
        $pdf->SetAuthor('@xsED');
        $pdf->SetFont('helvetica','B',15);
        $pdf->Cell(160,8,utf8_decode("CONTRATO ".mb_strtoupper($tipo_contrato_nombre,'utf-8')),0,1,"C");
        if ($contrato->tipo_contrato == 'CC') {
            $pdf->SetFont('helvetica','',10); 
            $pdf->Cell(160,5,utf8_decode("Artículo 15 del decreto 348 de 2015. (hoy decreto 1079 de 2015)"),0,1,"C");
            $pdf->SetFont('helvetica','B',15);
        }
        $pdf->Cell(160,8,utf8_decode($codigo),0,1,"C");
        $pdf->SetFont('helvetica','',10);    
        // Estilos para etiquetas
        $pdf->SetStyle("p","helvetica","N",12,"50,50,50",0);
        $pdf->SetStyle("b","helvetica","B",0,"102,153,153");

        //$pdf->SetLineWidth(0.5);  

        $pdf->Ln();
        switch ($contrato->tipo_contrato) {
            
            case 'AF':
               $pdf->WriteTag(0,6,utf8_decode($this->CV_P1($data)),0,"J",0,0); //de momento
                break;
            case 'CP':
                 $pdf->WriteTag(0,6,utf8_decode($this->CP_P1($data)),0,"J",0,0);
                break;
            case 'CV':
                $pdf->WriteTag(0,6,utf8_decode($this->CV_P1($data)),0,"J",0,0);
                break;
            case 'CC':
                $pdf->Cell(75,10,utf8_decode('EMPRESA CONTRATANTE'),1,0,"C");
                $pdf->Multicell(0,10,utf8_decode($data['mi_empresa_nombre_corto']),1,'C');
                $pdf->Cell(75,10,utf8_decode('NIT'),1,0,"C");
                $pdf->Multicell(0,10,utf8_decode($data['mi_empresa_nit']),1,'C');
                $pdf->Cell(75,10,utf8_decode('REPRESENTANTE LEGAL'),1,0,"C");
                $pdf->Multicell(0,10,utf8_decode($data['mi_empresa_rt_cedula']),1,'C');
                $pdf->Cell(75,10,utf8_decode('EMPRESA DE CONVENIO EMPRESARIAL'),1,0,"C");
                $pdf->Multicell(0,10,utf8_decode($data['contratista_razonsocial']),1,'C');
                $pdf->Cell(75,10,utf8_decode('NIT'),1,0,"C");
                $pdf->Multicell(0,10,utf8_decode($data['contratista_nit']),1,'C');
                $pdf->Cell(75,10,utf8_decode('REPRESENTANTE LEGAL'),1,0,"C");
                $pdf->Multicell(0,10,utf8_decode($data['contratista_nombre']),1,'C');
                $pdf->Cell(75,10,utf8_decode('CONVENIO A DESARROLLLAR'),1,0,"C");
                $pdf->Multicell(0,10,utf8_decode($contrato->servicio),1,'C');
                $pdf->Ln();
                $pdf->Ln();

                $pdf->WriteTag(0,6,utf8_decode($this->CC_P1($data)),0,"J",0,0);
                break;
            default:
                $tipo_contrato_nombre = 'NO DEFINIDO';
                break;
        }
        $pdf->Ln(8);  // 8 debido a que el anterior no tenia altura
        $pdf->SetFont('helvetica','',10); 

        //Tabla vehiculo
        $pdf->Cell(30,8,utf8_decode('PLACA'),0,0,"R");
        $pdf->Cell(50,8,utf8_decode($contrato->vehiculo->placa),1,0,"R");
        $pdf->Cell(30,8,utf8_decode('No. Interno'),0,0,"R");
        $pdf->Cell(50,8,utf8_decode($contrato->vehiculo->numero_interno),1,1,"R");
        $pdf->Cell(30,8,utf8_decode('CAPACIDAD'),0,0,"R");
        $pdf->Cell(50,8,utf8_decode($contrato->vehiculo->capacidad),1,0,"R");
        $pdf->Cell(30,8,utf8_decode('MODELO'),0,0,"R");
        $pdf->Cell(50,8,utf8_decode($contrato->vehiculo->modelo),1,1,"R");
        $pdf->Cell(30,8,utf8_decode('MARCA'),0,0,"R");
        $pdf->Cell(50,8,utf8_decode($contrato->vehiculo->marca),1,0,"R");
        $pdf->Cell(30,8,utf8_decode('CLASE'),0,0,"R");
        $pdf->Cell(50,8,utf8_decode($contrato->vehiculo->clase),1,1,"R");
        $pdf->Cell(30,8,utf8_decode('SERVICIO'),0,0,"R");        
        $pdf->Cell(50,8,utf8_decode($this->tarjeta_propiedad_por_vehiculo($contrato->vehiculo_id)->servicio),1,0,"R");
        $pdf->Cell(30,8,utf8_decode('MOTOR'),0,0,"R");
        $pdf->Cell(50,8,utf8_decode($this->tarjeta_propiedad_por_vehiculo($contrato->vehiculo_id)->numero_motor),1,1,"R");
        $pdf->Cell(30,8,utf8_decode('CHASIS'),0,0,"R");
        $pdf->Cell(50,8,utf8_decode($this->tarjeta_propiedad_por_vehiculo($contrato->vehiculo_id)->numero_chasis),1,0,"R");
        $pdf->Cell(30,8,utf8_decode('COLOR'),0,0,"R");
        $pdf->Cell(50,8,utf8_decode($this->tarjeta_propiedad_por_vehiculo($contrato->vehiculo_id)->color),1,1,"R");
        //fin tabla vehiculo
        $pdf->Ln();
        switch ($contrato->tipo_contrato) {
            
            case 'AF':
                $pdf->WriteTag(0,6,utf8_decode($this->CV_P2($data)),0,"J",0,0);
                break;
            case 'CP':
                 $pdf->WriteTag(0,6,utf8_decode($this->CP_P2($data)),0,"J",0,0);
                break;
            case 'CV':
                $pdf->WriteTag(0,6,utf8_decode($this->CV_P2($data)),0,"J",0,0);
                break;
            case 'CC':
                $pdf->WriteTag(0,6,utf8_decode($this->CC_P2($data)),0,"J",0,0);
                break;
            default:
                $tipo_contrato_nombre = 'NO DEFINIDO';
                break;
        }
        $pdf->SetFont('helvetica','',10); 
        $pdf->Ln(30);
        $pdf->Cell(65,5,'________________________',0,0,"L");
        $pdf->Cell(30,5,'',0,0,"L");
        $pdf->Cell(65,5,'________________________',0,1,"L");
        $pdf->Cell(65,5,utf8_decode($data['mi_empresa_rt_nombre']),0,0,"L");
        //$pdf->Cell(65,5,utf8_decode($data['contratista_nombre']),0,0,"L");
        $pdf->Cell(30,5,'',0,0,"L");
        $pdf->Multicell(65,5,utf8_decode($data['contratista_nombre']),0,'L',0);
        $pdf->Cell(65,5,utf8_decode("CC ".$data['mi_empresa_rt_cedula']),0,0,"L");        
        $pdf->Cell(30,5,'',0,0,"L");
        $pdf->Cell(65,5,utf8_decode("CC ".$data['contratista_cedula']),0,1,"L"); 
        $pdf->Cell(65,5,utf8_decode($data['mi_empresa_nombre_corto']),0,0,"L");        
        $pdf->Cell(30,5,'',0,0,"L");
        $pdf->Multicell(65,5,utf8_decode(mb_strtoupper($data['contratista_razonsocial'],'utf-8')),0,'L',0);


        $pdf->AliasNbPages();
        $pdf->Output();
    exit;
    } //termina funcion print_contratos
        /*
        ________/\\\\\\\\\__/\\\________/\\\_        
 _____/\\\////////__\/\\\_______\/\\\_       
  ___/\\\/___________\//\\\______/\\\__      
   __/\\\______________\//\\\____/\\\___     
    _\/\\\_______________\//\\\__/\\\____    
     _\//\\\_______________\//\\\/\\\_____   
      __\///\\\______________\//\\\\\______  
       ____\////\\\\\\\\\______\//\\\_______ 
        _______\/////////________\///________
        */

    function CV_P1($data){
        $view = "<p>Entre <b>".$data['mi_empresa_nombre']."</b>, Sociedad Comercial con domicilio en Apartado Antioquia, representada legalmente por la señor(a) <b>".$data['mi_empresa_rt_nombre']."</b>, mayor de edad, identificado(a) con la cedula de ciudadanía  N° <b>".$data['mi_empresa_rt_cedula']."</b>  expedida en  <b>".$data['mi_empresa_rt_cedula_ref']."</b>, y que en el  presente acto se denominara LA EMPRESA, y el señor(a)";

        if ($data['tipo_proveedor'] == 'Natural') {

            $view .= " <b>".$data['contratista_nombre']."</b>, portador de la cedula de ciudadanía N° <b>".$data['contratista_cedula']."</b>, expedida en ".$data['contratista_cedula_ref'].", y quien para efectos legales del presente documento se denominara EL CONTRATISTA, se ha celebrado el presente contrato de VINCULACIÓN Y ADMINISTRACIÓN DELEGADA DE UN VEHÍCULO AUTOMOTOR en ejercicio de nuestra libertad contractual, el cual se regirá por las siguientes CLAUSULAS: </p>
        ";
        } else {
            $view .= "
<b> ".$data['contratista_nombre']."</b>, mayor de edad y vecino de <b>".$data['mi_empresa_domicilio']."</b>, portador de la cedula de ciudadanía N° <b>".$data['contratista_cedula']."</b>, expedida en <b>".$data['contratista_cedula_ref']."</b>, y quien actua en representacion legal de <b>".$data['contratista_razonsocial']."</b> Con Nit  <b>".$data['contratista_nit']."</b> y que para todos los efectos legales del presente documento se denominara EL CONTRATISTA, se ha celebrado el presente contrato de VINCULACION Y ADMINISTRACION DELEGADA DE UN VEHÍCULO AUTOMOTOR en ejercicio de nuestra libertad contractual, el cual se regirá por las siguientes CLAUSULAS: </p>

            ";
        }

        $view .="
<p><b>PRIMERA. OBJETO: EL CONTRATISTA</b>, en calidad de ".$data['contratista_poseedor_or_prop']." se obliga a vincular un equipo automotor a <b>LA EMPRESA</b>,  con el ánimo de que este último lo incorpore a su parque automotor y lo administre delegadamente. <b>EL CONTRATISTA</b> prestara los servicios de transporte de pasajeros que autorice  <b>LA EMPRESA</b>, en  los diferentes contratos de Servicio Público de Transporte Terrestre Automotor Especial y con los cuales explota la actividad transportadora  de pasajeros en un radio de acción Nacional. Para los efectos referidos, las características del vehículo que se vincula y que será administrado por <b>LA EMPRESA</b> son las siguientes: </p>
        ";
        return $view;
    }

    function CV_P2($data){
        $view = "
<p><b>SEGUNDA: EL CONTRATISTA</b> garantiza que el equipo automotor  descrito en la cláusula anterior se encuentra en perfecto estado de funcionamiento y de presentación, que en igual condiciones se comprometen a tenerlo durante el término de duración del presente contrato. De igual forma, <b>EL CONTRATISTA</b> manifiesta que el automotor referido se encuentra libre de embargos, pleitos pendientes de cualquier naturaleza, limitaciones al dominio y todo tipo de gravamen. <b>PARAGRAFO:</b> No obstante lo anterior, la empresa se reserva el derecho de admitir según cada caso, los vehículos  que se encontraren en alguna de las situaciones citadas en precedencia, siempre y cuando no perjudiquen ni la marcha de LA EMPRESA, ni su patrimonio. De igual manera se reserva el derecho de admitir a cualquier persona que solicite viculacion de un automotor </p>

<p><b>TERCERA. DURACION DEL CONTRATO:</b> El presente contrato tendrá una Duracion de <b>".$data['contrato_duracion']."</b>, contados a partir del <b>".$data['FECHA_INICIO']."</b> Hasta <b>".$data['FECHA_FINAL']."</b>. En ningun caso se produciran renovaciones automaticas del contrato.</p> 

<p><b>CUARTA. CUOTA DE ADMINISTRACION</b>: <b>EL CONTRATISTA</b> se obliga a pagar a <b>LA EMPRESA</b> como cuota de administración mensual, el <b>".$data['mi_empresa_admin_cuota_porcentaje_letras']." por ciento</b> (<b>".$data['mi_empresa_admin_cuota_porcentaje']."%</b>) del valor que facture en el mes; en todo caso, la cuota mensual no podrá ser inferior a la suma de <b>".$data['mi_empresa_admin_cuota_valor']."</b>, valor que se incrementará cada año de acuerdo al IPC. <b>EL CONTRATISTA</b> autoriza a <b>LA EMPRESA</b> a que descuente automáticamente el porcentaje correspondiente a la cuota de administración del producido del vehiculo. o en en su defecto, la suma será cancelada  por <b>EL CONTRATISTA</b> en la oficina  de LA EMPRESA, dentro de los  tres (3) primeros días hábiles de cada  mes vencido.</p> 

<p><b>QUINTA. OBLIGACIONES DEL CONTRATISTA</b>: <b>EL CONTRATISTA</b> se compromete con la empresa a: 1) mantener el vehículo descrito en la cláusula primera de este contrato, en perfectas condiciones mecánicas, de presentación,  comodidad e higiene, necesarias para que  el  mismo pueda  cumplir el objetivo de la vinculación, esto es, prestar Servicio Público de Transporte Terrestre Automotor Especial durante todo el día  y en forma continua, excluidos en todo caso todos los días asignados para el mantenimiento y reparación del automotor. 2) A cancelar cumplidamente  y en forma establecida en la cláusula cuarta,  las obligaciones económicas adquiridas para con la empresa. 3) A informar por escrito el nombre de la persona que habrá de actuar como conductor del vehículo y a suministrar a LA EMPRESA copia del contrato laboral firmado entre  EL <b>CONTRATISTA Y EL CONDUCTOR</b>,   así  como informar de las modificaciones que a dicho contrato se le efectúen. 4) Pagar en forma oportuna los salarios  y prestaciones  económicas a  que tenga derecho el conductor, a afiliarlo al Sistema de Seguridad Social Integral (salud, pensiones, riesgos profesionales), y aportes parafiscales en las cuantías de ley, dentro de los periodos de tiempo estipulados  por la Ley. 5). Liquidar correctamente al conductor en el momento de cancelación  o terminación del  contrato y como previo requisito a la contratación de nuevo conductor, de todo lo cual deberá aportar copias a LA EMPRESA. En todo caso, <b>EL CONTRATISTA</b> cubre a <b>LA EMPRESA</b> de los perjuicios que se le ocasionen como consecuencia de incumplimiento de las obligaciones laborales a que esté obligado <b>EL CONTRATISTA,</b> derivadas de la contratación del personal utilizado para la ejecución del contrato, pactando la obligación de <b>EL CONTRATISTA</b> de mantenerla libre de cualquier daño o perjuicio originado en reclamaciones de terceros y que se deriven de sus actuaciones de sus subcontratistas o dependientes. 6). Cumplir órdenes dadas por <b>LA EMPRESA</b> y acatar las disposiciones y reglamentos de la misma. <b>EL CONTRATISTA</b> exigirá al conductor el cumplimiento de tales obligaciones. 7).<b>EL CONTRATISTA,</b> deberá responder con su vehículo y con otros bienes de su patrimonio, si fuere necesario, por conceptos de pagos que la empresa se viere obligada a efectuar  por él o por el conductor  o su ayudante. Si la empresa fuera demandada civil, laboral o administrativamente, por actuaciones  correspondientes  a <b>EL CONTRATISTA</b>, este último pagara todos y cada  uno  de los gastos que cause el litigio, tales como honorarios, costos y gastos judiciales, pagos de sentencias y perjuicios, conceptos que deberá cubrir en forma total y que en caso de efectuarlos, <b>LA EMPRESA</b> podrá exigir su cumplimiento por la vía  ejecutiva. Para lo anterior  bastara la sola presentación del contrato y la liquidación  correspondiente a la obligación  incumplida  por <b>EL CONTRATISTA</b> 8). Deberá igualmente EL CONTRATISTA obtener una póliza de seguros  que cubra los eventos de responsabilidad civil contractual y extracontractual en caso de muerte, lesiones, daños a  terceros o sus bienes. Las anteriores pólizas deben estar siempre vigentes durante la duración de este contrato, en los montos establecidos por la ley. 9) A cancelar oportunamente los valores mensuales que adeuda a <b>LA EMPRESA,</b> independiente de que la finca, gremio bananero y demás, paguen o no oportunamente los servicios de transporte contratados y prestados. 10). Acogerse  a lo estipulado por la ley, en cuanto a las obligaciones  de aportes al Fondo de Reposición  establecido en la cuantía  que establezca el <b>MINISTERIO DEL TRANSPORTE</b> o la autoridad encargada y a respetar el reglamento que adopte <b>LA EMPRESA</b> 11). En caso  de venta o retiro del automotor de la empresa, se perderá el cupo en la misma,  y dejando claro que el cupo utilizado es de la empresa y hace parte de su capacidad transportadora  otorgada por el MINISTERIO DE TRANSPORTE. 12). Avisar oportunamente a LA  EMPRESA cuando el vehículo no esté en condiciones de prestar el servicio contratado. Dicho aviso se hará en horarios de oficina (de 8 a 12 AM  y de 2 a 6 PM). Para proceder a asignar un reemplazo, deberá avisar con antelación de: a) De tres (03) horas antes del cierre de la oficina, es decir máximo hasta las 3:00 PM., cuando el servicio sea para el siguiente día. b) De seis (06) horas, antes del cierre de oficina, es decir máximo hasta las 12:00 AM, cuando el servicio sea para el horario de recogida de personal el mismo día. 13) Durante toda la prestación del servicio, el conductor del equipo automotor deberá portar un Formato Unico de Extacto de Contrato (FUEC ).<b>EL CONTRATISTA</b> será responsable del cumplimiento del mismo. 14) El equipo automotor de propiedad del <b>CONTRATISTA</b>  deberá llevar el  color  blanco y los logos de la empresa 15) Si el equipo automotor transporta estudiantes, además de lo mencionado en el numeral anterior, debe pintar en la parte posterior de la carrocería del vehículo franjas alternas de diez (10) centímetros de ancho en colores amarillo pantone 109 Y negro, con inclinación de 45 grados y una altura mínima de 60 centímetros. Igualmente, en la parte superior y delantera de la carrocería en caracteres destacados, de altura mínima de 10 centímetros, deberán llevar la leyenda *Escolar. 16) El equipo automotor vinculado y administrado deberá cumplir con las condiciones técnico-mecánicas y con las especificaciones de tipología vehicular requeridas y homologadas por el Ministerio de Transporte para la prestación de este servicio. 17) El conductor del equipo automotor no admitirá pasajeros de pie en ningún caso. Cada pasajero ocupará un (1) puesto de acuerdo con la capacidad establecida en la ficha de homologación del vehículo y de la licencia de tránsito. Será responsabilidad de EL CONTRATISTA vigilar el cumplimiento de tal prohibición por parte del conductor del equipo automotor, siendo <b>EL CONTRATISTA</b> el responsable civil y penal ante cualquier accidente. 18) EL CONTRATISTA y su conductor deben cumplir en forma estricta con el REGLAMENTO de LA EMPRESA y así mismo manifiestan tener pleno conocimiento del mismo y haber recibido una copia  de <b>LA EMPRESA</b> al momento de la suscripción del presente contrato. 19) <b>EL CONTRATISTA</b> y/o el conductor del equipo automotor deberá portar el original de la tarjeta de operación y presentarla a la autoridad competente que la solicite. 20) El conductor del equipo automotor durante la prestación del servicio de transporte de pasajeros deberá portar la camiseta y el carnet que lo identifique como el conductor del vehículo y que contengan los emblemas de la empresa. Será responsabilidad de <b>EL CONTRATISTA</b> proveer al conductor de esta dotación en los tiempos que estipula la ley.</p>

<p><b> SEPTIMA EXCLUSIÓN DE LA RELACIÓN LABORAL: </b> Queda claramente entendido que no existirá relación laboral alguna entre <b>LA EMPRESA y EL CONTRATISTA</b>, o el personal que éste utilice en la ejecución del objeto del presente contrato. EL CONTRATISTA es el único responsable por la vinculación del personal lo cual realiza en su propio nombre y por su cuenta y riesgo, sin que <b>LA EMPRESA</b> adquiera responsabilidad alguna por sus actos. Por tanto corresponde a <b>EL CONTRATISTA,</b> el pago de los salarios, prestaciones sociales e indemnizaciones a que haya lugar. </p>
<p><b>OCTAVA. CAUSALES DE TERMINACION DEL CONTRATO Y DESVINCULACIÓN ADMINISTRATIVA:</b> Este contrato termina por mutuo acuerdo entre las partes o por vencimiento del término de duración del contrato. , por cambio o mutación en el equipo automotor. La empresa podrá terminar el contrato  de vinculación de forma unilateral por: 1) No cumplir con el plan de rodamiento registrado por la empresa ante la autoridad competente. 2) No acreditar oportunamente ante la empresa la totalidad de los requisitos exigidos por la norma para el trámite de los documentos de transporte. 3) No cancelar oportunamente a la empresa los valores pactados en el contrato de vinculación. 4) Negarse a efectuar el mantenimiento preventivo del vehículo, de acuerdo con el plan señalado por la empresa. 5) No efectuar los aportes obligatorios al fondo de reposición.</p>

<p><b>NOVENA. SANCIÓN E INTERES POR MORA:</b> Acorde con el articulo 1610 y 1617 del Código Civil y demás normas concordantes, el incumplimiento en el pago de las obligaciones referentes a la cuota de administración o sanciones y perjuicios ocasionados a  LA EMPRESA, acarreará a <b>EL CONTRATISTA</b> la respectiva sanción por mora, viéndose obligado a pagar el interés legal permitido al momento de la mora.  En caso  de incumplimiento de alguna de las obligaciones de tipo económico que libremente se imponen a <b>EL CONTRATISTA, LA EMPRESA</b> queda facultada  a promover,  independientemente  las acciones civiles pertinentes, como también  a adoptar  la fórmula de no autorizar el servicio de transporte contratado en el vehículo  hasta tanto se cumplan  las obligaciones o se garantice  el pago  de las mismas.  En tal evento, EL CONTRATISTA renuncia a promover  acciones de cualquier naturaleza con miras a obtener resarcimiento de perjuicios.</p>

<p><b>DECIMA. EXTRACTO DEL CONTRATO:</b> Durante toda la prestación del servicio, el conductor del vehículo deberá portar un Formato Unico de  Extracto de contrato, debidamente firmado y con sello, por el representante legal de la misma  o quien este delegue. Queda prohibido que <b>EL CONTRATISTA</b> o su conductor celebren contratos de Servicio Público de Transporte Terrestre Automotor Especial de forma directa con particulares. En todo caso, si <b>EL CONTRATISTA</b> y/o el conductor es sorprendido por las autoridades competentes prestando el servicio de transporte sin el correspondiente extracto contrato, será responsabilidad exclusiva de <b>EL CONTRATISTA,</b> quien responderá por el cien por ciento (100%) de la sanción económica y/o perjuicios que le ocasione a <b>LA EMPRESA.</b> Por disposición del artículo 2.2.1.6.3.3 del Decreto 1079 de 2015, está terminantemente PROHIBIDO que EL CONTRATISTA permita o no verifique que su automotor preste el <b>SERVICIO PÚBLICO DE TRANSPORTE TERRESTRE AUTOMOTOR ESPECIAL</b> sin haber un contrato <b>DE PRESTACIÓN DE SERVICIOS DE TRANSPORTE</b> suscrito con la empresa <b>".$data['mi_empresa_nombre']."</b> y mucho menos salir a prestar el servicio sin portar el <b>EXTRACTO DEL CONTRATO, SO PENA DE ASUMIR TODA LA RESPONSABILIDAD CIVIL, PENAL Y ADMINISTRATIVA</b> de las infracciones que impongan las autoridades de control o los accidentes que ocurran durante la prestación del servicio.</p>


<p><b>DECIMA PRIMERA.  CLAUSULA COMPROMISORIA:</b> Toda controversia o diferencia relativa a este contrato, se resolverá por un tribunal de arbitramento que por economía será designado por las partes y será del domicilio donde se debió ejecutar el servicio contratado. El tribunal de Arbitramento se sujetara a lo dispuesto en el estatuto orgánico de los sistemas alternativos de solución de conflictos y demás normas concordantes.</p>
<p><b>DECIMA SEGUNDA. NATURALEZA LEGAL DEL CONTRATO:</b> El presente contrato se rige por lo dispuesto en el Código Civil, Código de Comercio, decreto 1079 de 2015, decreto 431 de 2017 y demás normas concordantes.</p>

<p><b>DECIMA TERCERA. PAGO DE LOS SERVICIOS DE TRANSPORTE:</b> Durante la prestación del Servicio Público de Transporte Terrestre Automotor Especial, se le cancelara a EL CONTRATISTA los servicios de transporte ejecutados, una vez estos sean pagados a LA EMPRESA por el usuario del servicio. <b>LA EMPRESA</b> no responderá por el pago de los servicios que no cancelen los usuarios-contratantes.</p>

<p>En constancia de aceptación, se firma el presente contrato en el Municipio de ".$data['mi_empresa_domicilio']." a los <b>".$data['FECHA_PERFEC_DIA']."</b> días del mes de <b>".$data['FECHA_PERFEC_MES']."</b> del año ".$data['FECHA_PERFEC_ANO_LETRAS']."(<b>".$data['FECHA_PERFEC_ANO']."</b>); por las partes que han intervenido, quienes procederán a suscribir y plasmar su huella dactilar (dedo índice) en el presente contrato,  advirtiéndose  que al mismo  se entienden incorporadas las disposiciones que sobre administración delegada  consagra la normatividad legal vigente y que este contrato presta mérito ejecutivo por contener una obligación clara, expresa y exigible para las partes.</p>
        ";
        return $view;
    }
/* 
________/\\\\\\\\\________/\\\\\\\\\_        
 _____/\\\////////______/\\\////////__       
  ___/\\\/_____________/\\\/___________      
   __/\\\______________/\\\_____________     
    _\/\\\_____________\/\\\_____________    
     _\//\\\____________\//\\\____________   
      __\///\\\___________\///\\\__________  
       ____\////\\\\\\\\\____\////\\\\\\\\\_ 
        _______\/////////________\/////////__

    */


    function CC_P1($data){
        $view = "
        <p><b>PRIMERA: OBJETO DEL CONVENIO:</b> Posibilitar una eficiente racionalización en el uso del equipo automotor y la mejor prestación del servicio publico de transporte de pasajeros en la modalidad especial mediante la colaboración entre empresas para el cumplimiento de un especifico contrato, en este caso para transportar personas en cumplimento de contrato de prestación de servicios con  la empresa mencionada en el encabezado.</p>

<p><b>SEGUNDA:</b> Para los efectos previstos en este contrato la empresa que tiene a su favor el contrato de prestación de servicios de transporte se denominara EMPRESA CONTRATANTE, y la empresa  que colabora con la ejecución del contrato  y ejecuta el mismo se denominara LA EMPRESA CONTRATISTA.</p>
<p><b>TERCERA: TIPO DE VEHICULOS</b>: La empresa contratista prestará los servicios con el vehículo distinguido por las siguientes características  así:</p>

        ";
        return $view;
    }
    function CC_P2($data){
        $view = "
<p><b>CUARTA: VALOR  DEL CONTRATO Y FORMA DE PAGO:</b> LA EMPRESA CONTRATANTE  pagara a la empresa contratista la suma que estará determinado de  acuerdo a las cláusulas establecidas en documento posterior, pero será de manera mensual previa la presentación de la cuenta de cobro correspondiente; el pago puede ser entregado directamente al propietario del vehículo previa presentación de la cuenta de cobro correspondiente y según lo acordado para la prestación del servicio, la empresa contratista autoriza al propietario para la firma del contrato de prestación de servicio que establezca las condiciones especiales del servicio.</p>

<p><b>QUINTA: SALARIOS, PRESTACIONES SOCIALES, COMBUSTIBLE Y MANTENIMIENTO Y SEGUROS</b>: Cada propietario del vehículo  asumirá por su cuenta y riesgo el pago de salarios, prestaciones sociales y demás prestaciones laborales de los conductores que conducen sus vehículos, así como los gastos de mantenimiento de cada vehiculo de acuerdo a lo establecido por cada empresa según su programa de mantenimiento, el valor de los seguros de responsabilidad civil contractual y extracontractual y el Soat y mantenerlos actualizados durante toda la prestación del servicio, así mismo cada propietario asumirá el combustible para los vehículos y las reparaciones a que hubiere lugar.</b>

<p><b>SEXTA</b>: Ambas empresas se comprometen a salvaguardar la información suministrada por la otra empresa y por los usuarios del servicio.</p>

<p><b>SEPTIMA: OBLIGACIONES DE LA EMPRESA CONTRATANTE:</b> Tendra las siguientes obligaciones: </p>

<p>1.   Pagar al contratista o a quien este designe la suma estipulada en este contrato o en sus anexos de acuerdo a los servicios prestados.</p>
<p>2.  Dar a conocer al cliente que el servicio le será suministrado por otra empresa en ejecución de un convenio de colaboración empresarial. </p>
<p>3.  Suministrar al contratista toda la información para la adecuada prestación del servicio. </p>
<p>4.  Entregar a sus conductores y/o propietarios encargados el formato Unico de Extracto del Contrato  (FUEC) y portarlo durante todo el recorrido de forma mensual, con el fin de realizar el control  correspondiente. </p>
    
<p><b>OCTAVA: OBLIGACIONES DEL CONTRATISTA:</b> tendrá las siguientes obligaciones:</p>

<p>1. Poner a disposición el vehiculo relacionado en el anexo, con conductores idóneos y capacitados para el cumplimiento del servicio.</p>

<p>2. Disponer para la prestación del servicio conductores: hombres o mujeres mayores de edad, con licencia de conducción de categoría igual o superior a los vehículos a utilizar dentro del servicio contratado y experiencia mínima de dos años en el manejo de vehículos de servicio público o de transporte especial de pasajeros.</p> 

<p><b>NOVENA: AUTONOMIA E INDEPENDENCIA:</b> A pesar de que las partes están sometidas a las obligaciones y derechos contenidos en ese contrato, no implica que este convenio genere relación laboral o vinculo alguno distinto diferente al aquí establecido.</p>

<p><b>DECIMA: AUSENCIA DE RESPONSABILIDAD:</b> Este convenio no implica exclusividad; por lo tanto cada contratante esta en libertad de contratar con otras empresas.</p>

<p><b>DECIMA PRIMERA: PÓLIZAS Y GARANTÍAS.</b>  Todos los vehículos objeto del convenio deben presentar una póliza de responsabilidad civil Contractual y Extracontractual por cada vehículo y se compromete a mantenerla vigente durante toda la duración del convenio.</p>

<p><b>DECIMA SEGUNDA: SUSTITUCIÓN Y MANIFESTACIONES.</b> El presente acuerdo sustituye a cualquier otro (s) anterior (es), ambos contratantes manifiestan que conocen y entienden las cláusulas del acuerdo, por lo cual además aceptan el contenido  de  cada  una  de las cláusulas redactadas, que lo leyó y le da su aprobación.</p>  

<p><b>DECIMA TERCERA:</b> el presente convenio se enviara para su registro al Ministerio de Transporte para que surta plenos efectos según el artículo  2.2.1.6.3.4. del decreto 431 del 2017.</b>

<p>El presente contrato tendrá una Duracion de <b>".$data['contrato_duracion'].",</b> contados a partir del <b>".$data['FECHA_INICIO']."</b> Hasta <b>".$data['FECHA_FINAL']."</b>.En ningun caso se produciran renovaciones automaticas del contrato </p> . 

<p>En constancia de aceptación, se firma el presente contrato en el Municipio de Apartadó (Antioquia) a los  <b>".$data['FECHA_PERFECCIONAMIENTO']."</b>; por las partes que han intervenido, quienes procederán a suscribir el presente contrato,  advirtiéndose  que al mismo  se entienden incorporadas las disposiciones que sobre administración delegada  consagra la normatividad legal vigente.</p>
        ";
        return $view;
    }

/*
________/\\\\\\\\\__/\\\\\\\\\\\\\___        
 _____/\\\////////__\/\\\/////////\\\_       
  ___/\\\/___________\/\\\_______\/\\\_      
   __/\\\_____________\/\\\\\\\\\\\\\/__     
    _\/\\\_____________\/\\\/////////____    
     _\//\\\____________\/\\\_____________   
      __\///\\\__________\/\\\_____________  
       ____\////\\\\\\\\\_\/\\\_____________ 
        _______\/////////__\///______________

        */
    function CP_P1($data){
        $view = "
<p>Entre los suscritos a saber, <b>".$data['mi_empresa_rt_nombre']."</b>, identificado(a) con Cédula de Ciudadanía Nro. <b>".$data['mi_empresa_rt_cedula']."</b>, en calidad de Gerente y Representante Legal de <b>".$data['mi_empresa_nombre'].".</b> Con Nit ".$data['mi_empresa_nit'].", y quien para efectos del presente contrato se denominará <b>EL CONTRATANTE</b>; y el señor (a) <b>".$data['contratista_nombre'].",</b> con Cédula de Ciudadanía. Nro. <b>".$data['contratista_cedula']."</b> expedida en ".$data['contratista_cedula_ref'].", quien actua como ".$data['contratista_poseedor_or_prop']." DEL VEHICULO  de servicio público inscrito en el organismo de transito correspondiente.</p>

<p><b>PARAGRAFO 1: ".$data['contratista_poseedor_or_prop']."</b> acredita  la tenencia de la  propiedad del vehiculo y además que, el automotor se encuentra libre de pleitos pendientes, embargos judiciales, condiciones resolutorias, acciones reales y en general, que se encuentra ajustada a derecho y es consecuencia de una cadena lógica de dominio.  Así mismo que su patrimonio liquido proviene de actividades lícitas; y quien para los efectos del presente documento se denominará el <b>PROPIETARIO</b>, acuerdan celebrar el presente <b>CONTRATO DE SUMINISTRO DE VEHÍCULO</b>, contrato que se rige por las siguientes estipulaciones:</p>

<p><b>PRIMERA</b>: MOTIVO DE LA CONTRATACIÓN Que la empresa <b>".$data['mi_empresa_nombre']."</b>, tiene contratos suscritos con clientes que demandan cada vez mas servicios en la modalidad de Contrato para transporte empresarial. especialmente de empleados de Fincas, y aunque la empresa presta servicios de transporte público especial, debidamente autorizada y habilitada por el Ministerio de Transporte,  en la actualidad no cuenta con la cantidad  de vehículos que exige la empresa y sus filiales a la cual le prestamos servicios,  para tal objeto contractual.</p>

<p><b>SEGUNDA</b>: OBJETO DEL CONTRATO: Para una eficiente racionalización en el uso del equipo automotor y la mejor prestación del servicio, el PROPIETARIO se obliga para con el contratante a suministrarle y prestar el servicio de transporte a través de los siguientes rodante debidamente inscrito en el  Organismo de Tránsito correspondiente, distinguido por las siguientes características  así:</p>

        ";
        return $view;
    }
    function CP_P2($data){
        $view = "




<p>Bajo las obligaciones que más adelante se detallan.</p>

<p><b>TERCERA. TÉRMINO </b>El presente contrato tendrá una Duracion de <b>".$data['contrato_duracion']."</b>, contados a partir del <b>".$data['FECHA_INICIO']."</b> Hasta <b>".$data['FECHA_FINAL']."</b>.En ningun caso se produciran renovaciones automaticas del contrato. </p>

<p><b>CUARTA. VALOR  DEL CONTRATO </b>: LA EMPRESA CONTRATANTE  pagará al <b>".$data['contratista_poseedor_or_prop']."</b>,  la suma que estará determinado de  acuerdo a las cláusulas establecidas en documento posterior, por  el suministro de cada vehículo por viaje realizado conforme lo dispone la cláusula siguiente.</p>

<p><b>QUINTA. FORMA DE PAGO</b>. LA EMPRESA CONTRATANTE  pagará al <b>".$data['contratista_poseedor_or_prop']."</b>,   la suma indicada de la siguiente manera: los clientes que demandan los servicios,  pagarán directamente el costo del contrato de manera global a LA EMPRESA CONTRATANTE, previa consignación en la cuenta suministrada por LA EMPRESA CONTRATANTE, y está a su vez le reconocerá al <b>".$data['contratista_poseedor_or_prop']."</b> por sus SERVICIOS el valor de los servicios pactados, por el suministro de cada viaje realizado.</p>

<p><b>SEXTA. OBLIGACIONES ESPECÍFICAS DEL ".$data['contratista_poseedor_or_prop'].".</b> EL ".$data['contratista_poseedor_or_prop']." se obliga para con LA EMPRESA CONTRATANTE: A) A cumplir con el suministro del vehículo con las características descritas y exigidas por el el cliente, en el tiempo pactado y con las descripciones exactas con el fin de atender las necesidades presentadas en el CONTRATO con el cliente respectivo; B) Demás actividades que asigne el CONTRATANTE,  relacionadas con el objeto contractual; C) El  ".$data['contratista_poseedor_or_prop']."  debe cumplir con todas las condiciones de seguridad y de revisión técnico mecánica y de emisiones contaminantes de que trata el artículo 51 de la Ley 769 de 2002, modificado por el artículo 11 de la Ley 1383 de 2010, modificado por el artículo 201 del Decreto número 019 de 2012, además del adecuado mantenimiento del vehículo de manera pre-ventiva y correctiva; D) El servicio debe hacerse de manera inmediata al usuario; E) El procedimiento debe ser continuo, permanente y ágil, y de la mejor calidad; F) Debe tenerse prevista la eventualidad de daños, a fin que el proceso sea permanente, repuestos, reparaciones, y vehículo de reemplazo.  G) El servicio deberá ser resuelta por lo menos en un día hábil.  H) Abstenerse de utilizar la información entregada por LA EMPRESA CONTRATANTE para fines distintos a los establecidos en el presente contrato, o para beneficio personal o de personas ajenas. I) Es obligación del <b>".$data['contratista_poseedor_or_prop']."</b> y su vehículo que desde el lugar de origen hasta el lugar de destino, que la prestación del servicio se haga a través de CONDUCTOR ASALARIADO, pagado directamente por el ".$data['contratista_poseedor_or_prop']." de conformidad con el Art. 36 de la Ley 336 de 1996 y será solidariamente responsable con la EMPRESA VINCULADORA del automotor de todas las obligaciones o sanciones que surgieran por este aspecto, además que deben estar afiliados al régimen de seguridad social (Salud, pensión y Riesgos Laborales si hubiere lugar).</p>

<p><b>SÉPTIMA. OBLIGACIONES DE LA EMPRESA CONTRATANTE .</b> LA EMPRESA CONTRATANTE se obliga: 1º) Facilitarle al ".$data['contratista_poseedor_or_prop']."  para el cumplimiento de sus obligaciones, todos los documentos e información que requiera para este fin. 2°) Pagarle oportunamente la contraprestación. 3º). Facilitarle los recursos de que dispone LA EMPRESA CONTRATANTE que le sean necesarios para el buen desempeño de las labores a realizar. PARÁGRAFO: Esto tiene que ver con información y logística, más no así suministro de materiales, combustibles lubricantes, peajes, viáticos, gastos de viajes, etc.</p>

<p><b>OCTAVA: SUPERVISIÓN</b>: Será ejercida por el Jefe Operativo de LA EMPRESA CONTRATANTE  o quien haga sus veces, quien para cumplir con esta función deberá realizar el seguimiento, control y vigilancia de la ejecución del presente contrato y de sus actuaciones, de lo cual dejará constancia escrita.</p>

<p><b>NOVENA: CUMPLIMIENTO AL SISTEMA GENERAL DE SEGURIDAD SOCIAL.</b> Es obligación del <b>".$data['contratista_poseedor_or_prop']."</b>, garantizar y demostrar el cumplimiento de sus obligaciones frente al SISTEMA DE SEGURIDAD SOCIAL de su CONDUCTOR, a pagar mensualmente sus aportes y presentar la planilla a la empresa, la cual podra requerirla para verificar y para efectos de cancelarle los servicios prestados. En caso de que el mismo opere el automotor,  debera presentar igualmente su afiliacion y pago.</p>

<p><b>DECIMA: INDEPENDENCIA DEL PROPIETARIO:</b> ".$data['contratista_poseedor_or_prop']." actuará por su propia cuenta con absoluta autonomía y no estará sometido a subordinación laboral con LA EMPRESA CONTRATANTE u horario laboral alguno y sus derechos se limitarán de acuerdo  con la naturaleza del contrato, las obligaciones inherentes al mismo.</p> 

<p><b>UNDÉCIMA. CESION</b> Este contrato no podrá ser cedido total ni parcialmente, salvo autorización expresa de LA EMPRESA CONTRATANTE.</p>

<p><b> DUODÉCIMA. DOMICILIO.</b> Para todos los efectos del domicilio contractual, es  señala Apartado . Antioquia </p>

<p><b>DÉCIMA TERCERA. CAUSALES DE TERMINACIÓN.</b>  El presente contrato termina por las siguientes causales: 1)  En forma regular cuando se configure: a) La ejecución total  del objeto del contrato.  b)  El cumplimiento del plazo estipulado y 2)  En forma anticipada cuando se configure: a) El incumplimiento parcial o total  de una de las obligaciones pactadas en el presente contrato, y b)  por mutuo acuerdo entre las partes.</p>

<p><b>DÉCIMA CUARTA. CLÁUSULA PENAL.</b> En caso de incumplimiento por alguna de las partes de cualquiera de las obligaciones previstas en este contrato dará derecho a LA EMPRESA CONTRATANTE  a cobrar al ".$data['contratista_poseedor_or_prop']." una suma igual a la afectacion sufrida por incumplimiento.</p>

<p><b>DÉCIMA QUINTA: DOCUMENTOS:</b> Hacen parte integral del presente contrato los siguientes, documentos del automotor, certificado de existencia y representación legal de LA EMPRESA CONTRATANTE, copias de la cédulas del Representante Legal y del ".$data['contratista_poseedor_or_prop']."  que es contratado, certificado de antecedentes judiciales, Registro Único Tributario (RUT), antecedentes, constancia de pago de aportes al Sistema General de Seguridad Social, y demás documentos relacionados con la ejecución del contrato.</p>

<p><b>DÉCIMA SEXTA:</b> Impuestos y Contabilización. En relación con el manejo contable y tributario del presente contrato, las partes expresamente declaran: 1) Contabilización del ingreso: Cada una de las partes registra en su respectiva contabilidad, como ingreso, el valor correspondiente a la participación pactada para cada una. 2) Contabilización de impuestos; Cada una de las partes deberá causar, declarar y pagar los impuestos que correspondan por la actividad, en proporción del ingreso que cada una percibe.</p>

<p><b>DÉCIMA SÉPTIMA:</b> Independencia: LA EMPRESA CONTRATANTE  y ".$data['contratista_poseedor_or_prop']." y/o  EL CONDUCTOR del vehículo conservan su Independencia y responden cada una de por sus obligaciones laborales y contractuales. PARÁGRAFO: Se deja expresa constancia que por la celebración del presente contrato no se entenderá de ninguna manera la constitución de Agencia Comercial de una parte hacia la otra, ni la celebración de Contrato de Cuentas en Participación, o constitución de Sociedad de Hecho ni ninguna otra forma asociativa, como tampoco la prestación de un servicio. Los derechos y obligaciones de las partes quedan recogidos bajo los términos y condiciones del presente Contrato, según lo convenido en el Objeto del mismo y expresamente aceptado por las partes, previa deliberación y conocimiento de su alcance, que queda circunscrito estrictamente a lo allí señalado.</p>

<p><b>DECIMA NOVENA:</b> Solución de conflictos Cláusula Compromisoria: Con excepción de las obligaciones económicas que se encuentren establecidas en forma cierta e indiscutible, y que serán exigibles por la vía judicial, todas las diferencias que se susciten entre las partes con motivo de la validez, existencia, celebración, interpretación, alcance o ejecución, forma, términos y condiciones de exigir los derechos y cumplir las obligaciones derivadas del contrato o sobre su terminación, consecuencias y liquidación se someterán a las disposiciones de la ley colombiana en materia de conciliación y arbitraje, tanto técnico como jurídico, para lo cual deberá agotarse el siguiente trámite: Toda discrepancia o controversia procurará resolverse por los respectivos representantes de las partes. En caso de no puedan ser resueltas directamente por los Representantes legales de las partes, el conflicto se someterá a la Justicia Ordinaria.</p>
 
<p>El presente contrato tendrá una Duracion de <b>".$data['contrato_duracion']."</b>, contados a partir del <b>".$data['FECHA_INICIO']."</b> Hasta <b>".$data['FECHA_FINAL']."</b>.En ningun caso se produciran renovaciones automaticas del contrato.</p> 

<p>En constancia de aceptación, se firma el presente contrato en el Municipio de Apartadó (Antioquia) a los  <b>".$data['FECHA_PERFECCIONAMIENTO']."</b>; por las partes que han intervenido, quienes procederán a suscribir el presente contrato.</p>
        ";
        return $view;
    }

} //TERMINA CLASE REPOSITORIO



// Text    
//$view = File::get(storage_path('af.txt'));
//$view = "<p>hola mundo</p>".$fecha_actual;        
// $view = \View::make('pdf.af')->render(); 
//dd($view);
// $view =  \View::make('pdf.invoice', compact('data', 'date', 'invoice'))->render();
//$vista =  \View::make('pdf.CV_CONT', compact('data'));