<?php

namespace App\Repositories;

use App\Models\Pago;
use App\Models\Empresa;
use InfyOm\Generator\Common\BaseRepository;

use Carbon\Carbon;
use Flash;

use Anouar\Fpdf\Fpdf as baseFpdf;

class PagoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'cps_id',
        'contrato_vinculacion',
        'fecha_planilla',
        'fecha_inicio',
        'fecha_final',
        'desc_transaccion',
        'desc_finca',
        'desc_admin',
        'cuatro_por_mil',
        'desc_sobrecosto',
        'irregularidad',
        'subtotal',
        'total',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Pago::class;
    }


    function print_pagos($id){
        $empresa = Empresa::first();
        $pago  = Pago::with(['user',
                'pagorelfactura.factura',
                'pagorelruta.ruta',
                'pagoreldescuento.descuento',
                'cps',
                'contratovinculacion'])
        ->where('id',$id)
        ->first();

        $pdf = new PDF_PAGOS('P','mm',array(139, 216));
        $pdf->AddPage();
        $pdf->SetTitle(str_pad($pago->id, 4, "0", STR_PAD_LEFT)." | PLANILLA DE PAGO",true);
        $pdf->SetSubject('Planilla de pago');
        $pdf->SetCreator('FestCar Project');
        $pdf->SetAuthor('@xsED');

        //$pdf->SetMargins(25,35,5);
        $pdf->SetLeftMargin(5);
        $pdf->SetTopMargin(20);
        $pdf->SetRightMargin(4);        
                

        $pdf->ln();

        $pdf->SetFont('helvetica','b',16);
        $pdf->SetTextColor(255);
        $pdf->Cell(100,8,"","0",0,"C");
        $pdf->Cell(30,8,str_pad($pago->id, 4, "0", STR_PAD_LEFT),"0",1,"C");

        $pdf->SetFont('helvetica','',10);
        $pdf->SetTextColor(50);

        $pdf->Cell(50,6,utf8_decode("Placa: ".$pago->contratovinculacion->vehiculo->placa),"0",0,"L");
        if ($pago->fecha_inicio->weekOfYear == $pago->fecha_final->weekOfYear) {
            $pdf->Cell(43,6,utf8_decode("Semana: ".$pago->fecha_inicio->weekOfYear),"0",0,"L");
        } else{
            $pdf->Cell(43,6,utf8_decode("Semanas: ".$pago->fecha_inicio->weekOfYear." a ".$pago->fecha_final->weekOfYear),"0",0,"L");
        }
        $pdf->Cell(35,6,utf8_decode(mb_strtoupper($pago->fecha_planilla->format('d / M / Y'),'utf-8')),"0",1,"R");

        $pdf->SetFont('helvetica','',8);
        $pdf->SetTextColor(100);

        if (!is_null($pago->contratovinculacion->responsable)) {           
            $pdf->Cell(0,4,"Propietario (Responsable)","0",1,"L");
        } else {
            $pdf->Cell(0,4,"Propietario (Contratista)","0",1,"L");
        }

        $pdf->SetFont('helvetica','',10);
        $pdf->SetTextColor(50);

        if (!is_null($pago->contratovinculacion->responsable)) {
            $pdf->Cell(30,6,utf8_decode("CC ".number_format($pago->contratovinculacion->responsable->cedula, 0, '.', ',' )),"0",0,"L");
            $pdf->Cell(100,6,utf8_decode($pago->contratovinculacion->responsable->fullname),"0",1,"L");
        } else {
            if ($pago->contratovinculacion->tipo_proveedor == 'Natural') {
                $pdf->Cell(30,6,utf8_decode("CC ".number_format($pago->contratovinculacion->natural->cedula, 0, '.', ',' )),"0",0,"L");
                $pdf->Cell(100,6,utf8_decode($pago->contratovinculacion->natural->fullname),"0",1,"L");
            } else if ($pago->contratovinculacion->tipo_proveedor == 'Juridico') {
                $pdf->Cell(30,6,utf8_decode("Nit ".$pago->contratovinculacion->juridico->nit),"0",0,"L");
                $pdf->Cell(100,6,utf8_decode($pago->contratovinculacion->juridico->nombre),"0",1,"L");
            }
        }

        $pdf->SetFont('helvetica','',8);
        $pdf->SetTextColor(100);

        $pdf->Cell(0,4,"Cliente","0",1,"L");

        $pdf->SetFont('helvetica','',10);
        $pdf->SetTextColor(50);

        if ($pago->cps->tipo_cliente == "Natural") {
            $pdf->Cell(30,6,utf8_decode("CC ".number_format($pago->cps->natural->cedula, 0, '.', ',' )),"0",0,"L");
            $pdf->Cell(100,6,utf8_decode($pago->cps->natural->fullname),"0",1,"L");
        } elseif ($pago->cps->tipo_cliente == "Juridico") {
            $pdf->Cell(30,6,utf8_decode("Nit ".$pago->cps->juridico->nit),"0",0,"L");
            $pdf->Cell(100,6,utf8_decode($pago->cps->juridico->nombre),"0",1,"L");
        }
        //dd($pago->PagoRelFactura);
        $all_facturas = "";
        foreach ($pago->PagoRelFactura as $key => $value) {
            if (!empty($all_facturas)) {
                  $all_facturas .= ", ";
               } 
            $all_facturas .=  "CR0000".$value->factura->codigo;            
        }

        $pdf->SetFont('helvetica','',8);
        $pdf->SetTextColor(100);

        $pdf->Cell(0,4,"Factura(s)","0",1,"L");        
        $pdf->SetFont('helvetica','',10);
        $pdf->SetTextColor(50);

        $pdf->Cell(0,6,utf8_decode($all_facturas),"0",1,"L");  
        
        $pdf->Ln(6);
        //$pdf->SetFont('helvetica','',8);
        $pdf->SetTextColor(0,149,219);

        $pdf->Cell(64,4,"Ruta","0",0,"L");
        $pdf->Cell(12,4,"Viajes","0",0,"C");
        $pdf->Cell(27,4,"Valor C/U","0",0,"C");
        $pdf->Cell(27,4,"SubTotal","0",1,"C");

        $pdf->SetFillColor(0,149,219);
        $pdf->Cell(130,0.5,"","0",1,1,"L");  //linea-divisor
        $pdf->Ln(1);

        $pdf->SetTextColor(50);
        //dd($pago->pagorelruta);
      foreach ($pago->pagorelruta as $key => $value) {
            $col = array();
            $col[] = array('text' => utf8_decode($value->ruta->nombre),
             'width' => '64',
             'height' => '8',
             'align' => 'L',
             'font_name' => 'helvetica',
             'font_size' => '10',
             'font_style' => '',
             'fillcolor' => '255,255,255',
             'textcolor' => '50,50,50',
             'drawcolor' => '0,0,0',
             'linewidth' => '0.4',
             'linearea' => '0');
            $col[] = array('text' => floatval($value->cantidad_viajes),
             'width' => '12',
             'height' => '8',
             'align' => 'C',
             'font_name' => 'helvetica',
             'font_size' => '10',
             'font_style' => '',
             'fillcolor' => '255,255,255',
             'textcolor' => '50,50,50',
             'drawcolor' => '0,0,0',
             'linewidth' => '0.4',
             'linearea' => '0');
            $col[] = array('text' => "$".number_format($value->valor_final, 2, '.', ',' ),
             'width' => '27',
             'height' => '8',
             'align' => 'C',
             'font_name' => 'helvetica',
             'font_size' => '10',
             'font_style' => '',
             'fillcolor' => '255,255,255',
             'textcolor' => '50,50,50',
             'drawcolor' => '0,0,0',
             'linewidth' => '0.4',
             'linearea' => '0');
            $col[] = array('text' => "$".number_format(($value->cantidad_viajes * $value->valor_final), 2, '.', ',' ),
             'width' => '27',
             'height' => '8',
             'align' => 'C',
             'font_name' => 'helvetica',
             'font_size' => '10',
             'font_style' => '',
             'fillcolor' => '255,255,255',
             'textcolor' => '50,50,50',
             'drawcolor' => '0,0,0',
             'linewidth' => '0.4',
             'linearea' => '0');   
            $tabla_rutas[] = $col;

        
      }

        // Draw Table  
        $pdf->WriteTable($tabla_rutas);

        $pdf->Ln(2);
        $pdf->SetFillColor(0,149,219);
        $pdf->SetDrawColor(220);
        $pdf->Cell(130,0.5,"","0",1,1,"L");  //linea-divisor
        $pdf->Ln(3);

        $pdf->SetFont('helvetica','',10);
        $pdf->Cell(90,6,"Valor Facturado","B",0,"L");
        $pdf->Cell(35,6,"$".number_format($pago->CalcFacturado, 2, '.', ',' ),"B",1,"R");
         $descuento_finca = $pago->CalcFacturado * $pago->desc_finca/100;
         $total_facturado = $pago->CalcFacturado - $descuento_finca;
        $pdf->Cell(90,6,"Descuento Finca","B",0,"L");    
        $pdf->Cell(35,6,"$ -".number_format($descuento_finca, 2, '.', ',' ),"B",1,"R");        
        $pdf->Cell(90,8,"Total Facturado","B",0,"L");
        $pdf->SetFont('helvetica','B',11);
        $pdf->Cell(35,8,"$".number_format($total_facturado, 2, '.', ',' ),"B",1,"R");
        $pdf->SetFont('helvetica','',10);

        $pdf->Ln();
        $pdf->Cell(90,6,utf8_decode("Transacción"),"B",0,"L");
        $pdf->Cell(35,6,"$ -".number_format($pago->desc_transaccion, 2, '.', ',' ),"B",1,"R");
        $pdf->Cell(90,6,"4x1000","B",0,"L");
        $pdf->Cell(35,6,"$ -".number_format($pago->CalcCuatroPorMil, 2, '.', ',' ),"B",1,"R");
        $pdf->Cell(90,6,utf8_decode("Administración"),"B",0,"L");
        $pdf->Cell(35,6,"$ -".number_format($pago->CalcFacturado * $pago->desc_admin/100, 2, '.', ',' ),"B",1,"R");

        if ($pago->desc_sobrecosto > 0) {
            $pdf->Cell(90,6,utf8_decode("Sobrecosto"),"B",0,"L");
            $pdf->Cell(35,6,"$ -".number_format($pago->desc_sobrecosto, 2, '.', ',' ),"B",1,"R");
        }
        
       

        $desc_each = 0;
        if (!is_null($pago->PagoRelDescuento)) {
           foreach ($pago->PagoRelDescuento as $key => $value) {
            $pdf->Cell(90,6,utf8_decode($value->descuento->nombre),"B",0,"L");
            $pdf->Cell(35,6,"$ -".number_format($value->valor, 2, '.', ',' ),"B",1,"R");
            
                $desc_each = $desc_each + $value->valor;
            }
        }

        $descuentos = $pago->desc_transaccion + $pago->desc_sobrecosto + $pago->CalcCuatroPorMil + ($pago->CalcFacturado * $pago->desc_admin/100) + $desc_each;
        

        $total = $total_facturado - $descuentos;


        $pdf->Cell(90,8,"Total Deducciones","B",0,"L");
        $pdf->SetFont('helvetica','B',11);
        $pdf->Cell(35,8,"$".number_format($descuentos, 2, '.', ',' ),"B",1,"R");
        $pdf->SetFont('helvetica','',10);
        $pdf->ln(3);

        $col = array();
        $col[] = array('text' => utf8_decode("Consignado en:"),
         'width' => '68',
         'height' => '6',
         'align' => 'L',
         'font_name' => 'helvetica',
         'font_size' => '10',
         'font_style' => '',
         'fillcolor' => '255,255,255',
         'textcolor' => '100,100,100',
         'drawcolor' => '0,0,0',
         'linewidth' => '0.4',
         'linearea' => '0');
        $col[] = array('text' => "",
         'width' => '27',
         'height' => '6',
         'align' => 'R',
         'font_name' => 'helvetica',
         'font_size' => '10',
         'font_style' => '',
         'fillcolor' => '255,255,255',
         'textcolor' => '50,50,50',
         'drawcolor' => '0,0,0',
         'linewidth' => '0.4',
         'linearea' => '0');
         $col[] = array('text' => "",
         'width' => '35',
         'height' => '6',
         'align' => 'R',
         'font_name' => 'helvetica',
         'font_size' => '10',
         'font_style' => '',
         'fillcolor' => '255,255,255',
         'textcolor' => '50,50,50',
         'drawcolor' => '0,0,0',
         'linewidth' => '0.4',
         'linearea' => '0');    
        $valores_finales[] = $col;

        $col = array();
        $col[] = array('text' => utf8_decode($pago->contratovinculacion->entidad_bancaria." - ".$pago->contratovinculacion->numero_cuenta_bancaria),
         'width' => '68',
         'height' => '6',
         'align' => 'L',
         'font_name' => 'helvetica',
         'font_size' => '8',
         'font_style' => '',
         'fillcolor' => '255,255,255',
         'textcolor' => '50,50,50',
         'drawcolor' => '0,0,0',
         'linewidth' => '0.4',
         'linearea' => '0');
        $col[] = array('text' => utf8_decode('Valor a Pagar'),
         'width' => '27',
         'height' => '6',
         'align' => 'R',
         'font_name' => 'helvetica',
         'font_size' => '11',
         'font_style' => '',
         'fillcolor' => '255,255,255',
         'textcolor' => '50,50,50',
         'drawcolor' => '0,0,0',
         'linewidth' => '0.4',
         'linearea' => '0');
         $col[] = array('text' => "$".number_format($total, 2, '.', ',' ),
         'width' => '35',
         'height' => '6',
         'align' => 'C',
         'font_name' => 'helvetica',
         'font_size' => '12',
         'font_style' => 'B',
         'fillcolor' => '255,255,255',
         'textcolor' => '0,149,219',
         'drawcolor' => '0,0,0',
         'linewidth' => '0.4',
         'linearea' => '0');    
        $valores_finales[] = $col;

        $col = array();
        $col[] = array('text' => utf8_decode(\NumeroALetras::convertir($total)."PESOS ***"),
         'width' => '130',
         'height' => '6',
         'align' => 'R',
         'font_name' => 'helvetica',
         'font_size' => '6',
         'font_style' => '',
         'fillcolor' => '255,255,255',
         'textcolor' => '50,50,50',
         'drawcolor' => '0,0,0',
         'linewidth' => '0.4',
         'linearea' => '0');
         $valores_finales[] = $col;

        
        // Draw Table  
        $pdf->WriteTable($valores_finales);


        $pdf->Output();

        

    }
}



