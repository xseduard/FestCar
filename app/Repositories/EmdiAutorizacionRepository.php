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
        $pdf->Cell(0,9,utf8_decode("Autorización de Transporte No. ".$codigo),"",1,"C");


        $pdf->ln(20);
        $pdf->SetFont('helvetica','',10);

        $pdf->Cell(0,9,utf8_decode("Fecha: ".$autorizacion->created_at->format('d')." de ".mb_strtoupper($autorizacion->created_at->format('F'),'utf-8')." de ".$autorizacion->created_at->format('Y')),"",1,"L");

        $pdf->Multicell(0,10,utf8_decode("EMDISALUD ESS EPS-S con nit  811004055-5 Autoriza a TRANSEBA S.A.S. con nit 900414811-9 a prestar el servicio de transporte de usuario, con los siguientes datos:"),"",'L');
        $pdf->ln(3);

        $col = array();
        $col[] = array('text' => utf8_decode('Cédula'),
         'width' => '30',
         'height' => '9',
         'align' => 'C',
         'font_name' => 'Arial',
         'font_size' => '10',
         'font_style' => 'B',
         'fillcolor' => '230,230,230',
         'textcolor' => '0,0,0',
         'drawcolor' => '0,0,0',
         'linewidth' => '0.4',
         'linearea' => 'LTBR');
        $col[] = array('text' => utf8_decode("Nombres y Apellidos"),
         'width' => '53',
         'height' => '9',
         'align' => 'C',
         'font_name' => 'Arial',
         'font_size' => '10',
         'font_style' => 'B',
         'fillcolor' => '230,230,230',
         'textcolor' => '0,0,0',
         'drawcolor' => '0,0,0',
         'linewidth' => '0.4',
         'linearea' => 'LTBR');
        $col[] = array('text' => utf8_decode("Celular"),
         'width' => '30',
         'height' => '9',
         'align' => 'C',
         'font_name' => 'Arial',
         'font_size' => '10',
         'font_style' => 'B',
         'fillcolor' => '230,230,230',
         'textcolor' => '0,0,0',
         'drawcolor' => '0,0,0',
         'linewidth' => '0.4',
         'linearea' => 'LTBR');
        $col[] = array('text' => utf8_decode("Ruta / Destino"),
         'width' => '53',
         'height' => '9',
         'align' => 'C',
         'font_name' => 'Arial',
         'font_size' => '10',
         'font_style' => 'B',
         'fillcolor' => '230,230,230',
         'textcolor' => '0,0,0',
         'drawcolor' => '0,0,0',
         'linewidth' => '0.4',
         'linearea' => 'LTBR');   
        $tabla_afiliado[] = $col;

         $col = array();
        $col[] = array('text' => utf8_decode(number_format($autorizacion->paciente->cedula, 0, '.', '.' )),
         'width' => '30',
         'height' => '6',
         'align' => 'C',
         'font_name' => 'Arial',
         'font_size' => '10',
         'font_style' => '',
         'fillcolor' => '255,255,255',
         'textcolor' => '0,0,0',
         'drawcolor' => '0,0,0',
         'linewidth' => '0.4',
         'linearea' => 'LTBR');
        $col[] = array('text' => utf8_decode($autorizacion->paciente->fullname),
         'width' => '53',
         'height' => '6',
         'align' => 'C',
         'font_name' => 'Arial',
         'font_size' => '10',
         'font_style' => '',
         'fillcolor' => '255,255,255',
         'textcolor' => '0,0,0',
         'drawcolor' => '0,0,0',
         'linewidth' => '0.4',
         'linearea' => 'LTBR');
        $col[] = array('text' => utf8_decode($autorizacion->paciente->celular),
         'width' => '30',
         'height' => '6',
         'align' => 'C',
         'font_name' => 'Arial',
         'font_size' => '10',
         'font_style' => '',
         'fillcolor' => '255,255,255',
         'textcolor' => '0,0,0',
         'drawcolor' => '0,0,0',
         'linewidth' => '0.4',
         'linearea' => 'LTBR');
        $col[] = array('text' => utf8_decode($autorizacion->ruta),
         'width' => '53',
         'height' => '6',
         'align' => 'C',
         'font_name' => 'Arial',
         'font_size' => '10',
         'font_style' => '',
         'fillcolor' => '255,255,255',
         'textcolor' => '0,0,0',
         'drawcolor' => '0,0,0',
         'linewidth' => '0.4',
         'linearea' => 'LTBR');   
        $tabla_afiliado[] = $col;

        

        // Draw Table  
        $pdf->WriteTable($tabla_afiliado);


       if (!empty(trim($autorizacion->paciente->ac_fullname))) {
           //acompañante
        $pdf->ln(2);
        $pdf->SetFont('helvetica','B',10);
        $pdf->Cell(0,6,utf8_decode("Acompañante"),"",1,"C");


        if (!empty(trim($autorizacion->paciente->ac_cedula))) {
            $acompanante_cedula = number_format($autorizacion->paciente->ac_cedula, 0, '.', '.' );
        } else {
            $acompanante_cedula = '';
        }
        
        $col = array();
        $col[] = array('text' => $acompanante_cedula,
         'width' => '30',
         'height' => '6',
         'align' => 'C',
         'font_name' => 'Arial',
         'font_size' => '10',
         'font_style' => '',
         'fillcolor' => '255,255,255',
         'textcolor' => '0,0,0',
         'drawcolor' => '0,0,0',
         'linewidth' => '0.4',
         'linearea' => 'LTBR');
        $col[] = array('text' => utf8_decode($autorizacion->paciente->ac_fullname),
         'width' => '136',
         'height' => '6',
         'align' => 'C',
         'font_name' => 'Arial',
         'font_size' => '10',
         'font_style' => '',
         'fillcolor' => '255,255,255',
         'textcolor' => '0,0,0',
         'drawcolor' => '0,0,0',
         'linewidth' => '0.4',
         'linearea' => 'LTBR');
        
        $tabla_acompanante[] = $col;

        

        // Draw Table  
        $pdf->WriteTable($tabla_acompanante);
       }

        $pdf->ln(8);


        //cita medical
        $pdf->SetFont('helvetica','B',10);
        $pdf->Cell(0,6,utf8_decode("Datos de la Cita"),"",1,"C");
        
        $col = array();

        $col[] = array('text' => utf8_decode('Día'),
         'width' => '30',
         'height' => '9',
         'align' => 'C',
         'font_name' => 'Arial',
         'font_size' => '10',
         'font_style' => 'B',
         'fillcolor' => '230,230,230',
         'textcolor' => '0,0,0',
         'drawcolor' => '0,0,0',
         'linewidth' => '0.4',
         'linearea' => 'LTBR');        
        $col[] = array('text' => utf8_decode("Hora"),
         'width' => '30',
         'height' => '9',
         'align' => 'C',
         'font_name' => 'Arial',
         'font_size' => '10',
         'font_style' => 'B',
         'fillcolor' => '230,230,230',
         'textcolor' => '0,0,0',
         'drawcolor' => '0,0,0',
         'linewidth' => '0.4',
         'linearea' => 'LTBR');
        $col[] = array('text' => utf8_decode("Lugar"),
         'width' => '53',
         'height' => '9',
         'align' => 'C',
         'font_name' => 'Arial',
         'font_size' => '10',
         'font_style' => 'B',
         'fillcolor' => '230,230,230',
         'textcolor' => '0,0,0',
         'drawcolor' => '0,0,0',
         'linewidth' => '0.4',
         'linearea' => 'LTBR');
        $col[] = array('text' => utf8_decode("Dirección"),
         'width' => '53',
         'height' => '9',
         'align' => 'C',
         'font_name' => 'Arial',
         'font_size' => '10',
         'font_style' => 'B',
         'fillcolor' => '230,230,230',
         'textcolor' => '0,0,0',
         'drawcolor' => '0,0,0',
         'linewidth' => '0.4',
         'linearea' => 'LTBR');   
        $tabla_cita[] = $col;
     

        $col = array();
        $col[] = array('text' => utf8_decode($autorizacion->cita_fecha->format('d-m-Y')),
         'width' => '30',
         'height' => '6',
         'align' => 'C',
         'font_name' => 'Arial',
         'font_size' => '10',
         'font_style' => '',
         'fillcolor' => '255,255,255',
         'textcolor' => '0,0,0',
         'drawcolor' => '0,0,0',
         'linewidth' => '0.4',
         'linearea' => 'LTBR');        
        $col[] = array('text' => utf8_decode($autorizacion->cita_hora),
         'width' => '30',
         'height' => '6',
         'align' => 'C',
         'font_name' => 'Arial',
         'font_size' => '10',
         'font_style' => '',
         'fillcolor' => '255,255,255',
         'textcolor' => '0,0,0',
         'drawcolor' => '0,0,0',
         'linewidth' => '0.4',
         'linearea' => 'LTBR');
        $col[] = array('text' => utf8_decode($autorizacion->lugar->nombre),
         'width' => '53',
         'height' => '6',
         'align' => 'C',
         'font_name' => 'Arial',
         'font_size' => '10',
         'font_style' => '',
         'fillcolor' => '255,255,255',
         'textcolor' => '0,0,0',
         'drawcolor' => '0,0,0',
         'linewidth' => '0.4',
         'linearea' => 'LTBR');
        $col[] = array('text' => utf8_decode($autorizacion->lugar->direccion),
         'width' => '53',
         'height' => '6',
         'align' => 'C',
         'font_name' => 'Arial',
         'font_size' => '10',
         'font_style' => '',
         'fillcolor' => '255,255,255',
         'textcolor' => '0,0,0',
         'drawcolor' => '0,0,0',
         'linewidth' => '0.4',
         'linearea' => 'LTBR');   
        $tabla_cita[] = $col;

        

        // Draw Table  
        $pdf->WriteTable($tabla_cita);

        

        $pdf->ln();
        $pdf->Multicell(0,10,utf8_decode("Este documento es valido para: ".\NumeroALetras::convertir($autorizacion->cantidad)." (".$autorizacion->cantidad.") Pasajero(s)"),"",'L');
        $pdf->Multicell(0,10,utf8_decode("Conductor: ".$autorizacion->conductor->fullname." celular: ".$autorizacion->conductor->celular),"",'L');
        $pdf->ln();

        $pdf->ln(12);
        $pdf->Cell(70,4,"___________________________","",0,"C");
        $pdf->Cell(10,4,"","",0,"C"); //divisor
        $pdf->Cell(70,4,"___________________________","",1,"C");

        $pdf->Cell(70,5,"Firma Afiliado","",0,"C");       
        $pdf->Cell(10,4,"","",0,"C"); //divisor
        $pdf->Cell(70,5,"Autorizador: ".$autorizacion->user->fullname,"",1,"C");
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
