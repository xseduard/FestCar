<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateJuridicoRequest;
use App\Http\Requests\UpdateJuridicoRequest;
use App\Repositories\JuridicoRepository;
use App\Repositories\CentralRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use Response;

class JuridicoController extends AppBaseController
{
    /** @var  JuridicoRepository */
    private $juridicoRepository;
    private $centralRepository;

    public function __construct(JuridicoRepository $juridicoRepo, CentralRepository $centralRepo)
    {
        $this->middleware('auth');
        $this->juridicoRepository = $juridicoRepo;
        $this->centralRepository = $centralRepo;
    }

    /**
     * Display a listing of the Juridico.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->juridicoRepository->pushCriteria(new RequestCriteria($request));
        $juridicos = $this->juridicoRepository->paginate(15);

        /**
         * $juridicos = $this->juridicoRepository->all();
         */

        return view('juridicos.index')
            ->with('juridicos', $juridicos);
    }
    /**
     * Selectores comunes
     */
    public function selectoresComunes()
    {
        $selectores = [];
        // $selectores['id_atributo'] = $this->centralRepository->id_atributo();
        $selectores['natural_id'] = $this->centralRepository->natural_id();
        return $selectores;
    }
    /**
     * Show the form for creating a new Juridico.
     *
     * @return Response
     */
    public function create()
    {
        $selectores = $this->selectoresComunes();

        return view('juridicos.create')->with(['selectores' => $selectores]);
    }

    /**
     * Store a newly created Juridico in storage.
     *
     * @param CreateJuridicoRequest $request
     *
     * @return Response
     */
    public function store(CreateJuridicoRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $juridico = $this->juridicoRepository->create($input);

        Flash::success('Tercero Jurídico registrado correctamente.');

        return redirect(route('juridicos.index'));
    }

    /**
     * Display the specified Juridico.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $juridico = $this->juridicoRepository->findWithoutFail($id);

        if (empty($juridico)) {
            Flash::error('Tercero Jurídico No se encuentra en encuentra registrado.');

            return redirect(route('juridicos.index'));
        }

        return view('juridicos.show')->with('juridico', $juridico);
    }

    /**
     * Show the form for editing the specified Juridico.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $juridico = $this->juridicoRepository->findWithoutFail($id);

        if (empty($juridico)) {
            Flash::error('Tercero Jurídico No se encuentra en encuentra registrado.');

            return redirect(route('juridicos.index'));
        }

        $selectores = $this->selectoresComunes();

        return view('juridicos.edit')->with(['juridico' => $juridico, 'selectores' => $selectores]);
    }

    /**
     * Update the specified Juridico in storage.
     *
     * @param  int              $id
     * @param UpdateJuridicoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateJuridicoRequest $request)
    {
        $juridico = $this->juridicoRepository->findWithoutFail($id);

        if (empty($juridico)) {
            Flash::error('Tercero Jurídico No se encuentra en encuentra registrado.');

            return redirect(route('juridicos.index'));
        }
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $juridico = $this->juridicoRepository->update($input, $id);

        Flash::success('Tercero Jurídico actualizado correctamente.');

        return redirect(route('juridicos.index'));
    }

    /**
     * Remove the specified Juridico from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $juridico = $this->juridicoRepository->findWithoutFail($id);

        if (empty($juridico)) {
            Flash::error('Tercero Jurídico No se encuentra en encuentra registrado.');

            return redirect(route('juridicos.index'));
        }

        $this->juridicoRepository->delete($id);

        Flash::success('Tercero Jurídico eliminado correctamente.');

        return redirect(route('juridicos.index'));
    }
}
