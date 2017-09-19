<?php

namespace App\Http\Controllers;

use App\Models\Recibo;
use App\Models\Ruta;
use App\Models\Vehiculo;
use App\Repositories\CentralRepository;
use App\Repositories\ExcelRepository;
use Carbon\Carbon;
use DB;
use Excel;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Date\Date;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

//use App\Http\Requests;

class ExcelController extends Controller
{
	 private $excelRepository;
	 private $centralRepository;

	 public function __construct(ExcelRepository $excelRepo, CentralRepository $centralRepo)
    {
        $this->middleware('auth');
        $this->excelRepository = $excelRepo;
        $this->centralRepository = $centralRepo;
    }

    public function index(Request $request)
    {
    	$dt = [];
    	$year =  Carbon::now()->format('Y');
    	$dt = [
		'now'                 => Carbon::now(),
		'hoy'                 => Carbon::now()->toDateString(),
		'manana'              => (new Carbon('tomorrow'))->toDateString(),
		'ayer'                => (new Carbon('yesterday'))->toDateString(),
		'subDay-7'            => Carbon::now()->subDay(7)->toDateString(),
		'subDay-30'           => Carbon::now()->subDay(30)->toDateString(),
		'subMonth'            => Carbon::now()->subMonth()->toDateString(),
		'this-month-start'    => Carbon::now()->modify('first day of this month')->toDateString(),
		'this-month-end'      => Carbon::now()->modify('last day of this month')->toDateString(),
		'last-month-start'    => Carbon::now()->modify('first day of last month')->toDateString(),
		'last-month-end'      => Carbon::now()->modify('last day of last month')->toDateString(),
		'last-3-month'        => Carbon::now()->modify('first day of -3 month')->toDateString(),
		'first-this-year'     => $year."-01-01",
		'last-this-year'      => $year."-12-31",
		'first-day-last-year' => ($year-1)."-01-01",
		'last-day-last-year'  => ($year-1)."-12-31",
		// 'last-this-year'   => Carbon::now()->modify('last day of december this year')->toDateString(),
		];

    	 return view('informes.index')
            ->with(['informes' => '', 'dt' => $dt]);
    }

    public function generate(Request $request)
    {	
    	//return $request->all();
    	switch ($request->type) {
    		case 'vehiculos_servicios':
    			return $this->vehiculos_servicios($request);
    			break;
    		case 'rutas':
    			return $this->rutas($request);
    			break;
    		case 'contador_recorrido':
    			return $this->contador_recorrido($request);
    			break;
    		case 'recibos_caja':
    			return $this->recibos_caja($request);
    			break;
    		
    		default:
    			# code...
    			break;
    	}

    }


