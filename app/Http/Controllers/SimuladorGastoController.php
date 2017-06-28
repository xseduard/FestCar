<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSimuladorGastoRequest;
use App\Http\Requests\UpdateSimuladorGastoRequest;
use App\Repositories\SimuladorGastoRepository;
use App\Repositories\CentralRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use Response;

class SimuladorGastoController extends AppBaseController
{
    /** @var  SimuladorGastoRepository */
    private $simuladorGastoRepository;
    private $centralRepository;

    public function __construct(SimuladorGastoRepository $simuladorGastoRepo, CentralRepository $centralRepo)
    {
        $this->middleware('auth');
        $this->simuladorGastoRepository = $simuladorGastoRepo;
        $this->centralRepository = $centralRepo;
    }

    /**
     * Display a listing of the SimuladorGasto.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->simuladorGastoRepository->pushCriteria(new RequestCriteria($request));
        $simuladorGastos = $this->simuladorGastoRepository->paginate(15);

        /**
         * $simuladorGastos = $this->simuladorGastoRepository->all();
         */

        return view('simulador_gastos.index')
            ->with('simuladorGastos', $simuladorGastos);
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
     * Show the form for creating a new SimuladorGasto.
     *
     * @return Response
     */
    public function create()
    {
        $selectores = $this->selectoresComunes();

        return view('simulador_gastos.create')->with(['selectores' => $selectores]);
    }

    /**
     * Store a newly created SimuladorGasto in storage.
     *
     * @param CreateSimuladorGastoRequest $request
     *
     * @return Response
     */
    public function store(CreateSimuladorGastoRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $simuladorGasto = $this->simuladorGastoRepository->create($input);

        Flash::success('Simulador Gasto registrado correctamente.');

        return redirect(route('simuladorGastos.index'));
    }

    /**
     * Display the specified SimuladorGasto.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $simuladorGasto = $this->simuladorGastoRepository->findWithoutFail($id);

        if (empty($simuladorGasto)) {
            Flash::error('Simulador Gasto No se encuentra registrado.');

            return redirect(route('simuladorGastos.index'));
        }

        return view('simulador_gastos.show')->with('simuladorGasto', $simuladorGasto);
    }

    /**
     * Show the form for editing the specified SimuladorGasto.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        dd('hola');
        $simuladorGasto = $this->simuladorGastoRepository->findWithoutFail($id);

        if (empty($simuladorGasto)) {
            Flash::error('Simulador Gasto No se encuentra registrado.');

            return redirect(route('simuladorGastos.index'));
        }

        $selectores = $this->selectoresComunes();

        return view('simulador_gastos.edit')->with(['simuladorGasto' => $simuladorGasto, 'selectores' => $selectores]);
    }

    /**
     * Update the specified SimuladorGasto in storage.
     *
     * @param  int              $id
     * @param UpdateSimuladorGastoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSimuladorGastoRequest $request)
    {
        $simuladorGasto = $this->simuladorGastoRepository->findWithoutFail($id);

        if (empty($simuladorGasto)) {
            Flash::error('Simulador Gasto No se encuentra registrado.');

            return redirect(route('simuladorGastos.index'));
        }
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $simuladorGasto = $this->simuladorGastoRepository->update($input, $id);

        Flash::success('Simulador Gasto actualizado correctamente.');

        return redirect(route('simuladorGastos.index'));
    }

    /**
     * Remove the specified SimuladorGasto from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $simuladorGasto = $this->simuladorGastoRepository->findWithoutFail($id);

        if (empty($simuladorGasto)) {
            Flash::error('Simulador Gasto No se encuentra registrado.');

            return redirect(route('simuladorGastos.index'));
        }

        $this->simuladorGastoRepository->delete($id);

        Flash::success('Simulador Gasto eliminado correctamente.');

        return redirect(route('simuladorGastos.index'));
    }
}
