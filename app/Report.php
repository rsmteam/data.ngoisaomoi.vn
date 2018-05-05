<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ApiCaller;
use Carbon\Carbon;
use DB;
use Auth;
use App\Contact;
class Report extends Model
{
    protected $table = "report";
    public static function callApiReport($starDate,$endDate,$website){
    	$contact = new Contact();
		$data = $contact->getContactForReport($starDate,$endDate,$website);
		return $data;
    }

    public static function addKeyArray($array){
    	// return $array;
    	$data = array();
    	$result['count_total_week'] = 0;
    	foreach ($array as $element) {
		    $data[$element->utm_source][] = $element;
		}
		foreach($data as $key => $item){
			if($key == '')
				$key = 'NA';
			$result['total_data_utm'][$key] = count($item);
			$result['count_total_week'] += count($item);
		}
		return $result;
    }

     public static function addKeyArrayDetail($array){

    	$data = array();
    	foreach ($array as $element) {
		    $data[$element->utm_source][] = $element;
		}
		
		foreach($data as $key => $item){
			// return $data[$key];
			if($key == '')
				$key = 'NA';
			$result[$key] =[
								'hangmuc' => $key,
								'thucte' => count($item),
								'click' => 0,
								'Impress' => 0,
								'ctr' => 0,
								'cpc' => 0,
								'cost' => 0,
								'cr' => 0,
								'cpl' => 0
							];
		}
		// return count($array);

		$result['tong']['hangmuc'] = 'Tổng';
		$result['tong']['thucte'] = count($array);
		$result['tong']['click'] = 0;
		$result['tong']['Impress'] = 0;
		$result['tong']['ctr'] = 0;
		$result['tong']['cpc'] = 0;
		$result['tong']['cost'] = 0;
		$result['tong']['cr'] = 0;
		$result['tong']['cpl'] = 0;
		return $result;
    }

