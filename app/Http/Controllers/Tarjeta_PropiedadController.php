<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTarjeta_PropiedadRequest;
use App\Http\Requests\UpdateTarjeta_PropiedadRequest;
use App\Repositories\Tarjeta_PropiedadRepository;
use App\Repositories\CentralRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use Response;

use App\Models\Tarjeta_Propiedad;

class Tarjeta_PropiedadController extends AppBaseController
{
    /** @var  Tarjeta_PropiedadRepository */
    private $tarjetaPropiedadRepository;
    private $centralRepository;

    public function __construct(Tarjeta_PropiedadRepository $tarjetaPropiedadRepo, CentralRepository $centralRepo)
    {
        $this->middleware('auth');
        $this->tarjetaPropiedadRepository = $tarjetaPropiedadRepo;
        $this->centralRepository = $centralRepo;
    }

    /**
     * Display a listing of the Tarjeta_Propiedad.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->tarjetaPropiedadRepository->pushCriteria(new RequestCriteria($request));
        $tarjetaPropiedads  = Tarjeta_Propiedad::Svehiculoplaca($request->vehiculo_id)
        ->orderBy(request('order_item', 'updated_at'), request('order_type', 'desc'))
        ->paginate(request('per_page', '15'));

        /**
         * $tarjetaPropiedads = $this->tarjetaPropiedadRepository->all();
         */

        return view('tarjeta_propiedads.index')
            ->with('tarjetaPropiedads', $tarjetaPropiedads);
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
     * Show the form for creating a new Tarjeta_Propiedad.
     *
     * @return Response
     */
    public function create()
    {
        $selectores = $this->selectoresComunes();

        return view('tarjeta_propiedads.create')->with(['selectores' => $selectores]);
    }

    /**
     * Store a newly created Tarjeta_Propiedad in storage.
     *
     * @param CreateTarjeta_PropiedadRequest $request
     *
     * @return Response
     */
    public function store(CreateTarjeta_PropiedadRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $tarjetaPropiedad = $this->tarjetaPropiedadRepository->create($input);

        Flash::success('Tarjeta de Propiedad registrada correctamente.');

        return redirect(route('tarjetaPropiedads.index'));
    }

    /**
     * Display the specified Tarjeta_Propiedad.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tarjetaPropiedad = $this->tarjetaPropiedadRepository->findWithoutFail($id);

        if (empty($tarjetaPropiedad)) {
            Flash::error('Tarjeta de Propiedad No se encuentra registrada.');

            return redirect(route('tarjetaPropiedads.index'));
        }

        return view('tarjeta_propiedads.show')->with('tarjetaPropiedad', $tarjetaPropiedad);
    }

    /**
     * Show the form for editing the specified Tarjeta_Propiedad.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tarjetaPropiedad = $this->tarjetaPropiedadRepository->findWithoutFail($id);
        if (empty($tarjetaPropiedad)) {
            Flash::error('Tarjeta de Propiedad No se encuentra registrada.');

            return redirect(route('tarjetaPropiedads.index'));
        }

        $selectores = $this->selectoresComunes();

        return view('tarjeta_propiedads.edit')->with(['tarjetaPropiedad' => $tarjetaPropiedad, 'selectores' => $selectores]);
    }

    /**
     * Update the specified Tarjeta_Propiedad in storage.
     *
     * @param  int              $id
     * @param UpdateTarjeta_PropiedadRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTarjeta_PropiedadRequest $request)
    {
        $tarjetaPropiedad = $this->tarjetaPropiedadRepository->findWithoutFail($id);

        if (empty($tarjetaPropiedad)) {
            Flash::error('Tarjeta de Propiedad No se encuentra registrada.');

            return redirect(route('tarjetaPropiedads.index'));
        }
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $tarjetaPropiedad = $this->tarjetaPropiedadRepository->update($input, $id);

        Flash::success('Tarjeta de Propiedad actualizada correctamente.');

        return redirect(route('tarjetaPropiedads.index'));
    }

    /**
     * Remove the specified Tarjeta_Propiedad from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tarjetaPropiedad = $this->tarjetaPropiedadRepository->findWithoutFail($id);

        if (empty($tarjetaPropiedad)) {
            Flash::error('Tarjeta de Propiedad No se encuentra registrada.');

            return redirect(route('tarjetaPropiedads.index'));
        }

        $this->tarjetaPropiedadRepository->delete($id);

        Flash::success('Tarjeta de Propiedad eliminada correctamente.');

        return redirect(route('tarjetaPropiedads.index'));
    }
}
