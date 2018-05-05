<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ApiCaller;
class NhanVien extends Model
{
    protected $table = "users";
    protected $fillable = ['id','name','email','loai','dateJoin'];
    protected static $APP_ID = 'APP001';
    protected static $SECRET = '28e336ac6c9423d946ba02d19c6a2632';
    protected static $LINK_API = 'https://api.ngoisaomoi.vn/';
 //    protected $fillable = ['khachhang_ten','khachhang_dia_chi','khachhang_sdt','khachhang_email','user_id'];

	// public $timestamps = false;
	public function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}

	public static function getLinkWebsite(){
		$apicaller =  new ApiCaller(self::$APP_ID,self::$SECRET,self::$LINK_API);
		$link = $apicaller->sendRequest(array(
					'controller' => 'ContactController',
					'action' => 'getLink',
				));
		return $link;
	}
}
?>