    public function vehiculos_servicios($request)
    {
    	//Separar fechas
    	$fechas  = $this->centralRepository->separarFechas($request->fecha);
    	
    	$doc = Excel::create('Vehiculos por servicio '.$request->fecha.' | InformesTranseba', function($excel) use($request, $fechas) {

				$vehiculos = $this->excelRepository->getData($request->type, $fechas);

		 		$excel->sheet('vehiculos', function($sheet) use($vehiculos, $request) { 
		 			$sheet->row(1, ['Informe Vehiculos por Servicio Transeba S.A.S '.$request->fecha]);
		 			$sheet->row(2, ['Placa', 'Empresarial', 'Escolar', 'Grupo de usuarios', 'Salud', 'Turismo', 'Total Servicios']);
		 				$s1 = 0;
		 				$s2 = 0;
		 				$s3 = 0;
		 				$s4 = 0;
		 				$s5 = 0;
		 				$st = 0;
		 				$total = 0;


		 			foreach ($vehiculos as $key => $value) {

		 				$s1 = $s1+$value->empresarial;
		 				$s2 = $s2+$value->escolar;
		 				$s3 = $s3+$value->grupo_usuarios;
		 				$s4 = $s4+$value->salud;
		 				$s5 = $s5+$value->turismo;		 				
	 					$st = $value->empresarial
							  + $value->escolar
		    				  + $value->grupo_usuarios
		    				  + $value->salud
		    				  + $value->turismo;
		    			$total = $total + $st;

			    		$sheet->row($key+3, [
			    			$value->placa,
			    			$value->empresarial,
			    			$value->escolar,
			    			$value->grupo_usuarios,
			    			$value->salud,
			    			$value->turismo,
			    			$st,			    				
			    			]); 

			    		if ($key%2==1) {				    			
				    		$sheet->cells('A'.($key+3).':G'.($key+3), function($cells) {
								$cells->setBackground('#d0e4ed');
							});
			    		}
		 			}

		 			$sheet->row(count($vehiculos)+3, [
			    			'Totales',
			    			$s1,
			    			$s2,
			    			$s3,
			    			$s4,
			    			$s5,
			    			$total,
			    			]); 


			    			//('A2:G'.(count($vehiculos)+1), 'thin');

		 			//Style Cells
					$sheet->cells('A1:G1', function($cells) {
						$cells->setFont(array(
						    'family'     => 'Calibri',
						    'size'       => '14',
						    'bold'       =>  true
						));	
					});
		 			$sheet->cells('A2:G2', function($cells) {
						$cells->setBackground('#00b0a3');
						$cells->setFontColor('#ffffff');
						$cells->setFont(array(
						    'family'     => 'Calibri',
						    'size'       => '16',
						    'bold'       =>  true
						));	

					});
					$sheet->cells('A'.(count($vehiculos)+3).':G'.(count($vehiculos)+3), function($cells) {
						$cells->setBackground('#00b0a3');
						$cells->setFontColor('#ffffff');
						$cells->setFont(array(
						    'family'     => 'Calibri',
						    'size'       => '12',
						    'bold'       =>  true
						));	

					});
					$sheet->mergeCells('A1:G1');
		 			$sheet->setFreeze('A3');

					$sheet->cells('A1:G1', function($cells) {
						$cells->setAlignment('center');
					});
		 			//$sheet->setBorder('A2:G'.(count($vehiculos)+1), 'thin');
						

				});

		});

		return $doc->export('xlsx');
    }

