<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePagoRelDescuentoRequest;
use App\Http\Requests\UpdatePagoRelDescuentoRequest;
use App\Repositories\PagoRelDescuentoRepository;
use App\Repositories\CentralRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use Response;

class PagoRelDescuentoController extends AppBaseController
{
    /** @var  PagoRelDescuentoRepository */
    private $pagoRelDescuentoRepository;
    private $centralRepository;

    public function __construct(PagoRelDescuentoRepository $pagoRelDescuentoRepo, CentralRepository $centralRepo)
    {
        $this->middleware('auth');
        $this->pagoRelDescuentoRepository = $pagoRelDescuentoRepo;
        $this->centralRepository = $centralRepo;
    }

    /**
     * Display a listing of the PagoRelDescuento.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->pagoRelDescuentoRepository->pushCriteria(new RequestCriteria($request));
        $pagoRelDescuentos = $this->pagoRelDescuentoRepository->paginate(15);

        /**
         * $pagoRelDescuentos = $this->pagoRelDescuentoRepository->all();
         */

        return view('pago_rel_descuentos.index')
            ->with('pagoRelDescuentos', $pagoRelDescuentos);
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
     * Show the form for creating a new PagoRelDescuento.
     *
     * @return Response
     */
    public function create()
    {
        $selectores = $this->selectoresComunes();

        return view('pago_rel_descuentos.create')->with(['selectores' => $selectores]);
    }

    /**
     * Store a newly created PagoRelDescuento in storage.
     *
     * @param CreatePagoRelDescuentoRequest $request
     *
     * @return Response
     */
    public function store(CreatePagoRelDescuentoRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $pagoRelDescuento = $this->pagoRelDescuentoRepository->create($input);

        Flash::success('Pago Rel Descuento registrado correctamente.');

        return redirect(route('pagoRelDescuentos.index'));
    }

    /**
     * Display the specified PagoRelDescuento.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pagoRelDescuento = $this->pagoRelDescuentoRepository->findWithoutFail($id);

        if (empty($pagoRelDescuento)) {
            Flash::error('Pago Rel Descuento No se encuentra registrado.');

            return redirect(route('pagoRelDescuentos.index'));
        }

        return view('pago_rel_descuentos.show')->with('pagoRelDescuento', $pagoRelDescuento);
    }

    /**
     * Show the form for editing the specified PagoRelDescuento.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pagoRelDescuento = $this->pagoRelDescuentoRepository->findWithoutFail($id);

        if (empty($pagoRelDescuento)) {
            Flash::error('Pago Rel Descuento No se encuentra registrado.');

            return redirect(route('pagoRelDescuentos.index'));
        }

        $selectores = $this->selectoresComunes();

        return view('pago_rel_descuentos.edit')->with(['pagoRelDescuento' => $pagoRelDescuento, 'selectores' => $selectores]);
    }

    /**
     * Update the specified PagoRelDescuento in storage.
     *
     * @param  int              $id
     * @param UpdatePagoRelDescuentoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePagoRelDescuentoRequest $request)
    {
        $pagoRelDescuento = $this->pagoRelDescuentoRepository->findWithoutFail($id);

        if (empty($pagoRelDescuento)) {
            Flash::error('Pago Rel Descuento No se encuentra registrado.');

            return redirect(route('pagoRelDescuentos.index'));
        }
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $pagoRelDescuento = $this->pagoRelDescuentoRepository->update($input, $id);

        Flash::success('Pago Rel Descuento actualizado correctamente.');

        return redirect(route('pagoRelDescuentos.index'));
    }

    /**
     * Remove the specified PagoRelDescuento from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pagoRelDescuento = $this->pagoRelDescuentoRepository->findWithoutFail($id);

        if (empty($pagoRelDescuento)) {
            Flash::error('Pago Rel Descuento No se encuentra registrado.');

            return redirect(route('pagoRelDescuentos.index'));
        }

        $this->pagoRelDescuentoRepository->delete($id);

        Flash::success('Pago Rel Descuento eliminado correctamente.');

        return redirect(route('pagoRelDescuentos.index'));
    }
}
