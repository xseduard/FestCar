<?php

namespace App\Http\Controllers;

// use App\Http\Requests\CreatePqrsWebRequest;
use App\Http\Requests\CreatePqrsPublicRequest;
use App\Http\Requests\UpdatePqrsWebRequest;
use App\Http\Requests\SeguimientoPqrsPublicRequest;
use App\Repositories\PqrsWebRepository;
use App\Repositories\CentralRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use Response;
use App\Models\PqrsWeb;
use Mail;

class PqrsPublicController extends AppBaseController
{
    /** @var  PqrsWebRepository */
    private $pqrsWebRepository;
    private $centralRepository;

    public function __construct(PqrsWebRepository $pqrsWebRepo, CentralRepository $centralRepo)
    {        
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

        $enterprise_public = $this->centralRepository->enterprise_public();

       

        return view('pqrs_webs.public_create')->with(['selectores' => $selectores, 'enterprise_public' => $enterprise_public]);
    }

    /**
     * Store a newly created PqrsWeb in storage.
     *
     * @param CreatePqrsWebRequest $request
     *
     * @return Response
     */
    public function store(CreatePqrsPublicRequest $request)
    {
        
        $input = $request->all();
        $input['easy_token'] = str_pad(mt_rand(100,999999), 6, "0", STR_PAD_LEFT); 

        $pqrsWeb = $this->pqrsWebRepository->create($input);   
        $enterprise_public = $this->centralRepository->enterprise_public();     
 
        try{
            Mail::send('emails.pqrs_radicado', ['pqrsWeb' => $pqrsWeb, 'enterprise_public' => $enterprise_public], function ($message) use($pqrsWeb, $enterprise_public){
     
                $message->from('sistema@transeba.com', $enterprise_public->short_name);
         
                $message->to($pqrsWeb->correo)->subject('Notificación Radicado PQRS');
         
            });
        } catch(\Exception $e) {
            // errors
        }

        Flash::success('Pqrs radicado correctamente con el número/codigo <b>'.$pqrsWeb->easy_token.'</b> <p>Se ha enviado un mensaje al correo <b>'.$pqrsWeb->correo.'</b> </p> <p>Para mas información puede consultar su petición haciendo <a href="/pqrsPublic/consulta">click aquí</a> .</p> ');

        return redirect(route('pqrsPublic.create'));
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
    public function consulta() //public function consulta($id) 
    {       
       $enterprise_public = $this->centralRepository->enterprise_public();

        return view('pqrs_webs.public_consulta')->with(['enterprise_public' => $enterprise_public]);
    }
    public function seguimiento(SeguimientoPqrsPublicRequest $request) //public function consulta($id) 
    {
        $enterprise_public = $this->centralRepository->enterprise_public();
        $pqrsWeb = PqrsWeb::where('easy_token', $request->radicado)->first();

        // $pqrsWeb = $this->pqrsWebRepository->findWithoutFail($request->radicado);

        if (empty($pqrsWeb)) {
            Flash::error('Pqrs número '.$request->radicado.' No se encuentra radicada.');

            return redirect(route('pqrsPublic.consulta'));
        }
        return view('pqrs_webs.show')->with(['pqrsWeb' => $pqrsWeb, 'enterprise_public' => $enterprise_public]);
    }
}
