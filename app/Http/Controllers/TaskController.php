<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Http\Request;
use App\Notifications\TaskCreated;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::where('assigned_to', Auth::User()->id)->where('status','<>','finished')->get();
        if(Auth::User()->parent_id == null)
          $users = User::where('parent_id', Auth::User()->id)->orwhere('id', Auth::User()->id)->get();
       else
          $users = User::where('parent_id' , Auth::User()->parent_id)->orwhere('id',Auth::User()->parent_id)->get();
        return view('task.index',['tasks' => $tasks,'users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::User()->parent_id == null)
          $users = User::where('parent_id', Auth::User()->id)->orwhere('id', Auth::User()->id)->get();
        else
          $users = User::where('parent_id' , Auth::User()->parent_id)->orwhere('id',Auth::User()->parent_id)->get();
        return view('task.create',['users'=>$users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'                   => 'required|min:3',
            'description'             => 'required|min:3',
            'duedate'                 => 'required|after:yesterday|date',
            'assigned_to'             => 'required'
        ]);

        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->duedate = $request->duedate;
        $task->assigned_to = $request->assigned_to;
        $task->status = "not started";
        $task->user_id = Auth::User()->id;
        $task->save();
        $user = User::where('id',$request->assigned_to)->first();
        // Notification::sendNow($user , new TaskCreated($task));
        return redirect()->route('dashboard')->with('success', 'Task created successfully');
    }
    public function store_status(Request $request)
    {
        for ($i = 0; $i < count($request->status); $i++) {
            $task = Task::find($request->taskId[$i]);
            if($request->status[$i] <> 'forward'){
                if($request->forwardto[$i] == null)
                    $task->status = $request->status[$i];
                else{
                    $task->status = 'forward';
                    $task->assigned_to = $request->forwardto[$i];
                    $task->user_id = Auth::User()->id;
                }
            }
            else{
                if($request->forwardto[$i] <> null){
                    $task->status = $request->status[$i];
                    $task->assigned_to = $request->forwardto[$i];
                    $task->user_id = Auth::User()->id;
                }
            }
            $task->save();
        }
        return redirect()->route('tasks.index');
    }

    public function archive()
    {
        $tasks = DB::select("CALL pr_archive_tasks( ".Auth::User()->id.")");//employees who have assign
        return view('task.archive',['tasks' => $tasks]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
      return view('task.show',['task'=> $task]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        if(Auth::User()->parent_id == null)
        $users = User::where('parent_id', Auth::User()->id)->orwhere('id', Auth::User()->id)->get();
       else
       $users = User::where('parent_id' , Auth::User()->parent_id)->orwhere('id',Auth::User()->parent_id)->get();
        return view('task.create',['task'=>$task,'users'=>$users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title'                   => 'required|min:3',
            'description'             => 'required|min:3',
            'duedate'                 => 'required|after:yesterday|date',
            'assigned_to'             => 'required'
        ]);
        $task->title = $request->title;
        $task->description = $request->description;
        $task->duedate = $request->duedate;
        $task->assigned_to = $request->assigned_to;
        $task->status =  "not started";
        $task->user_id = Auth::User()->id;
        $task->save();
        return redirect()->route('dashboard')->with('success', 'Task updated successfully');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->route('dashboard')->with('success', 'Task deleted successfully');
    }

    public function printArchive(Request $request)
    {
        $tasks = DB::select("CALL pr_archive_tasks( ".Auth::User()->id.")");
        $html = view('task.archive-pdf',['tasks'=>$tasks])->render();
        $pdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8', 'format' => 'A4','default_font' => 'fontawesome','margin_left' => 15,'margin_right' => 10,'margin_top' => 16,'margin_bottom' => 15,'margin_header' => 10, 'margin_footer' => 10 ]);
        $pdf->AddPage("P");
        $pdf->SetHTMLFooter('<p style="text-align: center">{PAGENO}</p>');
        $pdf->WriteHTML('.fa { font-family: fontawesome;}',1);
        $pdf->WriteHTML($html);
        return  $pdf->Output("archive.pdf","D");
    }
    public function printCreated(Request $request)
    {
        if(Auth::User()->parent_id == null){
            $tasks = DB::select("CALL pr_employees_tasks(".Auth::User()->id.")");//employees who have assign
        }else{ $tasks = Task::where('user_id', Auth::User()->id)->get();//all tasks that I created it
         }
        $html = view('task.createdtask-pdf',['tasks'=>$tasks])->render();
        $pdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8', 'format' => 'A4','default_font' => 'fontawesome','margin_left' => 15,'margin_right' => 10,'margin_top' => 16,'margin_bottom' => 15,'margin_header' => 10, 'margin_footer' => 10 ]);
        $pdf->AddPage("P");
        $pdf->SetHTMLFooter('<p style="text-align: center">{PAGENO}</p>');
        $pdf->WriteHTML('.fa { font-family: fontawesome;}',1);
        $pdf->WriteHTML($html);
        return  $pdf->Output("created.pdf","D");
    }

    public function printAssign (Request $request)
    {
        $tasks = Task::where('assigned_to', Auth::User()->id)->where('status','<>','finished')->get();
        $html = view('task.assign-task-pdf',['tasks'=>$tasks])->render();
        $pdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8', 'format' => 'A4','default_font' => 'fontawesome','margin_left' => 15,'margin_right' => 10,'margin_top' => 16,'margin_bottom' => 15,'margin_header' => 10, 'margin_footer' => 10 ]);
        $pdf->AddPage("P");
        $pdf->SetHTMLFooter('<p style="text-align: center">{PAGENO}</p>');
        $pdf->WriteHTML('.fa { font-family: fontawesome;}',1);
        $pdf->WriteHTML($html);
        return  $pdf->Output("assign.pdf","D");
    }
}






// $request->validate([
        //     'forwardto'           => "required|array",
        //     'forwardto.*'         => 'required',
        // ]);
