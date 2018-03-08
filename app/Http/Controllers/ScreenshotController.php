<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Contracts\ScreenshotContract;
use App\Http\Requests\ScreenshotRequest;
use Exception;

class ScreenshotController extends Controller
{
    
    protected $screenshot;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ScreenshotContract $screenshot)
    {
        $this->middleware('auth');
        $this->screenshot = $screenshot;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $report, $issue)
    {
        // will check permission through screenshot policy
        $limit = 10;
        $screenshots = $this->screenshot->getAll($request, $issue, $limit);
        $data = [
            'screenshots' => $screenshots,
            'issue' => $issue,
            'i' => $request->page ? (($limit*($request->page -1)) + 1) : 1,
        ];
        return view('screenshot/list', $data);
    }
    
    public function create($report, $issue)
    {
        // will check permission through screenshot policy
        $data = [
            'button_text' => 'Create',
            'issue' => $issue,
            'action' => 'add'
        ];
        return view('screenshot/save', $data);
    }
    
    public function save($report, $issue, ScreenshotRequest $request)
    {
        // will check permission through screenshot policy
        $stat = $this->screenshot->save($request, $issue);
        $status = $stat === 'success' ? 'Success! New screenshot uploaded.' : 'Error has occured! Please try again later.';
        return redirect()->route('screenshot-list', ['report' => $report->id, 'issue' => $issue->id])->with('status', $status);
    }
    
    public function edit($report, $issue, $id)
    {
        // will check permission through screenshot policy
        try {
            $screenshot = $this->screenshot->getById($id);
        } catch (Exception $ex) {
            $status = 'Error has occured! Please try again later.';
            return redirect()->route('screenshot-list', ['report' => $report->id, 'issue' => $issue->id])->with('status', $status);
        }
        $data = [
            'button_text' => 'Update',
            'screenshot' => $screenshot,
            'issue' => $issue,
            'id' => $id,
            'action' => 'edit'
        ];
        return view('screenshot/save', $data);
    }
    
    public function update($report, $issue, ScreenshotRequest $request, $id)
    {
        // will check permission through screenshot policy
        $status = 'Error has occured! Please try again later.';
        if($id && $id>0){
            $stat = $this->screenshot->save($request, $issue, $id);
            $status = $stat === 'success' ? 'Success! Screenshot updated.' : $status;
        }
        return redirect()->route('screenshot-list', ['report' => $report->id, 'issue' => $issue->id])->with('status', $status);
    }
    
    public function delete($report, $issue, $id)
    {
        // will check permission through screenshot policy
        $status = 'Error has occured! Please try again later.';
        if($id && $id>0){
            $stat = $this->screenshot->remove($issue, $id);
            $status = $stat === 'success' ? 'Success! Screenshot deleted.' : $status;
        }       
        return redirect()->route('screenshot-list', ['report' => $report->id, 'issue' => $issue->id])->with('status', $status);
    }
}