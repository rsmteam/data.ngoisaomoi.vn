<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use App\User;
use Mail;
class Utm extends Model
{
    protected  $table = "utm_source";
    protected $fillable = ['title','utm_parent_id'];
	
	public function utmParent()
    {
        return $this->belongsTo('App\UtmParent');
    }
}
?>