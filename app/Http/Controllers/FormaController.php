<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class FormaController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
    }
    public function index() {
        
        
        $page_title='Formas';        
        return view('forma')        
        ->with('page_title', $page_title);
    }

}