	public static function createReport($website,$startDay,$endDay,$id=0){
		$formatted_dt1 = Carbon::parse($startDay);
		$formatted_dt2 = Carbon::parse($endDay);
		$date_diff = $formatted_dt1->diffInDays($formatted_dt2);
		$start_date_array = explode('-',$startDay);
		$end_date_array = explode('-',$endDay);
		$day_week1 = $start_date_array[0].'-'.$start_date_array['1'].'-8 23:59:00';
		$day_start_week2 = $start_date_array[0].'-'.$start_date_array['1'].'-9 00:00:00';
		$day_end_week2 = $start_date_array[0].'-'.$start_date_array['1'].'-16 23:59:00';
		$day_start_week3 = $start_date_array[0].'-'.$start_date_array['1'].'-17 00:00:00';
		$day_end_week3 = $start_date_array[0].'-'.$start_date_array['1'].'-24 23:59:00';
		$day_start_week4 = $start_date_array[0].'-'.$start_date_array['1'].'-25 00:00:00';

		if($date_diff <= 30){
			if($start_date_array[2] <= 8 ){
				if($end_date_array[2] <= 8){
					$data['week1'] = self::callApiReport($startDay.' 00:00:00',$endDay.' 23:59:00',$website);
					$data['total_utm'] = self::callApiReport($startDay.' 00:00:00',$endDay.' 23:59:00',$website);
				}else if($end_date_array[2] <= 16){
					$data['week1'] = self::callApiReport($startDay.' 00:00:00',$day_week1,$website);
					$data['week2'] = self::callApiReport($day_start_week2,$endDay.' 23:59:00',$website);
					$data['total_utm'] = self::callApiReport($startDay.' 00:00:00',$endDay.' 23:59:00',$website);
				}else if($end_date_array[2] <= 24){
					$data['week1'] = self::callApiReport($startDay.' 00:00:00',$day_week1,$website);
					$data['week2'] = self::callApiReport($day_start_week2,$day_end_week2,$website);
					$data['week3'] = self::callApiReport($day_start_week3,$endDay.' 23:59:00',$website);
					$data['total_utm'] = self::callApiReport($startDay.' 00:00:00',$endDay.' 23:59:00',$website);
				}else if($end_date_array[2] <= 31){
					$data['week1'] = self::callApiReport($startDay.' 00:00:00',$day_week1,$website);
					$data['week2'] = self::callApiReport($day_start_week2,$day_end_week2,$website);
					$data['week3'] = self::callApiReport($day_start_week3,$day_end_week3,$website);
					$data['week4'] = self::callApiReport($day_start_week4,$endDay.' 23:59:00',$website);
					$data['total_utm'] = self::callApiReport($startDay.' 00:00:00',$endDay.' 23:59:00',$website);
				}
			}else if($start_date_array[2] <= 16 && $start_date_array[2] > 8 ){
				if($end_date_array[2] <= 16){
					$data['week2'] = self::callApiReport($startDay.' 00:00:00',$endDay.' 23:59:00',$website);
					$data['total_utm'] = self::callApiReport($startDay.' 00:00:00',$endDay.' 23:59:00',$website);
				}else if($end_date_array[2] <= 24){
					$data['week2'] = self::callApiReport($startDay.' 00:00:00',$day_end_week2,$website);
					$data['week3'] = self::callApiReport($day_start_week3,$endDay.' 23:59:00',$website);
					$data['total_utm'] = self::callApiReport($startDay.' 00:00:00',$endDay.' 23:59:00',$website);
				}else if($end_date_array[2] <= 31){
					$data['week2'] = self::callApiReport($startDay.' 00:00:00',$day_end_week2,$website);
					$data['week3'] = self::callApiReport($day_start_week3,$day_end_week3,$website);
					$data['week4'] = self::callApiReport($day_start_week4,$endDay.' 23:59:00',$website);
					$data['total_utm'] = self::callApiReport($startDay.' 00:00:00',$endDay.' 23:59:00',$website);
				}
			}else if($start_date_array[2] <= 24 && $start_date_array[2] > 16 ){
				if($end_date_array[2] <= 24){
					$data['week3'] = self::callApiReport($startDay.' 00:00:00',$endDay.' 23:59:00',$website);
					$data['total_utm'] = self::callApiReport($startDay.' 00:00:00',$endDay.' 23:59:00',$website);
				}else if($end_date_array[2] <= 31){
					$data['week3'] = self::callApiReport($startDay.' 00:00:00',$day_end_week3,$website);
					$data['week4'] = self::callApiReport($day_start_week4,$endDay.' 23:59:00',$website);
					$data['total_utm'] = self::callApiReport($startDay.' 00:00:00',$endDay.' 23:59:00',$website);
				}
			}else if($start_date_array[2] <= 31 && $start_date_array[2] > 24 ){
				$data['week4'] = self::callApiReport($startDay.' 00:00:00',$endDay.' 23:59:00',$website);
				$data['total_utm'] = self::callApiReport($startDay.' 00:00:00',$endDay.' 23:59:00',$website);
			}
		}

		$website_id = DB::table('website')->where('title',$website)->first();

		
		foreach($data['total_utm'] as $item_utm){
			if($item_utm->utm_source == '')
				$item_utm->utm_source = 'NA';
			$arr_utm[$item_utm->utm_source] = $item_utm->utm_source;
		}
		foreach($data as $key => $item_data){
			
			if($item_data){
				$result[$key] = self::addKeyArray($item_data);
				$data_detail[$key] = self::addKeyArrayDetail($item_data);
				$data_detail[$key] = array_values($data_detail[$key]);
				if($id != 0 ){
					$data_old = DB::table('report_detail_week')->where('report_id',$id)->first();
					if($key != 'total_utm'){
						$detail_old = json_decode($data_old->$key);
										
						if($detail_old != null){
							foreach($detail_old as $key_detail => $value_detail){	
								$click = $value_detail->click;
								$cost = $value_detail->cost;
								$thucte =  $data_detail[$key][$key_detail]['thucte'];
								$cr = 0;
								$cpl = 0;
								if($click != 0){
									$cr = round(($thucte/$click)*100,2);
								}
									
								if($thucte != 0)
									$cpl = round($cost/$thucte);
								$new_data[$key][] = [
												'hangmuc' => $data_detail[$key][$key_detail]['hangmuc'],
												'thucte' => $thucte,
												'click' => $click,
												'Impress' => $value_detail->Impress,
												'ctr' => $value_detail->ctr,
												'cpc' => $value_detail->cpc,
												'cost' => $cost,
												'cr' => $cr,
												'cpl' => $cpl
											];
								
							}
						}else{
							foreach($data_detail[$key] as $key_detail => $value_detail){	
								
								$new_data[$key][] = [
												'hangmuc' => $data_detail[$key][$key_detail]['hangmuc'],
												'thucte' => $data_detail[$key][$key_detail]['thucte'],
												'click' => '0',
												'Impress' => '0',
												'ctr' => '0',
												'cpc' => '0',
												'cost' => '0',
												'cr' => '0',
												'cpl' => '0'
											];
								
							}
						}
						
						$data_detail[$key] = json_encode($new_data[$key]);
					}

				}else{
					$data_detail[$key] = json_encode(array_values($data_detail[$key]));
				}

				
				// return $data_detail;
				unset($data_detail['total_utm']);
				
				if($key != 'total_utm'){
					$result_report[$key] = json_encode($result[$key]['total_data_utm']);
				}
				$count_total_week[$key] = $result[$key]['count_total_week'];	
			}
		}
		// echo "<pre>";
		// var_dump($data_detail);
		$column_report = ['week1' => '-','week2' => '-','week3'=> '-','week4'=> '-','total_utm'=> '-'];
		$result_arr = array_diff_key($column_report,$count_total_week);
		$count_total_week = array_merge($result_arr,$count_total_week);
		ksort($count_total_week);
		$v = $count_total_week['total_utm'];
		unset($count_total_week['total_utm']);
		$count_total_week['total_utm'] = $v;

		$result_report['utm_source'] = json_encode($arr_utm);
		$result_report['total_utm'] = json_encode($result['total_utm']['total_data_utm']);
		$result_report['total_week'] = json_encode($count_total_week);
		$result_report['user_id'] = Auth::user()->id;
		$result_report['startDay'] = $startDay;
		$result_report['endDay'] = $endDay;
		$result_report['website'] = $website;
		
		// echo "<pre>";
		// var_dump($data_old);
		if($id == 0){
			$id = self::SaveData($result_report);
			$data_detail['report_id'] = $id;
			DB::table('report_detail_week')->insert($data_detail);
			foreach($result['total_utm']['total_data_utm'] as $key_utm => $item_utm){
				DB::table('report_total')->insert(['report_id' => $id,'hangmuc' => $key_utm,'thucte' => $item_utm]);
				$thucte_total_report[] = $item_utm;
			}
			DB::table('report_total')->insert(['report_id' => $id,'hangmuc' => 'Tổng','thucte' => array_sum($thucte_total_report)]);
			
		}else{
			// cập nhật lại report total
			$new_utm_array = $result['total_utm']['total_data_utm'];
			
			$report_total_old = DB::table('report_total')->where('report_id',$id)->get();
			foreach($report_total_old as $item_report_total){
				if($item_report_total->hangmuc != 'Tổng'){
					$thucte_new = $new_utm_array[$item_report_total->hangmuc];
					if($item_report_total->click != 0)
						$sum_cr = round(($thucte_new/$item_report_total->click)*100,2);
					else
						$sum_cr = $item_report_total->cr;
					if($thucte_new != 0)
						
						$sum_cpl = round($item_report_total->cost/$thucte_new);
					else
						$sum_cpl = $item_report_total->cpl;
					DB::table('report_total')->where('hangmuc',$item_report_total->hangmuc)
											->where('report_id',$id)
											->update([
												'thucte' => $thucte_new,
												'cr' => $sum_cr,
												'cpl' => $sum_cpl
											]);
					unset($new_utm_array[$item_report_total->hangmuc]);
				}else{
					$thucte_new = $count_total_week['total_utm'];
					if($item_report_total->click != 0)
						$sum_cr = round(($thucte_new/$item_report_total->click)*100,2);
					else
						$sum_cr = $item_report_total->cr;
					if($thucte_new != 0)
						
						$sum_cpl = round($item_report_total->cost/$thucte_new);
					else
						$sum_cpl = $item_report_total->cpl;
					DB::table('report_total')->where('hangmuc','Tổng')
											->where('report_id',$id)
											->update([
												'thucte' => $thucte_new,
												'cr' => $sum_cr,
												'cpl' => $sum_cpl
											]);
					unset($new_utm_array['Tổng']);
				}
				
			}

			if(count($new_utm_array) > 0){
				foreach($new_utm_array as $key_new_utm_arr => $value_new_utm_arr){
					$report_total_insert[] = [
												'hangmuc' => $key_new_utm_arr,
												'thucte' => $value_new_utm_arr,
												'report_id' => $id,
											];
					
				}
				
				DB::table('report_total')->insert($report_total_insert);
			}
			$update = DB::table('report')->where('id',$id)->update($result_report);
			DB::table('report_detail_week')->where('report_id',$id)->update($data_detail);
			
		}
		return $id;
	}

	public static function SaveData($result){
        $result = array_reverse($result);
        return $id = DB::table('report')->insertGetId($result);
        
     }
}
?>