<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRutaRequest;
use App\Http\Requests\UpdateRutaRequest;
use App\Repositories\RutaRepository;
use App\Repositories\CentralRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use Response;

class RutaController extends AppBaseController
{
    /** @var  RutaRepository */
    private $rutaRepository;
    private $centralRepository;

    public function __construct(RutaRepository $rutaRepo, CentralRepository $centralRepo)
    {
        $this->middleware('auth');
        $this->rutaRepository = $rutaRepo;
        $this->centralRepository = $centralRepo;
    }

    /**
     * Display a listing of the Ruta.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->rutaRepository->pushCriteria(new RequestCriteria($request));
        $rutas = $this->rutaRepository->paginate(15);

        /**
         * $rutas = $this->rutaRepository->all();
         */

        return view('rutas.index')
            ->with('rutas', $rutas);
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
     * Show the form for creating a new Ruta.
     *
     * @return Response
     */
    public function create()
    {
        $selectores = $this->selectoresComunes();

        return view('rutas.create')->with(['selectores' => $selectores]);
    }

    /**
     * Store a newly created Ruta in storage.
     *
     * @param CreateRutaRequest $request
     *
     * @return Response
     */
    public function store(CreateRutaRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $ruta = $this->rutaRepository->create($input);

        Flash::success('Ruta registrado correctamente.');

        return redirect(route('rutas.index'));
    }

    /**
     * Display the specified Ruta.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $ruta = $this->rutaRepository->findWithoutFail($id);

        if (empty($ruta)) {
            Flash::error('Ruta No se encuentra registrado.');

            return redirect(route('rutas.index'));
        }

        return view('rutas.show')->with('ruta', $ruta);
    }

    /**
     * Show the form for editing the specified Ruta.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $ruta = $this->rutaRepository->findWithoutFail($id);

        if (empty($ruta)) {
            Flash::error('Ruta No se encuentra registrado.');

            return redirect(route('rutas.index'));
        }

        $selectores = $this->selectoresComunes();

        return view('rutas.edit')->with(['ruta' => $ruta, 'selectores' => $selectores]);
    }

    /**
     * Update the specified Ruta in storage.
     *
     * @param  int              $id
     * @param UpdateRutaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRutaRequest $request)
    {
        $ruta = $this->rutaRepository->findWithoutFail($id);

        if (empty($ruta)) {
            Flash::error('Ruta No se encuentra registrado.');

            return redirect(route('rutas.index'));
        }
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $ruta = $this->rutaRepository->update($input, $id);

        Flash::success('Ruta actualizado correctamente.');

        return redirect(route('rutas.index'));
    }

    /**
     * Remove the specified Ruta from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $ruta = $this->rutaRepository->findWithoutFail($id);

        if (empty($ruta)) {
            Flash::error('Ruta No se encuentra registrado.');

            return redirect(route('rutas.index'));
        }

        $this->rutaRepository->delete($id);

        Flash::success('Ruta eliminado correctamente.');

        return redirect(route('rutas.index'));
    }
}
