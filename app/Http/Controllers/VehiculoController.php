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
        // $selectores['atributo_id'] = $this->centralRepository->atributo_id();
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

        if (empty($vehiculo)) {
            Flash::error('Vehículo  No se encuentra en encuentra registrado.');

            return redirect(route('vehiculos.index'));
        }

        return view('vehiculos.show')->with('vehiculo', $vehiculo);
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
            Flash::error('Vehículo  No se encuentra en encuentra registrado.');

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
            Flash::error('Vehículo  No se encuentra en encuentra registrado.');

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
            Flash::error('Vehículo  No se encuentra en encuentra registrado.');

            return redirect(route('vehiculos.index'));
        }

        $this->vehiculoRepository->delete($id);

        Flash::success('Vehículo eliminado correctamente.');

        return redirect(route('vehiculos.index'));
    }
}