class PDF_PAGOS extends baseFpdf
{
       function Header()
    {
        // Logo
        // $this->Image('pdf-templates/pagos_membrete.jpg',0,0,0);
        $this->Image('pdf-templates/pagos_membrete_2.jpg',0,0,-198);
        $this->ln(5);
        // helvetica bold 15

        // Move to the right
        
        // Title
        // Line break  
    }

     // Margins
   var $left = 10;
   var $right = 10;
   var $top = 10;
   var $bottom = 10;
         
   // Create Table
   function WriteTable($tcolums)
   {
      // go through all colums
      for ($i = 0; $i < sizeof($tcolums); $i++)
      {
         $current_col = $tcolums[$i];
         $height = 0;
         
         // get max height of current col
         $nb=0;
         for($b = 0; $b < sizeof($current_col); $b++)
         {
            // set style
            $this->SetFont($current_col[$b]['font_name'], $current_col[$b]['font_style'], $current_col[$b]['font_size']);
            $color = explode(",", $current_col[$b]['fillcolor']);
            $this->SetFillColor($color[0], $color[1], $color[2]);
            $color = explode(",", $current_col[$b]['textcolor']);
            $this->SetTextColor($color[0], $color[1], $color[2]);            
            $color = explode(",", $current_col[$b]['drawcolor']);            
            $this->SetDrawColor($color[0], $color[1], $color[2]);
            $this->SetLineWidth($current_col[$b]['linewidth']);
                        
            $nb = max($nb, $this->NbLines($current_col[$b]['width'], $current_col[$b]['text']));            
            $height = $current_col[$b]['height'];
         }  
         $h=$height*$nb;
         
         
         // Issue a page break first if needed
         $this->CheckPageBreak($h);
         
         // Draw the cells of the row
         for($b = 0; $b < sizeof($current_col); $b++)
         {
            $w = $current_col[$b]['width'];
            $a = $current_col[$b]['align'];
            
            // Save the current position
            $x=$this->GetX();
            $y=$this->GetY();
            
            // set style
            $this->SetFont($current_col[$b]['font_name'], $current_col[$b]['font_style'], $current_col[$b]['font_size']);
            $color = explode(",", $current_col[$b]['fillcolor']);
            $this->SetFillColor($color[0], $color[1], $color[2]);
            $color = explode(",", $current_col[$b]['textcolor']);
            $this->SetTextColor($color[0], $color[1], $color[2]);            
            $color = explode(",", $current_col[$b]['drawcolor']);            
            $this->SetDrawColor($color[0], $color[1], $color[2]);
            $this->SetLineWidth($current_col[$b]['linewidth']);
            
            $color = explode(",", $current_col[$b]['fillcolor']);            
            $this->SetDrawColor($color[0], $color[1], $color[2]);
            
            
            // Draw Cell Background
            $this->Rect($x, $y, $w, $h, 'FD');
            
            $color = explode(",", $current_col[$b]['drawcolor']);            
            $this->SetDrawColor($color[0], $color[1], $color[2]);
            
            // Draw Cell Border
            if (substr_count($current_col[$b]['linearea'], "T") > 0)
            {
               $this->Line($x, $y, $x+$w, $y);
            }            
            
            if (substr_count($current_col[$b]['linearea'], "B") > 0)
            {
               $this->Line($x, $y+$h, $x+$w, $y+$h);
            }            
            
            if (substr_count($current_col[$b]['linearea'], "L") > 0)
            {
               $this->Line($x, $y, $x, $y+$h);
            }
                        
            if (substr_count($current_col[$b]['linearea'], "R") > 0)
            {
               $this->Line($x+$w, $y, $x+$w, $y+$h);
            }
            
            
            // Print the text
            $this->MultiCell($w, $current_col[$b]['height'], $current_col[$b]['text'], 0, $a, 0);
            
            // Put the position to the right of the cell
            $this->SetXY($x+$w, $y);         
         }
         
         // Go to the next line
         $this->Ln($h);          
      }                  
   }

   
   // If the height h would cause an overflow, add a new page immediately
   function CheckPageBreak($h)
   {
      if($this->GetY()+$h>$this->PageBreakTrigger)
         $this->AddPage($this->CurOrientation);
   }


   // Computes the number of lines a MultiCell of width w will take
   function NbLines($w, $txt)
   {
      $cw=&$this->CurrentFont['cw'];
      if($w==0)
         $w=$this->w-$this->rMargin-$this->x;
      $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
      $s=str_replace("\r", '', $txt);
      $nb=strlen($s);
      if($nb>0 and $s[$nb-1]=="\n")
         $nb--;
      $sep=-1;
      $i=0;
      $j=0;
      $l=0;
      $nl=1;
      while($i<$nb)
      {
         $c=$s[$i];
         if($c=="\n")
         {
            $i++;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
            continue;
         }
         if($c==' ')
            $sep=$i;
         $l+=$cw[$c];
         if($l>$wmax)
         {
            if($sep==-1)
            {
               if($i==$j)
                  $i++;
            }
            else
               $i=$sep+1;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
         }
         else
            $i++;
      }
      return $nl;
   }
}
