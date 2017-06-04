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
use Carbon\Carbon;
use File;


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

    function municipio_departamento($id){
            $dato = Municipio::where('id', $id)->first();
            $result = $dato->nombre.', '.$dato->departamento->nombre;
            return $result;
    }

    function print_contratos($id){
         //pdf
        $contrato = $this->findWithoutFail($id);
        global $codigo;
        $codigo = $contrato->tipo_contrato.str_pad($contrato->id, 4, "0", STR_PAD_LEFT);

        
        $fecha_actual = Carbon::now();




        dd($contrato->created_at->diffForHumans());

        $data = [
        'representante_transeba' => strtoupper($contrato->rl_name).' '.strtoupper ($contrato->rl_lastname),
        'NIT_MI_EMPRESA' => '438413513',
        'NOMBRE_EMPRESA' => 'TRANSPORTES ESPECIALES BUSES Y MIXTOS TRANSEBA S.A.S',
        'NOMBRE_RTE_LEGAL_MI_EMPRESA' =>  strtoupper($contrato->rl_name).' '.strtoupper ($contrato->rl_lastname),
        'CEDULA_RTE_LEGAL_MI_EMPRESA' => $contrato->rl_id,
        'LUGAR_EXP_CED_RTE_LEGAL_MI_EMPRESA' => $contrato->rl_id_ref,
        'NOMBRE_PROP_VEHICULO' => $contrato->natural->nombres.' '. $contrato->natural->apellidos,
        'DIRECCION_PROP_VEHICULO' => 'DATO faltante:(DIRECCION_PROP_VEHICULO) ',
        'LUGAR_EXP_PROP_VEHICULO' => $this->municipio_departamento($contrato->natural->municipio_id),
        'CEDULA_PROP_VEHICULO' => $contrato->natural->cedula,
        'DIR_MUNINCIPIO_PROP_VEHICULO' => '',
        'MUNICIPIO_MI_EMPRESA' => 'Apartadó, Antioquia',
        'DATOS_VEHICULO' => 'FALTA TABLA VEHICULO',
        'DURACION_CONTRATO' => 'FALTA',
        'FECHA_INICIO' => $contrato->fecha_inicio,
        'FECHA_FINAL' => $contrato->fecha_final,
        'VALOR_CUOTA_ADMIN' => '150.000',
        'VALOR_CUOTA_ADMIN_PORCENTAJE' => '5',
        'FECHA_PERFECCIONAMIENTO' => $contrato->created_at,
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
        $view = "<p>Entre <b>".$data['NOMBRE_EMPRESA']."</b>, Sociedad Comercial con domicilio en Apartado Antioquia, representada legalmente por la señora <b>".$data['NOMBRE_RTE_LEGAL_MI_EMPRESA']."</b>, mayor de edad, identificado (a) con la cedula de ciudadanía  N° <b>".$data['CEDULA_RTE_LEGAL_MI_EMPRESA']."</b>  expedida en  <b>".$data['LUGAR_EXP_CED_RTE_LEGAL_MI_EMPRESA']."</b>, y que en el  presente acto se denominara LA EMPRESA, y el señor (a) <b>".$data['NOMBRE_PROP_VEHICULO']."</b>, portador de la cedula de ciudadanía N° <b>".$data['CEDULA_PROP_VEHICULO']."</b>, expedida en ".$data['LUGAR_EXP_PROP_VEHICULO'].", y quien para efectos legales del presente documento se denominara EL CONTRATISTA, se ha celebrado el presente contrato de VINCULACION Y ADMINISTRACION DELEGADA DE UN VEHÍCULO AUTOMOTOR en ejercicio de nuestra libertad contractual, el cual se regirá por las siguientes CLAUSULAS: </p>

<p><b>PRIMERA. OBJETO: EL CONTRATISTA</b>, en calidad de PROPIETARIO se obliga a vincular un equipo automotor a <b>LA EMPRESA</b>,  con el ánimo de que este último lo incorpore a su parque automotor y lo administre delegadamente. <b>EL CONTRATISTA</b> prestara los servicios de transporte de pasajeros que autorice  <b>LA EMPRESA</b>, en  los diferentes contratos de Servicio Público de Transporte Terrestre Automotor Especial y con los cuales explota la actividad transportadora  de pasajeros en un radio de acción Nacional. Para los efectos referidos, las características del vehículo que se vincula y que será administrado por <b>LA EMPRESA</b> son las siguientes: </p>

<p>".$data['DATOS_VEHICULO']."</p>

<p><b>SEGUNDA: EL CONTRATISTA</b> garantiza que el equipo automotor  descrito en la cláusula anterior se encuentra en perfecto estado de funcionamiento y de presentación, que en igual condiciones se comprometen a tenerlo durante el término de duración del presente contrato. De igual forma, <b>EL CONTRATISTA</b> manifiesta que el automotor referido se encuentra libre de embargos, pleitos pendientes de cualquier naturaleza, limitaciones al dominio y todo tipo de gravamen. <b>PARAGRAFO</b>: No obstante lo anterior, la empresa se reserva el derecho de admitir según cada caso, los vehículos  que se encontraren en alguna de las situaciones citadas en precedencia, siempre y cuando no perjudiquen ni la marcha de LA EMPRESA, ni su patrimonio. </p>

<p><b>TERCERA. DURACION DEL CONTRATO </b>: El presente contrato tendrá una Duracion de <b>".$data['DURACION_CONTRATO']."</b>, contados a partir del <b>".$data['FECHA_INICIO']."</b> Hasta <b>".$data['FECHA_FINAL']."</b>. En ningun caso se produciran renovaciones automaticas del contrato.</p> 

<p><b>CUARTA. CUOTA DE ADMINISTRACION</b>: <b>EL CONTRATISTA</b> se obliga a pagar a <b>LA EMPRESA</b> como cuota de administración mensual, el cinco (".$data['VALOR_CUOTA_ADMIN_PORCENTAJE'].") por ciento (%) del valor que facture en el mes; en todo caso, la cuota mensual no podrá ser inferior a la suma de <b>".$data['VALOR_CUOTA_ADMIN']."</b>, valor que se incrementará cada año de acuerdo al IPC. <b>EL CONTRATISTA</b> autoriza a <b>LA EMPRESA</b> a que descuente automáticamente el porcentaje correspondiente a la cuota de administración del producido del vehiculo. o en en su defecto, la suma será cancelada  por <b>EL CONTRATISTA</b> en la oficina  de LA EMPRESA, dentro de los  tres (3) primeros días hábiles de cada  mes vencido. </p> 

<p><b>QUINTA. OBLIGACIONES DEL CONTRATISTA</b>: <b>EL CONTRATISTA</b> se compromete con la empresa a: 1) mantener el vehículo descrito en la cláusula primera de este contrato, en perfectas condiciones mecánicas, de presentación,  comodidad e higiene, necesarias para que  el  mismo pueda  cumplir el objetivo de la vinculación, esto es, prestar Servicio Público de Transporte Terrestre Automotor Especial durante todo el día  y en forma continua, excluidos en todo caso todos los días asignados para el mantenimiento y reparación del automotor. 2) A cancelar cumplidamente  y en forma establecida en la cláusula cuarta,  las obligaciones económicas adquiridas para con la empresa. 3) A informar por escrito el nombre de la persona que habrá de actuar como conductor del vehículo y a suministrar a LA EMPRESA copia del contrato laboral firmado entre  EL <b>CONTRATISTA Y EL CONDUCTOR</b>,   así  como informar de las modificaciones que a dicho contrato se le efectúen. 4) Pagar en forma oportuna los salarios  y prestaciones  económicas a  que tenga derecho el conductor, a afiliarlo al Sistema de Seguridad Social Integral (salud, pensiones, riesgos profesionales), y aportes parafiscales en las cuantías de ley, dentro de los periodos de tiempo estipulados  por la Ley. 5). Liquidar correctamente al conductor en el momento de cancelación  o terminación del  contrato y como previo requisito a la contratación de nuevo conductor, de todo lo cual deberá aportar copias a LA EMPRESA. En todo caso, <b>EL CONTRATISTA</b> cubre a <b>LA EMPRESA</b> de los perjuicios que se le ocasionen como consecuencia de incumplimiento de las obligaciones laborales a que esté obligado <b>EL CONTRATISTA</b>, derivadas de la contratación del personal utilizado para la ejecución del contrato, pactando la obligación de <b>EL CONTRATISTA</b>() de mantenerla libre de cualquier daño o perjuicio originado en reclamaciones de terceros y que se deriven de sus actuaciones de sus subcontratistas o dependientes. 6). Cumplir órdenes dadas por <b>LA EMPRESA</b> y acatar las disposiciones y reglamentos de la misma. <b>EL CONTRATISTA</b> exigirá al conductor el cumplimiento de tales obligaciones. 7).<b>EL CONTRATISTA</b>, deberá responder con su vehículo y con otros bienes de su patrimonio, si fuere necesario, por conceptos de pagos que la empresa se viere obligada a efectuar  por él o por el conductor  o su ayudante. Si la empresa fuera demandada civil, laboral o administrativamente, por actuaciones  correspondientes  a <b>EL CONTRATISTA</b>, este último pagara todos y cada  uno  de los gastos que cause el litigio, tales como honorarios, costos y gastos judiciales, pagos de sentencias y perjuicios, conceptos que deberá cubrir en forma total y que en caso de efectuarlos, <b>LA EMPRESA</b> podrá exigir su cumplimiento por la vía  ejecutiva. Para lo anterior  bastara la sola presentación del contrato y la liquidación  correspondiente a la obligación  incumplida  por <b>EL CONTRATISTA</b> 8). Deberá igualmente EL CONTRATISTA obtener una póliza de seguros  que cubra los eventos de responsabilidad civil contractual y extracontractual en caso de muerte, lesiones, daños a  terceros o sus bienes. Las anteriores pólizas deben estar siempre vigentes durante la duración de este contrato, en los montos establecidos por la ley. 9) A cancelar oportunamente los valores mensuales que adeuda a <b>LA EMPRESA</b>, independiente de que la finca, gremio bananero y demás, paguen o no oportunamente los servicios de transporte contratados y prestados. 10). Acogerse  a lo estipulado por la ley, en cuanto a las obligaciones  de aportes al Fondo de Reposición  establecido en la cuantía  que establezca el <b>MINISTERIO DEL TRANSPORTE</b> o la autoridad encargada y a respetar el reglamento que adopte <b>LA EMPRESA</b> 11). En caso  de venta y retiro del automotor de la empresa, se perderá el cupo en la misma, dado que este contrato cubre solo el equipo automotor descrito en la cláusula primera de este convenio y dejando claro que el cupo utilizado es de la empresa y hace parte de su capacidad transportadora  otorgada a la empresa por el MINISTERIO DE TRANSPORTE. 12). Avisar oportunamente a LA  EMPRESA cuando el vehículo no esté en condiciones de prestar el servicio contratado. Dicho aviso se hará en horarios de oficina (de 8 a 12 AM  y de 2 a 6 PM). Para proceder a asignar un reemplazo, deberá avisar con antelación de: a) De tres (03) horas antes del cierre de la oficina, es decir máximo hasta las 3:00 PM., cuando el servicio sea para el siguiente día. b) De seis (06) horas, antes del cierre de oficina, es decir máximo hasta las 12:00 AM, cuando el servicio sea para el horario de recogida de personal el mismo día. 13) Durante toda la prestación del servicio, el conductor del equipo automotor deberá portar en papel membreteado de la empresa y firmado por el representante legal de la misma o un empleado designado por él, un extracto del contrato que ejecuta.<b>EL CONTRATISTA</b> será responsable del cumplimiento del mismo. 14) El equipo automotor de propiedad del <b>CONTRATISTA</b>  deberá llevar los colores verde y/o blanco distribuidos a lo largo y ancho de la carrocería. 15) Si el equipo automotor transporta estudiantes, además de lo mencionado en el numeral anterior, debe pintar en la parte posterior de la carrocería del vehículo franjas alternas de diez (10) centímetros de ancho en colores amarillo pantone 109 Y negro, con inclinación de 45 grados y una altura mínima de 60 centímetros. Igualmente, en la parte superior y delantera de la carrocería en caracteres destacados, de altura mínima de 10 centímetros, deberán llevar la leyenda *Escolar. 16) El equipo automotor vinculado y administrado deberá cumplir con las condiciones técnico-mecánicas y con las especificaciones de tipología vehicular requeridas y homologadas por el Ministerio de Transporte para la prestación de este servicio. 17) El conductor del equipo automotor no admitirá pasajeros de pie en ningún caso. Cada pasajero ocupará un (1) puesto de acuerdo con la capacidad establecida en la ficha de homologación del vehículo y de la licencia de tránsito. Será responsabilidad de EL CONTRATISTA vigilar el cumplimiento de tal prohibición por parte del conductor del equipo automotor, siendo <b>EL CONTRATISTA</b> el responsable civil y penal ante cualquier accidente. 18) EL CONTRATISTA y su conductor deben cumplir en forma estricta con el REGLAMENTO de LA EMPRESA y así mismo manifiestan tener pleno conocimiento del mismo y haber recibido una copia  de <b>LA EMPRESA</b> al momento de la suscripción del presente contrato. 19) <b>EL CONTRATISTA</b> y/o el conductor del equipo automotor deberá portar el original de la tarjeta de operación y presentarla a la autoridad competente que la solicite. 20) El conductor del equipo automotor durante la prestación del servicio de transporte de pasajeros deberá portar la camiseta y el carnet que lo identifique como el conductor del vehículo y que contengan los emblemas de la empresa. Será responsabilidad de <b>EL CONTRATISTA</b> proveer al conductor de esta dotación en los tiempos que estipula la ley.</p>

