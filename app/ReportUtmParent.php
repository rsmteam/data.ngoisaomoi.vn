<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ApiCaller;
use Carbon\Carbon;
use DB;
use Auth;
use App\Contact;
class ReportUtmParent extends Model
{
    protected $table = "report_utm_parent";

    public static function callApiReport($starDate,$endDate,$website){
    	$contact = new Contact();
        $data = $contact->getContactForReport($starDate,$endDate,$website);
        return $data;
    }

    public static function addKeyArray($array){
    	$data = array();
    	foreach ($array as $element) {
		    $data[$element->utm_source][] = $element;
		}
		foreach($data as $key => $item){
			if($key == '')
				$key = 'NA';
			$data_utm = DB::table('utm_source')->where('title','=',$key)->first();
            // return $data_utm;
            if($data_utm){
                $data_utm_parent = DB::table('utm_parent')->where('id',$data_utm->utm_parent_id)->first();
                $result_utm[$data_utm_parent->id][] = count($item);
            }
			
		}

		foreach($result_utm as $key => $value){
			$result[$key] = array_sum($value);
		}
		return $result;
    }

    public static function createReport($website,$startDay,$endDay,$report_id){
    	$data= self::callApiReport($startDay.' 00:00:00',$endDay.' 23:59:00',$website);
    	$result = self::addKeyArray($data);
    	foreach($result as $key => $value){
    		$arr_insert[] = [
    							'user_id' => Auth::user()->id,
    							'utm_parent_id' => $key,
    							'report_id' => $report_id,
    							'kpi' => 0,
    							'thucte' => $value,
    							'ketqua' => 0,
    						];
    	}
    	// echo "<pre>";
    	// var_dump($result);
    	DB::table('report_utm_parent')->insert($arr_insert);
    	return $report_id;
    }

    public static function updateReport($website,$startDay,$endDay,$report_id){
    	$data= self::callApiReport($startDay.' 00:00:00',$endDay.' 23:59:00',$website);
    	$result = self::addKeyArray($data);
    	$result_report_old = DB::table('report_utm_parent')->where('report_id',$report_id)->get();

    	// $result_update = array_values($result);
        
    	foreach($result_report_old as $key => $value){
    		if($value->kpi != 0){
    			$ketqua = round(($result[$value->utm_parent_id]/$value->kpi)*100) ;
	    		DB::table('report_utm_parent')->where('id',$value->id)->update(['thucte' => $result[$value->utm_parent_id],'ketqua' => $ketqua]);
    		}
    		unset($result[$value->utm_parent_id]);
    	}  	
    	if(count($result) > 0){
    		foreach($result as $key => $value){
    		$arr_insert[] = [
    							'user_id' => Auth::user()->id,
    							'utm_parent_id' => $key,
    							'report_id' => $report_id,
    							'kpi' => 0,
    							'thucte' => $value,
    							'ketqua' => 0,
    						];
    		}
    		DB::table('report_utm_parent')->insert($arr_insert);
    	}
        // echo "<pre>";
        // var_dump($result);
    	return $report_id;
    }


}
?>