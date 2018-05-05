<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use App\User;
use Mail;
class UtmParent extends Model
{
    protected  $table = "utm_parent";
    protected $fillable = ['title'];
	
	public function utm()
    {
        return $this->hasMany('App\Utm');
    }
}
?>