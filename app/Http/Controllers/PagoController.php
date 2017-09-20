<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePagoRequest;
use App\Http\Requests\UpdatePagoRequest;

use App\Repositories\PagoRepository;
use App\Repositories\CentralRepository;
use App\Repositories\DescuentoRepository;
use App\Repositories\FacturaRepository;
use App\Repositories\RutaRepository;
use App\Repositories\PagoRelFacturaRepository;
use App\Repositories\PagoRelDescuentoRepository;
use App\Repositories\PagoRelRutaRepository;

use App\Models\Pago;
use App\Models\Descuento;
use App\Models\Factura;
use App\Models\Ruta;
use App\Models\PagoRelFactura;
use App\Models\PagoRelDescuento;
use App\Models\PagoRelRuta;
use App\Models\ContratoVinculacion;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;

class PagoController extends AppBaseController
{
    /** @var  PagoRepository */
    private $pagoRepository;
    private $centralRepository;
    private $descuentoRepository;
    private $facturaRepository;
    private $rutaRepository;
    private $pagoRelFacturaRepository;
    private $pagoRelDescuentoRepository;
    private $pagoRelRutaRepository;

    public function __construct(
        PagoRepository $pagoRepo, 
        CentralRepository $centralRepo,
        DescuentoRepository $descuentoRepo,
        FacturaRepository $facturaRepo,
        RutaRepository $rutaRepo,
        PagoRelFacturaRepository $pagoRelFacturaRepo,
        PagoRelDescuentoRepository $pagoRelDescuentoRepo,
        PagoRelRutaRepository $pagoRelRutaRepo
        )
    {
        $this->middleware('auth');
        $this->pagoRepository = $pagoRepo;
        $this->centralRepository = $centralRepo;
        $this->descuentoRepository = $descuentoRepo;
        $this->facturaRepository = $facturaRepo;
        $this->rutaRepository = $rutaRepo;
        $this->pagoRelFacturaRepository = $pagoRelFacturaRepo;
        $this->pagoRelDescuentoRepository = $pagoRelDescuentoRepo;
        $this->pagoRelRutaRepository = $pagoRelRutaRepo;
    }
    /**
     * Display a listing of the Pago.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->pagoRepository->pushCriteria(new RequestCriteria($request));

        $pagos = Pago::with(['contratovinculacion.vehiculo',
          'contratovinculacion.responsable',
          'contratovinculacion.natural'])
        ->WhereHas('contratovinculacion.vehiculo', function($q) use ($request) { $q->Splaca($request->vehiculo_id); })
        ->WhereHas('cps', function($q) use ($request) { $q->Scodigo($request->cps); })
        ->Scodigo($request->codigo)
        ->orderBy(request('order_item', 'updated_at'), request('order_type', 'desc'))
        ->paginate(request('per_page', '15'));

       /* dd($this->pagoRepository
            ->with('pagorelfactura.factura')
            ->with('pagorelruta.ruta')
            ->with('pagoreldescuento.descuento')
            ->with('express_factura')
            ->with('express_ruta')
            ->with('express_descuento')
            ->all());
            */
        /**
         * $pagos = $this->pagoRepository->all();
         */

