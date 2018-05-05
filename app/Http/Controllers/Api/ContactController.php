<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;

class ContactController extends Controller
{
    public function createContact(){
    	$data = request()->toArray();
    	$data['register_time'] = Carbon::now();
    	$current_date = date("Y-m-d H:i:s");
        $link = $data['link'];
        $domain = explode('//',$link);
        $source_cookie = $data['source_cookie'];
        $arr_source_cookie = explode('|', $source_cookie);
        $cookie = '';
        foreach($arr_source_cookie as $item){
            if($item != $domain[1]){
                $cookie = $cookie . '|' . $item;
            }
        }
        $source_cookie = $domain[1] . $cookie;
        $quertGetUser = DB::table('contact')->where('email',$data['email'])
        									->where('link',$link)
        									->orWhere('phone',$data['phone'])
        									->where('link',$link)
        									->first();
        if($quertGetUser){
            $new = Carbon::parse($quertGetUser->register_time);
            $length = $new->diffInMinutes($data['register_time']);
            $contactTrung['contact_id'] = $quertGetUser->id;
            if($length >= 5){
                $contactTrung['name'] = $quertGetUser->name;
                $contactTrung['phone'] = $quertGetUser->phone;
                $contactTrung['email'] = $quertGetUser->email;
                $contactTrung['comment'] = $quertGetUser->comment;
                $contactTrung['register_time'] = $quertGetUser->register_time;
                $contactTrung['link'] = $quertGetUser->link;
                $contactTrung['source_cookie'] = $quertGetUser->source_cookie;
                $contactTrung['utm_source'] = $quertGetUser->utm_source;
                $contactTrung['utm_medium'] = $quertGetUser->utm_medium;
                $contactTrung['utm_campaign'] = $quertGetUser->utm_campaign;
                $insert = DB::table('contact_trung')->insert($contactTrung);
                $update = DB::table('contact')->where('id',$quertGetUser->id)->update($data);
            }
        }else{
        	$insert = DB::table('contact')->insert($data);
        	
        }

        if($insert)
            return "Create Successful";
        else
            return "Create Fail";
       
    }

   
}

