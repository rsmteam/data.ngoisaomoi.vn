<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\AddNhanVienRequest;
use App\Http\Requests\ChangeRoleRequest;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\AjaxDateRequest;
use Auth;
use DB;
use Input,File;
use Excel;
use Collection;
use Mail;
use App\User;
use App\MemberHistory;
use App\Report;
use App\md;
use Carbon\Carbon;
use App\Website;

class WebsiteController extends Controller
{
	public function index(){
		$data = \App\Website::all();
		return view('backend.website.index',compact('data'));
	}

	public function getForm($id){
		if($id == 'null'){
			return view('backend.website.form');
		}else{
			$data = \App\Website::where('id', 1)->first();
			return view('backend.website.form',compact('data'));
		}
	}

	public function edit($id){
		$result = \App\Website::where('id', $id)
		          ->update(['title' => request()->title]);
		return redirect()->route('listWebsite');

	}

	public function create(){
		$result = \App\Website::create(['title' => request()->title]);
		return redirect()->route('listWebsite');
	}

	
}