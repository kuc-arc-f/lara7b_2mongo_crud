<?php

namespace App\Libs;

use MongoDB\Client;
//
class LibTask{
    var $param1 =1;
    //
    public function convert_utc_date($items ){
        $ret = [];
        foreach ($items as $item) {
            $dt = $item["created_at"]->toDateTime()->format('Y-m-d H:i:s');
            $item["date"] = $dt;
            $ret[] = $item;
// var_dump($item["created_at"]->toDateTime()->format('Y-m-d H:i:s') );
        }        
        return $ret;
    }
}
