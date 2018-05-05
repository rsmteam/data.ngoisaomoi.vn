<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use App\User;
use Mail;
class Contact extends Model
{
    protected  $table = "contact";
    protected  $table_trung = "contact_trung";

	public function getListByDate($startDate,$endDate){
		if(Auth::user()->roleId == User::SUPPER_ADMIN){
			$result = DB::table($this->table)->where('register_time','>=',$startDate)
        									->where('register_time','<=',$endDate)
        									->orderBy('register_time', 'desc')
        									->get();
		}else if(Auth::user()->roleId == User::ADMIN){
			$result = DB::table($this->table)->where('register_time','>=',$startDate)
        									->where('register_time','<=',$endDate)
        									->where('register_time','>=',Auth::user()->dateJoin)
            								 ->orderBy('register_time','desc')
            								 ->get();
		}else{
			$link = explode(',',Auth::user()->duan);
	            $result = DB::table($this->table)->where('register_time','>=',$startDate)
        										->where('register_time','<=',$endDate)
        										->where('register_time','>=',Auth::user()->dateJoin)
	            								->where(function ($query) use ($link) {
												      $query->whereIn('link',$link);
												  })
	            								->get();
		}
		
		return $result;
	}
	public function getContactTrungByContactId($id){
		return $result = DB::table($this->table_trung)->where('contact_id',$id)->orderBy('register_time', 'desc')->get();
	}
	public function getLink(){
		if(Auth::user()->roleId == User::SUPPER_ADMIN ){
			$result = DB::table($this->table)->select('link as link_website')
            								->groupBy('link')
            								->get();
        }else if(Auth::user()->roleId == User::ADMIN){
         	$result = DB::table($this->table)->select('link as link_website')
            								->where('register_time','>=',Auth::user()->dateJoin)
            								->groupBy('link')
            								->get();
		}else{
			$link = explode(',',Auth::user()->duan);
            $result = DB::table($this->table)->select('link as link_website')
            								->where('register_time','>=',Auth::user()->dateJoin)
            								->where(function ($query) use ($link) {
											      $query->whereIn('link',$link);
											  })
            								->groupBy('link')
            								->get();
		}

     return $result;
	}

	public function getContactById($id){
		if(count($id) < 2){
			$result = DB::table($this->table)->where('id', $id)->first();
		}else{
			$result = DB::table($this->table)->whereIn('id', $id)->get();
		}
		return $result;
	}

	public function getContactForReport($startDate,$endDate,$website){
		$result = DB::table($this->table)->where('register_time','>=',$startDate)
										 ->where('register_time','<=',$endDate)
										 ->where('link',$website)
										 ->get();
		return $result;
	}

	public function getCountContact(){
        if(Auth::user()->roleId == User::SUPPER_ADMIN){
        	
        	$result = DB::table($this->table)->select(DB::raw('count(*) as count_data'))
        									->first();
        }else if(Auth::user()->roleId == User::ADMIN){

            $result = DB::table($this->table)->select(DB::raw('count(*) as count_data'))
        									->where('register_time','>=',Auth::user()->dateJoin)
        									->first();
        }else{
        	$link = explode(',',Auth::user()->duan);
            $result = DB::table($this->table)->select(DB::raw('count(*) as count_data'))
        									->where('register_time','>=',Auth::user()->dateJoin)
        									->where(function ($query) use ($link) {
												      $query->whereIn('link',$link);
												  })
        									->first();
        }
        return $result;
	}
	public function getLinkByDate($startDate,$endDate){
		if(Auth::user()->roleId == User::SUPPER_ADMIN){
        	
        	$result = DB::table($this->table)->select('link',DB::raw('count(*) as count_data'))
        									->where('register_time','>=',$startDate)
        									->where('register_time','<=',$endDate)
        									->groupBy('link')
        									->get();
        }else if(Auth::user()->roleId == User::ADMIN){

            $result = DB::table($this->table)->select('link',DB::raw('count(*) as count_data'))
            								->where('register_time','>=',$startDate)
        									->where('register_time','<=',$endDate)
        									->where('register_time','>=',Auth::user()->dateJoin)
        									->groupBy('link')
        									->get();
        }else{
        	$link = explode(',',Auth::user()->duan);
            $result = DB::table($this->table)->select('link',DB::raw('count(*) as count_data'))
            								->where('register_time','>=',$startDate)
        									->where('register_time','<=',$endDate)
        									->where('register_time','>=',Auth::user()->dateJoin)
        									->where(function ($query) use ($link) {
												      $query->whereIn('link',$link);
												  })
        									->groupBy('link')
        									->get();
        }
        return $result;
		
	}

	public function getColumnContact(){
		$result = DB::table('column_show')->orderBy('position')->get();
		return $result;
	}

