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
use Fpdf;

 

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
        $selectores['vehiculo_id'] = $this->centralRepository->vehiculo_id();
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
        //pdf
       
         $pdf = new PDFCUSTOM();
/*
         $pdf::Header(){
            $this->SetFont('Arial','B',15);
            // Move to the right
            $this->Cell(70); //title position
            // Title
            $this->Cell(60,10,'Hisoka PDF Title',1,0,'C');//box size
            // Line break
            $this->Ln(20);
        };
        */

         $pdf::AddPage();
         $pdf::SetFont('Arial','B',18);
         //$pdf::Cell(0,10,"Title-HEY MAMA",0,"","C");
         $pdf::Ln(10);
         $pdf::Ln();
         $pdf::SetFont('Arial','B',12);
         $pdf::cell(25,8,"ID",1,"","C");
         $pdf::cell(45,8,"Name",1,"","L");
         $pdf::cell(35,8,"Address",1,"","L");
         $pdf::Ln();
         $pdf::SetFont("Arial","",10);
         $pdf::cell(25,8,"1",1,"","C");
         $pdf::cell(45,8,"John",1,"","L");
         $pdf::cell(35,8,"New York",1,"","L");
         $pdf::Ln();
         $pdf::Output();
 exit;
        
    }
}

class PDFCUSTOM extends FPDF
        {
            // Cabecera de página
            function Header()
            {
                $this::Cell(0,10,"Title-HEY MAMA",0,"","C");
                // Logo
                $this->Image('logo_pb.png',10,8,33);
                // Arial bold 15
                $this->SetFont('Arial','B',15);
                // Movernos a la derecha
                $this->Cell(80);
                // Título
                $this->Cell(30,10,'Title hola',1,0,'C');
                // Salto de línea
                $this->Ln(20);
            }

            // Pie de página
            function Footer()
            {
                // Posición: a 1,5 cm del final
                $this->SetY(-15);
                // Arial italic 8
                $this->SetFont('Arial','I',8);
                // Número de página
                $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
            }
        }
