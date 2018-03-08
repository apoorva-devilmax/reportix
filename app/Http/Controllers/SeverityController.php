<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Contracts\SeverityContract;
use App\Http\Requests\SeverityRequest;
use Exception;

class SeverityController extends Controller
{
    
    protected $severity;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SeverityContract $severity)
    {
        $this->middleware('auth');
        $this->severity = $severity;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = 10;
        $severity = $this->severity->getAll($limit);
        $data = [
            'severity' => $severity,
            'i' => $request->page ? (($limit*($request->page -1)) + 1) : 1,
        ];
        return view('severity/list', $data);
    }
    
    public function create()
    {
        $data = [
            'button_text' => 'Create',
            'action' => 'add'
        ];
        return view('severity/save', $data);
    }
    
    public function save(SeverityRequest $request)
    {
        $stat = $this->severity->save($request);
        $status = $stat === 'success' ? 'Success! New severity created.' : 'Error has occured! Please try again later.';
        return redirect()->route('severity-list')->with('status', $status);
    }
    
    public function edit($id)
    {
        try {
            $severity = $this->severity->getById($id);
        } catch (Exception $ex) {
            $status = 'Error has occured! Please try again later.';
            return redirect()->route('severity-list')->with('status', $status);
        }
        $data = [
            'button_text' => 'Update',
            'severity' => $severity,
            'id' => $id,
            'action' => 'edit'
        ];
        return view('severity/save', $data);
    }
    
    public function update(SeverityRequest $request, $id)
    {
        $status = 'Error has occured! Please try again later.';
        if($id && $id>0){
            $stat = $this->severity->save($request, $id);
            $status = $stat === 'success' ? 'Success! Severity updated.' : $status;
        }
        return redirect()->route('severity-list')->with('status', $status);
    }
    
    public function delete($id)
    {
        $status = 'Error has occured! Please try again later.';
        if($id && $id>0){
            $stat = $this->severity->remove($id);
            $status = $stat === 'success' ? 'Success! Severity deleted.' : $status;
        }       
        return redirect()->route('severity-list')->with('status', $status);
    }
}
