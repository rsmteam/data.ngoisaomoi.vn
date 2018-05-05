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

class UtmParentController extends Controller
{
	public function update(){
		$data = request()->toArray();
		$update = DB::table('report_utm_parent')
					->where('id',$data['id'])
					->update([
						'kpi' => $data['kpi'],
						'ketqua' => $data['ketqua'],
					]);
	}

	
}