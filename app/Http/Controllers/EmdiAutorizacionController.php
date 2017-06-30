<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmdiAutorizacionRequest;
use App\Http\Requests\UpdateEmdiAutorizacionRequest;
use App\Repositories\EmdiAutorizacionRepository;
use App\Repositories\CentralRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use Response;

class EmdiAutorizacionController extends AppBaseController
{
    /** @var  EmdiAutorizacionRepository */
    private $emdiAutorizacionRepository;
    private $centralRepository;

    public function __construct(EmdiAutorizacionRepository $emdiAutorizacionRepo, CentralRepository $centralRepo)
    {
        $this->middleware('auth');
        $this->emdiAutorizacionRepository = $emdiAutorizacionRepo;
        $this->centralRepository = $centralRepo;
    }

    /**
     * Display a listing of the EmdiAutorizacion.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->emdiAutorizacionRepository->pushCriteria(new RequestCriteria($request));
        $emdiAutorizacions = $this->emdiAutorizacionRepository->paginate(15);

        /**
         * $emdiAutorizacions = $this->emdiAutorizacionRepository->all();
         */

        return view('emdi_autorizacions.index')
            ->with('emdiAutorizacions', $emdiAutorizacions);
    }
    /**
     * Selectores comunes
     */
    public function selectoresComunes()
    {
        $selectores = [];
        $selectores['paciente_id'] = $this->emdiAutorizacionRepository->paciente_id();
        $selectores['cita_lugar_id'] = $this->emdiAutorizacionRepository->cita_lugar_id();
        $selectores['conductor_id'] = $this->emdiAutorizacionRepository->conductor_id();
        return $selectores;
    }
    /**
     * Show the form for creating a new EmdiAutorizacion.
     *
     * @return Response
     */
    public function create()
    {
        $selectores = $this->selectoresComunes();

        return view('emdi_autorizacions.create')->with(['selectores' => $selectores]);
    }

    /**
     * Store a newly created EmdiAutorizacion in storage.
     *
     * @param CreateEmdiAutorizacionRequest $request
     *
     * @return Response
     */
    public function store(CreateEmdiAutorizacionRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $emdiAutorizacion = $this->emdiAutorizacionRepository->create($input);

        Flash::success('Autorización registrado correctamente.');

        return redirect(route('emdiAutorizacions.index'));
    }

    /**
     * Display the specified EmdiAutorizacion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $emdiAutorizacion = $this->emdiAutorizacionRepository->findWithoutFail($id);

        if (empty($emdiAutorizacion)) {
            Flash::error('Autorización No se encuentra registrado.');

            return redirect(route('emdiAutorizacions.index'));
        }

        return view('emdi_autorizacions.show')->with('emdiAutorizacion', $emdiAutorizacion);
    }

    /**
     * Show the form for editing the specified EmdiAutorizacion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $emdiAutorizacion = $this->emdiAutorizacionRepository->findWithoutFail($id);

        if (empty($emdiAutorizacion)) {
            Flash::error('Autorización No se encuentra registrado.');

            return redirect(route('emdiAutorizacions.index'));
        }

        $selectores = $this->selectoresComunes();

        return view('emdi_autorizacions.edit')->with(['emdiAutorizacion' => $emdiAutorizacion, 'selectores' => $selectores]);
    }

    /**
     * Update the specified EmdiAutorizacion in storage.
     *
     * @param  int              $id
     * @param UpdateEmdiAutorizacionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEmdiAutorizacionRequest $request)
    {
        $emdiAutorizacion = $this->emdiAutorizacionRepository->findWithoutFail($id);

        if (empty($emdiAutorizacion)) {
            Flash::error('Autorización No se encuentra registrado.');

            return redirect(route('emdiAutorizacions.index'));
        }
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $emdiAutorizacion = $this->emdiAutorizacionRepository->update($input, $id);

        Flash::success('Autorización actualizado correctamente.');

        return redirect(route('emdiAutorizacions.index'));
    }

    /**
     * Remove the specified EmdiAutorizacion from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $emdiAutorizacion = $this->emdiAutorizacionRepository->findWithoutFail($id);

        if (empty($emdiAutorizacion)) {
            Flash::error('Autorización No se encuentra registrado.');

            return redirect(route('emdiAutorizacions.index'));
        }

        $this->emdiAutorizacionRepository->delete($id);

        Flash::success('Autorización eliminado correctamente.');

        return redirect(route('emdiAutorizacions.index'));
    }
    public function print_space($id)
    {
        $emdiAutorizacion = $this->emdiAutorizacionRepository->findWithoutFail($id);

        if (empty($emdiAutorizacion)) {
            Flash::error('Autorización No se encuentra registrado.');

            return redirect(route('emdiAutorizacions.index'));
        }
       $this->emdiAutorizacionRepository->print_autorizaciones($id);
        
    }
}
