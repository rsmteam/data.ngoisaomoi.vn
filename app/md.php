<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Cache;

class md extends Model
{

   public static function select($table_name=NULL,$conditions = NULL,$orderby =NULL)
   {
      $value = DB::table($table_name);
      if($conditions!=NULL)
         $value->whereRaw($conditions);
      if($orderby!=NULL)
         $value->orderByRaw($orderby);

      return $value->get();
      // return DB::table($table_name)->whereRaw($conditions)->get();
   }

   /**
    * Return Array
    * @param mixed $table_name Table name
    * @param mixed $conditions <IF>
    * @param mixed $orderby  <Order>
    * @return array Array
    */
   public static function find($table_name=NULL, $conditions = NULL, $flg = false) {
      $value = DB::table($table_name);

      if($conditions!=NULL)
         $value->whereRaw($conditions);

      //if($orderby!=NULL)
      //   $value->orderByRaw($orderby);

      if($flg==true)
         return $value->first();
      else return (array)$value->first();
      // return DB::table($table_name)->whereRaw($conditions)->get();
   }

   public static function cor($table_name=NULL,$conditions = NULL)
   {
      $value = DB::table($table_name);
      if($conditions!=NULL)
         $value->whereRaw($conditions);

      return count($value->get()->toArray());

   }
   /**
    * Summary of find_all
    * @param mixed $table_nam Tên table
    * @param mixed $conditions [?i?u ki?n]
    * @param mixed $orderby [S?n x?p]
    * @param mixed $star [B?t ??u t? record]
    * @param mixed $limit [S? record]
    * @return array
    */
   public static function find_all($table_name=NULL,$conditions = NULL,$orderby =NULL,$star=NULL,$limit=NULL)
   {
      $value = DB::table($table_name);

      if($conditions!=NULL)
         $value->whereRaw($conditions);

      if($orderby!=NULL)
         $value->orderByRaw($orderby);

      if(intval($star) !=0)
		  $value->skip($star);
	  if($limit!=NULL)
          $value->take($limit);

      return array_map(function($n){return (array)$n;},$value->get()->toArray());

   }

   public static function paging($table_name=NULL,$conditions = NULL,$orderby =NULL,$limit=NULL)
   {
      $value = DB::table($table_name);

      if($conditions!=NULL)
         $value->whereRaw($conditions);

      if($orderby!=NULL)
         $value->orderByRaw($orderby);

      return $value->paginate($limit);

   }

   public static function dictionary($table_name=NULL,$conditions = NULL,$orderby =NULL,$key=NULL,$field=NULL)
   {
      $value = DB::table($table_name);
      if($conditions!=NULL)
         $value->whereRaw($conditions);
      if($orderby!=NULL)
         $value->orderByRaw($orderby);

       $result =  array_map(function($n){return (array)$n;},$value->get()->toArray());

      return array_column($result,$field,$key);

   }

   public static function scalar($table_name=NULL,$conditions = NULL,$field =NULL){
      $value = DB::table($table_name);


      if($conditions!=NULL)
         $value->whereRaw($conditions);
      $result = $value->get();
      if(@$result)
         return  $result[0]->{$field};
      else return '';
      // return DB::table($table_name)->whereRaw($conditions)->get();
   }
   public static function val_max($table_name=NULL,$conditions = NULL,$field =NULL)
   {
      $value = DB::table($table_name);
      $value->max($field);
      if($conditions!=NULL)
         $value->whereRaw($conditions);
      $result = $value->get();
      if(@$result)
         return  $result[0]->{$field};
      else return '';
      // return DB::table($table_name)->whereRaw($conditions)->get();
   }
   public static function select_cache($cache_name,$table_name=NULL,$conditions = NULL,$orderby =NULL,$flg = false)
   {
      $minutes = 30;
      if($flg==true)
      	Cache::pull($cache_name);
      $value = Cache::remember($cache_name,$minutes,function()use($table_name,$conditions,$orderby){
         //return DB::table($table_name)->get();

         $_value = DB::table($table_name);
         if($conditions!=NULL)
            $_value->whereRaw($conditions);
         if($orderby!=NULL)
            $_value->orderBy($orderby);
         return array_map(function($n){return (array)$n;},$_value->get()->toArray());;
      });

      return $value;
   }
   public static function find_cache($name,$table_name=NULL,$conditions = NULL,$flg = false){
      $minutes = 30;
      if($flg==true)
         Cache::pull($name);
      $value = Cache::remember($name,$minutes,function()use($table_name,$conditions){

         $_value = DB::table($table_name);
         if($conditions!=NULL)
            $_value->whereRaw($conditions);

         return $_value->first();
      });

      return $value;
   }
   public static function page_cache($cache_name,$table_name=NULL,$conditions = NULL,$orderby =NULL,$flg = false,$limit=NULL){
      $minutes = 30;
      if($flg==true) Cache::pull($cache_name);
      $value = Cache::remember($cache_name,$minutes,function()use($table_name,$conditions,$orderby,$limit){

         $value = DB::table($table_name);

         if($conditions!=NULL)
            $value->whereRaw($conditions);

         if($orderby!=NULL)
            $value->orderByRaw($orderby);

         return $value->paginate($limit);

      });

      return $value;
   }

   public static function pro_cache($name,$procedure_name=NULL,$value = NULL,$flg = false){
      $minutes = 30;
      if($flg==true)

         Cache::pull($name);
      $value = Cache::remember($name,$minutes,function()use($procedure_name,$value){
         if($value!=null)
            return DB::select('CALL  my_stored_procedure',$value);
         else  return DB::select('CALL  '.$procedure_name);

      });

      return $value;


   }

   /**
    * Summary of remove
    * @param mixed $table_name Table Name
    * @param mixed $field if[id=NULL] <field: Column[id]-> field>
    * @param mixed $id
    */
   public static function remove($table_name = NULL,$field=NULL,$id=NULL)
   {
      if($id==NULL)
         DB::table($table_name)->where('id',$field)->delete();
      else DB::table($table_name)->where($field,$id)->delete();
   }

   public static function remove_field($table_name = NULL,$field=NULL,$id=NULL){
      DB::table($table_name)->whereRaw($field,$id)->delete();
   }

   /**
    * Return ID Record Updated
    * @param mixed $table_name : Table name
    * @param mixed $data : Array [Data]
    * @param mixed $id : <ID>
    * @return mixed
    */
   public static function save_data($table_name=NULL,$data = NULL, $id = NULL){
      $fields = DB::connection()->getSchemaBuilder()->getColumnListing($table_name);

      foreach ($data as $key => $value)
      {
         # set multi language fields
         //if (array_search($key, $this->fields)!==false)
         //{
         //   $this->data[$key] = $this->data[$key];
         //}

         # remove fields not exists in DB
         if (array_search($key, $fields) === FALSE)
         {
            unset($data[$key]);
         }
      }


      if ($id != NULL && $id !== false)
      {
         $result = DB::table($table_name)->where('id',$id)->update($data);
         return $id;
      }
      else
      {
        $result = DB::table($table_name)->insert($data);
        return $result;
      }
   }
}