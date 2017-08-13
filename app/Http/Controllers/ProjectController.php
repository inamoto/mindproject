<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
use Ramsey\Uuid\Uuid;
use App\Project;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use App\User;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        $projects = Project::where('userid', $user->id)->get();
        return view('project.index')->with('projects', $projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = \Auth::user();
        $uuid = Uuid::uuid1()->toString();
        $title='Project';
        $mindmap=sprintf('{"meta":{"name":"Project","author":"%s","version":"0.2"},"format":"node_array","data":[{"id":"root", "isroot":true, "topic":"Project"},]}', $user->email);
        $gantt='{"tasks":[{"id":-1,"name":"Project","progress":0,"progressByWorklog":false,"description":"","level":0,"status":"STATUS_ACTIVE","depends":"","canWrite":true,"start":1499007600000,"duration":20,"end":1501253999999,"startIsMilestone":false,"endIsMilestone":false,"collapsed":false,"assigs":[],"hasChild":false}],"selectedRow":0,"deletedTaskIds":[],"resources":[{"id":"tmp_1","name":"Resource 1"}],"roles":[{"id":"tmp_1","name":"Worker"}],"canWrite":true,"canWriteOnParent":true,"zoom":"w2"}';
        $project = Project::create([
            'uuid' => $uuid,
            'title' => $title,
            'userid' => $user->id,
            'mindmap'=> $mindmap,
            'gantt'=>$gantt
        ]);
        $path='/project/mindmap/'.$uuid;
        return redirect()->to($path);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function EditMindmap($uuid){
        $project = Project::where('uuid', $uuid)->get()->first();
        return view('project.editMindmap')->with('project', $project);
    }
    public function postMindmap(Request $request){
        $mm=$request->input('mindmap');
        $path=$request->input('path');
        $uuid = basename($path);
        $title=$request->input('title');        
        $project = Project::where('uuid', $uuid)->get()->first();
        $project->mindmap=$mm;
        $project->title=$title;
        $project->gantt = $request->input('ganttData');
        DB::transaction(function() use($project){
            $project->save();
            \Session::flash('flash_message', $project->title." was saved");

        });
        return redirect()->to($path);
    }
    public function toGantt(Request $request){
        $mm=$request->input('mindmap2');
        $path=$request->input('path2');
        $uuid = basename($path);
        $title=$request->input('title2');        
        $project = Project::where('uuid', $uuid)->get()->first();
        $project->mindmap=$mm;
        $project->title=$title;
        $project->gantt = $request->input('ganttData2');
        DB::transaction(function() use($project){
            $project->save();
            \Session::flash('flash_message', $project->title." was saved");

        });
        $path = sprintf('project/gantt/%s', $uuid);
        return redirect()->to($path);
    } 

    public function editGantt($uuid){
        $project = Project::where('uuid', $uuid)->get()->first();
        return view('project.editGantt')->with('project', $project);
    }
    public function postGantt(Request $request){
        $gan=$request->input('gantt');
        $path=$request->input('path');
        $uuid = basename($path);
        $title=$request->input('title');        
        $project = Project::where('uuid', $uuid)->get()->first();
        $project->gantt=$gan;
        $project->title=$title;
        $project->save();
        \Session::flash('flash_message', $project->title." was saved");

        return redirect()->to($path);

        /*$mm=$request->input('mindmap');
        $path=$request->input('path');
        $uuid = basename($path);
        $title=$request->input('title');        
        $project = Project::where('uuid', $uuid)->get()->first();
        $project->mindmap=$mm;
        $project->title=$title;
        $project->save();
        return redirect()->to($path);*/
    } 
    public function toMindmap(Request $request){
        //$mm=$request->input('mindmap2');
        $path=$request->input('path2');
        $uuid = basename($path);
        $title=$request->input('title2');        
        $project = Project::where('uuid', $uuid)->get()->first();
        //$project->mindmap=$mm;
        $project->title=$title;
        $project->gantt = $request->input('ganttData2');
        DB::transaction(function() use($project){
            $project->save();
            \Session::flash('flash_message', $project->title." was saved");
        });
        $path = sprintf('project/mindmap/%s', $uuid);
        return redirect()->to($path);
    } 
    public function importProject(Request $request){
        $file = $request->file('csvfile');
        $path = $file->getRealPath();
        //echo $path;
        $file_handler = fopen($path, "r");
        $array = fgetcsv($file_handler);
        //print_r($array);
        $user = \Auth::user();
        $uuid = Uuid::uuid1()->toString();
        $title=$array[3];
        $mindmap=$array[4];
        $gantt=$array[5];        
        $project = Project::create([
            'uuid' => $uuid,
            'title' => $title,
            'userid' => $user->id,
            'mindmap'=> $mindmap,
            'gantt'=>$gantt
        ]);
        

        //$rows[0]='';
        //foreach ($rows as $row){
         // Project::create($row);
        //}
        return redirect()->to('');
    }
    public function exportProject(){
        $url = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://').$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $uuid = basename($url);
        $project = Project::where('uuid', $uuid)->get()->first();
        $pr = $project->toArray();
        $stream = fopen('php://output','w');
        fputcsv($stream, $pr);
        if($project){
            //echo "ok";
            //echo $project;
            //echo $project->title;
            //DB::transaction(function() use($project){
            //    \Session::flash('flash_message', $project->title." was exported");
            //});
            
        } else {
            DB::transaction(function() use($project){
                \Session::flash("Project was not found");
            });
        }
        $cd = 'attachment; filename='.$project->title.".csv";
        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => $cd,
        );

        return Response::make('/', 200, $headers);
        //return redirect()->to('');

        //return 
        
        //DB::transaction(function() use($project){
            //$project->save();
           // \Session::flash('flash_message', $project->title." was exported");
        //});
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        return view('project.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $user = \Auth::user();
        $project = Project::where('uuid', $uuid)->get()->first();
        if($project){
            //$project = Project::findOrFail($id);
            $project->delete();
            \Session::flash('flash_message', $project->title." was deleted");
        }
        return redirect()->to('/home');
    }
}
