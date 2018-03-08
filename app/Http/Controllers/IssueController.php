<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Contracts\IssueContract;
use App\Http\Requests\IssueRequest;
use Exception;

class IssueController extends Controller
{
    
    protected $issue;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(IssueContract $issue)
    {
        $this->middleware('auth');
        $this->issue = $issue;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $report)
    {
        $limit = 10;
        $issues = $this->issue->getAll($request, $report, $limit);
        $data = [
            'issues' => $issues,
            'report' => $report,
            'i' => $request->page ? (($limit*($request->page -1)) + 1) : 1,
        ];
        return view('issue/list', $data);
    }
    
    public function create($report)
    {
        $data = [
            'button_text' => 'Create',
            'report' => $report,
            'vulnerabilities' => $this->issue->getVulnerabilityRef()->getVulnerabilityForDropdown(),
            'severity'  => $this->issue->getSeverityRef()->getAll(),
            'action' => 'add'
        ];
        return view('issue/save', $data);
    }
    
    public function save($report, IssueRequest $request)
    {
        $stat = $this->issue->save($request, $report);
        $status = $stat === 'success' ? 'Success! New issue reported.' : 'Error has occured! Please try again later.';
        return redirect()->route('issue-list', ['report' => $report->id])->with('status', $status);
    }
    
    public function edit($report, $id)
    {
        // will check permission through report policy
        try {
            $issue = $this->issue->getById($id);
        } catch (Exception $ex) {
            $status = 'Error has occured! Please try again later.';
            return redirect()->route('issue-list', ['report' => $report->id])->with('status', $status);
        }
        $data = [
            'button_text' => 'Update',
            'report' => $report,
            'vulnerabilities' => $this->issue->getVulnerabilityRef()->getVulnerabilityForDropdown(),
            'severity'  => $this->issue->getSeverityRef()->getAll(),
            'issue' => $issue,
            'id' => $id,
            'action' => 'edit'
        ];
        return view('issue/save', $data);
    }
    
    public function update($report, IssueRequest $request, $id)
    {
        // will check permission through issue policy
        $status = 'Error has occured! Please try again later.';
        if($id && $id>0){
            $stat = $this->issue->save($request, $report, $id);
            $status = $stat === 'success' ? 'Success! Issue updated.' : $status;
        }
        return redirect()->route('issue-list', ['report' => $report->id])->with('status', $status);
    }
    
    public function delete($report, $id)
    {
        // will check permission through issue policy
        $status = 'Error has occured! Please try again later.';
        if($id && $id>0){
            $stat = $this->issue->remove($id);
            $status = $stat === 'success' ? 'Success! Issue deleted.' : $status;
        }       
        return redirect()->route('issue-list', ['report' => $report->id])->with('status', $status);
    }
}