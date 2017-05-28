<?php

namespace App\Http\Controllers;

use App\Repositories\CentralRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Departamento;

class CentralController extends AppBaseController
{
    /** @var  DepartamentoRepository */
    /** vendor laravel-generator templates xs*/
    private $centralRepository;

    public function __construct(CentralRepository $centralRepo)
    {
        $this->middleware('auth');
        $this->centralRepository = $centralRepo;
    }


    public function sdepa(Request $request)
    {
        return $this->centralRepository->selector_departamento($request->term);
         
    }
    
}