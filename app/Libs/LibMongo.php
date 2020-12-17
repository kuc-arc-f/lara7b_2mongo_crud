<?php

namespace App\Libs;

use MongoDB\Client;
//
class LibMongo{
    var $param1 =1;
    //
    public function get_client(){
        $client = new Client("mongodb://mongo:27017");
        return $client;
    }
    //
    public function get_db(){
        $client = new Client("mongodb://mongo:27017");
        $db = $client->db1;
        return $db;
    }
}
