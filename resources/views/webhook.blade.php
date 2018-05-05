<?php

	$challenge = $_REQUEST['hub_challenge'];
$verify_token = $_REQUEST['hub_verify_token'];

if ($verify_token === 'abc133') {
  echo $challenge;
}

// function getLead($leadgen_id,$user_access_token) {
//     //fetch lead info from FB API
//     $graph_url= 'https://graph.facebook.com/v2.8/'.$leadgen_id."?access_token=".$user_access_token;
//     $ch = curl_init();
//     curl_setopt($ch, CURLOPT_URL, $graph_url);
//     curl_setopt($ch, CURLOPT_HEADER, 0);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//     $output = curl_exec($ch); 
//     curl_close($ch);

//     //work with the lead data
//     $leaddata = json_decode($output);
//     $lead = [];
//     for($i=0;$i<count($leaddata->field_data);$i++) {
//         $lead[$leaddata->field_data[$i]->name]=$leaddata->field_data[$i]->values[0];
//     }
//     return $lead;
// }


// // get info page
// function getPagesInfo($page_id,$token){
   
//     $url = 'https://graph.facebook.com/'.$page_id.'?fields=website&access_token='.$token;
//     $ch = curl_init();
//     curl_setopt($ch, CURLOPT_URL, $url);
//     curl_setopt($ch, CURLOPT_HEADER, 0);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//     $all_page = curl_exec($ch); 
//     curl_close($ch);
//     $leaddata = json_decode($all_page);
//     return $leaddata;
// }

// // replace số điện thoại +84
// function ReplacePhone($phone){
//     $array =  array("+84","+840","00");

//     foreach ($array as $item) {
//         if (strpos($phone, $item) !== false) {
//             $phone = str_replace($item,"0",$phone);
//         }
//     }
//     return $phone;
    
// }



// //Take input from Facebook webhook request
// $input = json_decode(file_get_contents('php://input'),true);
// $leadgen_id = $input["entry"][0]["changes"][0]["value"]["leadgen_id"];
// $page_id = $input["entry"][0]["changes"][0]["value"]["page_id"];
// $form_id = $input["entry"][0]["changes"][0]["value"]["form_id"];

// //Token - you must generate this in the FB API Explorer - tip: exchange it to a long-lived (valid 60 days) token
// $user_access_token = 'EAACJHJgAO1oBANBOFoDrkVdMOZAAe2HKwOf9TIGUZAq2XPyatg8izOSIeN6b3v877oZABHrzqr9mB0fZAUGLjZCf4IXECmw4Q3XPYo3XN7mXpOjO8dVbEpXvHYZArv7qqyxWb2Ya1kA8p29LhVAoggYUtNuYMxEINFoDgmVmdBZBwePT1Ca2wfN';
// // $leadgen_id = '1793535707347651';

//  $lead= getLead($leadgen_id,$user_access_token);//get lead info

//  $page = getPagesInfo($page_id,$user_access_token);

// // Thêm http:// vào link
//  if (strpos($page->website, 'http://') === false) {
//     $website = 'http://'.$page->website;
// }else{
//     $website = $page->website;
// }

//  $last_char = substr($website, -1);

//  // xóa dấu '/' cuối link
//  if( $last_char == '/'){
//     $website=rtrim($website,"/");
// }



// $email = $lead['email'];
// $name = $lead['full_name'];
// $phone = ReplacePhone($lead['phone_number']);
// $comment = 'FormID: '.$form_id;

// $r = App\Contact::test();

// $QueryGetUser = "select * from contact where email = '$email' and link = '$website' or phone = '$phone' and link = '$website'";
// $query = "insert into contact (name, phone, email, comment, register_time, utm_source, utm_medium, utm_campaign,link,source_cookie) values('$name','$phone','$email','$comment','$current_date','FB_Lead','','','$website','')";
 
// if(!$db->getInstance($QueryGetUser)){
//     $query = "insert into contact (name, phone, email, comment, register_time, utm_source, utm_medium, utm_campaign,link,source_cookie) values('$name','$phone','$email','$comment','$current_date','FB_Lead','','','$website','')";
//     $result = $db->exec($query);
// }



?>
