<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
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
use App\Contact;
use Carbon\Carbon;


class ContactController extends Controller
{
	
	public function index(){
		$contact = new Contact();
		$now = Carbon::now();
		$year = $now->year;
		$month = $now->month;
		$startDate = $year.'-'.$month.'-1 00:00:00';
		$endDate = $year.'-'.$month.'-31 23:00:00';
		// $startDate = '2018-04-1 00:00:00';
		// $endDate =  '2018-04-31 23:00:00';

		$todo_items = $contact->getListByDate($startDate,$endDate);
		$link = $contact->getLink();
  		$total_data = $contact->getCountContact($startDate,$endDate);
  		$total_link = $contact->getLinkByDate($startDate,$endDate);


    	foreach ($todo_items as $item) {
		    $utm[$item->utm_source] = $item->utm_source;
		    $contact_child = $contact->getContactTrungByContactId($item->id);
		    if($contact_child){
		    	$todo_items_child[$item->id] = $contact_child;
		    }
		}

		if(!isset($todo_items_child)){
			$todo_items_child[] = 'null';
		}
		

		$column = $contact->getColumnContact();

    	$total_data_date = count($todo_items);
		$currentPage = LengthAwarePaginator::resolveCurrentPage();
		$itemCollection = collect($todo_items);
		$perPage = 10;
		$currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
		$todo_items= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
		$todo_items->setPath(request()->url());
		// echo "<pre>";
		// var_dump($todo_items);
		return view('backend.dashboardbk1',compact('todo_items','todo_items_child','link','utm','total_data_date','total_data','column','total_link'));
	}
	public function test(){
		$contact = new Contact();
		$now = Carbon::now();
		$year = $now->year;
		$month = $now->month;
		$startDate = $year.'-'.$month.'-1 00:00:00';
		$endDate = $year.'-'.$month.'-31 23:00:00';
		// $startDate = '2018-04-1 00:00:00';
		// $endDate =  '2018-04-31 23:00:00';

		$todo_items = $contact->getListByDate($startDate,$endDate);
		$link = $contact->getLink();
  		$total_data = $contact->getCountContact($startDate,$endDate);
  		$total_link = $contact->getLinkByDate($startDate,$endDate);


    	foreach ($todo_items as $item) {
		    $utm[$item->utm_source] = $item->utm_source;
		    $contact_child = $contact->getContactTrungByContactId($item->id);
		    if($contact_child){
		    	$todo_items_child[$item->id] = $contact_child;
		    }
		}

		if(!isset($todo_items_child)){
			$todo_items_child[] = 'null';
		}
		

		$column = $contact->getColumnContact();

    	$total_data_date = count($todo_items);
		$currentPage = LengthAwarePaginator::resolveCurrentPage();
		$itemCollection = collect($todo_items);
		$perPage = 10;
		$currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
		$todo_items= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
		$todo_items->setPath(request()->url());
		// echo "<pre>";
		// var_dump($total_data);
		return view('backend.dashboardbk1',compact('todo_items','todo_items_child','link','utm','total_data_date','total_data','column','total_link'));
	}

	public function getSourceUTM(){
		$contact = new Contact();
    	$todo_items = $contact->getUtmSource();
		return view('backend.list_utm',compact('todo_items'));
    }

    public function updateUTM($utm_source){
    	$contact = new Contact();
    	$data_request = request()->toArray();

    	$result = $contact->updateUTM($utm_source,$data_request['source_utm']);
		$data = json_encode(['utm_new' => $data_request['source_utm'],'utm_old' => $utm_source]);
		MemberHistory::InsertHistory('Đổi UTM',$data);
		return redirect()->route('getUtmSource');
	}

	public function insertData(){
		$data = request()->toArray();
		$valid = Validator::make($data,[
			'name' => 'required',
			'email' => 'required|email',
			'phone' => 'required|min:10|numeric',
			'link' => 'required',
			'register_time' => 'required',
		],[
			'name.required' => 'Tên không được để trống',
			'email.required' => 'Email không được để trống',
			'email.email' => 'Email không đúng định dạng',
			'phone.required' => 'Điện thoại không được để trống',
			'link.required' => 'Website không được để trống',
			'register_time.required' => 'Thời gian không được để trống',
		]);
		if ($valid->fails()) {
            return redirect()->back()
                        	->withErrors($valid)
                        	->withInput();
        }else{
        	unset($data['_token']);
        	$result = DB::table('contact')->insert($data);
        	return redirect()->back();
        }
		
	}

