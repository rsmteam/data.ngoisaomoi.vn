<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use App\User;
use Mail;
class Website extends Model
{
    protected  $table = "website";
    protected $fillable = ['title'];
	// public function getList(){
	// 	$result = DB::table(self::$table)-
	// }
}
?>