	public function getUtmSource(){
		$result = DB::table($this->table)->select('utm_source')
										->where('register_time','>=',Auth::user()->dateJoin)
										->groupBy(DB::raw('binary `utm_source`'))
										->get();
		return $result;
	}

	public function updateUTM($oldUtm,$newUtm){
		$result = DB::table($this->table)->where('utm_source',$oldUtm)
										->update(['utm_source' => $newUtm]);
		if($result)
			return true;
		else
			return false;
	}


	public function searchContactByParram($startDate,$endDate,$utm,$website){
		if(Auth::user()->roleId == User::ADMIN or Auth::user()->roleId == User::SUPPER_ADMIN){
			if($utm[0] == '--UTM--' or $utm[0] == 'null'){
				if($website == 'null'){
					$result = DB::table($this->table)->where('register_time','>=',$startDate)
													->where('register_time','<=',$endDate)
													->orderBy('register_time','desc')
													->get();
				}else{
					$result = DB::table($this->table)->where('register_time','>=',$startDate)
													->where('register_time','<=',$endDate)
		        									->where(function ($query) use ($website) {
														      $query->whereIn('link',$website);
														  })
		        									->orderBy('register_time','desc')
		        									->get();
				}
			}else{
				
				if($website == 'null'){

					$result = DB::table($this->table)->where('register_time','>=',$startDate)
													->where('register_time','<=',$endDate)
													->where(function ($query) use ($utm) {
														      $query->whereIn('utm_source',$utm);
														  })
													->orderBy('register_time','desc')
													->get();
				}else{
					$result = DB::table($this->table)->where('register_time','>=',$startDate)
													->where('register_time','<=',$endDate)
													->where(function ($query) use ($utm) {
														      $query->whereIn('utm_source',$utm);
														  })
		        									->where(function ($query) use ($website) {
														      $query->whereIn('link',$website);
														  })
		        									->orderBy('register_time','desc')
		        									->get();
				}

			}
		}else{
			$link = explode(',',Auth::user()->duan);
			if($utm[0] == '--UTM--' or $utm[0] == 'null'){
				if($website == 'null'){
					$result = DB::table($this->table)->where('register_time','>=',$startDate)
													->where('register_time','<=',$endDate)
													->where('register_time','>=',Auth::user()->dateJoin)
													->where(function ($query) use ($link) {
														      $query->whereIn('link',$link);
														  })
													->orderBy('register_time','desc')
													->get();
				}else{

					$result = DB::table($this->table)->where('register_time','>=',$startDate)
													->where('register_time','<=',$endDate)
													->where('register_time','>=',Auth::user()->dateJoin)
		        									->where(function ($query) use ($website) {
														      $query->whereIn('link',$website);
														  })
		        									->orderBy('register_time','desc')
		        									->get();
				}
			}else{
				if($website == 'null'){
					$result = DB::table($this->table)->where('register_time','>=',$startDate)
													->where('register_time','<=',$endDate)
													->where(function ($query) use ($utm) {
														      $query->whereIn('utm_source',$utm);
														  })
													->where(function ($query) use ($link) {
														      $query->whereIn('link',$utm);
														  })
													->orderBy('register_time','desc')
													->get();
				}else{

					$result = DB::table($this->table)->where('register_time','>=',$startDate)
													->where('register_time','<=',$endDate)
													->where(function ($query) use ($utm) {
														      $query->whereIn('utm_source',$utm);
														  })
		        									->where(function ($query) use ($website) {
														      $query->whereIn('link',$website);
														  })
		        									->orderBy('register_time','desc')
		        									->get();
				}

			}

		}

		return $result;

	}

	function deleteContact($id){
		$result = DB::table($this->table)->whereIn('id', $id)->delete(); 
		if($result)
			return true;
		else
			return false;
	}

	public function SentEmailToAdmin(){
        
        $todo_items = DB::table($this->table)->orderBy('register_time','DESC')->get();
        $todo_items_old = DB::select("SELECT * FROM $this->table WHERE STR_TO_DATE(register_time, '%Y-%m-%d %H:%i:%s') <= DATE_SUB(NOW(), INTERVAL 1 MINUTE)");
        $count = count($todo_items);
        $count_old = count($todo_items_old);
        if ($count > $count_old){
            $data = (array) reset($todo_items);
            $link = $data['link'];
            $user_admin = DB::table('users')->where('roleId',User::SUPPER_ADMIN)->get();
            $user = DB::table('users')->where('roleId','like',"%$link%")->get();
            $user = array_merge($user,$user_admin);
            foreach ($user as $item) {
                $emails[] = $item->email;
            }
            Mail::send('email.hasData',$data, function($message) use ($emails)
            {    
                $message->from('noreply.datangoisaomoi.vn@gmail.com','Admin RSM');
                $message->to($emails)->subject('Email thông báo phát sinh data');    
            });

        }
        
        // return $count.'ddd'.$count_old;
    }
}
?>