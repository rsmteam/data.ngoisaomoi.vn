<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests;
use Auth;
use DB;
use Collection;
use Mail;
use App\User;
use App\MemberHistory;
use App\Report;
use App\md;
use Carbon\Carbon;

class UtmController extends Controller
{
	public function index(){
		// $result = \App\Utm::paginate(20);
		$comments = \App\UtmParent::find(1)->utm;
		echo "<pre>";
		var_dump($comments);
		// return view('backend.utm_source.index',compact('result'));
	}

	public function create(){
		$result = \App\Utm::create(['title' => request()->title]);
	}
	
}