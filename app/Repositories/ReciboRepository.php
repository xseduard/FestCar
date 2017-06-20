<?php

namespace App\Repositories;

use App\Models\Recibo;
use App\Models\Empresa;
use InfyOm\Generator\Common\BaseRepository;

use Anouar\Fpdf\Fpdf as baseFpdf;

class ReciboRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'natural_id',
        'modo_pago',
        'descuento',
        'incremento',
        'observaciones'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Recibo::class;
    }

    function print_recibos($id){
        $empresa = Empresa::first();
        $recibo  = Recibo::with('user')
        ->with('natural.residenciamunicipio.departamento')
        ->with('articulos.producto')
        ->where('id',$id)
        ->first();

        $codigo     = str_pad($recibo->id, 4, "0", STR_PAD_LEFT);
        $cliente    = $recibo->natural->fullname;
        $cliente_id = number_format($recibo->natural->cedula, 0, '.', '.' );

        if (!empty($recibo->natural->direccion)) {
            $direccion = utf8_decode($recibo->natural->direccion)." ".ucwords(mb_strtolower($recibo->natural->residenciamunicipio->nombre.", ".$recibo->natural->residenciamunicipio->departamento->nombre,'utf-8'));
        } else {
            $direccion = ucwords(strtolower($recibo->natural->residenciamunicipio->nombre.", ".$recibo->natural->residenciamunicipio->departamento->nombre));
        }


        //dd($empresa);

        $pdf = new PDF_RECIBO('P','mm',array(216,279));

        //$pdf->Cell(Ancho,Alto,"Texto",borde,Ln 0=derecha 1=siguiente linea 2=debajo,'L/C/R',relleno true/false);
        $pdf->AddPage();
        $pdf->SetTitle("RC".$codigo." | RECIBO ".$empresa->nombre_corto,true);
        $pdf->SetSubject('Copia Recibo '.$empresa->nombre_corto);
        $pdf->SetCreator('FestCar Project');
        $pdf->SetAuthor('@xsED');

        //$pdf->SetMargins(25,35,5);
        $pdf->SetLeftMargin(8);
        $pdf->SetTopMargin(5);
        $pdf->SetRightMargin(5);        
                

        $pdf->ln();

        $pdf->SetFont('helvetica','b',16);
        $pdf->SetTextColor(255);
        $pdf->Cell(177,9,"","",0,"C");
        $pdf->Cell(25,9,$codigo,"",1,"C");

        $pdf->ln(1);
        $pdf->SetFont('helvetica','',10);
        $pdf->SetTextColor(100);
        $pdf->Cell(142,5,"Cliente","",0,"L");

        
        $pdf->Cell(30,5,"Fecha","",0,"C");
        $pdf->SetFont('helvetica','',12);
        $pdf->SetTextColor(50);
        $pdf->Cell(30,5,ucwords($recibo->created_at->format('d / F / Y')),"",1,"C");

        $pdf->SetFont('helvetica','',12);
        $pdf->SetTextColor(50);

        $pdf->Cell(0,5,$cliente,"",1,"L"); 
        $pdf->Cell(0,5,$cliente_id,"",1,"L");   
        $pdf->Cell(0,5,$direccion,"",1,"L");

        $pdf->ln(2);
        $pdf->SetFont('helvetica','',10);
        $pdf->SetTextColor(0,149,216);
        $pdf->Cell(101,5,'Concepto',"0",0,"L");
        $pdf->Cell(33,5,'Cantidad',"0",0,"C");
        $pdf->Cell(34,5,'Valor C/U',"0",0,"R");
        $pdf->Cell(34,5,'Sub Total',"0",1,"R");


        $pdf->SetFont('helvetica','',12);
        $pdf->SetTextColor(50);
    
        $pdf->ln(-3);

        //Articulos
        $cnt_articulos = 4;
        $total = 0;
        foreach ($recibo->articulos as $key => $value) {
            $pdf->ln(8);
            $pdf->Cell(101,5, utf8_decode($value->producto->nombre),"0",0,"L");
            $pdf->Cell(33,5,$value->cantidad,"0",0,"C");
            $pdf->Cell(34,5,number_format($value->precio_final, 0, '.', '.' ),"0",0,"R");
            $pdf->Cell(34,5,number_format($value->cantidad * $value->precio_final, 0, '.', '.' ),"0",1,"R");

            $cnt_articulos--;
            $total = $total + ($value->cantidad * $value->precio_final);
        }

        while ( $cnt_articulos > 0) {
            $pdf->ln(8);
            $cnt_articulos--;
        }
        $pdf->ln(8);

        
        $pdf->SetFont('helvetica','',6);
        $pdf->Cell(142,4,utf8_decode(\NumeroALetras::convertir($total)."PESOS ***"),"",0,'L');

        $pdf->SetFont('helvetica','',12);
        $pdf->SetTextColor(0,149,216);
        $pdf->Cell(30,5,"Total","",0,"C");

        $pdf->SetFont('helvetica','',16);
        $pdf->SetTextColor(50);
        $pdf->Cell(30,5,"$ ".number_format($total, 0, '.', '.' ),"",1,"C");
        
        $pdf->SetFont('helvetica','',12);
        $pdf->SetTextColor(100);

        $pdf->ln(12);

        $pdf->Cell(70,4,"___________________________","",0,"C");
        $pdf->Cell(10,4,"","",0,"C"); //divisor
        $pdf->Cell(70,4,"___________________________","",1,"C");

        $pdf->Cell(70,5,"Recibido Por:","",0,"C");       
        $pdf->Cell(10,4,"","",0,"C"); //divisor
        $pdf->Cell(70,5,$recibo->user->nombres." ".number_format($recibo->user->cedula, 0, '.', '.' ),"",1,"C");

        $pdf->SetFont('helvetica','',8);
        $pdf->ln(3);
        $pdf->Cell(206,5,utf8_decode($empresa->nombre_corto." Nit: ".$empresa->nit." ".$empresa->direccion_corta."  ".ucwords(mb_strtolower($empresa->ciudad.",  ".$empresa->departamento,'utf-8'))."  ".$empresa->telefono."  ".$empresa->correo),"",1,"C");
        
        
      

        

        $pdf->Output();
    }

}

class PDF_RECIBO extends baseFpdf
{
       function Header()
    {
        // Logo
        $this->Image('pdf-templates/recibo_caja.jpg',0,0,0);
        //$this->ln(0);
        // helvetica bold 15

        // Move to the right
        
        // Title
        // Line break  
    }
}
