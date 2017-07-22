<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePqrsSeguimientoRequest;
use App\Http\Requests\UpdatePqrsSeguimientoRequest;
use App\Repositories\PqrsSeguimientoRepository;
use App\Repositories\CentralRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use Response;

class PqrsSeguimientoController extends AppBaseController
{
    /** @var  PqrsSeguimientoRepository */
    private $pqrsSeguimientoRepository;
    private $centralRepository;

    public function __construct(PqrsSeguimientoRepository $pqrsSeguimientoRepo, CentralRepository $centralRepo)
    {
        $this->middleware('auth');
        $this->pqrsSeguimientoRepository = $pqrsSeguimientoRepo;
        $this->centralRepository = $centralRepo;
    }

    /**
     * Display a listing of the PqrsSeguimiento.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->pqrsSeguimientoRepository->pushCriteria(new RequestCriteria($request));
        $pqrsSeguimientos = $this->pqrsSeguimientoRepository->paginate(15);

        /**
         * $pqrsSeguimientos = $this->pqrsSeguimientoRepository->all();
         */

        return view('pqrs_seguimientos.index')
            ->with('pqrsSeguimientos', $pqrsSeguimientos);
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
     * Show the form for creating a new PqrsSeguimiento.
     *
     * @return Response
     */
    public function create()
    {
        $selectores = $this->selectoresComunes();

        return view('pqrs_seguimientos.create')->with(['selectores' => $selectores]);
    }

    public function create_with($id)
    {        
        $selectores = $this->selectoresComunes();

        return view('pqrs_seguimientos.create')->with(['selectores' => $selectores, 'pqrs_id' => $id]);
    }

    /**
     * Store a newly created PqrsSeguimiento in storage.
     *
     * @param CreatePqrsSeguimientoRequest $request
     *
     * @return Response
     */
    public function store(CreatePqrsSeguimientoRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $pqrsSeguimiento = $this->pqrsSeguimientoRepository->create($input);

        Flash::success('Pqrs Seguimiento registrado correctamente.');

        return redirect(route('pqrsSeguimientos.index'));
    }

    /**
     * Display the specified PqrsSeguimiento.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pqrsSeguimiento = $this->pqrsSeguimientoRepository->findWithoutFail($id);

        if (empty($pqrsSeguimiento)) {
            Flash::error('Pqrs Seguimiento No se encuentra registrado.');

            return redirect(route('pqrsSeguimientos.index'));
        }

        return view('pqrs_seguimientos.show')->with('pqrsSeguimiento', $pqrsSeguimiento);
    }

    /**
     * Show the form for editing the specified PqrsSeguimiento.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pqrsSeguimiento = $this->pqrsSeguimientoRepository->findWithoutFail($id);

        if (empty($pqrsSeguimiento)) {
            Flash::error('Pqrs Seguimiento No se encuentra registrado.');

            return redirect(route('pqrsSeguimientos.index'));
        }

        $selectores = $this->selectoresComunes();

        return view('pqrs_seguimientos.edit')->with(['pqrsSeguimiento' => $pqrsSeguimiento, 'selectores' => $selectores]);
    }

    /**
     * Update the specified PqrsSeguimiento in storage.
     *
     * @param  int              $id
     * @param UpdatePqrsSeguimientoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePqrsSeguimientoRequest $request)
    {
        $pqrsSeguimiento = $this->pqrsSeguimientoRepository->findWithoutFail($id);

        if (empty($pqrsSeguimiento)) {
            Flash::error('Pqrs Seguimiento No se encuentra registrado.');

            return redirect(route('pqrsSeguimientos.index'));
        }
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $pqrsSeguimiento = $this->pqrsSeguimientoRepository->update($input, $id);

        Flash::success('Pqrs Seguimiento actualizado correctamente.');

        return redirect(route('pqrsSeguimientos.index'));
    }

    /**
     * Remove the specified PqrsSeguimiento from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pqrsSeguimiento = $this->pqrsSeguimientoRepository->findWithoutFail($id);

        if (empty($pqrsSeguimiento)) {
            Flash::error('Pqrs Seguimiento No se encuentra registrado.');

            return redirect(route('pqrsSeguimientos.index'));
        }

        $this->pqrsSeguimientoRepository->delete($id);

        Flash::success('Pqrs Seguimiento eliminado correctamente.');

        return redirect(route('pqrsSeguimientos.index'));
    }
}