<p><b> SEPTIMA EXCLUSIÓN DE LA RELACIÓN LABORAL: </b> Queda claramente entendido que no existirá relación laboral alguna entre <b>LA EMPRESA y EL CONTRATISTA</b>, o el personal que éste utilice en la ejecución del objeto del presente contrato. EL CONTRATISTA es el único responsable por la vinculación del personal lo cual realiza en su propio nombre y por su cuenta y riesgo, sin que <b>LA EMPRESA</b> adquiera responsabilidad alguna por sus actos. Por tanto corresponde a <b>EL CONTRATISTA</b>, el pago de los salarios, prestaciones sociales e indemnizaciones a que haya lugar  </p>
<p><b>OCTAVA. CAUSALES DE TERMINACION DEL CONTRATO Y DESVINCULACIÓN ADMINISTRATIVA</b>: Este contrato termina por mutuo acuerdo entre las partes o por vencimiento del término de duración del contrato. , por cambio o mutación en el equipo automotor. La empresa podrá terminar el contrato  de vinculación de forma unilateral por: 1) No cumplir con el plan de rodamiento registrado por la empresa ante la autoridad competente. 2) No acreditar oportunamente ante la empresa la totalidad de los requisitos exigidos por la norma para el trámite de los documentos de transporte. 3) No cancelar oportunamente a la empresa los valores pactados en el contrato de vinculación. 4) Negarse a efectuar el mantenimiento preventivo del vehículo, de acuerdo con el plan señalado por la empresa. 5) No efectuar los aportes obligatorios al fondo de reposición</p>

