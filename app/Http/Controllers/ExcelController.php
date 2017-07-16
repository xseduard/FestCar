<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;
use Response;
use Jenssegers\Date\Date;
use Carbon\Carbon;

//use App\Http\Requests;

class ExcelController extends Controller
{
	 public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
    	$dt = [];
    	$year =  Carbon::now()->format('Y');
    	$dt = [
		'now'                 => Carbon::now(),
		'hoy'                 => Carbon::now()->toDateString(),
		'manana'              => (new Carbon('tomorrow'))->toDateString(),
		'ayer'                => (new Carbon('yesterday'))->toDateString(),
		'subDay-7'            => Carbon::now()->subDay(7)->toDateString(),
		'subDay-30'           => Carbon::now()->subDay(30)->toDateString(),
		'subMonth'            => Carbon::now()->subMonth()->toDateString(),
		'this-month-start'    => Carbon::now()->modify('first day of this month')->toDateString(),
		'this-month-end'      => Carbon::now()->modify('last day of this month')->toDateString(),
		'last-month-start'    => Carbon::now()->modify('first day of last month')->toDateString(),
		'last-month-end'      => Carbon::now()->modify('last day of last month')->toDateString(),
		'last-3-month'        => Carbon::now()->modify('first day of -3 month')->toDateString(),
		'first-this-year'     => $year."-01-01",
		'last-this-year'      => $year."-12-31",
		'first-day-last-year' => ($year-1)."-01-01",
		'last-day-last-year'  => ($year-1)."-12-31",
		// 'last-this-year'   => Carbon::now()->modify('last day of december this year')->toDateString(),
		];

    	 return view('informes.index')
            ->with(['informes' => '', 'dt' => $dt]);
    }

    public function generate(Request $request)
    {
    	return $request->all();
    }
}
