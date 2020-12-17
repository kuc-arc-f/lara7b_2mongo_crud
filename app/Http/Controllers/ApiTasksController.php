<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use MongoDB\Client;
use MongoDB\BSON\ObjectID;
use App\Libs\LibMongo;
//
class ApiTasksController extends Controller
{
    /**************************************
     *
     **************************************/
    public function __construct(){
        $LibMongo = new LibMongo;
        $this->db= $LibMongo->get_db();        
    }
    /**************************************
     *
     **************************************/
    public function get_tasks()
    {   
        $collection = $this->db->tasks;
        $result = $collection->find();
        $items = [];    
        foreach ($result as $entry) {
            $items[] = $entry;
//            var_dump($entry["_id"]);
        }
        return response()->json($items);
    }
    /**************************************
     *
     **************************************/  
    public function create_task(Request $request){
    }
    /**************************************
     *
     **************************************/
    public function get_item(Request $request)
    {
        $id = request('id');
        $collection = $this->db->tasks;
        $item = $collection->findOne(
            ["_id"=>new ObjectID($id)]
        );
        return response()->json($item );
    }
    /**************************************
     *
     **************************************/
    public function update_post(Request $request){
    }
    /**************************************
     *
     **************************************/
    public function delete_task(Request $request){
    }
    /**************************************
     *
     **************************************/
    public function test_tasks()
    {   
//exit();
    }

}
