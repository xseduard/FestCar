<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateExtractoRequest;
use App\Http\Requests\UpdateExtractoRequest;
use App\Repositories\ExtractoRepository;
use App\Repositories\CentralRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use Response;

class ExtractoController extends AppBaseController
{
    /** @var  ExtractoRepository */
    private $extractoRepository;
    private $centralRepository;

    public function __construct(ExtractoRepository $extractoRepo, CentralRepository $centralRepo)
    {
        $this->middleware('auth');
        $this->extractoRepository = $extractoRepo;
        $this->centralRepository = $centralRepo;
    }

    /**
     * Display a listing of the Extracto.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->extractoRepository->pushCriteria(new RequestCriteria($request));
        $extractos = $this->extractoRepository->paginate(15);

        /**
         * $extractos = $this->extractoRepository->all();
         */

        return view('extractos.index')
            ->with('extractos', $extractos);
    }
    /**
     * Selectores comunes
     */
    public function selectoresComunes()
    {
        $selectores = [];
        // $selectores['atributo_id'] = $this->centralRepository->atributo_id();
        $selectores['ContratoPrestacionServicio_id'] = $this->centralRepository->ContratoPrestacionServicio_id();
        $selectores['conductor_id'] = $this->centralRepository->conductor_id();
        return $selectores;
    }
    /**
     * Show the form for creating a new Extracto.
     *
     * @return Response
     */
    public function create()
    {
        $selectores = $this->selectoresComunes();

        return view('extractos.create')->with(['selectores' => $selectores]);
    }

    /**
     * Store a newly created Extracto in storage.
     *
     * @param CreateExtractoRequest $request
     *
     * @return Response
     */
    public function store(CreateExtractoRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $extracto = $this->extractoRepository->create($input);

        Flash::success('Extracto registrado correctamente.');

        return redirect(route('extractos.index'));
    }

    /**
     * Display the specified Extracto.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $extracto = $this->extractoRepository->findWithoutFail($id);

        if (empty($extracto)) {
            Flash::error('Extracto No se encuentra registrado.');

            return redirect(route('extractos.index'));
        }

        return view('extractos.show')->with('extracto', $extracto);
    }

    /**
     * Show the form for editing the specified Extracto.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $extracto = $this->extractoRepository->findWithoutFail($id);

        if (empty($extracto)) {
            Flash::error('Extracto No se encuentra registrado.');

            return redirect(route('extractos.index'));
        }

        $selectores = $this->selectoresComunes();

        return view('extractos.edit')->with(['extracto' => $extracto, 'selectores' => $selectores]);
    }

    /**
     * Update the specified Extracto in storage.
     *
     * @param  int              $id
     * @param UpdateExtractoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExtractoRequest $request)
    {
        $extracto = $this->extractoRepository->findWithoutFail($id);

        if (empty($extracto)) {
            Flash::error('Extracto No se encuentra registrado.');

            return redirect(route('extractos.index'));
        }
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $extracto = $this->extractoRepository->update($input, $id);

        Flash::success('Extracto actualizado correctamente.');

        return redirect(route('extractos.index'));
    }

    /**
     * Remove the specified Extracto from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $extracto = $this->extractoRepository->findWithoutFail($id);

        if (empty($extracto)) {
            Flash::error('Extracto No se encuentra registrado.');

            return redirect(route('extractos.index'));
        }

        $this->extractoRepository->delete($id);

        Flash::success('Extracto eliminado correctamente.');

        return redirect(route('extractos.index'));
    }
}
