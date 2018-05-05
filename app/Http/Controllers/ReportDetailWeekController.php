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
class ReportDetailWeekController extends Controller
{

    public function update(){
    	$data = request()->toArray();
    	$result = DB::table('report_detail_week')->where('id',$data['id'])->select($data['col'])->first();
    	$week = json_decode($result->$data['col']);
    	foreach($week as $item){
    		if($item->hangmuc == $data['hangmuc']){
    			$item->click = $data['click'];
    			$item->Impress = $data['impress'];
    			$item->ctr = $data['ctr'];
    			$item->cpc = $data['cpc'];
    			$item->cost = $data['cost'];
    			$item->cr = $data['cr'];
    			$item->cpl = $data['cpl'];
    		}else if($item->hangmuc == 'Tổng'){
               $item->click = $data['sum_week_click'];
               $item->Impress = $data['sum_week_impress'];
               $item->ctr = $data['sum_week_ctr'];
               $item->cpc = $data['sum_week_cpc'];
               $item->cost = $data['sum_week_cost'];
               $item->cr = $data['sum_week_cr'];
               $item->cpl = $data['sum_week_cpl'];
            }
    	}
    	$week_new = json_encode($week);
    	$update = DB::table('report_detail_week')->where('id',$data['id'])->update([$data['col'] => $week_new]);
        DB::table('report_total')->where('id',$data['report_total_id'])
                                 ->update([
                                        'click' => $data['sum_click'],
                                        'impress' => $data['sum_impress'],
                                        'ctr' => $data['sum_ctr'],
                                        'cpc' => $data['sum_cpc'],
                                        'cost' => $data['sum_cost'],
                                        'cr' => $data['sum_cr'],
                                        'cpl' => $data['sum_cpl'],
                                    ]);
        DB::table('report_total')->where('report_id',$data['report_id'])
                                ->where('hangmuc','Tổng')
                                 ->update([
                                        'click' => $data['sum_total_click'],
                                        'impress' => $data['sum_total_impress'],
                                        'ctr' => $data['sum_total_ctr'],
                                        'cpc' => $data['sum_total_cpc'],
                                        'cost' => $data['sum_total_cost'],
                                        'cr' => $data['sum_total_cr'],
                                        'cpl' => $data['sum_total_cpl'],
                                    ]);
    	if($update){
    		return 'Update Success';
    	}
        echo "<pre>";
        var_dump($week);
    }
}
?>