    public function rutas($request)
    {
    	$rutas = Ruta::select('*');

    	switch ($request->tipo_ruta) {
    		case '1':
    			$rutas->where('predefinido', 1);
    			break;

    		case '2':
    			$rutas->where('predefinido', 0);
    			break;
    		
    		default:
    			# code...
    			break;
    	}


    	$vehiculos = Vehiculo::with(['natural', 'juridico', 'contratovinculacion'])->orderBy('placa')->get();   

    	$query_rel = DB::table('vehiculos as vh')
			        ->select("vh.placa")
            	    ->addSelect("pg.id as pg_id")
			        ->addSelect("rt.nombre as ruta")
			        ->addSelect("rt.distancia")
			        ->addSelect("rt.duracion")
			        ->addSelect("rt.valor_sugerido")
			        ->addSelect("rt.predefinido")
			        ->addSelect("prr.cantidad_viajes")
			        ->addSelect("prr.valor_final")
			        ->addSelect(DB::raw("CONCAT ('CPS', LPAD(cps.id,4,'0')) as cps_cod"))
			        ->addSelect(DB::raw("cast(SUM(prr.cantidad_viajes*rt.distancia) as  decimal(16,1)) AS suma_km"))
			        ->addSelect(DB::raw("cast(SUM(prr.cantidad_viajes*rt.duracion/60) as  decimal(16,2)) AS total_duracion_horas"))
			        ->addSelect(DB::raw("round(SUM(prr.cantidad_viajes*prr.valor_final)) as total_pagados"))
			        ->addSelect(DB::raw("round(SUM(prr.cantidad_viajes*prr.valor_final)/SUM(prr.cantidad_viajes*rt.distancia)) as dinner_km"));

                $query_rel->leftJoin('contrato_vinculaciones as cv', 'cv.vehiculo_id', '=', 'vh.id')
			        ->leftJoin('pagos as pg', 'pg.contrato_vinculacion_id', '=', 'cv.id')
			        ->leftJoin('contrato_prestacion_servicios as cps', 'cps.id', '=', 'pg.cps_id')
			        ->leftJoin('pago_rel_rutas as prr', 'prr.pago_id', '=', 'pg.id')
			        ->leftJoin('rutas as rt', 'rt.id', '=', 'prr.ruta_id');

		        $query_rel->whereNull('vh.deleted_at')
			        ->whereNull('cv.deleted_at')
			        ->whereNull('pg.deleted_at')
			        ->whereNull('prr.deleted_at');   

			    switch ($request->tipo_ruta) {
		    		case '1':
		    			$query_rel->where('rt.predefinido', 1);
		    			break;

		    		case '2':
		    			$query_rel->where('rt.predefinido', 0);
		    			break;
		    		
		    		default:
		    			# code...
		    			break;
		    	}                     

                $query_rel->whereNotNull('pg.id')
                    ->groupBy('prr.id');

                $query_rel->get(); //inutil 



    	$doc = Excel::create('Rutas Vehiculos | InformesTranseba', function($excel) use($request, $rutas, $vehiculos, $query_rel) {
    		 $excel->sheet('Rutas', function($sheet) use($rutas) {
    		 	
    		 	$sheet->row(1, ['Codigo', 'Ruta', 'Distancia', 'Duración', 'Valor sugerido', 'Predefinido', 'Fecha de creación', 'Última actualización', 'Descripción']);
    		 	$sheet->setColumnFormat(array(
				    'C' => '0" Km"',
				    'D' => '0" Min"',
				    'E' => '"$"#,##0.00_-',

				));				
    		 	foreach ($rutas->get() as $key => $value) {
    		 		$sheet->row($key+2, [
			    			$value->id,
			    			$value->nombre,
			    			$value->distancia,
			    			$value->duracion,
			    			$value->valor_sugerido,
			    			$value->predefinido,
			    			$value->created_at,
			    			$value->updated_at,
			    			$value->descripcion,			    						    				
			    			]); 
    		 	}

    		 	//style
    		 	$sheet->cells('A1:I1', function($cells) {
						$cells->setBackground('#00b0a3');
						$cells->setFontColor('#ffffff');
						$cells->setFont(array(
						    'family'     => 'Calibri',
						    'size'       => '16',
						    'bold'       =>  true
						));	

					});
				$sheet->cells('A1:I1', function($cells) {
						$cells->setAlignment('center');
				});
    		 	$sheet->freezeFirstRowAndColumn();
        		
    		});// end sheet Rutas


    	/**
    	 * Vehiculos sheet
    	 */

	    
	    	$excel->sheet('Vehiculos', function($sheet) use($vehiculos) {

	    		$sheet->row(1, ['Placa', 'Tipo Prop.', 'CC / Nit', 'Nombre / Razón social', 'Vehiculo', 'ID',  'Capacidad', 'Modelo', 'Marca', 'Clase', 'Propiedad Empresarial', 'Contrato', 'CC/Nit Contratista', 'Nombre Contratista', 'Responsable Contrato', 'Fecha de creación', 'Última actualización', 'Observaciones' ]);

    		 	foreach ($vehiculos as $key => $value) {

    		 		$sw_exist = null;
    		 		$cv = null;

    		 		$cv_id_contratista = null;
    		 		$cv_name_contratista = null;
    		 		$cv_name_responsable = null;

                    if ($value->contratovinculacion->isEmpty()) {
                        $cv = "Sin contrato";
                    } else { 
                     foreach ($value->contratovinculacion as $key_cv => $value_cv) {
                            if ($value_cv->vigente) {
                                $cv = $value_cv->tipo_contrato.str_pad($value_cv->id, 4, "0", STR_PAD_LEFT);
								$cv_id_contratista   = $value_cv->id_contratista;
								$cv_name_contratista = $value_cv->name_contratista;
								$cv_name_responsable = $value_cv->name_responsable;
                                $sw_exist = true;
                            }                                               
                    }                     
                    if (is_null($sw_exist)) {
                             $cv = "Contrato Vencido";
                         } 

                    } 

    		 		$sheet->row($key+2, [
			    			$value->placa,
			    			$value->tipo_propietario,
			    			$value->id_owner,
			    			$value->name_owner,
			    			$value->numero_interno,
			    			$value->id,
			    			$value->capacidad,
			    			$value->modelo,
			    			$value->marca,
			    			$value->clase,
			    			$value->propiedad,
			    			$cv,
			    			$cv_id_contratista,
    		 				$cv_name_contratista,
    		 				$cv_name_responsable,
			    			$value->created_at,
			    			$value->updated_at,
			    			$value->observaciones,			    						    						    				
			    			]); 
    		 	}

    		 	//style
    		 	$sheet->cells('A1:R1', function($cells) {
						$cells->setBackground('#00b0a3');
						$cells->setFontColor('#ffffff');
						$cells->setFont(array(
						    'family'     => 'Calibri',
						    'size'       => '16',
						    'bold'       =>  true
						));	

					});
				$sheet->cells('A1:R1', function($cells) {
						$cells->setAlignment('center');
				});
    		 	$sheet->freezeFirstRowAndColumn();
    		 	


	    	}); //end sheet Vehiculos

	    	/**
	    	 * Relacion 
	    	 */
	    	$excel->sheet('Relacion', function($sheet) use($query_rel) {
	    		// dd($query_rel->get());

	    		$sheet->row(1, ['Placa', 'Contrato Cliente', 'No Pago', 'Ruta', 'Valor Sugerido', 'Valor Final', 'Cant. Viajes', 'Recorrido Total', 'Tiempo Estiamdo', 'Total Generado (Sin descuento)', 'Costo por Km', 'Predefinda']);	

	    		$sheet->setColumnFormat(array(
				    'E' => '"$"#,##0.00_-',
				    'F' => '"$"#,##0.00_-',
				    'H' => '0" Km"',
				    'I' => '0" Horas"',
				    'J' => '"$"#,##0.00_-',
				    'K' => '"$"#,##0.00_-',

				));	 		

 	    		foreach ($query_rel->get() as $key => $value) {
	    			$sheet->row($key+2, [
				    			$value->placa,
				    			$value->cps_cod,
				    			$value->pg_id,
				    			$value->ruta,				    			
				    			$value->valor_sugerido,
				    			$value->valor_final,
				    			$value->cantidad_viajes,
				    			$value->suma_km,
				    			$value->total_duracion_horas,
				    			$value->total_pagados,
				    			$value->dinner_km,
				    			$value->predefinido,			    				    						    						    				
				    			]); 
	    		 	}	

	    		 	//style
	    		 	$sheet->cells('A1:L1', function($cells) {
							$cells->setBackground('#00b0a3');
							$cells->setFontColor('#ffffff');
							$cells->setFont(array(
							    'family'     => 'Calibri',
							    'size'       => '16',
							    'bold'       =>  true
							));	

						});
					$sheet->cells('A1:L1', function($cells) {
							$cells->setAlignment('center');
					});
	    		 	$sheet->freezeFirstRowAndColumn();

	    	}); // end sheet relacion
		
    	});  // end excel
		
		return $doc->export('xlsx');
    }

