<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReciboRequest;
use App\Http\Requests\UpdateReciboRequest;
// import all repositories recibo
use App\Repositories\ReciboRepository;
use App\Repositories\ReciboDetalleRepository;
use App\Repositories\ReciboProductoRepository;

use App\Repositories\CentralRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

class ReciboController extends AppBaseController
{
    /** @var  ReciboRepository */
    private $reciboRepository;   
    private $reciboProductoRepository;
    private $reciboDetalleRepository;
    private $centralRepository;

    public function __construct(ReciboRepository $reciboRepo, ReciboDetalleRepository $reciboDetalleRepo, ReciboProductoRepository $reciboProductoRepo, CentralRepository $centralRepo)
    {
        $this->middleware('auth');
        $this->reciboRepository = $reciboRepo;
        $this->reciboDetalleRepository = $reciboDetalleRepo;
        $this->reciboProductoRepository = $reciboProductoRepo;
        $this->centralRepository = $centralRepo;
    }

    /**
     * Display a listing of the Recibo.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->reciboRepository->pushCriteria(new RequestCriteria($request));
        $recibos = $this->reciboRepository
        ->with('user')
        ->with('natural')
        ->with('articulos.producto')
        ->paginate(15);

        // $recibos = $this->reciboRepository->paginate(15);

        /**
         * $recibos = $this->reciboRepository->all();
         */

        return view('recibos.index')
            ->with('recibos', $recibos);
    }
    /**
     * Selectores comunes
     */
    public function selectoresComunes()
    {
        $selectores = [];
        // $selectores['atributo_id'] = $this->centralRepository->atributo_id();
        $selectores['natural_id'] = $this->centralRepository->natural_id();
        $selectores['recibo_producto_id'] = $this->reciboProductoRepository->recibo_producto_id();
        return $selectores;
    }
    /**
     * Show the form for creating a new Recibo.
     *
     * @return Response
     */
    public function create()
    {
        $selectores = $this->selectoresComunes();

        return view('recibos.create')->with(['selectores' => $selectores]);
    }

    /**
     * Store a newly created Recibo in storage.
     *
     * @param CreateReciboRequest $request
     *
     * @return Response
     */
    public function store(CreateReciboRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $rel_input = [];

        if (empty($input['art_1']) or $input['cantidad_1'] < 1 or $input['precio_1'] < 1000) {
             Flash::error('Articulo/Cantidad/Precio uno es obligatorio');           
             return Redirect::back()->withInput(Input::all());
        } else{            
            $rel_input[1] = [
                'recibo_producto_id' => $input['art_1'],
                'cantidad'           => $input['cantidad_1'],
                'precio_final'       => $input['precio_1']
                ];
        }
        if (!empty($input['art_2']) and $input['cantidad_2'] > 0 and $input['precio_2'] >= 1000) {
            $rel_input[2] = [
                'recibo_producto_id' => $input['art_2'],
                'cantidad'           => $input['cantidad_2'],
                'precio_final'       => $input['precio_2']
                ];
        }
        if (!empty($input['art_3']) and $input['cantidad_3'] > 0 and $input['precio_3'] >= 1000) {
            $rel_input[3] = [
                'recibo_producto_id' => $input['art_3'],
                'cantidad'           => $input['cantidad_3'],
                'precio_final'       => $input['precio_3']
                ];
        }
        if (!empty($input['art_4']) and $input['cantidad_4'] > 0 and $input['precio_4'] >= 1000) {
            $rel_input[4] = [
                'recibo_producto_id' => $input['art_4'],
                'cantidad'           => $input['cantidad_4'],
                'precio_final'       => $input['precio_4']
                ];
        }

        $recibo = $this->reciboRepository->create($input);

        foreach ($rel_input as $key => $value) {
            $value['recibo_id'] = $recibo->id;
            $reciboDetalle = $this->reciboDetalleRepository->create($value);                       
        }

        Flash::success('Recibo registrado correctamente.');

        return redirect(route('recibos.index'));
    }

    /**
     * Display the specified Recibo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $recibo = $this->reciboRepository->findWithoutFail($id);

        if (empty($recibo)) {
            Flash::error('Recibo No se encuentra registrado.');

            return redirect(route('recibos.index'));
        }

        return view('recibos.show')->with('recibo', $recibo);
    }

    /**
     * Show the form for editing the specified Recibo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $recibo = $this->reciboRepository->findWithoutFail($id);

        if (empty($recibo)) {
            Flash::error('Recibo No se encuentra registrado.');

            return redirect(route('recibos.index'));
        }

        $selectores = $this->selectoresComunes();

        return view('recibos.edit')->with(['recibo' => $recibo, 'selectores' => $selectores]);
    }

    /**
     * Update the specified Recibo in storage.
     *
     * @param  int              $id
     * @param UpdateReciboRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReciboRequest $request)
    {
        $recibo = $this->reciboRepository->findWithoutFail($id);

        if (empty($recibo)) {
            Flash::error('Recibo No se encuentra registrado.');

            return redirect(route('recibos.index'));
        }
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $recibo = $this->reciboRepository->update($input, $id);

        Flash::success('Recibo actualizado correctamente.');

        return redirect(route('recibos.index'));
    }

    /**
     * Remove the specified Recibo from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $recibo = $this->reciboRepository->findWithoutFail($id);

        if (empty($recibo)) {
            Flash::error('Recibo No se encuentra registrado.');

            return redirect(route('recibos.index'));
        }

        $this->reciboRepository->delete($id);

        Flash::success('Recibo eliminado correctamente.');

        return redirect(route('recibos.index'));
    }
    public function print_space($id)
    {
        $recibo = $this->reciboRepository->findWithoutFail($id);

        if (empty($recibo)) {
            Flash::error('Recibo No se encuentra registrado.');

            return redirect(route('recibos.index'));
        }
       $this->reciboRepository->print_recibos($id);
        
    }
}
