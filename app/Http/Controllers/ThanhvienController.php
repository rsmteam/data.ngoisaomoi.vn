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
use Carbon\Carbon;

class ThanhvienController extends Controller
{
	

	
	public function getLogOut(){
		Auth::logout();
		return redirect('/');
	}
    public function getLogin(){

		if (Auth::check()) {
		    return redirect()->route('adminHome');
		}else{
        	return view('auth.login');
    	}
    }

    public function postLogin(LoginRequest $request){
        $arr= array(
                'name' => $request->username,
                'password' => $request->password
            );
        if(Auth::attempt($arr)){
        	MemberHistory::InsertHistory('Đăng nhập');
			return redirect()->route('adminHome');
        }else{
            echo 'thất bại';
        }

    }

    public function fogotPassForm(){
    	return view('auth.fogotPassForm');
    }
    
    public function fogotPass(Request $request){
    	$email = $request->input('email');
    	$user = DB::table('users')->where('email', $email)->first();
    	if (empty($user)){
    		echo "<script>
    		alert('Email không tồn tại');
    		window.location = '".url('/')."';
    		</script>";
    	}else{
    		$id = $user->id;
	    	$NhanVien = new NhanVien();
	    	$password =  $NhanVien->generateRandomString();
	    	DB::table('users')
	            ->where('id', $id)
	            ->update(['password' => bcrypt($password)]);
	    	$data = ['password' => $password,'email' => $email];
	    	Mail::send('email.resetpass',$data,function($message) use ($user){
	    		$message->from('dinhgiatructuyen20@gmail.com','Admin RSM');
	    		$message->to($user->email,'khách hàng')->subject('Xác nhận lại mật khẩu');
	    	});
	    	echo "<script>
	    		alert('Mật khẩu của bạn đã được cấp mới, hãy vào email để xem nhé');
	    		window.location = '".url('/')."';
	    		</script>";
    	}
    	
    }

    public function getAddNhanVien(){
    	return view('auth.add');
    }

    public function postAddNhanVien(AddNhanVienRequest $request){
    	$users = DB::table('users')
                    ->where('name', $request->name)
                    ->orWhere('email', $request->email)
                    ->get();
        $request->phan_quyen = implode(',',$request->phan_quyen);
        if(empty($users)){
        	$NhanVien = new NhanVien();
	    	$NhanVien->name = $request->name;
	    	$NhanVien->email = $request->email;
	    	$NhanVien->password = bcrypt($request->password);
	    	$NhanVien->api_token = str_random(60);
	    	$NhanVien->loai = $request->phan_quyen;
	    	$NhanVien->dateJoin = $request->dateJoin;
	    	$NhanVien->save();
	    	// json_encode($myObj)
	    	MemberHistory::InsertHistory('Thêm nhân viên',$request->email);
	    	return redirect()->route('getListUser');
        }else{
        	$message = "username hoặc email đã tồn tại";
        	return view('auth.add',compact('message'));
        }
    	
    }

    

    public function getFormChangeRole($id){
    	// return $id;
    	$users = DB::table('users')->where('id', $id)->get();
    	return view('auth.changeRole',compact('users'));
    }

    public function postFormChangeRole($id,ChangeRoleRequest $request){
    	
    	$Count_SupperAdmin = DB::table('users')
                ->where('loai', '=','Supper Admin')
                ->count();
        $request->phan_quyen = implode(',',$request->phan_quyen);
        if($request->phan_quyen == 'Supper Admin'){
        	if($Count_SupperAdmin >= 2){
	        	echo "<script>
		    		alert('Bạn không được cấp quyền này');
		    		window.location = '".url("/getFormChangeRole/$id")."';
		    		</script>";
		    		return 'Bạn không được cấp quyền này';
	        }
        }
    	$result = DB::table('users')
            ->where('id', $id)
            ->update([
            	'loai' => $request->phan_quyen,
            	'dateJoin' => $request->dateJoin
            	]);
        $data = json_encode(['user_id' => $id,'loai' => $request->phan_quyen,'dateJoin' => $request->dateJoin]);
        MemberHistory::InsertHistory('Đổi quyền user',$data);
    	return redirect()->route('getListUser');
    }