        return view('pagos.index')
            ->with('pagos', $pagos);
    }
    /**
     * Selectores comunes
     */
    public function selectoresComunes()
    {
        $selectores = [];
        $selectores['ContratoPrestacionServicio_id'] = $this->centralRepository->ContratoPrestacionServicio_id();
        $selectores['ruta_id'] = $this->centralRepository->ruta_id();
        $selectores['ContratoVinculacion_id'] = $this->centralRepository->ContratoVinculacion_id();
        $selectores['descuento_id'] = $this->descuentoRepository->descuento_id();
        return $selectores;
    }
    /**
     * Show the form for creating a new Pago.
     *
     * @return Response
     */
    public function create()
    {
        $selectores = $this->selectoresComunes();

        return view('pagos.create')->with(['selectores' => $selectores, 'date_now' => Carbon::now()]);
    }

    /**
     * Store a newly created Pago in storage.
     *
     * @param CreatePagoRequest $request
     *
     * @return Response
     */
    public function store(CreatePagoRequest $request)
    {
        $input = $request->all();

        $input['user_id'] = Auth::id();
        
        $contratoVinculacion = ContratoVinculacion::where('id',  $input['contrato_vinculacion_id'])->first();
        
        if (!empty($contratoVinculacion)) {
            $validar_documentos_vehiculo = $this->centralRepository->validar_documentos_vehiculo($contratoVinculacion->vehiculo_id);

            if ($validar_documentos_vehiculo['error']) {
                
                Flash::error($validar_documentos_vehiculo['mensaje']);
                return redirect(route('pagos.index'));
               
            }
        }
        
        $input['fecha_inicio'] = Carbon::createFromFormat('Y-m-d',$request->fecha_inicio)->startOfWeek();
        $input['fecha_final'] = Carbon::createFromFormat('Y-m-d', $request->fecha_final)->endOfWeek();

        $subtotal   = 0;
        $total      = 0;
        $descuentos = 0;
        //dd($input['factura'][1]);
        //dd($request->desc_valor);
        foreach ($request->factura as $key => $value) {

            $dupli_factura = Factura::where('codigo', trim($value))->first();
            //$dupli_factura = Factura::firstOrCreate(array('codigo' => $request->factura));           
            if (is_null($dupli_factura)) {
                $new_factura = Factura::create(['codigo' => $value, 'user_id' => Auth::id()]);
                $input['pago_rel_factura'][$key] = $new_factura->id;
            } else {
                 $input['pago_rel_factura'][$key] = $dupli_factura->id; 
            }        
           
        }
        

         foreach ($request->predefinido as $key => $value) {
                     
            if ($value == 'yes') {
                $input['pago_rel_ruta'][$key]['ruta_id']         = $request->ruta_nombre[$key];
                $input['pago_rel_ruta'][$key]['cantidad_viajes'] = $request->cantidad[$key];
                $input['pago_rel_ruta'][$key]['valor_final']     = $request->valor_final[$key]; 

            } else if ($value == 'not') {

                $new_ruta = Ruta::create([
                    'nombre'         => $request->ruta_nombre[$key],
                    'distancia'       => $request->distancia[$key],
                    'duracion'       => $request->duracion[$key],
                    'valor_sugerido' => $request->valor_final[$key],
                    'predefinido'    => false,
                    'descripcion'    => 'Registrado desde modulo Pagos',
                    'user_id'        => Auth::id()
                    ]);

                $input['pago_rel_ruta'][$key]['ruta_id']         = $new_ruta->id;
                $input['pago_rel_ruta'][$key]['cantidad_viajes'] = $request->cantidad[$key];
                $input['pago_rel_ruta'][$key]['valor_final']     = $request->valor_final[$key];                
            }                      
        }

        foreach ($request->predefinido as $key => $value) {
           $subtotal = $subtotal + ($request->cantidad[$key] * $request->valor_final[$key]);
        }
        
        $descuentos = $request->desc_transaccion + $request->desc_sobrecosto + $request->text_cuatro_por_mil + ($subtotal*$request->desc_finca/100) + ($subtotal*$request->desc_admin/100);

        if (!is_null($request->desc_valor)) {
           foreach ($request->desc_valor as $key => $value) {
                $descuentos = $descuentos + $value;
            }
        }
        

        $total = $subtotal - $descuentos;

        $input['subtotal'] = $subtotal;
        $input['total_descuentos'] = $descuentos;
        $input['total'] = $total;
        //dd($input['fecha_final']->weekOfYear);

        $pago = $this->pagoRepository->create($input);

         foreach ($input['pago_rel_factura'] as $key => $value) {
            $new_rel_fac = PagoRelFactura::create([
                        'pago_id'    => $pago->id,
                        'factura_id' => $value,
                        'user_id'    => Auth::id()
                        ]);
        }
        if (!is_null($request->desc_valor)) {
            foreach ($request->desc_tipo as $key => $value) {
                $new_rel_desc = PagoRelDescuento::create([
                            'pago_id'      => $pago->id,
                            'descuento_id' => $value,
                            'valor'        => $request->desc_valor[$key],
                            'user_id'      => Auth::id()
                            ]);
            }
        }
        foreach ($input['pago_rel_ruta'] as $key => $value) {
             $new_rel_ruta = PagoRelRuta::create([
                        'pago_id'         => $pago->id,
                        'ruta_id'         => $value['ruta_id'],
                        'valor_final'     => $value['valor_final'],
                        'cantidad_viajes' => $value['cantidad_viajes'],
                        'user_id'         => Auth::id()
                        ]);
        }

        //dd($input);        

        Flash::success('Planilla de Pago registrada correctamente.');

        return redirect(route('pagos.index'));
    }

    /**
     * Display the specified Pago.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pago = $this->pagoRepository->findWithoutFail($id);

        if (empty($pago)) {
            Flash::error('Pago No se encuentra registrado.');

            return redirect(route('pagos.index'));
        }

        return view('pagos.show')->with('pago', $pago);
    }

    /**
     * Show the form for editing the specified Pago.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pago = $this->pagoRepository->findWithoutFail($id);

        if (empty($pago)) {
            Flash::error('Pago No se encuentra registrado.');

            return redirect(route('pagos.index'));
        }

        $selectores = $this->selectoresComunes();

        return view('pagos.edit')->with(['pago' => $pago, 'selectores' => $selectores]);
    }

    /**
     * Update the specified Pago in storage.
     *
     * @param  int              $id
     * @param UpdatePagoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePagoRequest $request)
    {
        $pago = $this->pagoRepository->findWithoutFail($id);

        if (empty($pago)) {
            Flash::error('Pago No se encuentra registrado.');

            return redirect(route('pagos.index'));
        }
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $pago = $this->pagoRepository->update($input, $id);

        Flash::success('Pago actualizado correctamente.');

        return redirect(route('pagos.index'));
    }

    /**
     * Remove the specified Pago from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pago = $this->pagoRepository->findWithoutFail($id);

        if (empty($pago)) {
            Flash::error('Pago No se encuentra registrado.');

            return redirect(route('pagos.index'));
        }

        $pagoRelRuta = PagoRelRuta::where('pago_id', $id)->get();
        if (!$pagoRelRuta->isEmpty()) {
            foreach ($pagoRelRuta as $key => $value) {               
               $this->pagoRelRutaRepository->delete($value->id);
            }
        }

        $pagoRelFactura = PagoRelFactura::where('pago_id', $id)->get();
        if (!$pagoRelFactura->isEmpty()) {
            foreach ($pagoRelFactura as $key => $value) {               
               $this->pagoRelFacturaRepository->delete($value->id);
            }
        }

        $pagoRelDescuento = PagoRelDescuento::where('pago_id', $id)->get();
        if (!$pagoRelDescuento->isEmpty()) {
            foreach ($pagoRelDescuento as $key => $value) {               
               $this->pagoRelDescuentoRepository->delete($value->id);
            }
        }
        

        $this->pagoRepository->delete($id);

        Flash::success('Pago eliminado correctamente.');

        return redirect(route('pagos.index'));
    }
    public function print_space($id)
    {
        $pago = $this->pagoRepository->findWithoutFail($id);

        if (empty($pago)) {
            Flash::error('Pago No se encuentra registrado.');

            return redirect(route('pagos.index'));
        }
       $this->pagoRepository->print_pagos($id);
        
    }
}
