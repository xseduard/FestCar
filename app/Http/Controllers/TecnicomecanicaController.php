<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTecnicomecanicaRequest;
use App\Http\Requests\UpdateTecnicomecanicaRequest;
use App\Repositories\TecnicomecanicaRepository;
use App\Repositories\CentralRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use Response;
use Jenssegers\Date\Date;

use App\Models\Tecnicomecanica;

class TecnicomecanicaController extends AppBaseController
{
    /** @var  TecnicomecanicaRepository */
    private $tecnicomecanicaRepository;
    private $centralRepository;

    public function __construct(TecnicomecanicaRepository $tecnicomecanicaRepo, CentralRepository $centralRepo)
    {
        $this->middleware('auth');
        $this->tecnicomecanicaRepository = $tecnicomecanicaRepo;
        $this->centralRepository = $centralRepo;
    }

    /**
     * Display a listing of the Tecnicomecanica.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        //$this->tecnicomecanicaRepository->pushCriteria(new RequestCriteria($request));
        
        $tecnicomecanicas = Tecnicomecanica::Svehiculoplaca($request->vehiculo_id)
        ->Sestado($request->estado)
        ->orderBy(request('order_item', 'updated_at'), request('order_type', 'desc'))
        ->paginate(request('per_page', '15'));

        $fecha_actual = \Carbon\Carbon::now();

        /**
         * $tecnicomecanicas = $this->tecnicomecanicaRepository->all();
         */

        return view('tecnicomecanicas.index')
            ->with(['tecnicomecanicas' => $tecnicomecanicas, 'fecha_actual' => $fecha_actual]);
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
     * Show the form for creating a new Tecnicomecanica.
     *
     * @return Response
     */
    public function create()
    {
        $selectores = $this->selectoresComunes();

        return view('tecnicomecanicas.create')->with(['selectores' => $selectores]);
    }

    /**
     * Store a newly created Tecnicomecanica in storage.
     *
     * @param CreateTecnicomecanicaRequest $request
     *
     * @return Response
     */
    public function store(CreateTecnicomecanicaRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();        
        $input['fecha_vigencia_inicio'] = (new Date ($input['fecha_vigencia_final']))->subYear();

        $tecnicomecanica = $this->tecnicomecanicaRepository->create($input);

        Flash::success('Revisión Técnico Mecánica registrada correctamente.');

        return redirect(route('tecnicomecanicas.index'));
    }

    /**
     * Display the specified Tecnicomecanica.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tecnicomecanica = $this->tecnicomecanicaRepository->findWithoutFail($id);

        if (empty($tecnicomecanica)) {
            Flash::error('Revisión Técnico Mecánica No se encuentra registrado.');

            return redirect(route('tecnicomecanicas.index'));
        }

        return view('tecnicomecanicas.show')->with('tecnicomecanica', $tecnicomecanica);
    }

    /**
     * Show the form for editing the specified Tecnicomecanica.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tecnicomecanica = $this->tecnicomecanicaRepository->findWithoutFail($id);

        if (empty($tecnicomecanica)) {
            Flash::error('Revisión Técnico Mecánica No se encuentra registrado.');

            return redirect(route('tecnicomecanicas.index'));
        }

        $selectores = $this->selectoresComunes();

        return view('tecnicomecanicas.edit')->with(['tecnicomecanica' => $tecnicomecanica, 'selectores' => $selectores]);
    }

    /**
     * Update the specified Tecnicomecanica in storage.
     *
     * @param  int              $id
     * @param UpdateTecnicomecanicaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTecnicomecanicaRequest $request)
    {
        $tecnicomecanica = $this->tecnicomecanicaRepository->findWithoutFail($id);

        if (empty($tecnicomecanica)) {
            Flash::error('Revisión Técnico Mecánica No se encuentra registrado.');

            return redirect(route('tecnicomecanicas.index'));
        }
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $input['fecha_vigencia_inicio'] = (new Date ($input['fecha_vigencia_final']))->subYear();
        

        $tecnicomecanica = $this->tecnicomecanicaRepository->update($input, $id);

        Flash::success('Revisión Técnico Mecánica actualizado correctamente.');

        return redirect(route('tecnicomecanicas.index'));
    }

    /**
     * Remove the specified Tecnicomecanica from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tecnicomecanica = $this->tecnicomecanicaRepository->findWithoutFail($id);

        if (empty($tecnicomecanica)) {
            Flash::error('Revisión Técnico Mecánica No se encuentra registrado.');

            return redirect(route('tecnicomecanicas.index'));
        }

        $this->tecnicomecanicaRepository->delete($id);

        Flash::success('Revisión Técnico Mecánica eliminado correctamente.');

        return redirect(route('tecnicomecanicas.index'));
    }
}
