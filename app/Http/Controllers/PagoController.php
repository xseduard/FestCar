<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePagoRequest;
use App\Http\Requests\UpdatePagoRequest;

use App\Repositories\PagoRepository;
use App\Repositories\CentralRepository;
use App\Repositories\DescuentoRepository;
use App\Repositories\FacturaRepository;
use App\Repositories\RutaRepository;
use App\Repositories\PagoRelFacturaRepository;
use App\Repositories\PagoRelDescuentoRepository;
use App\Repositories\PagoRelRutaRepository;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use Response;

class PagoController extends AppBaseController
{
    /** @var  PagoRepository */
    private $pagoRepository;
    private $centralRepository;
    private $descuentoRepository;
    private $facturaRepository;
    private $rutaRepository;
    private $pagoRelFacturaRepository;
    private $pagoRelDescuentoRepository;
    private $pagoRelRutaRepository;

    public function __construct(
        PagoRepository $pagoRepo, 
        CentralRepository $centralRepo,
        DescuentoRepository $descuentoRepo,
        FacturaRepository $facturaRepo,
        RutaRepository $rutaRepo,
        PagoRelFacturaRepository $pagoRelFacturaRepo,
        PagoRelDescuentoRepository $pagoRelDescuentoRepo,
        PagoRelRutaRepository $pagoRelRutaRepo
        )
    {
        $this->middleware('auth');
        $this->pagoRepository = $pagoRepo;
        $this->centralRepository = $centralRepo;
        $this->descuentoRepository = $descuentoRepo;
        $this->facturaRepository = $facturaRepo;
        $this->rutaRepository = $rutaRepo;
        $this->pagoRelFacturaRepository = $pagoRelFacturaRepo;
        $this->pagoRelDescuentoRepository = $pagoRelDescuentoRepo;
        $this->pagoRelRutaRepository = $pagoRelRutaRepo;
    }
    /**
     * Display a listing of the Pago.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->pagoRepository->pushCriteria(new RequestCriteria($request));
        $pagos = $this->pagoRepository->paginate(15);

        /**
         * $pagos = $this->pagoRepository->all();
         */

        return view('pagos.index')
            ->with('pagos', $pagos);
    }
    /**
     * Selectores comunes
     */
    public function selectoresComunes()
    {
        $selectores = [];
        $selectores['ContratoPrestacionServicio_id'] = $this->centralRepository->ContratoPrestacionServicio_id();
        $selectores['ruta_id'] = $this->centralRepository->ruta_id();
        $selectores['ContratoVinculacion_id'] = $this->centralRepository->ContratoVinculacion_id();
        $selectores['descuento_id'] = $this->descuentoRepository->descuento_id();
        return $selectores;
    }
    /**
     * Show the form for creating a new Pago.
     *
     * @return Response
     */
    public function create()
    {
        $selectores = $this->selectoresComunes();

        return view('pagos.create')->with(['selectores' => $selectores]);
    }

    /**
     * Store a newly created Pago in storage.
     *
     * @param CreatePagoRequest $request
     *
     * @return Response
     */
    public function store(CreatePagoRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();

        dd($input);

        $pago = $this->pagoRepository->create($input);

        Flash::success('Pago registrado correctamente.');

        return redirect(route('pagos.index'));
    }

    /**
     * Display the specified Pago.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pago = $this->pagoRepository->findWithoutFail($id);

        if (empty($pago)) {
            Flash::error('Pago No se encuentra registrado.');

            return redirect(route('pagos.index'));
        }

        return view('pagos.show')->with('pago', $pago);
    }

    /**
     * Show the form for editing the specified Pago.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pago = $this->pagoRepository->findWithoutFail($id);

        if (empty($pago)) {
            Flash::error('Pago No se encuentra registrado.');

            return redirect(route('pagos.index'));
        }

        $selectores = $this->selectoresComunes();

        return view('pagos.edit')->with(['pago' => $pago, 'selectores' => $selectores]);
    }

    /**
     * Update the specified Pago in storage.
     *
     * @param  int              $id
     * @param UpdatePagoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePagoRequest $request)
    {
        $pago = $this->pagoRepository->findWithoutFail($id);

        if (empty($pago)) {
            Flash::error('Pago No se encuentra registrado.');

            return redirect(route('pagos.index'));
        }
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $pago = $this->pagoRepository->update($input, $id);

        Flash::success('Pago actualizado correctamente.');

        return redirect(route('pagos.index'));
    }

    /**
     * Remove the specified Pago from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pago = $this->pagoRepository->findWithoutFail($id);

        if (empty($pago)) {
            Flash::error('Pago No se encuentra registrado.');

            return redirect(route('pagos.index'));
        }

        $this->pagoRepository->delete($id);

        Flash::success('Pago eliminado correctamente.');

        return redirect(route('pagos.index'));
    }
}