    public function contador_recorrido($request)
    {
    	$fechas  = $this->centralRepository->separarFechas($request->fecha);
    	
		$q = DB::table('vehiculos as vh')
	        ->select("vh.placa")    	    
	        ->addSelect(DB::raw("cast(SUM(prr.cantidad_viajes*rt.distancia) as  decimal(16,1)) AS suma_km"))
	        ->addSelect(DB::raw("cast(SUM(prr.cantidad_viajes*rt.duracion/60) as  decimal(16,2)) AS total_duracion_horas"));
	        

		$q->leftJoin('contrato_vinculaciones as cv', 'cv.vehiculo_id', '=', 'vh.id')
	        ->leftJoin('pagos as pg', 'pg.contrato_vinculacion_id', '=', 'cv.id')
	        ->leftJoin('contrato_prestacion_servicios as cps', 'cps.id', '=', 'pg.cps_id')
	        ->leftJoin('pago_rel_rutas as prr', 'prr.pago_id', '=', 'pg.id')
	        ->leftJoin('rutas as rt', 'rt.id', '=', 'prr.ruta_id');

		$q->whereNull('vh.deleted_at')
	        ->whereNull('cv.deleted_at')
	        ->whereNull('pg.deleted_at')
	        ->whereNull('prr.deleted_at')
	        ->where('pg.created_at', '>=', $fechas['inicial'])
			->where('pg.created_at', '<=', $fechas['final']);

		$q->whereNotNull('pg.id');

        $q->groupBy('vh.placa');  

        $doc = Excel::create('Tiempos de recorrido y kilometros '.$request->fecha.' | InformesTranseba', function($excel) use($request, $q) {
    		 $excel->sheet('Contadores', function($sheet) use($q) {
    		 	
    		 	$sheet->row(1, ['Placa', 'Kilometros', 'Tiempo Estimado']); 

    		 	$sheet->setColumnFormat(array(				   
				    'B' => '0" Km"',
				    'C' => '0" Horas"',	
				));	 

				$ckm   = 0;
				$ctime = 0;

				$data = $q->get();
    		 	foreach ($data as $key => $value) {
	    			$sheet->row($key+2, [
				    			$value->placa,
				    			$value->suma_km,
				    			$value->total_duracion_horas,
				    			]); 

					$ckm   = $ckm + $value->suma_km;
					$ctime = $ctime + $value->total_duracion_horas;
	    		 }

	    		 $sheet->row(count($data)+2, [
			    			'Totales',
			    			$ckm,
			    			$ctime,
			    			]); 


	    		 	//style
	    		 	$sheet->cells('A1:C1', function($cells) {
							$cells->setBackground('#00b0a3');
							$cells->setFontColor('#ffffff');
							$cells->setFont(array(
							    'family'     => 'Calibri',
							    'size'       => '16',
							    'bold'       =>  true
							));	

						});
					$sheet->cells('A1:C1', function($cells) {
							$cells->setAlignment('center');
					});
	    		 	$sheet->freezeFirstRowAndColumn();

	    		}); // end sheet contadores

	    	});  // end excel

		return $doc->export('xlsx');
    }