<p><b>NOVENA. SANCIÓN E INTERES POR MORA</b>: Acorde con el articulo 1610 y 1617 del Código Civil y demás normas concordantes, el incumplimiento en el pago de las obligaciones referentes a la cuota de administración o sanciones y perjuicios ocasionados a  LA EMPRESA, acarreará a <b>EL CONTRATISTA</b> la respectiva sanción por mora, viéndose obligado a pagar el interés legal permitido al momento de la mora.  En caso  de incumplimiento de alguna de las obligaciones de tipo económico que libremente se imponen a <b>EL CONTRATISTA, LA EMPRESA</b> queda facultada  a promover,  independientemente  las acciones civiles pertinentes, como también  a adoptar  la fórmula de no autorizar el servicio de transporte contratado en el vehículo  hasta tanto se cumplan  las obligaciones o se garantice  el pago  de las mismas.  En tal evento, EL CONTRATISTA renuncia a promover  acciones de cualquier naturaleza con miras a obtener resarcimiento de perjuicios</p>

<p><b>DECIMA. EXTRACTO DEL CONTRATO</b>: Durante toda la prestación del servicio, el conductor del vehículo deberá portar en papel membreteado de la empresa y firmado por el representante legal de la misma  o quien este delegue, un extracto del contrato que contenga como mínimo los datos del contrato a ejecutar. Queda prohibido que <b>EL CONTRATISTA</b> o su conductor celebren contratos de Servicio Público de Transporte Terrestre Automotor Especial de forma directa con particulares. En todo caso, si <b>EL CONTRATISTA</b> y/o el conductor es sorprendido por las autoridades competentes prestando el servicio de transporte sin el correspondiente extracto contrato, será responsabilidad exclusiva de <b>EL CONTRATISTA</b>, quien responderá por el cien (100) por ciento (%) de la sanción económica y/o perjuicios que le ocasione a <b>LA EMPRESA</b>. Por disposición del artículo 2.2.1.6.3.3 del Decreto 1079 de 2015, está terminantemente PROHIBIDO que EL CONTRATISTA permita o no verifique que su automotor preste el <b>SERVICIO PÚBLICO DE TRANSPORTE TERRESTRE AUTOMOTOR ESPECIAL</b> sin haber un contrato <b>DE PRESTACIÓN DE SERVICIOS DE TRANSPORTE</b> suscrito con la empresa <b>".$data['NOMBRE_EMPRESA']."</b>., y mucho menos salir a prestar el servicio sin portar el <b>EXTRACTO DEL CONTRATO, SO PENA DE ASUMIR TODA LA RESPONSABILIDAD CIVIL, PENAL Y ADMINISTRATIVA</b> de las infracciones que impongan las autoridades de control o los accidentes que ocurran durante la prestación del servicio</p>


