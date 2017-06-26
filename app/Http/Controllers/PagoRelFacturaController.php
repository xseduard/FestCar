<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePagoRelFacturaRequest;
use App\Http\Requests\UpdatePagoRelFacturaRequest;
use App\Repositories\PagoRelFacturaRepository;
use App\Repositories\CentralRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use Response;

class PagoRelFacturaController extends AppBaseController
{
    /** @var  PagoRelFacturaRepository */
    private $pagoRelFacturaRepository;
    private $centralRepository;

    public function __construct(PagoRelFacturaRepository $pagoRelFacturaRepo, CentralRepository $centralRepo)
    {
        $this->middleware('auth');
        $this->pagoRelFacturaRepository = $pagoRelFacturaRepo;
        $this->centralRepository = $centralRepo;
    }

    /**
     * Display a listing of the PagoRelFactura.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->pagoRelFacturaRepository->pushCriteria(new RequestCriteria($request));
        $pagoRelFacturas = $this->pagoRelFacturaRepository->paginate(15);

        /**
         * $pagoRelFacturas = $this->pagoRelFacturaRepository->all();
         */

        return view('pago_rel_facturas.index')
            ->with('pagoRelFacturas', $pagoRelFacturas);
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
     * Show the form for creating a new PagoRelFactura.
     *
     * @return Response
     */
    public function create()
    {
        $selectores = $this->selectoresComunes();

        return view('pago_rel_facturas.create')->with(['selectores' => $selectores]);
    }

    /**
     * Store a newly created PagoRelFactura in storage.
     *
     * @param CreatePagoRelFacturaRequest $request
     *
     * @return Response
     */
    public function store(CreatePagoRelFacturaRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $pagoRelFactura = $this->pagoRelFacturaRepository->create($input);

        Flash::success('Pago Rel Factura registrado correctamente.');

        return redirect(route('pagoRelFacturas.index'));
    }

    /**
     * Display the specified PagoRelFactura.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pagoRelFactura = $this->pagoRelFacturaRepository->findWithoutFail($id);

        if (empty($pagoRelFactura)) {
            Flash::error('Pago Rel Factura No se encuentra registrado.');

            return redirect(route('pagoRelFacturas.index'));
        }

        return view('pago_rel_facturas.show')->with('pagoRelFactura', $pagoRelFactura);
    }

    /**
     * Show the form for editing the specified PagoRelFactura.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pagoRelFactura = $this->pagoRelFacturaRepository->findWithoutFail($id);

        if (empty($pagoRelFactura)) {
            Flash::error('Pago Rel Factura No se encuentra registrado.');

            return redirect(route('pagoRelFacturas.index'));
        }

        $selectores = $this->selectoresComunes();

        return view('pago_rel_facturas.edit')->with(['pagoRelFactura' => $pagoRelFactura, 'selectores' => $selectores]);
    }

    /**
     * Update the specified PagoRelFactura in storage.
     *
     * @param  int              $id
     * @param UpdatePagoRelFacturaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePagoRelFacturaRequest $request)
    {
        $pagoRelFactura = $this->pagoRelFacturaRepository->findWithoutFail($id);

        if (empty($pagoRelFactura)) {
            Flash::error('Pago Rel Factura No se encuentra registrado.');

            return redirect(route('pagoRelFacturas.index'));
        }
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $pagoRelFactura = $this->pagoRelFacturaRepository->update($input, $id);

        Flash::success('Pago Rel Factura actualizado correctamente.');

        return redirect(route('pagoRelFacturas.index'));
    }

    /**
     * Remove the specified PagoRelFactura from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pagoRelFactura = $this->pagoRelFacturaRepository->findWithoutFail($id);

        if (empty($pagoRelFactura)) {
            Flash::error('Pago Rel Factura No se encuentra registrado.');

            return redirect(route('pagoRelFacturas.index'));
        }

        $this->pagoRelFacturaRepository->delete($id);

        Flash::success('Pago Rel Factura eliminado correctamente.');

        return redirect(route('pagoRelFacturas.index'));
    }
}
