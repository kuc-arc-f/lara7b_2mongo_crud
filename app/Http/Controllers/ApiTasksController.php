<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use MongoDB\Client;
use MongoDB\BSON\ObjectID;
use App\Libs\LibMongo;
use App\Libs\LibPagenate;
use App\Libs\LibTask;

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
        $page = $_GET['page'];
//print_r($page);
//exit();
        $LibPagenate = new LibPagenate();
        $LibPagenate->init();
        $page_info = $LibPagenate->get_page_start($page); 
//print_r($page_info);
        $collection = $this->db->tasks;
        $result = $collection->find([], 
        [ 
            'sort' => array('created_at' => -1), 
            'skip' => $page_info["start"],
            'limit' => $page_info["limit"],
        ]
        );        
        $items = [];    
        foreach ($result as $entry) {
            $items[] = $entry;
//            var_dump($entry["_id"]);
        }
        $LibTask = new LibTask();
        $items = $LibTask->convert_utc_date($items);
        $param = $LibPagenate->get_page_items($items);
//print_r(count($items));
        return response()->json($param);
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
