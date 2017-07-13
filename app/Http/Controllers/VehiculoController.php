<?php

namespace App\Http\Controllers;

use App\DataTables\VehiculoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateVehiculoRequest;
use App\Http\Requests\UpdateVehiculoRequest;
use App\Repositories\VehiculoRepository;
use App\Repositories\CentralRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Auth;
use Response;

use App\Models\SimuladorGasto;

class VehiculoController extends AppBaseController
{
    /** @var  VehiculoRepository */
    private $vehiculoRepository;
    private $centralRepository;

    public function __construct(VehiculoRepository $vehiculoRepo, CentralRepository $centralRepo)
    {
        $this->middleware('auth');
        $this->vehiculoRepository = $vehiculoRepo;
        $this->centralRepository = $centralRepo;
    }

    /**
     * Display a listing of the Vehiculo.
     * Datatables by xs Templates
     *
     * @param VehiculoDataTable $vehiculoDataTable
     * @return Response
     */
    public function index(VehiculoDataTable $vehiculoDataTable)
    {
        return $vehiculoDataTable->render('vehiculos.index');
    }
    /**
     * Selectores comunes
     */
    public function selectoresComunes()
    {
        $selectores = [];
        $selectores['natural_id'] = $this->centralRepository->natural_id();
        $selectores['juridico_id'] = $this->centralRepository->juridico_id();
        return $selectores;
    }
    /**
     * Show the form for creating a new Vehiculo.
     *
     * @return Response
     */
    public function create()
    {
        $selectores = $this->selectoresComunes();

        return view('vehiculos.create')->with(['selectores' => $selectores]);
    }

    /**
     * Store a newly created Vehiculo in storage.
     *
     * @param CreateVehiculoRequest $request
     *
     * @return Response
     */
    public function store(CreateVehiculoRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $input['placa'] = strtoupper($request->placa);
        $vehiculo = $this->vehiculoRepository->create($input);

        Flash::success('Vehículo registrado correctamente.');

        return redirect(route('vehiculos.index'));
    }

    /**
     * Display the specified Vehiculo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $vehiculo = $this->vehiculoRepository->findWithoutFail($id);

        $documentos = $this->centralRepository->validar_documentos_vehiculo($id);  

        /*$pla = null;

        $pla = $vehiculo->with('contratovinculacion.pago')->where('id', $id);

        dd($pla);
*/
        $sim_gasto = SimuladorGasto::where('min', '<=', $vehiculo->capacidad)
        ->where('max', '>=', $vehiculo->capacidad)->first();

        $subtotal = $sim_gasto->inversion
                    + $sim_gasto->llantas_completas 
                    + $sim_gasto->motor_caja_trasmision
                    + $sim_gasto->ajuste_pintura
                    + $sim_gasto->rodamiento
                    + $sim_gasto->cojineria_vidrios
                    + $sim_gasto->lavado
                    + $sim_gasto->carroceria
                    + $sim_gasto->salario_conductor
                    + $sim_gasto->prestaciones_sociales
                    + $sim_gasto->seguridad_social
                    + $sim_gasto->soat
                    + $sim_gasto->tecnicomecanica
                    + $sim_gasto->revision_bimensual
                    + $sim_gasto->contractual
                    + $sim_gasto->extracontractual
                    + ($sim_gasto->acpm_galon * $sim_gasto->galones_kilometro * 10)
                    + $sim_gasto->aceites_filtros
                    + $sim_gasto->aditivos
                    + $sim_gasto->baterias
                    + $sim_gasto->impuesto_rodamiento
                    + $sim_gasto->impuesto_semaforizacion
                    + $sim_gasto->parqueo
                    + $sim_gasto->tramites_varios
                    + $sim_gasto->administracion
                    + $sim_gasto->plan_reposicion_equipo
                    + $sim_gasto->sistema_comunicacion
                    + $sim_gasto->gps
                    + $sim_gasto->otros;
        $margen = $subtotal*$sim_gasto->margen/100;
        $total = $subtotal + ($subtotal*$sim_gasto->margen/100);

        $valores =  [];
        $valores['subtotal'] = $subtotal;
        $valores['margen']   = $margen;
        $valores['total']    = $total;
        //dd($documentos);
        if (empty($vehiculo)) {
            Flash::error('Vehículo  No se encuentra registrado.');

            return redirect(route('vehiculos.index'));
        }

        return view('vehiculos.show')->with(['vehiculo' => $vehiculo, 'documentos' => $documentos, 'sim_gasto' => $sim_gasto, 'valores' => $valores]);
    }

    /**
     * Show the form for editing the specified Vehiculo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $vehiculo = $this->vehiculoRepository->findWithoutFail($id);

        if (empty($vehiculo)) {
            Flash::error('Vehículo  No se encuentra registrado.');

            return redirect(route('vehiculos.index'));
        }
        $selectores = $this->selectoresComunes();

        return view('vehiculos.edit')->with(['vehiculo' => $vehiculo, 'selectores' => $selectores]);
    }

    /**
     * Update the specified Vehiculo in storage.
     *
     * @param  int              $id
     * @param UpdateVehiculoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVehiculoRequest $request)
    {
        $vehiculo = $this->vehiculoRepository->findWithoutFail($id);

        if (empty($vehiculo)) {
            Flash::error('Vehículo  No se encuentra registrado.');

            return redirect(route('vehiculos.index'));
        }
        $input = $request->all();
        $input['user_id'] = Auth::id();
        
        
        $vehiculo = $this->vehiculoRepository->update($input, $id);

        Flash::success('Vehículo actualizado correctamente.');

        return redirect(route('vehiculos.index'));
    }

    /**
     * Remove the specified Vehiculo from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $vehiculo = $this->vehiculoRepository->findWithoutFail($id);

        if (empty($vehiculo)) {
            Flash::error('Vehículo  No se encuentra registrado.');

            return redirect(route('vehiculos.index'));
        }

        $this->vehiculoRepository->delete($id);

        Flash::success('Vehículo eliminado correctamente.');

        return redirect(route('vehiculos.index'));
    }
}
