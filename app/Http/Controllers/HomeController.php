<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tasklist;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
		$this->_Tasklist = new Tasklist();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		$tasklist = DB::table('tasklist')->select('*')->get();
        return view('home',['tasklist'=>$tasklist]);
    }
	
	
	public function addtask(Request $request)
    {
		$request->validate([
            'task_name'     => 'required|unique:tasklist', 
        ]);
		
		 $id = $request->input('id');
		 $this->data['task_name'] = $request->input('task_name');
         $this->data['status'] = 0;
         $this->data['created_at'] =date('Y-m-d H:i:s');
		 $this->data['updated_at'] =date('Y-m-d H:i:s');
		 
		 
		if($request->input('id')>0){
			$this->_Tasklist->updateData($request->input('id'),$this->data);
			$success_msg = 'Updated successfully.';
		}else{
			$request->id = $this->_Tasklist->addData($this->data);
			$success_msg = 'Added successfully.';
		}
        return  $success_msg;
    }
	public function statusupdate(Request $request)
    {
		$data = $this->_Tasklist->getEditDetails($request->input('id'));	
		return  $data;
	}
	public function taskdelete(Request $request)
    {
		$data = $this->_Tasklist->datadelete($request->input('id'));
		$success_msg = 'Delete successfully.';
		return  $success_msg;
	}
	public function gettasklist(Request $request)
    {
		$data = $tasklist = DB::table('tasklist')->select('*')->get();
		$aa=json_encode($data);
		return $aa; 
	}
}
