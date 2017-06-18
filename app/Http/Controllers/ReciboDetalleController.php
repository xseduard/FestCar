<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReciboDetalleRequest;
use App\Http\Requests\UpdateReciboDetalleRequest;
use App\Repositories\ReciboDetalleRepository;
use App\Repositories\CentralRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use Response;

class ReciboDetalleController extends AppBaseController
{
    /** @var  ReciboDetalleRepository */
    private $reciboDetalleRepository;
    private $centralRepository;

    public function __construct(ReciboDetalleRepository $reciboDetalleRepo, CentralRepository $centralRepo)
    {
        $this->middleware('auth');
        $this->reciboDetalleRepository = $reciboDetalleRepo;
        $this->centralRepository = $centralRepo;
    }

    /**
     * Display a listing of the ReciboDetalle.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->reciboDetalleRepository->pushCriteria(new RequestCriteria($request));
        $reciboDetalles = $this->reciboDetalleRepository->paginate(15);

        /**
         * $reciboDetalles = $this->reciboDetalleRepository->all();
         */

        return view('recibo_detalles.index')
            ->with('reciboDetalles', $reciboDetalles);
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
     * Show the form for creating a new ReciboDetalle.
     *
     * @return Response
     */
    public function create()
    {
        $selectores = $this->selectoresComunes();

        return view('recibo_detalles.create')->with(['selectores' => $selectores]);
    }

    /**
     * Store a newly created ReciboDetalle in storage.
     *
     * @param CreateReciboDetalleRequest $request
     *
     * @return Response
     */
    public function store(CreateReciboDetalleRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $reciboDetalle = $this->reciboDetalleRepository->create($input);

        Flash::success('Recibo Detalle registrado correctamente.');

        return redirect(route('reciboDetalles.index'));
    }

    /**
     * Display the specified ReciboDetalle.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $reciboDetalle = $this->reciboDetalleRepository->findWithoutFail($id);

        if (empty($reciboDetalle)) {
            Flash::error('Recibo Detalle No se encuentra registrado.');

            return redirect(route('reciboDetalles.index'));
        }

        return view('recibo_detalles.show')->with('reciboDetalle', $reciboDetalle);
    }

    /**
     * Show the form for editing the specified ReciboDetalle.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $reciboDetalle = $this->reciboDetalleRepository->findWithoutFail($id);

        if (empty($reciboDetalle)) {
            Flash::error('Recibo Detalle No se encuentra registrado.');

            return redirect(route('reciboDetalles.index'));
        }

        $selectores = $this->selectoresComunes();

        return view('recibo_detalles.edit')->with(['reciboDetalle' => $reciboDetalle, 'selectores' => $selectores]);
    }

    /**
     * Update the specified ReciboDetalle in storage.
     *
     * @param  int              $id
     * @param UpdateReciboDetalleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReciboDetalleRequest $request)
    {
        $reciboDetalle = $this->reciboDetalleRepository->findWithoutFail($id);

        if (empty($reciboDetalle)) {
            Flash::error('Recibo Detalle No se encuentra registrado.');

            return redirect(route('reciboDetalles.index'));
        }
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $reciboDetalle = $this->reciboDetalleRepository->update($input, $id);

        Flash::success('Recibo Detalle actualizado correctamente.');

        return redirect(route('reciboDetalles.index'));
    }

    /**
     * Remove the specified ReciboDetalle from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $reciboDetalle = $this->reciboDetalleRepository->findWithoutFail($id);

        if (empty($reciboDetalle)) {
            Flash::error('Recibo Detalle No se encuentra registrado.');

            return redirect(route('reciboDetalles.index'));
        }

        $this->reciboDetalleRepository->delete($id);

        Flash::success('Recibo Detalle eliminado correctamente.');

        return redirect(route('reciboDetalles.index'));
    }
}