    public function getListUser(){
    	$user_loai = Auth::user()->loai;
    	if($user_loai == 'Supper Admin'){
    		$data = DB::table('users')->get();
    	}else{
    		$data = DB::table('users')
                    ->whereNotIn('loai', ['Supper Admin'])
                    ->get();
    	}
    	return view('backend.listUser',compact('data'));
    }

    public function getFormEdit($id){
    	$users = DB::table('users')->where('id', $id)->get();
    	return view('auth.edit',compact('users'));
    }

    public function PostFormEdit($id,EditUserRequest $request){
    	$result = DB::table('users')
	            ->where('id', $id)
	            ->update([
	            	'email' => $request->email,
	            	'password' => bcrypt($request->password),
	            ]);
	    return redirect()->route('adminHome');
	    
    }

    

    public function getFormChangeUTM($utm_name){
    	return view('backend.form_edit_utm',compact('utm_name'));
    }
   

    public function excel() {
    	$data = request()->toArray();
    	echo "<pre>";
    	var_dump($data);

	    // Execute the query used to retrieve the data. In this example
	    // we're joining hypothetical users and payments tables, retrieving
	    // the payments table's primary key, the user's first and last name, 
	    // the user's e-mail address, the amount paid, and the payment
	    // timestamp.
	  //   $apicaller = new ApiCaller('APP001', '28e336ac6c9423d946ba02d19c6a2632', 'https://api.ngoisaomoi.vn/');
	  //   $user_loai = Auth::user()->loai;
	  //   $dateJoin = Auth::user()->dateJoin;
	  //   if($user_loai == 'admin' or $user_loai == 'Supper Admin'){
	  //   	if($startDay == 'all'){
		 //    	$todo_items = $apicaller->sendRequest(array(
			// 		'controller' => 'ContactController',
			// 		'action' => 'getList',
			// 	));	
		 //    }else{
		 //    	return $utm;
			//     $todo_items = $apicaller->sendRequest(array(
			// 			'controller' => 'ContactController',
			// 			'action' => 'getListByDate',
			// 			'starDay' => $startDay,
			// 			'endDay' => $endDay,
			// 			'user_loai' => $user_loai,
			// 			'dateJoin' => $dateJoin,
			// 			'utm' => $utm
			// 	));
			// 	// return $todo_items;
			// }
	  //   }else{
	  //   	if($startDay == 'all'){
		 //    	$todo_items = $apicaller->sendRequest(array(
			// 		'controller' => 'ContactController',
			// 		'action' => 'getListByLink',
			// 		'link' => $user_loai
			// 	));	
		 //    }else{
		 //    	$user_loai = Auth::user()->loai;
			//     $todo_items = $apicaller->sendRequest(array(
			// 			'controller' => 'ContactController',
			// 			'action' => 'getListByDate',
			// 			'starDay' => $startDay,
			// 			'endDay' => $endDay,
			// 			'user_loai' => $user_loai,
			// 			'dateJoin' => $dateJoin,
			// 			'utm' => $utm
			// 	));
			// 	// return $todo_items;
			// }	
	  //   }
	   
	  //   // Initialize the array which will be passed into the Excel
	  //   // generator.
	  //   $paymentsArray = []; 

	  //   // // Define the Excel spreadsheet headers
	  //   $paymentsArray[] = ['id', 'name','phone','email','comment','Ngày','utm_source','utm_medium','utm_campaign','Nguồn'];

	    // Convert each member of the returned collection into an array,
	    // and append it to the payments array.
	    // echo "<pre>";
	    // var_dump($todo_items);
	    // die;
	 //    foreach ($todo_items as $payment) {
	 //    	$payment = collect($payment);
	 //        $paymentsArray[] = $payment->toArray();
	 //    }
	 //    $name = 'data_'.$startDay.'_'.$endDay;
	 //    // $paymentsArray[] = $todo_items->toArray();
	 //    // Generate and return the spreadsheet
	 //    Excel::create($name, function($excel) use($paymentsArray) {

		//     $excel->sheet('data', function($sheet) use($paymentsArray) {

		//         $sheet->fromArray($paymentsArray);

		// });

	 //    })->download('xlsx');
	}
    public function testfunction()
    {
        return $p = User::SentEmailToAdmin();
    }
    public function webhook(){
    	return view('webhook');

    }
}
