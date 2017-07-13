<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSoatRequest;
use App\Http\Requests\UpdateSoatRequest;
use App\Repositories\SoatRepository;
use App\Repositories\CentralRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use Response;
use Jenssegers\Date\Date;

use App\Models\Soat;

class SoatController extends AppBaseController
{
    /** @var  SoatRepository */
    private $soatRepository;
    private $centralRepository;

    public function __construct(SoatRepository $soatRepo, CentralRepository $centralRepo)
    {
        $this->middleware('auth');
        $this->soatRepository = $soatRepo;
        $this->centralRepository = $centralRepo;
    }

    /**
     * Display a listing of the Soat.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        //$this->soatRepository->pushCriteria(new RequestCriteria($request));
        $soats = Soat::Svehiculoplaca($request->vehiculo_id)
        ->Sestado($request->estado)
        ->orderBy(request('order_item', 'updated_at'), request('order_type', 'desc'))
        ->paginate(request('per_page', '15'));
        
        $fecha_actual = \Carbon\Carbon::now();


        /**
         * $soats = $this->soatRepository->all();
         */

        return view('soats.index')
            ->with(['soats' => $soats, 'fecha_actual' => $fecha_actual]);
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
     * Show the form for creating a new Soat.
     *
     * @return Response
     */
    public function create()
    {
        $selectores = $this->selectoresComunes();

        return view('soats.create')->with(['selectores' => $selectores]);
    }

    /**
     * Store a newly created Soat in storage.
     *
     * @param CreateSoatRequest $request
     *
     * @return Response
     */
    public function store(CreateSoatRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $input['fecha_vigencia_inicio'] = (new Date ($input['fecha_vigencia_final']))->subYear()->addDay();

        $soat = $this->soatRepository->create($input);

        Flash::success('Soat registrado correctamente.');

        return redirect(route('soats.index'));
    }

    /**
     * Display the specified Soat.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $soat = $this->soatRepository->findWithoutFail($id);

        if (empty($soat)) {
            Flash::error('Soat No se encuentra registrado.');

            return redirect(route('soats.index'));
        }

        return view('soats.show')->with('soat', $soat);
    }

    /**
     * Show the form for editing the specified Soat.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $soat = $this->soatRepository->findWithoutFail($id);


        if (empty($soat)) {
            Flash::error('Soat No se encuentra registrado.');

            return redirect(route('soats.index'));
        }

        $selectores = $this->selectoresComunes();

        return view('soats.edit')->with(['soat' => $soat, 'selectores' => $selectores]);
    }

    /**
     * Update the specified Soat in storage.
     *
     * @param  int              $id
     * @param UpdateSoatRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSoatRequest $request)
    {
        $soat = $this->soatRepository->findWithoutFail($id);

        if (empty($soat)) {
            Flash::error('Soat No se encuentra registrado.');

            return redirect(route('soats.index'));
        }
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $input['fecha_vigencia_inicio'] = (new Date ($input['fecha_vigencia_final']))->subYear()->addDay();
       
        $soat = $this->soatRepository->update($input, $id);

        Flash::success('Soat actualizado correctamente.');

        return redirect(route('soats.index'));
    }

    /**
     * Remove the specified Soat from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $soat = $this->soatRepository->findWithoutFail($id);

        if (empty($soat)) {
            Flash::error('Soat No se encuentra registrado.');

            return redirect(route('soats.index'));
        }

        $this->soatRepository->delete($id);

        Flash::success('Soat eliminado correctamente.');

        return redirect(route('soats.index'));
    }
}
