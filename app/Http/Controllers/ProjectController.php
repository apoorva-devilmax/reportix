<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Contracts\ProjectContract;
use App\Http\Requests\ProjectRequest;
use Exception;

class ProjectController extends Controller
{
    
    protected $project;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProjectContract $project)
    {
        $this->middleware('auth');
        $this->project = $project;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = 10;
        $projects = $this->project->getAll($limit);
        $data = [
            'projects' => $projects,
            'i' => $request->page ? (($limit*($request->page -1)) + 1) : 1,
        ];
        return view('project/list', $data);
    }
    
    public function create()
    {
        $data = [
            'button_text' => 'Create',
            'action' => 'add'
        ];
        return view('project/save', $data);
    }
    
    public function save(ProjectRequest $request)
    {
        $stat = $this->project->save($request);
        $status = $stat === 'success' ? 'Success! New project created.' : 'Error has occured! Please try again later.';
        return redirect()->route('project-list')->with('status', $status);
    }
    
    public function edit($id)
    {
        try {
            $project = $this->project->getById($id);
        } catch (Exception $ex) {
            $status = 'Error has occured! Please try again later.';
            return redirect()->route('project-list')->with('status', $status);
        }
        $data = [
            'button_text' => 'Update',
            'project' => $project,
            'id' => $id,
            'action' => 'edit'
        ];
        return view('project/save', $data);
    }
    
    public function update(ProjectRequest $request, $id)
    {
        $status = 'Error has occured! Please try again later.';
        if($id && $id>0){
            $stat = $this->project->save($request, $id);
            $status = $stat === 'success' ? 'Success! project updated.' : $status;
        }
        return redirect()->route('project-list')->with('status', $status);
    }
    
    public function delete($id)
    {
        $status = 'Error has occured! Please try again later.';
        if($id && $id>0){
            $stat = $this->project->remove($id);
            $status = $stat === 'success' ? 'Success! Project deleted.' : $status;
        }       
        return redirect()->route('project-list')->with('status', $status);
    }
}
