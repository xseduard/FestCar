<?php

namespace App\Repositories;

use App\Models\Extracto;
use InfyOm\Generator\Common\BaseRepository;
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

    function print_extractos($id){

        $extracto = $this->findWithoutFail($id);
        $codigo_cont = 'CPS'.str_pad($extracto->id, 4, "0", STR_PAD_LEFT);
        $codigo = 'CPS'.str_pad($extracto->id, 4, "0", STR_PAD_LEFT);
        global $codigo_cont; 
            
        $data = [
        'nombre_mi_empresa' => 'TRANSPORTES ESPECIALES BUSES Y MIXTOS TRANSEBA S.A.S',
        'nombre_mi_empresa_corto' => 'TRANSEBA S.A.S',
        'nit_mi_empresa' => '90000000-4',
        ];

       
        

        $pdf = new PDF('P','mm',array(216,279));

        //$pdf->Cell(Ancho,Alto,"Texto",borde,Ln 0=derecha 1=siguiente linea 2=debajo,'L/C/R',relleno true/false);
        $pdf->AddPage();
        $pdf->SetTitle(" | CONTRATO ".$data['nombre_mi_empresa_corto'],true);
        $pdf->SetSubject('Copia Contrato '.$data['nombre_mi_empresa_corto']);
        $pdf->SetCreator('FestCar Project');
        $pdf->SetAuthor('@xsED');
        $pdf->ln(30);
        $pdf->SetFont('helvetica','',15);

        //$pdf->SetMargins(25,35,5);
        $pdf->SetLeftMargin(15);
        $pdf->SetTopMargin(35);
        $pdf->SetRightMargin(5);
        
        $pdf->SetTextColor(50);
        $pdf->Cell(0,8,utf8_decode("Es un hecho establecido hace demasiado tiempo que un lector se distraerá con el contenido del texto de un sitio mientras que mira su diseño. El punto de usar Lorem Ipsum es que tiene una distribución más o menos normal de las letras, al contrario de usar textos como por ejemplo Contenido aquí, contenido aquí. Estos textos hacen parecerlo un español que se puede leer. Muchos paquetes de autoedición y editores de páginas web usan el Lorem Ipsum como su texto por defecto, y al hacer una búsqueda de Lorem Ipsum va a dar por resultado muchos sitios web que usan este texto si se encuentran en estado de desarrollo. Muchas versiones han evolucionado a través de los años, algunas veces por accidente, otras veces a propósito (por ejemplo insertándole humor y cosas por el estilo)."),1,1,"L");

        $pdf->SetFont('helvetica','',10); 
        $pdf->Cell(160,5,utf8_decode("2017"),0,1,"C");
        $pdf->SetFont('helvetica','B',15);
        $pdf->Cell(160,8,utf8_decode($codigo),0,1,"C");

        $pdf->SetFont('helvetica','',10);
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
        // helvetica bold 15

        // Move to the right
        
        // Title
        // Line break  
    }
}
