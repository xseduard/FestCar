<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmdiLugarRequest;
use App\Http\Requests\UpdateEmdiLugarRequest;
use App\Repositories\EmdiLugarRepository;
use App\Repositories\CentralRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use Response;

class EmdiLugarController extends AppBaseController
{
    /** @var  EmdiLugarRepository */
    private $emdiLugarRepository;
    private $centralRepository;

    public function __construct(EmdiLugarRepository $emdiLugarRepo, CentralRepository $centralRepo)
    {
        $this->middleware('auth');
        $this->emdiLugarRepository = $emdiLugarRepo;
        $this->centralRepository = $centralRepo;
    }

    /**
     * Display a listing of the EmdiLugar.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->emdiLugarRepository->pushCriteria(new RequestCriteria($request));
        $emdiLugars = $this->emdiLugarRepository->with('user')->paginate(15);

        /**
         * $emdiLugars = $this->emdiLugarRepository->all();
         */

        return view('emdi_lugars.index')
            ->with('emdiLugars', $emdiLugars);
    }
    /**
     * Selectores comunes
     */
    public function selectoresComunes()
    {
        $selectores = [];
        $selectores['municipio_id'] = $this->centralRepository->municipio_id();
        return $selectores;
    }
    /**
     * Show the form for creating a new EmdiLugar.
     *
     * @return Response
     */
    public function create()
    {
        $selectores = $this->selectoresComunes();

        return view('emdi_lugars.create')->with(['selectores' => $selectores]);
    }

    /**
     * Store a newly created EmdiLugar in storage.
     *
     * @param CreateEmdiLugarRequest $request
     *
     * @return Response
     */
    public function store(CreateEmdiLugarRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $emdiLugar = $this->emdiLugarRepository->create($input);

        Flash::success('Lugar registrado correctamente.');

        return redirect(route('emdiLugars.index'));
    }

    /**
     * Display the specified EmdiLugar.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $emdiLugar = $this->emdiLugarRepository->findWithoutFail($id);

        if (empty($emdiLugar)) {
            Flash::error('Lugar No se encuentra registrado.');

            return redirect(route('emdiLugars.index'));
        }

        return view('emdi_lugars.show')->with('emdiLugar', $emdiLugar);
    }

    /**
     * Show the form for editing the specified EmdiLugar.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $emdiLugar = $this->emdiLugarRepository->findWithoutFail($id);

        if (empty($emdiLugar)) {
            Flash::error('Lugar No se encuentra registrado.');

            return redirect(route('emdiLugars.index'));
        }

        $selectores = $this->selectoresComunes();

        return view('emdi_lugars.edit')->with(['emdiLugar' => $emdiLugar, 'selectores' => $selectores]);
    }

    /**
     * Update the specified EmdiLugar in storage.
     *
     * @param  int              $id
     * @param UpdateEmdiLugarRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEmdiLugarRequest $request)
    {
        $emdiLugar = $this->emdiLugarRepository->findWithoutFail($id);

        if (empty($emdiLugar)) {
            Flash::error('Lugar No se encuentra registrado.');

            return redirect(route('emdiLugars.index'));
        }
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $emdiLugar = $this->emdiLugarRepository->update($input, $id);

        Flash::success('Lugar actualizado correctamente.');

        return redirect(route('emdiLugars.index'));
    }

    /**
     * Remove the specified EmdiLugar from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $emdiLugar = $this->emdiLugarRepository->findWithoutFail($id);

        if (empty($emdiLugar)) {
            Flash::error('Lugar No se encuentra registrado.');

            return redirect(route('emdiLugars.index'));
        }

        $this->emdiLugarRepository->delete($id);

        Flash::success('Lugar eliminado correctamente.');

        return redirect(route('emdiLugars.index'));
    }
}
