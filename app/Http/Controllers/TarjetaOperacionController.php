<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTarjetaOperacionRequest;
use App\Http\Requests\UpdateTarjetaOperacionRequest;
use App\Repositories\TarjetaOperacionRepository;
use App\Repositories\CentralRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use Response;

use App\Models\TarjetaOperacion;

class TarjetaOperacionController extends AppBaseController
{
    /** @var  TarjetaOperacionRepository */
    private $tarjetaOperacionRepository;
    private $centralRepository;

    public function __construct(TarjetaOperacionRepository $tarjetaOperacionRepo, CentralRepository $centralRepo)
    {
        $this->middleware('auth');
        $this->tarjetaOperacionRepository = $tarjetaOperacionRepo;
        $this->centralRepository = $centralRepo;
    }

    /**
     * Display a listing of the TarjetaOperacion.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        //$this->tarjetaOperacionRepository->pushCriteria(new RequestCriteria($request));
       
        $tarjetaOperacions = TarjetaOperacion::with('vehiculo')->Svehiculoplaca($request->vehiculo_id)
        ->Sestado($request->estado)
        ->orderBy(request('order_item', 'updated_at'), request('order_type', 'desc'))
        ->paginate(request('per_page', '15'));

        $fecha_actual = \Carbon\Carbon::now();

        /**
         * $tarjetaOperacions = $this->tarjetaOperacionRepository->all();
         */

        return view('tarjeta_operacions.index')
            ->with(['tarjetaOperacions' => $tarjetaOperacions, 'fecha_actual' => $fecha_actual]);
    }
    /**
     * Selectores comunes
     */
    public function selectoresComunes()
    {
        $selectores = [];
        // $selectores['atributo_id'] = $this->centralRepository->atributo_id();
        $selectores['vehiculo_id'] = $this->centralRepository->vehiculo_id();
        return $selectores;
    }
    /**
     * Show the form for creating a new TarjetaOperacion.
     *
     * @return Response
     */
    public function create()
    {
        $selectores = $this->selectoresComunes();

        return view('tarjeta_operacions.create')->with(['selectores' => $selectores]);
    }

    /**
     * Store a newly created TarjetaOperacion in storage.
     *
     * @param CreateTarjetaOperacionRequest $request
     *
     * @return Response
     */
    public function store(CreateTarjetaOperacionRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $tarjetaOperacion = $this->tarjetaOperacionRepository->create($input);

        Flash::success('Tarjeta de Operación registrada correctamente.');

        return redirect(route('tarjetaOperacions.index'));
    }

    /**
     * Display the specified TarjetaOperacion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tarjetaOperacion = $this->tarjetaOperacionRepository->findWithoutFail($id);

        if (empty($tarjetaOperacion)) {
            Flash::error('Tarjeta de Operación No se encuentra registrada.');

            return redirect(route('tarjetaOperacions.index'));
        }

        return view('tarjeta_operacions.show')->with('tarjetaOperacion', $tarjetaOperacion);
    }

    /**
     * Show the form for editing the specified TarjetaOperacion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tarjetaOperacion = $this->tarjetaOperacionRepository->findWithoutFail($id);

        if (empty($tarjetaOperacion)) {
            Flash::error('Tarjeta de Operación No se encuentra registrada.');

            return redirect(route('tarjetaOperacions.index'));
        }

        $selectores = $this->selectoresComunes();

        return view('tarjeta_operacions.edit')->with(['tarjetaOperacion' => $tarjetaOperacion, 'selectores' => $selectores]);
    }

    /**
     * Update the specified TarjetaOperacion in storage.
     *
     * @param  int              $id
     * @param UpdateTarjetaOperacionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTarjetaOperacionRequest $request)
    {
        $tarjetaOperacion = $this->tarjetaOperacionRepository->findWithoutFail($id);

        if (empty($tarjetaOperacion)) {
            Flash::error('Tarjeta de Operación No se encuentra registrada.');

            return redirect(route('tarjetaOperacions.index'));
        }
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $tarjetaOperacion = $this->tarjetaOperacionRepository->update($input, $id);

        Flash::success('Tarjeta de Operación actualizada correctamente.');

        return redirect(route('tarjetaOperacions.index'));
    }

    /**
     * Remove the specified TarjetaOperacion from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tarjetaOperacion = $this->tarjetaOperacionRepository->findWithoutFail($id);

        if (empty($tarjetaOperacion)) {
            Flash::error('Tarjeta de Operación No se encuentra registrada.');

            return redirect(route('tarjetaOperacions.index'));
        }

        $this->tarjetaOperacionRepository->delete($id);

        Flash::success('Tarjeta de Operación eliminada correctamente.');

        return redirect(route('tarjetaOperacions.index'));
    }
}
