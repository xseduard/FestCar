<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmdiPacienteRequest;
use App\Http\Requests\UpdateEmdiPacienteRequest;
use App\Repositories\EmdiPacienteRepository;
use App\Repositories\CentralRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use Response;

class EmdiPacienteController extends AppBaseController
{
    /** @var  EmdiPacienteRepository */
    private $emdiPacienteRepository;
    private $centralRepository;

    public function __construct(EmdiPacienteRepository $emdiPacienteRepo, CentralRepository $centralRepo)
    {
        $this->middleware('auth');
        $this->emdiPacienteRepository = $emdiPacienteRepo;
        $this->centralRepository = $centralRepo;
    }

    /**
     * Display a listing of the EmdiPaciente.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->emdiPacienteRepository->pushCriteria(new RequestCriteria($request));
        $emdiPacientes = $this->emdiPacienteRepository->orderBy('updated_at', 'desc')->paginate(15);

        /**
         * $emdiPacientes = $this->emdiPacienteRepository->all();
         */

        return view('emdi_pacientes.index')
            ->with('emdiPacientes', $emdiPacientes);
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
     * Show the form for creating a new EmdiPaciente.
     *
     * @return Response
     */
    public function create()
    {
        $selectores = $this->selectoresComunes();

        return view('emdi_pacientes.create')->with(['selectores' => $selectores]);
    }

    /**
     * Store a newly created EmdiPaciente in storage.
     *
     * @param CreateEmdiPacienteRequest $request
     *
     * @return Response
     */
    public function store(CreateEmdiPacienteRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $emdiPaciente = $this->emdiPacienteRepository->create($input);

        Flash::success('Afiliado/Usuario registrado correctamente.');

        return redirect(route('emdiPacientes.index'));
    }

    /**
     * Display the specified EmdiPaciente.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $emdiPaciente = $this->emdiPacienteRepository->findWithoutFail($id);

        if (empty($emdiPaciente)) {
            Flash::error('Afiliado/Usuario No se encuentra registrado.');

            return redirect(route('emdiPacientes.index'));
        }

        return view('emdi_pacientes.show')->with('emdiPaciente', $emdiPaciente);
    }

    /**
     * Show the form for editing the specified EmdiPaciente.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $emdiPaciente = $this->emdiPacienteRepository->findWithoutFail($id);

        if (empty($emdiPaciente)) {
            Flash::error('Afiliado/Usuario No se encuentra registrado.');

            return redirect(route('emdiPacientes.index'));
        }

        $selectores = $this->selectoresComunes();

        return view('emdi_pacientes.edit')->with(['emdiPaciente' => $emdiPaciente, 'selectores' => $selectores]);
    }

    /**
     * Update the specified EmdiPaciente in storage.
     *
     * @param  int              $id
     * @param UpdateEmdiPacienteRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEmdiPacienteRequest $request)
    {
        $emdiPaciente = $this->emdiPacienteRepository->findWithoutFail($id);

        if (empty($emdiPaciente)) {
            Flash::error('Afiliado/Usuario No se encuentra registrado.');

            return redirect(route('emdiPacientes.index'));
        }
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $emdiPaciente = $this->emdiPacienteRepository->update($input, $id);

        Flash::success('Afiliado/Usuario actualizado correctamente.');

        return redirect(route('emdiPacientes.index'));
    }

    /**
     * Remove the specified EmdiPaciente from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $emdiPaciente = $this->emdiPacienteRepository->findWithoutFail($id);

        if (empty($emdiPaciente)) {
            Flash::error('Afiliado/Usuario No se encuentra registrado.');

            return redirect(route('emdiPacientes.index'));
        }

        $this->emdiPacienteRepository->delete($id);

        Flash::success('Afiliado/Usuario eliminado correctamente.');

        return redirect(route('emdiPacientes.index'));
    }
}
