<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmpresaRequest;
use App\Http\Requests\UpdateEmpresaRequest;
use App\Repositories\EmpresaRepository;
use App\Repositories\CentralRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use Response;

class EmpresaController extends AppBaseController
{
    /** @var  EmpresaRepository */
    private $empresaRepository;
    private $centralRepository;

    public function __construct(EmpresaRepository $empresaRepo, CentralRepository $centralRepo)
    {
        $this->middleware('auth');
        $this->empresaRepository = $empresaRepo;
        $this->centralRepository = $centralRepo;
    }

    /**
     * Display a listing of the Empresa.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->empresaRepository->pushCriteria(new RequestCriteria($request));
        $empresas = $this->empresaRepository->paginate(15);

        /**
         * $empresas = $this->empresaRepository->all();
         */

        return view('empresas.index')
            ->with('empresas', $empresas);
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
     * Show the form for creating a new Empresa.
     *
     * @return Response
     */
    public function create()
    {
        $selectores = $this->selectoresComunes();

        return view('empresas.create')->with(['selectores' => $selectores]);
    }

    /**
     * Store a newly created Empresa in storage.
     *
     * @param CreateEmpresaRequest $request
     *
     * @return Response
     */
    public function store(CreateEmpresaRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $empresa = $this->empresaRepository->create($input);

        Flash::success('Empresa registrado correctamente.');

        return redirect(route('empresas.index'));
    }

    /**
     * Display the specified Empresa.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $empresa = $this->empresaRepository->findWithoutFail($id);

        if (empty($empresa)) {
            Flash::error('Empresa No se encuentra registrado.');

            return redirect(route('empresas.index'));
        }

        return view('empresas.show')->with('empresa', $empresa);
    }

    /**
     * Show the form for editing the specified Empresa.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $empresa = $this->empresaRepository->findWithoutFail($id);

        if (empty($empresa)) {
            Flash::error('Empresa No se encuentra registrado.');

            return redirect(route('empresas.index'));
        }

        $selectores = $this->selectoresComunes();

        return view('empresas.edit')->with(['empresa' => $empresa, 'selectores' => $selectores]);
    }

    /**
     * Update the specified Empresa in storage.
     *
     * @param  int              $id
     * @param UpdateEmpresaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEmpresaRequest $request)
    {
        $empresa = $this->empresaRepository->findWithoutFail($id);

        if (empty($empresa)) {
            Flash::error('Empresa No se encuentra registrado.');

            return redirect(route('empresas.index'));
        }
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $empresa = $this->empresaRepository->update($input, $id);

        Flash::success('Empresa actualizado correctamente.');

        return redirect(route('empresas.index'));
    }

    /**
     * Remove the specified Empresa from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $empresa = $this->empresaRepository->findWithoutFail($id);

        if (empty($empresa)) {
            Flash::error('Empresa No se encuentra registrado.');

            return redirect(route('empresas.index'));
        }

        $this->empresaRepository->delete($id);

        Flash::success('Empresa eliminado correctamente.');

        return redirect(route('empresas.index'));
    }
}
