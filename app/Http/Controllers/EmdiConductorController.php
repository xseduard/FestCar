<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmdiConductorRequest;
use App\Http\Requests\UpdateEmdiConductorRequest;
use App\Repositories\EmdiConductorRepository;
use App\Repositories\CentralRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use Response;

class EmdiConductorController extends AppBaseController
{
    /** @var  EmdiConductorRepository */
    private $emdiConductorRepository;
    private $centralRepository;

    public function __construct(EmdiConductorRepository $emdiConductorRepo, CentralRepository $centralRepo)
    {
        $this->middleware('auth');
        $this->emdiConductorRepository = $emdiConductorRepo;
        $this->centralRepository = $centralRepo;
    }

    /**
     * Display a listing of the EmdiConductor.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->emdiConductorRepository->pushCriteria(new RequestCriteria($request));
        $emdiConductors = $this->emdiConductorRepository->with('user')->paginate(15);

        /**
         * $emdiConductors = $this->emdiConductorRepository->all();
         */

        return view('emdi_conductors.index')
            ->with('emdiConductors', $emdiConductors);
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
     * Show the form for creating a new EmdiConductor.
     *
     * @return Response
     */
    public function create()
    {
        $selectores = $this->selectoresComunes();

        return view('emdi_conductors.create')->with(['selectores' => $selectores]);
    }

    /**
     * Store a newly created EmdiConductor in storage.
     *
     * @param CreateEmdiConductorRequest $request
     *
     * @return Response
     */
    public function store(CreateEmdiConductorRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $emdiConductor = $this->emdiConductorRepository->create($input);

        Flash::success('Conductor registrado correctamente.');

        return redirect(route('emdiConductors.index'));
    }

    /**
     * Display the specified EmdiConductor.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $emdiConductor = $this->emdiConductorRepository->findWithoutFail($id);

        if (empty($emdiConductor)) {
            Flash::error('Conductor No se encuentra registrado.');

            return redirect(route('emdiConductors.index'));
        }

        return view('emdi_conductors.show')->with('emdiConductor', $emdiConductor);
    }

    /**
     * Show the form for editing the specified EmdiConductor.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $emdiConductor = $this->emdiConductorRepository->findWithoutFail($id);

        if (empty($emdiConductor)) {
            Flash::error('Conductor No se encuentra registrado.');

            return redirect(route('emdiConductors.index'));
        }

        $selectores = $this->selectoresComunes();

        return view('emdi_conductors.edit')->with(['emdiConductor' => $emdiConductor, 'selectores' => $selectores]);
    }

    /**
     * Update the specified EmdiConductor in storage.
     *
     * @param  int              $id
     * @param UpdateEmdiConductorRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEmdiConductorRequest $request)
    {
        $emdiConductor = $this->emdiConductorRepository->findWithoutFail($id);

        if (empty($emdiConductor)) {
            Flash::error('Conductor No se encuentra registrado.');

            return redirect(route('emdiConductors.index'));
        }
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $emdiConductor = $this->emdiConductorRepository->update($input, $id);

        Flash::success('Conductor actualizado correctamente.');

        return redirect(route('emdiConductors.index'));
    }

    /**
     * Remove the specified EmdiConductor from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $emdiConductor = $this->emdiConductorRepository->findWithoutFail($id);

        if (empty($emdiConductor)) {
            Flash::error('Conductor No se encuentra registrado.');

            return redirect(route('emdiConductors.index'));
        }

        $this->emdiConductorRepository->delete($id);

        Flash::success('Conductor eliminado correctamente.');

        return redirect(route('emdiConductors.index'));
    }
}
