<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRevisionPreventivaRequest;
use App\Http\Requests\UpdateRevisionPreventivaRequest;
use App\Repositories\RevisionPreventivaRepository;
use App\Repositories\CentralRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use Response;

class RevisionPreventivaController extends AppBaseController
{
    /** @var  RevisionPreventivaRepository */
    private $revisionPreventivaRepository;
    private $centralRepository;

    public function __construct(RevisionPreventivaRepository $revisionPreventivaRepo, CentralRepository $centralRepo)
    {
        $this->middleware('auth');
        $this->revisionPreventivaRepository = $revisionPreventivaRepo;
        $this->centralRepository = $centralRepo;
    }

    /**
     * Display a listing of the RevisionPreventiva.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->revisionPreventivaRepository->pushCriteria(new RequestCriteria($request));
        $revisionPreventivas = $this->revisionPreventivaRepository->orderBy('updated_at', 'desc')->paginate(15);
        $fecha_actual = \Carbon\Carbon::now();

        /**
         * $revisionPreventivas = $this->revisionPreventivaRepository->all();
         */

        return view('revision_preventivas.index')
            ->with(['revisionPreventivas' => $revisionPreventivas, 'fecha_actual' => $fecha_actual]);
    }
    /**
     * Selectores comunes
     */
    public function selectoresComunes()
    {
        $selectores = [];
        // $selectores['atributo_id'] = $this->centralRepository->atributo_id();
        $selectores['vehiculo_id'] = $this->centralRepository->vehiculo_id();
        return $selectores;
    }
    /**
     * Show the form for creating a new RevisionPreventiva.
     *
     * @return Response
     */
    public function create()
    {
        $selectores = $this->selectoresComunes();

        return view('revision_preventivas.create')->with(['selectores' => $selectores]);
    }

    /**
     * Store a newly created RevisionPreventiva in storage.
     *
     * @param CreateRevisionPreventivaRequest $request
     *
     * @return Response
     */
    public function store(CreateRevisionPreventivaRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $revisionPreventiva = $this->revisionPreventivaRepository->create($input);

        Flash::success('Revision Preventiva registrada correctamente.');

        return redirect(route('revisionPreventivas.index'));
    }

    /**
     * Display the specified RevisionPreventiva.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $revisionPreventiva = $this->revisionPreventivaRepository->findWithoutFail($id);

        if (empty($revisionPreventiva)) {
            Flash::error('Revision Preventiva No se encuentra registrada.');

            return redirect(route('revisionPreventivas.index'));
        }

        return view('revision_preventivas.show')->with('revisionPreventiva', $revisionPreventiva);
    }

    /**
     * Show the form for editing the specified RevisionPreventiva.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $revisionPreventiva = $this->revisionPreventivaRepository->findWithoutFail($id);

        if (empty($revisionPreventiva)) {
            Flash::error('Revision Preventiva No se encuentra registrada.');

            return redirect(route('revisionPreventivas.index'));
        }

        $selectores = $this->selectoresComunes();

        return view('revision_preventivas.edit')->with(['revisionPreventiva' => $revisionPreventiva, 'selectores' => $selectores]);
    }

    /**
     * Update the specified RevisionPreventiva in storage.
     *
     * @param  int              $id
     * @param UpdateRevisionPreventivaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRevisionPreventivaRequest $request)
    {
        $revisionPreventiva = $this->revisionPreventivaRepository->findWithoutFail($id);

        if (empty($revisionPreventiva)) {
            Flash::error('Revision Preventiva No se encuentra registrada.');

            return redirect(route('revisionPreventivas.index'));
        }
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $revisionPreventiva = $this->revisionPreventivaRepository->update($input, $id);

        Flash::success('Revision Preventiva actualizada correctamente.');

        return redirect(route('revisionPreventivas.index'));
    }

    /**
     * Remove the specified RevisionPreventiva from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $revisionPreventiva = $this->revisionPreventivaRepository->findWithoutFail($id);

        if (empty($revisionPreventiva)) {
            Flash::error('Revision Preventiva No se encuentra registrada.');

            return redirect(route('revisionPreventivas.index'));
        }

        $this->revisionPreventivaRepository->delete($id);

        Flash::success('Revision Preventiva eliminada correctamente.');

        return redirect(route('revisionPreventivas.index'));
    }
}