	 public function deleteContact(){
	 	$contact = new Contact();
    	$id = request()->id;
    	$data = $contact->getContactById($id);
    	$data = json_encode($data);
    	MemberHistory::InsertHistory('Xóa data',$data);
        $result = $contact->deleteContact($id);
        if($result){
            return "Delete Successful";
        }
        else{
            return "Delete Fail";
        }
    }

    public function searchContactByParam(){
    	$contact = new Contact();
    	$startDate = $_GET['starDay'];
    	$endDate = $_GET['endDay'] . ' 23:59:59';
    	$utm = $_GET['utm'];
    	$website = $_GET['website'];
    	$todo_items = $contact->searchContactByParram($startDate,$endDate,$utm,$website);

    	if($utm[0] == 'null'){
	    	foreach ($todo_items as $item) {
			    $utm_select[$item->utm_source][] = $item->utm_source;
			}
	    }else{
	    	$utm_select = '';
	    }

		// get website in array
		if(getType($website) != 'array'){
			foreach ($todo_items as $item) {
			    $website_select[$item->link][] = $item;
			}
			$website_arr[] = 'null';
		}else{
			$website_select = '';
			foreach($website as $item){
				$website_explo = explode('http://',$item);
				$website_arr[] = $website_explo[1];
			}
		}

		foreach ($todo_items as $item) {
		    $contact_child = $contact->getContactTrungByContactId($item->id);
		    if($contact_child){
		    	$todo_items_child[$item->id] = $contact_child;
		    }
		    $link[$item->link][] = $item->link;
		}

		if(!isset($todo_items_child))
			$todo_items_child[] = 'null';

		if($utm[0] == '')
			$utm[0] = 'NA';


		$currentPage = LengthAwarePaginator::resolveCurrentPage();
		$itemCollection = collect($todo_items);
		$perPage = 10;
		$currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
		$todo_items= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
		$todo_items->setPath(request()->url());
		$total_data = $todo_items->total();
		// echo "<pre>";
		// var_dump($link);
		// return count($link);
		return view('backend.ajax_date',compact('todo_items','startDate','endDate','utm','utm_select','website_arr','website_select','todo_items_child','total_data','link'));
    }

    public function exportExcel($startDate,$endDate,$utm,$website) {
    	$contact = new Contact();
	    $utm = explode(',',$utm);
	    $website = explode(',',$website);
    	foreach($website as $item){
    		if($item != 'null')
    			$website_arr[] = 'http://'.$item;
    		else
    			$website_arr = 'null';
    	}
    	if($utm[0] == 'NA')
    		$utm[0] = '';

	    $todo_items = $contact->searchContactByParram($startDate,$endDate,$utm,$website_arr);

	    $paymentsArray = []; 

	    $paymentsArray[] = ['id', 'name','phone','email','comment','Ngày','Nguồn','Source Cookie','utm_source','utm_medium','utm_campaign'];


	    foreach ($todo_items as $payment) {
	    	$payment = collect($payment);
	        $paymentsArray[] = $payment->toArray();
	    }
	    $name = 'data_'.$startDate.'_'.$endDate;
	   
	    Excel::create($name, function($excel) use($paymentsArray) {

		    $excel->sheet('data', function($sheet) use($paymentsArray) {

		        $sheet->fromArray($paymentsArray);

		});

	    })->download('xls');
   	}

   	public function getFormImport(){
   		return view('backend.import');
   	}

   	public function importExcel(){
   		$data = request()->toArray();
        if( request()->hasFile('file_contact') )
        {

            $path = request()->file('file_contact')->getRealPath();

            $data = Excel::selectSheets('Sheet1')->load($path, function($reader) {})->get();
            if(!empty($data) && $data->count()){

	            foreach ($data->toArray() as $key => $value) {

	                  // $project_id = Model\project::getIdByName($value['du_an']);
	                  
                      $insert[] = [

                                'name' => $value['name'], 

                                'phone' => $value['phone'],

                                'email' => $value['email'],
                                'comment' => $value['comment'],
                                'register_time' => $value['ngay'],

                                'link' => $value['nguon'],

                                'utm_source' => $value['utm_source'],

                                'utm_medium' => $value['utm_medium'],

                                'utm_campaign' => $value['utm_campaign'],
                              ];
	            }
	            if(isset($insert)){
	                $result = DB::table('contact')->insert($insert);
	            }
	        }
            	return redirect()->route('adminHome');
        }
     	echo "<pre>";
        var_dump($data);
       	
    }

}
