<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePagoRelRutaRequest;
use App\Http\Requests\UpdatePagoRelRutaRequest;
use App\Repositories\PagoRelRutaRepository;
use App\Repositories\CentralRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use Response;

class PagoRelRutaController extends AppBaseController
{
    /** @var  PagoRelRutaRepository */
    private $pagoRelRutaRepository;
    private $centralRepository;

    public function __construct(PagoRelRutaRepository $pagoRelRutaRepo, CentralRepository $centralRepo)
    {
        $this->middleware('auth');
        $this->pagoRelRutaRepository = $pagoRelRutaRepo;
        $this->centralRepository = $centralRepo;
    }

    /**
     * Display a listing of the PagoRelRuta.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->pagoRelRutaRepository->pushCriteria(new RequestCriteria($request));
        $pagoRelRutas = $this->pagoRelRutaRepository->paginate(15);

        /**
         * $pagoRelRutas = $this->pagoRelRutaRepository->all();
         */

        return view('pago_rel_rutas.index')
            ->with('pagoRelRutas', $pagoRelRutas);
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
     * Show the form for creating a new PagoRelRuta.
     *
     * @return Response
     */
    public function create()
    {
        $selectores = $this->selectoresComunes();

        return view('pago_rel_rutas.create')->with(['selectores' => $selectores]);
    }

    /**
     * Store a newly created PagoRelRuta in storage.
     *
     * @param CreatePagoRelRutaRequest $request
     *
     * @return Response
     */
    public function store(CreatePagoRelRutaRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $pagoRelRuta = $this->pagoRelRutaRepository->create($input);

        Flash::success('Pago Rel Ruta registrado correctamente.');

        return redirect(route('pagoRelRutas.index'));
    }

    /**
     * Display the specified PagoRelRuta.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pagoRelRuta = $this->pagoRelRutaRepository->findWithoutFail($id);

        if (empty($pagoRelRuta)) {
            Flash::error('Pago Rel Ruta No se encuentra registrado.');

            return redirect(route('pagoRelRutas.index'));
        }

        return view('pago_rel_rutas.show')->with('pagoRelRuta', $pagoRelRuta);
    }

    /**
     * Show the form for editing the specified PagoRelRuta.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pagoRelRuta = $this->pagoRelRutaRepository->findWithoutFail($id);

        if (empty($pagoRelRuta)) {
            Flash::error('Pago Rel Ruta No se encuentra registrado.');

            return redirect(route('pagoRelRutas.index'));
        }

        $selectores = $this->selectoresComunes();

        return view('pago_rel_rutas.edit')->with(['pagoRelRuta' => $pagoRelRuta, 'selectores' => $selectores]);
    }

    /**
     * Update the specified PagoRelRuta in storage.
     *
     * @param  int              $id
     * @param UpdatePagoRelRutaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePagoRelRutaRequest $request)
    {
        $pagoRelRuta = $this->pagoRelRutaRepository->findWithoutFail($id);

        if (empty($pagoRelRuta)) {
            Flash::error('Pago Rel Ruta No se encuentra registrado.');

            return redirect(route('pagoRelRutas.index'));
        }
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $pagoRelRuta = $this->pagoRelRutaRepository->update($input, $id);

        Flash::success('Pago Rel Ruta actualizado correctamente.');

        return redirect(route('pagoRelRutas.index'));
    }

    /**
     * Remove the specified PagoRelRuta from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pagoRelRuta = $this->pagoRelRutaRepository->findWithoutFail($id);

        if (empty($pagoRelRuta)) {
            Flash::error('Pago Rel Ruta No se encuentra registrado.');

            return redirect(route('pagoRelRutas.index'));
        }

        $this->pagoRelRutaRepository->delete($id);

        Flash::success('Pago Rel Ruta eliminado correctamente.');

        return redirect(route('pagoRelRutas.index'));
    }
}