<p><b>DECIMA PRIMERA.  CLAUSULA COMPROMISORIA</b>: Toda controversia o diferencia relativa a este contrato, se resolverá por un tribunal de arbitramento que por economía será designado por las partes y será del domicilio donde se debió ejecutar el servicio contratado. El tribunal de Arbitramento se sujetara a lo dispuesto en el estatuto orgánico de los sistemas alternativos de solución de conflictos y demás normas concordantes</p>
<p><b>DECIMA SEGUNDA. NATURALEZA LEGAL DEL CONTRATO</b>: El presente contrato se rige por lo dispuesto en el Código Civil, Código de Comercio, decreto 1079 de 2015, decreto 431 de 2017 y demás normas concordantes</p>

<p><b>DECIMA TERCERA. PAGO DE LOS SERVICIOS DE TRANSPORTE</b>: Durante la prestación del Servicio Público de Transporte Terrestre Automotor Especial, se le cancelara a EL CONTRATISTA los servicios de transporte ejecutados, una vez estos sean pagados a LA EMPRESA por el usuario del servicio. <b>LA EMPRESA</b> no responderá por el pago de los servicios que no cancelen los usuarios-contratantes.</p>

<p>En constancia de aceptación, se firma el presente contrato en el Municipio de ".$data['MUNICIPIO_MI_EMPRESA']." a los  <b>".$data['FECHA_PERFECCIONAMIENTO']."</b>; por las partes que han intervenido, quienes procederán a suscribir y plasmar su huella dactilar (dedo índice) en el presente contrato,  advirtiéndose  que al mismo  se entienden incorporadas las disposiciones que sobre administración delegada  consagra la normatividad legal vigente y que este contrato presta mérito ejecutivo por contener una obligación clara, expresa y exigible para las partes.</p>";

        //$view = File::get(storage_path('af.txt'));
        //$view = "<p>hola mundo</p>".$fecha_actual;
        
// $view = \View::make('pdf.af')->render(); 
//dd($view);
// $view =  \View::make('pdf.invoice', compact('data', 'date', 'invoice'))->render();
//$view =  \View::make('pdf.CV_CONT', compact('data'))->render();
//dd($view);

        $pdf->WriteTag(0,6,utf8_decode($view),0,"J",0,0);
        $pdf->Ln();
        $pdf->Ln();
        $pdf->AliasNbPages();
        $pdf->Output();
    exit;
    } //termina funcion print_contratos


} //TERMINA CLASE REPOSITORIO
