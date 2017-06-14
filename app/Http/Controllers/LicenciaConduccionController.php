<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLicenciaConduccionRequest;
use App\Http\Requests\UpdateLicenciaConduccionRequest;
use App\Repositories\LicenciaConduccionRepository;
use App\Repositories\CentralRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use Response;

class LicenciaConduccionController extends AppBaseController
{
    /** @var  LicenciaConduccionRepository */
    private $licenciaConduccionRepository;
    private $centralRepository;

    public function __construct(LicenciaConduccionRepository $licenciaConduccionRepo, CentralRepository $centralRepo)
    {
        $this->middleware('auth');
        $this->licenciaConduccionRepository = $licenciaConduccionRepo;
        $this->centralRepository = $centralRepo;
    }

    /**
     * Display a listing of the LicenciaConduccion.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->licenciaConduccionRepository->pushCriteria(new RequestCriteria($request));
        $licenciaConduccions = $this->licenciaConduccionRepository->orderBy('updated_at', 'desc')->paginate(15);

        /**
         * $licenciaConduccions = $this->licenciaConduccionRepository->all();
         */

        return view('licencia_conduccions.index')
            ->with('licenciaConduccions', $licenciaConduccions);
    }
    /**
     * Selectores comunes
     */
    public function selectoresComunes()
    {
        $selectores = [];
        // $selectores['atributo_id'] = $this->centralRepository->atributo_id();
        $selectores['natural_id'] = $this->centralRepository->natural_id();
        return $selectores;
    }
    /**
     * Show the form for creating a new LicenciaConduccion.
     *
     * @return Response
     */
    public function create()
    {
        $selectores = $this->selectoresComunes();

        return view('licencia_conduccions.create')->with(['selectores' => $selectores]);
    }

    /**
     * Store a newly created LicenciaConduccion in storage.
     *
     * @param CreateLicenciaConduccionRequest $request
     *
     * @return Response
     */
    public function store(CreateLicenciaConduccionRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $licenciaConduccion = $this->licenciaConduccionRepository->create($input);

        Flash::success('Licencia de Conducción registrada correctamente.');

        return redirect(route('licenciaConduccions.index'));
    }

    /**
     * Display the specified LicenciaConduccion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $licenciaConduccion = $this->licenciaConduccionRepository->findWithoutFail($id);

        if (empty($licenciaConduccion)) {
            Flash::error('Licencia de Conducción No se encuentra registrada.');

            return redirect(route('licenciaConduccions.index'));
        }

        return view('licencia_conduccions.show')->with('licenciaConduccion', $licenciaConduccion);
    }

    /**
     * Show the form for editing the specified LicenciaConduccion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $licenciaConduccion = $this->licenciaConduccionRepository->findWithoutFail($id);

        if (empty($licenciaConduccion)) {
            Flash::error('Licencia de Conducción No se encuentra registrada.');

            return redirect(route('licenciaConduccions.index'));
        }

        $selectores = $this->selectoresComunes();

        return view('licencia_conduccions.edit')->with(['licenciaConduccion' => $licenciaConduccion, 'selectores' => $selectores]);
    }

    /**
     * Update the specified LicenciaConduccion in storage.
     *
     * @param  int              $id
     * @param UpdateLicenciaConduccionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLicenciaConduccionRequest $request)
    {
        $licenciaConduccion = $this->licenciaConduccionRepository->findWithoutFail($id);

        if (empty($licenciaConduccion)) {
            Flash::error('Licencia de Conducción No se encuentra registrada.');

            return redirect(route('licenciaConduccions.index'));
        }
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $licenciaConduccion = $this->licenciaConduccionRepository->update($input, $id);

        Flash::success('Licencia de Conducción actualizada correctamente.');

        return redirect(route('licenciaConduccions.index'));
    }

    /**
     * Remove the specified LicenciaConduccion from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $licenciaConduccion = $this->licenciaConduccionRepository->findWithoutFail($id);

        if (empty($licenciaConduccion)) {
            Flash::error('Licencia de Conducción No se encuentra registrada.');

            return redirect(route('licenciaConduccions.index'));
        }

        $this->licenciaConduccionRepository->delete($id);

        Flash::success('Licencia de Conducción eliminada correctamente.');

        return redirect(route('licenciaConduccions.index'));
    }
}
