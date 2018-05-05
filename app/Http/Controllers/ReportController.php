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
use App\ApiCaller;
use App\NhanVien;
use DB;
use Input,File;
use Excel;
use Collection;
use Mail;
use App\User;
use App\MemberHistory;
use App\Report;
use App\ReportUtmParent;
use App\Contact;

class ReportController extends Controller
{
	public function index(){
		$contact = new Contact();
		// $apicaller = new ApiCaller('APP001', '28e336ac6c9423d946ba02d19c6a2632', 'https://api.ngoisaomoi.vn/');
		// $user_loai = Auth::user()->loai;
		// $dateJoin = Auth::user()->dateJoin;
		// $link = $apicaller->sendRequest(array(
		// 		'controller' => 'ContactController',
		// 		'action' => 'getLink',
		// 	));
		$link = $contact->getLink();
		$result = DB::table('report')->get();
		foreach($result as $key => $value){
			$result[$key]->utm_parent = DB::table('report_utm_parent')
			->join('utm_parent', 'utm_parent.id', '=', 'report_utm_parent.utm_parent_id')
			->select('report_utm_parent.*','utm_parent.title')
            ->where('report_utm_parent.report_id',$value->id)
            ->get();

            $result[$key]->detail_week = DB::table('report_detail_week')
            ->where('report_id',$value->id)
            ->get();
            $result[$key]->report_total = DB::table('report_total')
            ->where('report_id',$value->id)
            ->get();
		}

		// echo "<pre>";
		// var_dump($result);
		return view('backend.report.index',compact('link','result'));
	}

	public function createReport(){
		$user_loai = Auth::user()->loai;
		$dateJoin = Auth::user()->dateJoin;
		$request_data = request()->toArray();
		$startDay = $request_data['startDay'];
		$endDay = $request_data['endDay'];
		$website = $request_data['website'];

		// kiểm tra trùng report
		// $checkReport = DB::table('report')->where('website','=',$website)
		// 								  ->where('month','=',$month)
		// 								  ->where('year','=',$year)
		// 								  ->where('user_id','=',Auth::user()->id)
		// 								  ->first();
		// if($checkReport)
		// 	return 'Report Really Exist';
		
		$id_report = Report::createReport($website,$startDay,$endDay);
		$id_report_utm_parent = ReportUtmParent::createReport($website,$startDay,$endDay,$id_report);
		
		$result_report = DB::table('report')->where('id',$id_report)->first();
		$result_report_utm_parent = DB::table('report_utm_parent')
			->join('utm_parent', 'utm_parent.id', '=', 'report_utm_parent.utm_parent_id')
			->select('report_utm_parent.*','utm_parent.title')
            ->where('report_id',$id_report)
            ->get();
        $report_detail = DB::table('report_detail_week')->where('report_id',$id_report)->first();
        $report_total = DB::table('report_total')->where('report_id',$id_report)->get();
		return view('backend.report.report_ajax',compact('result_report','result_report_utm_parent','report_detail','report_total'));
	}

	public function deleteReport($id){
		DB::table('report')->where('id',$id)->delete();
		return back();
	}

	public function refeshReport(){
		$request_data = request()->toArray();
		
		$report_id = Report::createReport($request_data['website'],$request_data['startDay'],$request_data['endDay'],$request_data['id']);
		$id_report_utm_parent = ReportUtmParent::updateReport($request_data['website'],$request_data['startDay'],$request_data['endDay'],$report_id);
		return redirect()->route('getReport');

	}
}
