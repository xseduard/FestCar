<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDescuentoRequest;
use App\Http\Requests\UpdateDescuentoRequest;
use App\Repositories\DescuentoRepository;
use App\Repositories\CentralRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use Response;

class DescuentoController extends AppBaseController
{
    /** @var  DescuentoRepository */
    private $descuentoRepository;
    private $centralRepository;

    public function __construct(DescuentoRepository $descuentoRepo, CentralRepository $centralRepo)
    {
        $this->middleware('auth');
        $this->descuentoRepository = $descuentoRepo;
        $this->centralRepository = $centralRepo;
    }

    /**
     * Display a listing of the Descuento.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->descuentoRepository->pushCriteria(new RequestCriteria($request));
        $descuentos = $this->descuentoRepository->paginate(15);

        /**
         * $descuentos = $this->descuentoRepository->all();
         */

        return view('descuentos.index')
            ->with('descuentos', $descuentos);
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
     * Show the form for creating a new Descuento.
     *
     * @return Response
     */
    public function create()
    {
        $selectores = $this->selectoresComunes();

        return view('descuentos.create')->with(['selectores' => $selectores]);
    }

    /**
     * Store a newly created Descuento in storage.
     *
     * @param CreateDescuentoRequest $request
     *
     * @return Response
     */
    public function store(CreateDescuentoRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $descuento = $this->descuentoRepository->create($input);

        Flash::success('Descuento registrado correctamente.');

        return redirect(route('descuentos.index'));
    }

    /**
     * Display the specified Descuento.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $descuento = $this->descuentoRepository->findWithoutFail($id);

        if (empty($descuento)) {
            Flash::error('Descuento No se encuentra registrado.');

            return redirect(route('descuentos.index'));
        }

        return view('descuentos.show')->with('descuento', $descuento);
    }

    /**
     * Show the form for editing the specified Descuento.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $descuento = $this->descuentoRepository->findWithoutFail($id);

        if (empty($descuento)) {
            Flash::error('Descuento No se encuentra registrado.');

            return redirect(route('descuentos.index'));
        }

        $selectores = $this->selectoresComunes();

        return view('descuentos.edit')->with(['descuento' => $descuento, 'selectores' => $selectores]);
    }

    /**
     * Update the specified Descuento in storage.
     *
     * @param  int              $id
     * @param UpdateDescuentoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDescuentoRequest $request)
    {
        $descuento = $this->descuentoRepository->findWithoutFail($id);

        if (empty($descuento)) {
            Flash::error('Descuento No se encuentra registrado.');

            return redirect(route('descuentos.index'));
        }
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $descuento = $this->descuentoRepository->update($input, $id);

        Flash::success('Descuento actualizado correctamente.');

        return redirect(route('descuentos.index'));
    }

    /**
     * Remove the specified Descuento from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $descuento = $this->descuentoRepository->findWithoutFail($id);

        if (empty($descuento)) {
            Flash::error('Descuento No se encuentra registrado.');

            return redirect(route('descuentos.index'));
        }

        $this->descuentoRepository->delete($id);

        Flash::success('Descuento eliminado correctamente.');

        return redirect(route('descuentos.index'));
    }
}
