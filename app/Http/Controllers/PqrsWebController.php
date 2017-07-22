<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePqrsWebRequest;
use App\Http\Requests\UpdatePqrsWebRequest;
use App\Repositories\PqrsWebRepository;
use App\Repositories\CentralRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use Response;

class PqrsWebController extends AppBaseController
{
    /** @var  PqrsWebRepository */
    private $pqrsWebRepository;
    private $centralRepository;

    public function __construct(PqrsWebRepository $pqrsWebRepo, CentralRepository $centralRepo)
    {
        $this->middleware('auth');
        $this->pqrsWebRepository = $pqrsWebRepo;
        $this->centralRepository = $centralRepo;
    }

    /**
     * Display a listing of the PqrsWeb.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->pqrsWebRepository->pushCriteria(new RequestCriteria($request));
        $pqrsWebs = $this->pqrsWebRepository->paginate(15);

        /**
         * $pqrsWebs = $this->pqrsWebRepository->all();
         */

        return view('pqrs_webs.index')
            ->with('pqrsWebs', $pqrsWebs);
    }
    /**
     * Selectores comunes
     */
    public function selectoresComunes()
    {
        $selectores = [];
        // $selectores['atributo_id'] = $this->centralRepository->atributo_id();
        $selectores['tipo_documento'] = $this->centralRepository->tipo_documento();
        $selectores['tipo_pqrs'] = $this->centralRepository->tipo_pqrs();
        $selectores['tipo_servicio'] = $this->centralRepository->tipo_servicio();
        return $selectores;
    }
    /**
     * Show the form for creating a new PqrsWeb.
     *
     * @return Response
     */
    public function create()
    {        
        $selectores = $this->selectoresComunes();

        return view('pqrs_webs.create')->with(['selectores' => $selectores]);
    }

    /**
     * Store a newly created PqrsWeb in storage.
     *
     * @param CreatePqrsWebRequest $request
     *
     * @return Response
     */
    public function store(CreatePqrsWebRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $input['easy_token'] = str_pad(mt_rand(100,999999), 6, "0", STR_PAD_LEFT); 

        $pqrsWeb = $this->pqrsWebRepository->create($input);

        Flash::success('Pqrs registrado correctamente.');

        return redirect(route('pqrsWebs.index'));
    }

    /**
     * Display the specified PqrsWeb.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pqrsWeb = $this->pqrsWebRepository->findWithoutFail($id);

        if (empty($pqrsWeb)) {
            Flash::error('Pqrs No se encuentra registrado.');

            return redirect(route('pqrsWebs.index'));
        }

        return view('pqrs_webs.show')->with('pqrsWeb', $pqrsWeb);
    }

    /**
     * Show the form for editing the specified PqrsWeb.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pqrsWeb = $this->pqrsWebRepository->findWithoutFail($id);

        if (empty($pqrsWeb)) {
            Flash::error('Pqrs No se encuentra registrado.');

            return redirect(route('pqrsWebs.index'));
        }

        $selectores = $this->selectoresComunes();

        return view('pqrs_webs.edit')->with(['pqrsWeb' => $pqrsWeb, 'selectores' => $selectores]);
    }

    /**
     * Update the specified PqrsWeb in storage.
     *
     * @param  int              $id
     * @param UpdatePqrsWebRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePqrsWebRequest $request)
    {
        $pqrsWeb = $this->pqrsWebRepository->findWithoutFail($id);

        if (empty($pqrsWeb)) {
            Flash::error('Pqrs No se encuentra registrado.');

            return redirect(route('pqrsWebs.index'));
        }
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $pqrsWeb = $this->pqrsWebRepository->update($input, $id);

        Flash::success('Pqrs actualizado correctamente.');

        return redirect(route('pqrsWebs.index'));
    }

    /**
     * Remove the specified PqrsWeb from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pqrsWeb = $this->pqrsWebRepository->findWithoutFail($id);

        if (empty($pqrsWeb)) {
            Flash::error('Pqrs No se encuentra registrado.');

            return redirect(route('pqrsWebs.index'));
        }

        $this->pqrsWebRepository->delete($id);

        Flash::success('Pqrs eliminado correctamente.');

        return redirect(route('pqrsWebs.index'));
    }
}
