<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    

    public function __construct(){

        $this->middleware('permission:issue-add', ['only' => ['create','update']]);
         
        $this->middleware('permission:issue-edit', ['only' => ['edit','update']]);
        
        $this->middleware('permission:issue-delete', ['only' => ['destroy']]);

        $this->middleware('permission:issue-view', ['only' => ['index']]);
         
    }

    public function select_all_active_issues(){

        $issues = Issue::where('status','ACTIVE')->get();

        return response()->json($issues);
        
    }
    public function get_all_issues(){

        $issues = Issue::paginate(5);

        return response()->json($issues);

    }

    public function get_issue($id){
        
        $issues = Issue::find($id);

        return response()->json($issues);

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('issue.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          return view('issue.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Issue $issue)
    {

        $data['status'] = 'error';
        
        $data['message'] = 'Issue saved successfully';

        if(isset($request->issue)){
            
            $update_issue = $issue;

            $check_request_already_exists  = $issue->where('issue',trim($request->issue));

            if($request->id){
                
                $update_issue = $issue->find($request->id);

                $check_request_already_exists  = $check_request_already_exists->where('id','!=',$request->id);
            
                $data['message'] = 'issue updated successfully';
            }
    
            $check_request_already_exists  = $check_request_already_exists->get();

            if(count($check_request_already_exists)>0){
                
                $data['message'] = 'issue already exists';
                
                return response()->json($data);
           
            }
            
            $update_issue->issue = trim($request->issue);
            $update_issue->status = trim($request->status);

            $update_issue->save();

            $data['status'] = 'success';

            return response()->json($data);
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function show(Issue $issue,$id)
    {
        
        $data = $issue->findOrFail($id);

        return response()->json($data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       return view('issue.edit',compact('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Issue $issue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Issue $issue,$id)
    {
         $users =  $issue->findOrFail($id);
        $users->delete();
        return redirect()->back()->with('success', 'Issue deleted successfully!');   
    }
}
