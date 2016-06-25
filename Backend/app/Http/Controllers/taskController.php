<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;

use App\task as Task;


class taskController extends Controller
{
    /**
     * Get all records
     * @return array
     */
    public function showAll()
    {
        $task = Task::all();
        return $this->getJson($task);
    }

    protected function show($id){

        $task = Task::find($id);

        return response()->json(['success' => true, 'data' => array(
            "id"=> $task->id,
            "type" => "task",
            "attributes"=> array(
                "task" => $task->task,
                "status" => $task->status
            )
        )]);
    }

    /**
     * Create new row
     * @param Request $request
     */
    protected function create(Request $request){
        $attributes = $request->data['attributes'];
        $task = Task::create(array(
            'task' => $attributes['task'],
            'status'=> $attributes['status']
            )
        );
        error_log($task);
        return response()->json(["data"=>array('id' => $task->id,
            'type' => "task",
            "attributes" => array(
                "task"=> $task->task,
                "status" => $task->status)
        )]);

    }

    /**
     * @param Request $request
     */
    protected function destroy($id){
        Task::find($id) ->delete();
        return response()->json(['status' => 'success', 'errors' => array()]);
    }

    protected function update(Request $request,$id){
        $task = Task::find($id);
        $task->task = $request->data['attributes']['task'];
        $task->status = $request->data['attributes']['status'];
        $task->save();
        return response()->json(['status' => 'success', 'errors' => array()]);
    }
    /**
     * @param $obj
     * @return array
     */
    private function getJson($obj){
        $json = array(
            'success' =>false,
            'data' =>[]
        );
        $tempData = array(
            "id",
            "type",
            "attributes"
        );
        foreach ($obj as $value) {
            $tempData["id"] = $value->id;
            $tempData["type"] = "task";
            $tempData["attributes"]["task"] = $value->task;
            $tempData["attributes"]["status"] = $value->status;
            array_push($json["data"], $tempData);
        }
        return $json;
    }
}
