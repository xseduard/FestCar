<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFacturaRequest;
use App\Http\Requests\UpdateFacturaRequest;
use App\Repositories\FacturaRepository;
use App\Repositories\CentralRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use Response;

class FacturaController extends AppBaseController
{
    /** @var  FacturaRepository */
    private $facturaRepository;
    private $centralRepository;

    public function __construct(FacturaRepository $facturaRepo, CentralRepository $centralRepo)
    {
        $this->middleware('auth');
        $this->facturaRepository = $facturaRepo;
        $this->centralRepository = $centralRepo;
    }

    /**
     * Display a listing of the Factura.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->facturaRepository->pushCriteria(new RequestCriteria($request));
        $facturas = $this->facturaRepository->paginate(15);

        /**
         * $facturas = $this->facturaRepository->all();
         */

        return view('facturas.index')
            ->with('facturas', $facturas);
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
     * Show the form for creating a new Factura.
     *
     * @return Response
     */
    public function create()
    {
        $selectores = $this->selectoresComunes();

        return view('facturas.create')->with(['selectores' => $selectores]);
    }

    /**
     * Store a newly created Factura in storage.
     *
     * @param CreateFacturaRequest $request
     *
     * @return Response
     */
    public function store(CreateFacturaRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $factura = $this->facturaRepository->create($input);

        Flash::success('Factura registrado correctamente.');

        return redirect(route('facturas.index'));
    }

    /**
     * Display the specified Factura.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $factura = $this->facturaRepository->findWithoutFail($id);

        if (empty($factura)) {
            Flash::error('Factura No se encuentra registrado.');

            return redirect(route('facturas.index'));
        }

        return view('facturas.show')->with('factura', $factura);
    }

    /**
     * Show the form for editing the specified Factura.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $factura = $this->facturaRepository->findWithoutFail($id);

        if (empty($factura)) {
            Flash::error('Factura No se encuentra registrado.');

            return redirect(route('facturas.index'));
        }

        $selectores = $this->selectoresComunes();

        return view('facturas.edit')->with(['factura' => $factura, 'selectores' => $selectores]);
    }

    /**
     * Update the specified Factura in storage.
     *
     * @param  int              $id
     * @param UpdateFacturaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFacturaRequest $request)
    {
        $factura = $this->facturaRepository->findWithoutFail($id);

        if (empty($factura)) {
            Flash::error('Factura No se encuentra registrado.');

            return redirect(route('facturas.index'));
        }
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $factura = $this->facturaRepository->update($input, $id);

        Flash::success('Factura actualizado correctamente.');

        return redirect(route('facturas.index'));
    }

    /**
     * Remove the specified Factura from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $factura = $this->facturaRepository->findWithoutFail($id);

        if (empty($factura)) {
            Flash::error('Factura No se encuentra registrado.');

            return redirect(route('facturas.index'));
        }

        $this->facturaRepository->delete($id);

        Flash::success('Factura eliminado correctamente.');

        return redirect(route('facturas.index'));
    }
}
