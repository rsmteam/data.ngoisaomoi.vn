<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\IsRoleAdmin;
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
Route::get('/',['as' => 'getLogin','uses' => 'ThanhvienController@getLogin']);
Route::get('fogotPassForm',['as' => 'fogotPassForm','uses' => 'ThanhvienController@fogotPassForm']);
Route::post('fogotPass',['as' => 'fogotPass','uses' => 'ThanhvienController@fogotPass']);   

// Route::get('admin/home',['as' => 'adminHome','uses' => 'ThanhvienController@index'])->middleware(auth::class);
Route::get('admin/home',['as' => 'adminHome','uses' => 'ContactController@index'])->middleware(auth::class);
Route::get('test',['as' => 'test','uses' => 'ContactController@test']);

Route::post('authen/postlogin',['as' => 'postLogin','uses' => 'ThanhvienController@postLogin']);
Route::get('getLogOut',['as' => 'getLogOut','uses' => 'ThanhvienController@getLogOut']);
Route::get('getEditUser/{id}',['as' => 'getEditUser','uses' => 'ThanhvienController@getFormEdit']);
Route::post('postEditUser/{id}',['as' => 'postEditUser','uses' => 'ThanhvienController@PostFormEdit']);


/* quyền admin */
Route::group(['middleware' => ['CheckRole']], function () {
    Route::get('admin/get-create-user',['as' => 'create-user','uses' => 'ThanhvienController@getAddNhanVien']);
    Route::post('admin/post-create-user',['as' => 'post-create-user','uses' => 'ThanhvienController@postAddNhanVien']);
    
     
    Route::post('admin/insertData',['as' => 'insertData','uses' => 'ContactController@insertData']);
    Route::get('getFormChangeRole/{id}',['as'=>'getFormChangeRole','uses'=>'ThanhvienController@getFormChangeRole']);

    Route::post('postChangeRole/{id}',['as'=>'admin.postChangeRole','uses'=>'ThanhvienController@postFormChangeRole']);

    Route::get('admin/getListUser',['as' => 'getListUser','uses' => 'ThanhvienController@getListUser']);
    Route::get('admin/getUtmSource',['as' => 'getUtmSource','uses' => 'UtmController@index']);
    Route::post('admin/createUtmSource',['as' => 'createUtmSource','uses' => 'UtmController@create']);
    Route::get('admin/getFormChangeUTM/{utm_name}',['as' => 'getFormChangeUTM','uses' => 'ThanhvienController@getFormChangeUTM']);
    Route::post('admin/postFormChangeUTM/{utm_name}',['as' => 'postFormChangeUTM','uses' => 'ContactController@updateUTM']);


});

/* quyền Supper Admin */
Route::group(['middleware' => ['IsRoleAdmin']], function () {
    Route::post('getDeleteData',['as' => 'getDeleteData','uses' => 'ContactController@deleteContact']);
});
Route::get('getImport',['as' => 'getImport','uses' => 'ContactController@getFormImport']);
Route::post('postImport',['as' => 'postImport','uses' => 'ContactController@importExcel']);
Route::get('search_date',['as' => 'search_date','uses' => 'ContactController@searchContactByParam']);
Route::post('search_date',['as' => 'search_date','uses' => 'ContactController@searchContactByParam']);
Route::get('excel/{startDate}&{endDate}&{utm}&{website}',['as' => 'admin.invoices.excel','uses' => 'ContactController@exportExcel']);
Route::get('chinhsach','ThanhvienController@chinhsach');
Route::get('getReport',['as' => 'getReport','uses' => 'ReportController@index']);
Route::post('createReport',['as' => 'createReport','uses' => 'ReportController@createReport']);
Route::get('deleteReport/{id}',['as' => 'deleteReport','uses' => 'ReportController@deleteReport']);
Route::get('refeshReport',['as' => 'refeshReport','uses' => 'ReportController@refeshReport']);
Route::get('listWebsite',['as' => 'listWebsite','uses' => 'WebsiteController@index']);
Route::post('CreateWebsite',['as' => 'CreateWebsite','uses' => 'WebsiteController@create']);
Route::post('editWebsite/{id}',['as' => 'editWebsite','uses' => 'WebsiteController@edit']);
Route::post('UpdateUtmParent',['as' => 'UpdateUtmParent','uses' => 'UtmParentController@update']);
Route::post('UpdateDetailWeek',['as' => 'UpdateDetailWeek','uses' => 'ReportDetailWeekController@update']);

// api route
Route::post('createItems',['as' => 'createItems','uses' => 'Api\ContactController@createContact']);
Route::post('deleteContact',['as' => 'deleteContact','uses' => 'ContactController@delete']);
Route::get('test',['as' => 'test','uses' => 'ContactController@test']);
