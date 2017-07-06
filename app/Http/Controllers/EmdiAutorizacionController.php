<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmdiAutorizacionRequest;
use App\Http\Requests\UpdateEmdiAutorizacionRequest;
use App\Repositories\EmdiAutorizacionRepository;
use App\Repositories\EmdiPacienteRepository;
use App\Repositories\CentralRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use Response;
use Carbon\Carbon;
use App\Models\EmdiPaciente;

class EmdiAutorizacionController extends AppBaseController
{
    /** @var  EmdiAutorizacionRepository */
    private $emdiAutorizacionRepository;
    private $emdiPacienteRepository;
    private $centralRepository;

    public function __construct(EmdiAutorizacionRepository $emdiAutorizacionRepo, EmdiPacienteRepository $emdiPacienteRepo, CentralRepository $centralRepo)
    {
        $this->middleware('auth');
        $this->emdiAutorizacionRepository = $emdiAutorizacionRepo;
        $this->emdiPacienteRepository = $emdiPacienteRepo;
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

        $valid_date = Carbon::createFromFormat('Y-m-d', $input['cita_fecha']);
        if ($valid_date >  Carbon::now()->addMonth(2) or $valid_date <  Carbon::now()->subMonth(2)) {
             Flash::error("Fecha de Cita (".$valid_date->format('Y-m-d').") debe estar entre ".Carbon::now()->subMonth(2)->format('Y-m-d')." y ".Carbon::now()->addMonth(2)->format('Y-m-d'));
             return Redirect::back()->withInput(Input::all());
        }
        $paciente = EmdiPaciente::create($input);
        $input['paciente_id'] = $paciente->id;
        
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

        //eliminar paciente
       $emdiPaciente = $this->emdiPacienteRepository->findWithoutFail($emdiAutorizacion->paciente_id);

        if (!empty($emdiPaciente)) {
            $this->emdiPacienteRepository->delete($emdiAutorizacion->paciente_id);
        }

        $this->emdiAutorizacionRepository->delete($id);
        


        Flash::success('Autorización eliminada correctamente.');

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
