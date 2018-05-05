<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\ApiCaller;
use DB;
use Mail;
use Session;
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    const SUPPER_ADMIN = 1;
    const ADMIN = 2;
    // static $count_old = 0;
    // public function 

    public static function SentEmailToAdmin(){
        
        $apicaller = new ApiCaller('APP001', '28e336ac6c9423d946ba02d19c6a2632', 'https://api.ngoisaomoi.vn/');
        $todo_items = $apicaller->sendRequest(array(
                'controller' => 'ContactController',
                'action' => 'getList',
            ));
        $todo_items_old = $apicaller->sendRequest(array(
                'controller' => 'ContactController',
                'action' => 'getList',
                'count' => 'count',
            ));
        $count = count($todo_items);
        $count_old = count($todo_items_old);
        if ($count > $count_old){
            $data = (array) reset($todo_items);
            $link = $data['link'];
            $user_admin = DB::table('users')->where('loai',User::SUPPER_ADMIN)->get();
            $user = DB::table('users')->where('loai','like',"%$link%")->get();
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

    public static function AddUser(){
        DB::table('items')->insert(
            ['name' => 'bao']
        );
    }
}
