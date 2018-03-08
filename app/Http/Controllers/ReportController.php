<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Contracts\ReportContract;
use App\Http\Requests\ReportRequest;
use Exception;
use Carbon\Carbon;

class ReportController extends Controller
{
    
    protected $report;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ReportContract $report)
    {
        $this->middleware('auth');
        $this->report = $report;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = 10;
        $reports = $this->report->getAll($limit);
        $data = [
            'reports' => $reports,
            'i' => $request->page ? (($limit*($request->page -1)) + 1) : 1,
        ];
        return view('report/list', $data);
    }
    
    public function create()
    {
        $data = [
            'button_text' => 'Create',
            'projects' => $this->report->getProjectRef()->getProjectForDropdown(),
            'action' => 'add'
        ];
        return view('report/save', $data);
    }
    
    public function save(ReportRequest $request)
    {
        $stat = $this->report->save($request);
        $status = $stat === 'success' ? 'Success! New report created.' : 'Error has occured! Please try again later.';
        return redirect()->route('report-list')->with('status', $status);
    }
    
    public function edit($id)
    {
        // will check permission through report policy
        try {
            $report = $this->report->getById($id);
        } catch (Exception $ex) {
            $status = 'Error has occured! Please try again later.';
            return redirect()->route('report-list')->with('status', $status);
        }
        $data = [
            'button_text' => 'Update',
            'projects' => $this->report->getProjectRef()->getProjectForDropdown(),
            'report' => $report,
            'id' => $id,
            'action' => 'edit'
        ];
        return view('report/save', $data);
    }
    
    public function update(ReportRequest $request, $id)
    {
        // will check permission through report policy
        $status = 'Error has occured! Please try again later.';
        if($id && $id>0){
            $stat = $this->report->save($request, $id);
            $status = $stat === 'success' ? 'Success! Report updated.' : $status;
        }
        return redirect()->route('report-list')->with('status', $status);
    }
    
    public function delete($id)
    {
        // will check permission through report policy
        $status = 'Error has occured! Please try again later.';
        if($id && $id>0){
            $stat = $this->report->remove($id);
            $status = $stat === 'success' ? 'Success! Report deleted.' : $status;
        }       
        return redirect()->route('report-list')->with('status', $status);
    }
    
    public function preview($id)
    {
        // will check permission through report policy
        try {
            $report = $this->report->getById($id);
        } catch (Exception $ex) {
            $status = 'Error has occured! Please try again later.';
            return redirect()->route('report-list')->with('status', $status);
        }
        $data = [
            'report' => $report,
            'id' => $id,
            'now' => Carbon::now()
        ];
        return view('report/preview', $data);
    }
    
    public function generate($id)
    {
        
    }
    
    public function approve($id)
    {
        
    }
}