<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateHojaVidaRequest;
use App\Http\Requests\UpdateHojaVidaRequest;
use App\Repositories\HojaVidaRepository;
use App\Repositories\CentralRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use Response;

class HojaVidaController extends AppBaseController
{
    /** @var  HojaVidaRepository */
    private $hojaVidaRepository;
    private $centralRepository;

    public function __construct(HojaVidaRepository $hojaVidaRepo, CentralRepository $centralRepo)
    {
        $this->middleware('auth');
        $this->hojaVidaRepository = $hojaVidaRepo;
        $this->centralRepository = $centralRepo;
    }

    /**
     * Display a listing of the HojaVida.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->hojaVidaRepository->pushCriteria(new RequestCriteria($request));
        $hojaVidas = $this->hojaVidaRepository->paginate(15);

        /**
         * $hojaVidas = $this->hojaVidaRepository->all();
         */

        return view('hoja_vidas.index')
            ->with('hojaVidas', $hojaVidas);
    }
    /**
     * Selectores comunes
     */
    public function selectoresComunes()
    {
        $selectores = [];
        // $selectores['atributo_id'] = $this->centralRepository->atributo_id();
        $selectores['natural_id'] = $this->centralRepository->natural_id();
        $selectores['municipio_id'] = $this->centralRepository->municipio_id();
        return $selectores;
    }
    /**
     * Show the form for creating a new HojaVida.
     *
     * @return Response
     */
    public function create()
    {
        $selectores = $this->selectoresComunes();

        return view('hoja_vidas.create')->with(['selectores' => $selectores]);
    }

    /**
     * Store a newly created HojaVida in storage.
     *
     * @param CreateHojaVidaRequest $request
     *
     * @return Response
     */
    public function store(CreateHojaVidaRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $hojaVida = $this->hojaVidaRepository->create($input);

        Flash::success('Hoja de Vida registrado correctamente.');

        return redirect(route('hojaVidas.index'));
    }

    /**
     * Display the specified HojaVida.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $hojaVida = $this->hojaVidaRepository->findWithoutFail($id);

        if (empty($hojaVida)) {
            Flash::error('Hoja de Vida No se encuentra registrada.');

            return redirect(route('hojaVidas.index'));
        }

        return view('hoja_vidas.show')->with('hojaVida', $hojaVida);
    }

    /**
     * Show the form for editing the specified HojaVida.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $hojaVida = $this->hojaVidaRepository->findWithoutFail($id);

        if (empty($hojaVida)) {
            Flash::error('Hoja de Vida No se encuentra registrada.');

            return redirect(route('hojaVidas.index'));
        }

        $selectores = $this->selectoresComunes();

        return view('hoja_vidas.edit')->with(['hojaVida' => $hojaVida, 'selectores' => $selectores]);
    }

    /**
     * Update the specified HojaVida in storage.
     *
     * @param  int              $id
     * @param UpdateHojaVidaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHojaVidaRequest $request)
    {
        $hojaVida = $this->hojaVidaRepository->findWithoutFail($id);

        if (empty($hojaVida)) {
            Flash::error('Hoja de Vida No se encuentra registrada.');

            return redirect(route('hojaVidas.index'));
        }
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $hojaVida = $this->hojaVidaRepository->update($input, $id);

        Flash::success('Hoja de Vida actualizada correctamente.');

        return redirect(route('hojaVidas.index'));
    }

    /**
     * Remove the specified HojaVida from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $hojaVida = $this->hojaVidaRepository->findWithoutFail($id);

        if (empty($hojaVida)) {
            Flash::error('Hoja de Vida No se encuentra registrada.');

            return redirect(route('hojaVidas.index'));
        }

        $this->hojaVidaRepository->delete($id);

        Flash::success('Hoja de Vida eliminada correctamente.');

        return redirect(route('hojaVidas.index'));
    }
}
