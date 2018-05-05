<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ApiCaller;
use Carbon\Carbon;
use DB;
use Auth;
class MemberHistory extends Model
{
    protected $table = "member_history";


	public static function InsertHistory($title,$value = null){
		$current_time = Carbon::now()->toDateTimeString();
		DB::table('member_history')->insert([
		    ['title' => $title, 'value' => $value,'user_id' => Auth::user()->id,'date' => $current_time],
		]);
	}
}
?>