    public function recibos_caja($request)
    {

    	$fechas  = $this->centralRepository->separarFechas($request->fecha);			


    	$recibos = Recibo::with(['user', 'natural', 'articulos.producto'])
	    	->where('created_at', '>=', $fechas['inicial'])
			->where('created_at', '<=', $fechas['final'])
	    	->orderBy('created_at')->get();

    	$doc = Excel::create('Recibos caja '.$request->fecha.' | InformesTranseba', function($excel) use($fechas, $recibos) {
    		 $excel->sheet('Recibos', function($sheet) use($recibos) {
    		 	
    		 	$sheet->row(1, [
    		 	  'Fecha',
    		 	  'Codigo',
    		 	  'Cédula cliente',
    		 	  'Nombre cliente',
    		 	  'Metodo de Pago',
    		 	  'Descuento',
    		 	  'Incremento',
    		 	  'Total',
    		 	  'Observaciones',

    		 	]);
    		 	$sheet->setColumnFormat(array(				    
				    'C' => '#,##_-',
				    'F' => '"$"#,##0.00_-',
				    'G' => '"$"#,##0.00_-',
				    'H' => '"$"#,##0.00_-',

				));	
				$sum_descuento = 0;	
				$sum_incremento = 0;	
				$sum_total = 0;	

    		 	foreach ($recibos as $key => $value) {
    		 		$sheet->row($key+2, [
			    			$value->created_at->format('d-m-Y'),						    				
			    			$value->id,
			    			$value->natural->cedula,
			    			$value->natural->fullname,
			    			$value->modo_pago,
			    			$value->descuento,
			    			$value->incremento,
			    			$value->articulos->sum('total'),
			    			$value->observaciones,
			    			]);
			    	
			    	$sum_descuento = $sum_descuento +  $value->descuento;
			    	$sum_incremento = $sum_incremento +  $value->incremento;
			    	$sum_total = $sum_total + $value->articulos->sum('total');

			    	if ($key%2==1) {				    			
				    		$sheet->cells('A'.($key+2).':I'.($key+2), function($cells) {
								$cells->setBackground('#d0e4ed');
							});
			    		}
    		 	}

    		 	$cont_rows = count($recibos)+2;

    		 	$sheet->row($cont_rows, [
			    			'Totales',
			    			'',
			    			'',
			    			'',
			    			'',
			    			$sum_descuento,
			    			$sum_incremento,
			    			$sum_total,
			    			]);

    		 	//style
    		 	$sheet->cells('A1:I1', function($cells) {
						$cells->setBackground('#00b0a3');
						$cells->setFontColor('#ffffff');
						$cells->setFont(array(
						    'family'     => 'Calibri',
						    'size'       => '16',
						    'bold'       =>  true
						));	

					});

    		 	$sheet->cells('A'.$cont_rows.':I'.$cont_rows, function($cells) {
						$cells->setBackground('#00b0a3');
						$cells->setFontColor('#ffffff');
						$cells->setFont(array(
						    'family'     => 'Calibri',
						    'size'       => '16',
						    'bold'       =>  true
						));	

					});

				$sheet->cells('A1:I1', function($cells) {
						$cells->setAlignment('center');
				});
    		 	$sheet->freezeFirstRowAndColumn();
        		
    		});// end sheet recibos


	    	});  // end excel

		return $doc->export('xlsx');
    }


} //Class
