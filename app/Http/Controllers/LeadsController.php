<?php

namespace App\Http\Controllers;

use App\Models\Leads;
use Illuminate\Http\Request;
use App\Http\Requests\LeadsAddRequest;
use App\Models\Files;
use App\Models\Lead_Documents as LeadDocuments;
use App\Models\User; 

use App\Models\Orders;
use Spatie\Permission\Models\Role;
use App\Models\City;
use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserEditRequest;
use Auth;
use DB;
use Validator;
class LeadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct(){

        $this->middleware('permission:leads-add', ['only' => ['create','update']]);
         
        $this->middleware('permission:leads-edit', ['only' => ['edit','update']]);
        
        $this->middleware('permission:leads-delete', ['only' => ['destroy']]);

        $this->middleware('permission:leads-view', ['only' => ['index']]);
         
    }

    public function index(Request $request){
        
     if ($request->ajax()) {


            $data = new Leads();


            $data = $data->select(

                                'leads.id',
                                'leads.email',
                                'leads.phone_number',
                                'leads.url',
                                'leads.description',
                                'leads.lead_status',
                                'lead_issues.issue',
                                'leads.lead_id',
                                'leads.created_at',
                                DB::raw('CONCAT(leads.first_name," ",leads.last_name) AS name'),

                                DB::raw('CONCAT(users.first_name," ",users.last_name) AS created_name')
                                
                            )->with('website_url');

                            $data = $data->leftJoin('lead_issues','lead_issues.id','=','leads.lead_issue_id');

                            $data = $data->join('users','users.id','=','leads.created_by');

                            // $data = $data->leftJoin('lead_transfers lt','lt.lead_id','=','leads.id');


                    


                            if(isset($_GET['lead_id'])&& !empty($_GET['lead_id'])){
       
                                $lead_id = trim($_GET['lead_id']); 
                 
                                $data = $data->where('leads.lead_id',$_GET['lead_id']);     
                        
                            }

                            if(isset($_GET['email'])&& !empty($_GET['email'])){
       
                                $email = $_GET['email']; 
                 
                                $data = $data->where('leads.email',$_GET['email']);     
                        
                            }

                            if(isset($_GET['status'])&& !empty($_GET['status'])){
       
                                $status = $_GET['status']; 
                 
                                $data = $data->where('leads.lead_status',$_GET['status']);     
                        
                            }

                            if(isset($_GET['url'])&& !empty($_GET['url'])){
       
                                $url = $_GET['url']; 
                 
                                $data = $data->where('leads.url',$_GET['url']);     
                        
                            }
                            

                            if(isset($_GET['date_start'])&& !empty($_GET['date_start'])){
       
                                $date_start = $_GET['date_start'] ." 00:00:00";
                                
                                $data = $data->where('leads.created_at','>=',$date_start);     
                        
                            }

                            if(isset($_GET['date_end'])&& !empty($_GET['date_end'])){
       
                                $date_end = $_GET['date_end'] ." 23:59:59";
                 
                                $data = $data->where('leads.created_at','<=',$date_end);     
                        
                            }

                            if(isset($_GET['name'])&& !empty($_GET['name'])){
       
                                $name = $_GET['name']; 

                                $data = $data->where('leads.first_name','LIKE','%'.$name.'%');     

                                $data = $data->orWhere('leads.last_name','LIKE','%'.$name.'%');  

                            }
                // $data = $data->orderBy('leads.id','DESC');          
                if($this->is_admin() != true){

                    $data = $data->where('leads.transfered_id',Auth::user()->id);

                    if(Auth::user()->roles[0]->type == 'manager'){

                        $data = $data->orWhere('users.assigned_to',Auth::user()->id);

                    }else{
                        
                        if(Auth::user()->is_lead){

                            $data = $data->orWhere('users.lead_id',Auth::user()->id);
         
                        }
                    }
                  
                }
                return $this->table($data,'leads');   
            
        }

       return view('leads.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('leads.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Leads $leads)
    {
        $rules['first_name'] = 'required';
        
        $rules['last_name'] = 'required';
        
        $rules['email'] = 'email';
        
        $rules['phone_number'] = 'required';
        
        $rules['lead_status'] = 'required';
        
        $rules['url'] = 'required';
        
        $rules['description'] = 'required';
    
        if($request->lead_status == 'Un-Paid'){
        
            $rules['lead_issue_id'] = 'required';

        }
        
        $validator = Validator::make( $request->all(), $rules);

        if ( $validator->fails() ) 
        {
            $data = [
                'success' => false, 
                'message'=>$validator->errors()
            ];

        }else{

            $lead_update = $leads;

            if(isset($request->id)){
            
                $lead_update = $leads->find($request->id);
            
            }else{

                $rules['created_by'] = Auth::user()->id;

            }
            
            foreach($rules as $key=>$value){
                
                $lead_update->{$key} = $request->$key;    

                if(isset($request->id)){

                }else{

                    $lead_update['created_by'] = Auth::user()->id;

                    $lead_update['transfered_id'] = Auth::user()->id;
                    
                }
            
            }

            $lead_update->save();
            
            $lead_id = $lead_update->id;

            $find_lead_id = $leads->find($lead_id);

            $find_lead_id->lead_id = "LEAD-{$lead_id}";
            
            $find_lead_id->save();

            if ($request->file('files')) {
                
                $file = $request->file('files');

                for($i=0;$i<count($file);$i++){

                    $lead_file_name = 'leads-data-'.date('YmdHis').'.'.$file[$i]->getClientOriginalExtension();

                    $original_file_name = $file[$i]->getClientOriginalExtension();

                    $path = $file[$i]->storeAs("leads_files/lead_{$lead_id}", $lead_file_name);
            
                    $leads_files          =  new Files();
            
                    $leads_files->name = $lead_file_name;

                    $leads_files->original_name = $file[$i]->getClientOriginalName();

                    $leads_files->type = $file[$i]->getClientOriginalExtension();
                    
                    $leads_files->directory = url("storage/app/leads_files/lead_{$lead_id}");
        
                    $leads_files->save();
                    
                    $leads_documents = new LeadDocuments();
                
                
                    $leads_docs_array = ['file_id' =>$leads_files->id,'lead_id'=>$lead_id]; 
        
                    $leads_documents->create($leads_docs_array);
                    
                }
            
            }
            
            $data = [

                'success' => true, 

                'message'=>'Lead Updated Successfully'

            ];
        }
        
        return response($data, 200)->header('Content-Type', 'text/plain');
    
    }

    public function all_docs(Leads $leads,$id){

        $all_docs = LeadDocuments::where('lead_id',$id)
                                    ->with('files')
                                    ->get();
       
        return view('modals.leads.lead_docs',compact('all_docs'));

    }

    public function delete_docs($id){

        $lead_file = Files::where('id',$id)->delete();

        $lead_docs = LeadDocuments::where('file_id',$id)->delete();
        
        return response(['status'=>'success','message'=>'file deleted successfully'], 200)->header('Content-Type', 'text/plain');
    }

    public function lead_transfers($id){

            $data = User::select(
                'users.id as user_id',
                'users.is_lead',
                'users.email',
                'users.lead_id as user_lead_id',
                'roles.name as role_name',
                DB::raw('CONCAT(users.first_name," ",users.last_name) AS name')
            );

            $data =  $data->leftJoin('roles','roles.id','=','users.designation');

            if($this->is_admin() != true){

                if(Auth::user()->roles[0]->type == 'manager'){

                    $data = $data->orWhere('users.assigned_to',Auth::user()->id);

                }else{
                    
                    if(Auth::user()->is_lead){

                        $data = $data->orWhere('users.lead_id',Auth::user()->id);
     
                    }
                }
            }

            $data = $data->where('users.designation','!=','NULL');

            $res['results'] = $data->orderBy('users.id','DESC')->get();      

            $res['lead_id'] = $id;

            $transfere_user_id = DB::table('lead_transfers')->select('user_id')->where('lead_id',$id)->first();
            
            $res['transfere_user_id'] = $transfere_user_id??null; 
            
            return view('modals.leads.leads_transfer',$res);
        }


    public function lead_transfer_update(Request $request){

        $check_if_already_exists = DB::table('lead_transfers')->where([

                                    'lead_id'=>$request->lead_id
            
                                    ])->first();
        
        DB::table('leads')->where('id',$request->lead_id)->update(['transfered_id'=>$request->user_id]);

        if($check_if_already_exists){
         
            if($check_if_already_exists->user_id == $request->user_id){

                return response(['status'=>'error',
                                'message'=>'this lead already transfers to the user'
                                ], 200)->header('Content-Type', 'text/plain');

            }

        }
        
        $transfer_lead =   DB::table('lead_transfers')->insert(
                [
                    'lead_id'=>$request->lead_id,
                    'user_id'=>$request->user_id,
                    'created_by'=>Auth::user()->id,
                    'created_at'=>date('Y-m-d H:i:s')
                ]
                
        );
        return response(['status'=>'success','message'=>'lead transfered successfully'], 200)->header('Content-Type', 'text/plain');
    }

    public function lead_transfers_details($id){

        $leads_transfers_details['lead_details'] = DB::table('lead_transfers')
                            ->join('leads','leads.id','=','lead_transfers.lead_id')
                            ->join('users','users.id','=','lead_transfers.user_id')
                            ->join('users as u','u.id','=','lead_transfers.created_by')
                            ->join('users as us','us.id','=','leads.created_by')
                            ->select('lead_transfers.id',
                                     'users.first_name',
                                     'users.last_name',
                                     'u.first_name as f_name',
                                     'u.last_name  as l_name',
                                     'us.first_name as fs_name',
                                     'us.last_name as ls_name',
                                     'lead_transfers.created_at')
                            ->orderBy('lead_transfers.id','DESC')
                            ->get();
                            $leads_transfers_details['lead_id'] = $id; 
                            return view('modals.leads.leads_transfer_details',$leads_transfers_details);
                            
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Leads  $leads
     * @return \Illuminate\Http\Response
     */
    public function show(Leads $leads)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Leads  $leads
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('leads.edit',compact('id'));

    }

    public function fetch_lead(Leads $lead,$id){

        if($this->is_admin() != true){

            $lead = $lead->join('users','users.id','=','leads.created_by')->where('leads.transfered_id',Auth::user()->id);

            if(Auth::user()->roles[0]->type == 'manager'){

                $lead = $lead->orWhere('users.assigned_to',Auth::user()->id);

            }else{
                
                if(Auth::user()->is_lead){

                    $lead = $lead->orWhere('users.lead_id',Auth::user()->id);
 
                }
            }
          
        }
        
        $lead_deatils= $lead->select('leads.*')->find($id);
        
        if($lead_deatils){

            $status = 200;

        }else{

            $status = 404;

        }
        return response($lead_deatils,$status);

    }



    public function convert_lead(Leads $lead,$id){
        

        $leads_transfers_details['lead_id'] = $id;

        $lead_orders = Orders::where('lead_id',$id)->get();

        $leads_transfers_details['orders'] = [];

        if(count($lead_orders)){

           $leads_transfers_details['orders'] = $lead_orders;

        }
        return view('modals.leads.convert_leads',$leads_transfers_details);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Leads  $leads
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Leads $leads)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Leads  $leads
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leads $leads)
    {
        //
    }
}
