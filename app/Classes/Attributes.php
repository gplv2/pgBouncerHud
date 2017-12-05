<?php

namespace App\Classes;

use Config;
use DB;
use Cache;
use Log;

class Attributes
{      
    /* This function is used to perform select queries of to obtain object attributes */
    protected static function get_attributes($select_query, $select_query_md5 = ""){ 

        if(empty($select_query)){
            return array();
        }

        if(empty($select_query_md5)){
            $select_query_md5 = md5($select_query);
        }

        $expire=config('app.sel_exp');
        // initialize result

        $attributes = array();
        if (Cache::has($select_query_md5)){ 
            $attributes = Cache::get($select_query_md5);
        }else{
            try{
                $res= DB::connection('pgsqlc')->select(DB::raw($select_query));
                if(!empty($res['0'])){
                    $attributes=$res['0'];
                    Cache::put($select_query_md5, $attributes, $expire);  
                } 
            } catch(\Illuminate\Database\QueryException $ex){
                Log::info('Error: executing cached query', array($ex->getMessage()));   
                Log::info('Error querying attributes', array($select_query));
            }
        }

        return $attributes;
    }
}