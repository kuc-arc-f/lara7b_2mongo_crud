<?php
//タスク

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use MongoDB\Client;
use MongoDB\BSON\ObjectID;
use App\Libs\LibMongo;
//
class TasksController extends Controller
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
    public function index()
    {
        $tasks = [];
        return view('tasks/index')->with('tasks', $tasks);
    }    
    /**************************************
     *
     **************************************/
    public function create()
    {
        return view('tasks/create')->with('task',  null);
    }     
   /**************************************
     *
     **************************************/    
    public function store(Request $request)
    {
        $data = $request->all();
        var_dump( $data["title"] );        
        var_dump( $data["content"] ); 
        $collection = $this->db->tasks;
        $result = $collection->insertOne( [
            'title' => $data["title"], 
            'content' => $data["content"], 
       ]);              
        return redirect()->route('tasks.index');
//        exit();
    }  
    /**************************************
     *
     **************************************/
    public function show($id)
    {
        return view('tasks/show')->with('task_id', $id );
    }   
    /**************************************
     *
     **************************************/
    public function edit($id)
    {
        $collection = $this->db->tasks;
        $task = $collection->findOne(
            ["_id"=>new ObjectID($id)]
        ); 
//var_dump($task["_id"] );       
        return view('tasks/edit')->with([
            'task'=>$task, 'task_id'=>$id
        ]);
    }
    /**************************************
     *
     **************************************/
    public function update(Request $request, $id)
    {
        $collection = $this->db->tasks;
        $data = $request->all();
        $new_item = array('$set' => array(
            "title" => $data["title"], "content" => $data["content"] 
        ));
        $result = $collection->updateOne(
            array("_id"=>new ObjectID( $id ) ),
            $new_item
        );
        return redirect()->route('tasks.index');
    }
    /**************************************
     *
     **************************************/
    public function destroy($id)
    {
// var_dump( $id );
        $collection = $this->db->tasks;
        $result = $collection->deleteOne(
            array("_id"=>new ObjectID( $id ) )
        );
        return redirect()->route('tasks.index');
    }      
    /**************************************
     *
     **************************************/
    public function test1(){
//        $client = new MongoDB\Client("mongodb://mongo:27017");
//$collection = $client->db1->tasks;
        $collection = $this->db->tasks;
        $result = $collection->findOne(
//            ["_id"=>new MongoDB\BSON\ObjectID("5fdab56a231fd030630a6722")]
            ["_id"=>new ObjectID("5fdab56a231fd030630a6722")]
        );
        return response()->json($result );
        /*
        print_r($result );
        print_r($result["_id"] );
        print_r($result["title"] );        
        $collection = $this->db->posts;
        $result = $collection->find();

        foreach ($result as $entry) {
            var_dump("#id=". $entry["_id"]);
            var_dump("#title=". $entry["title"]);
        }        
        */
        exit();
    }

}
