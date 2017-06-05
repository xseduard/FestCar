<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContratoVinculacionRequest;
use App\Http\Requests\UpdateContratoVinculacionRequest;
use App\Repositories\ContratoVinculacionRepository;
use App\Repositories\CentralRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use Response;

 

class ContratoVinculacionController extends AppBaseController
{
    /** @var  ContratoVinculacionRepository */
    private $contratoVinculacionRepository;
    private $centralRepository;

    public function __construct(ContratoVinculacionRepository $contratoVinculacionRepo, CentralRepository $centralRepo)
    {
        $this->middleware('auth');
        $this->contratoVinculacionRepository = $contratoVinculacionRepo;
        $this->centralRepository = $centralRepo;
    }

    /**
     * Display a listing of the ContratoVinculacion.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->contratoVinculacionRepository->pushCriteria(new RequestCriteria($request));
        $contratoVinculacions = $this->contratoVinculacionRepository->paginate(15);

        /**
         * $contratoVinculacions = $this->contratoVinculacionRepository->all();
         */

        return view('contrato_vinculacions.index')
            ->with('contratoVinculacions', $contratoVinculacions);
    }
    /**
     * Selectores comunes
     */
    public function selectoresComunes()
    {
        $selectores = [];
        // $selectores['atributo_id'] = $this->centralRepository->atributo_id();
        $selectores['vehiculo_id'] = $this->centralRepository->vehiculo_con_tarjeta_propiedad();
        $selectores['natural_id'] = $this->centralRepository->natural_id();
        $selectores['juridico_id'] = $this->centralRepository->juridico_id();
        return $selectores;
    }
    /**
     * Show the form for creating a new ContratoVinculacion.
     *
     * @return Response
     */
    public function create()
    {
        $selectores = $this->selectoresComunes();

        return view('contrato_vinculacions.create')->with(['selectores' => $selectores]);
    }

    /**
     * Store a newly created ContratoVinculacion in storage.
     *
     * @param CreateContratoVinculacionRequest $request
     *
     * @return Response
     */
    public function store(CreateContratoVinculacionRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();


        $contratoVinculacion = $this->contratoVinculacionRepository->create($input);

        Flash::success('Contrato de Vinculación registrado correctamente.');

        return redirect(route('contratoVinculacions.index'));
    }

    /**
     * Display the specified ContratoVinculacion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $contratoVinculacion = $this->contratoVinculacionRepository->findWithoutFail($id);

        if (empty($contratoVinculacion)) {
            Flash::error('Contrato de Vinculación No se encuentra registrado.');

            return redirect(route('contratoVinculacions.index'));
        }

        return view('contrato_vinculacions.show')->with('contratoVinculacion', $contratoVinculacion);
    }

    /**
     * Show the form for editing the specified ContratoVinculacion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $contratoVinculacion = $this->contratoVinculacionRepository->findWithoutFail($id);

        if (empty($contratoVinculacion)) {
            Flash::error('Contrato de Vinculación No se encuentra registrado.');

            return redirect(route('contratoVinculacions.index'));
        }

        $selectores = $this->selectoresComunes();

        return view('contrato_vinculacions.edit')->with(['contratoVinculacion' => $contratoVinculacion, 'selectores' => $selectores]);
    }

    /**
     * Update the specified ContratoVinculacion in storage.
     *
     * @param  int              $id
     * @param UpdateContratoVinculacionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateContratoVinculacionRequest $request)
    {
        $contratoVinculacion = $this->contratoVinculacionRepository->findWithoutFail($id);

        if (empty($contratoVinculacion)) {
            Flash::error('Contrato de Vinculación No se encuentra registrado.');

            return redirect(route('contratoVinculacions.index'));
        }
        $input = $request->all();
        $input['user_id'] = Auth::id();
      
        $contratoVinculacion = $this->contratoVinculacionRepository->update($input, $id);

        Flash::success('Contrato de Vinculación actualizado correctamente.');

        return redirect(route('contratoVinculacions.index'));
    }

    /**
     * Remove the specified ContratoVinculacion from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $contratoVinculacion = $this->contratoVinculacionRepository->findWithoutFail($id);

        if (empty($contratoVinculacion)) {
            Flash::error('Contrato de Vinculación No se encuentra registrado.');

            return redirect(route('contratoVinculacions.index'));
        }

        $this->contratoVinculacionRepository->delete($id);

        Flash::success('Contrato de Vinculación eliminado correctamente.');

        return redirect(route('contratoVinculacions.index'));
    }
     public function print($id)
    {
        $contratoVinculacion = $this->contratoVinculacionRepository->findWithoutFail($id);

        if (empty($contratoVinculacion)) {
            Flash::error('Contrato de Vinculación No se encuentra registrado.');

            return redirect(route('contratoVinculacions.index'));
        }
       
       $this->contratoVinculacionRepository->print_contratos($id);
        
    }
}