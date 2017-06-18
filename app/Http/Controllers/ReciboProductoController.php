<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReciboProductoRequest;
use App\Http\Requests\UpdateReciboProductoRequest;
use App\Repositories\ReciboProductoRepository;
use App\Repositories\CentralRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use Response;

class ReciboProductoController extends AppBaseController
{
    /** @var  ReciboProductoRepository */
    private $reciboProductoRepository;
    private $centralRepository;

    public function __construct(ReciboProductoRepository $reciboProductoRepo, CentralRepository $centralRepo)
    {
        $this->middleware('auth');
        $this->reciboProductoRepository = $reciboProductoRepo;
        $this->centralRepository = $centralRepo;
    }

    /**
     * Display a listing of the ReciboProducto.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->reciboProductoRepository->pushCriteria(new RequestCriteria($request));
        $reciboProductos = $this->reciboProductoRepository->paginate(15);

        /**
         * $reciboProductos = $this->reciboProductoRepository->all();
         */

        return view('recibo_productos.index')
            ->with('reciboProductos', $reciboProductos);
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
     * Show the form for creating a new ReciboProducto.
     *
     * @return Response
     */
    public function create()
    {
        $selectores = $this->selectoresComunes();

        return view('recibo_productos.create')->with(['selectores' => $selectores]);
    }

    /**
     * Store a newly created ReciboProducto in storage.
     *
     * @param CreateReciboProductoRequest $request
     *
     * @return Response
     */
    public function store(CreateReciboProductoRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $reciboProducto = $this->reciboProductoRepository->create($input);

        Flash::success('Recibo Producto registrado correctamente.');

        return redirect(route('reciboProductos.index'));
    }

    /**
     * Display the specified ReciboProducto.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $reciboProducto = $this->reciboProductoRepository->findWithoutFail($id);

        if (empty($reciboProducto)) {
            Flash::error('Recibo Producto No se encuentra registrado.');

            return redirect(route('reciboProductos.index'));
        }

        return view('recibo_productos.show')->with('reciboProducto', $reciboProducto);
    }

    /**
     * Show the form for editing the specified ReciboProducto.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $reciboProducto = $this->reciboProductoRepository->findWithoutFail($id);

        if (empty($reciboProducto)) {
            Flash::error('Recibo Producto No se encuentra registrado.');

            return redirect(route('reciboProductos.index'));
        }

        $selectores = $this->selectoresComunes();

        return view('recibo_productos.edit')->with(['reciboProducto' => $reciboProducto, 'selectores' => $selectores]);
    }

    /**
     * Update the specified ReciboProducto in storage.
     *
     * @param  int              $id
     * @param UpdateReciboProductoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReciboProductoRequest $request)
    {
        $reciboProducto = $this->reciboProductoRepository->findWithoutFail($id);

        if (empty($reciboProducto)) {
            Flash::error('Recibo Producto No se encuentra registrado.');

            return redirect(route('reciboProductos.index'));
        }
        $input = $request->all();
        $input['user_id'] = Auth::id();

        $reciboProducto = $this->reciboProductoRepository->update($input, $id);

        Flash::success('Recibo Producto actualizado correctamente.');

        return redirect(route('reciboProductos.index'));
    }

    /**
     * Remove the specified ReciboProducto from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $reciboProducto = $this->reciboProductoRepository->findWithoutFail($id);

        if (empty($reciboProducto)) {
            Flash::error('Recibo Producto No se encuentra registrado.');

            return redirect(route('reciboProductos.index'));
        }

        $this->reciboProductoRepository->delete($id);

        Flash::success('Recibo Producto eliminado correctamente.');

        return redirect(route('reciboProductos.index'));
    }
}
