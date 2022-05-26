<?php

namespace App\Http\Controllers;
use App\Models\Notice_Board; 
use App\Models\User; 
use Illuminate\Http\Request;
use DB;
use Auth;
class NoticeBoardController extends Controller
{
   
    public function __construct(){

        // $this->middleware('permission:noticeboard-add', ['only' => ['create','update']]);
         
        // $this->middleware('permission:noticeboard-edit', ['only' => ['edit','update']]);
        
        // $this->middleware('permission:noticeboard-delete', ['only' => ['destroy']]);

        $this->middleware('permission:noticeboard-view', ['only' => ['index']]);
         
    }
    public function index(Request $request)
    {

        $data = new Notice_Board();

        // $data = $data->where('notices.created_by',Auth::user()->id);
        $data = $data->select('notices.*','users.first_name','users.last_name');
        $data  = $data->leftJoin('users','users.id','=','notices.created_by');

        if(Auth::user()->roles[0]->name != 'Admin'){
      
            if(Auth::user()->roles[0]->type == 'manager'){
                $data = $data->where('notices.created_by',Auth::user()->id);
                $data = $data->orWhere('notices.sent_type','managers');

            }else{

            if(Auth::user()->is_lead == 1){  

                $data = $data->where('notices.created_by',Auth::user()->id);

                $data = $data->orWhere('notices.sent_type','lead');
            
            }  else    {
                
                $data  = $data->leftJoin('notice_users','notices.id','=','notice_users.notice_id');
                
                $data = $data->orWhere('notices.sent_type','Individually');
                
                $data = $data->where('notice_users.user_id',Auth::user()->id);
            }       
                // $data = $data->where('notice_users.notice_id',Auth::user()->id);
 
            }
         
            $data = $data->orWhere('notices.sent_type','all')->orderBy('notices.id', 'DESC');
        }else{
        
        
        }
      
        
       $result = $data->orderBy('notices.id','desc')->paginate(5);

       return view('noticeboard.index',compact('result'));
    }


    public function create()
    {
        
        return view('noticeboard.add');
    
    }

    public function edit($id)
    {
        $notice = new Notice_Board();
        
        $data['result'] = $notice->find($id);

        $data['users'] = DB::table('notice_users')->where('notice_id',$id)->get();
        $data['id'] = $id;


        return view('noticeboard.edit',$data);
    
    }

    public function get_users_notice($id){

        $users = User::where('first_name','!=','NULL')->where('last_name','!=','NULL')->get();
       
        if(Auth::user()->roles[0]->name != 'Admin'){
     
           if(Auth::user()->roles[0]->type == 'manager'){
             
               $users = User::where('first_name','!=','NULL')->where('last_name','!=','NULL')->where('assigned_to',Auth::user()->id,)->get();

           }

           else{
               $users = User::where('first_name','!=','NULL')->where('last_name','!=','NULL')->where('lead_id',Auth::user()->id,)->get();

           }
       }

       $data['status'] = 'success';
       $data['data'] = $users;
       
      $data['users']=DB::table('notice_users')->where('notice_id',$id)->get();
       


            $html = "<option></option>";  
           
            foreach($users as $key=>$value){
                $selected = "";
                if($data['users']){
                    foreach($data['users'] as $keyy=>$valuee){

                        if($value->id == $valuee->user_id){

                            $selected = 'selected';

                        }

                    }
                }
                $html .="<option ".$selected." value='".$value->id."'>".$value->first_name." ".$value->last_name."</option>";

           }
return $html;


    }

    public function update(Request $request)
    {
        
    //     ^ array:5 [▼
    //     "_token" => "UH1B9bvy7nfLGnUC7HILd8rNkZcwKVV0NBhi9vby"
    //     "title" => "zx"
    //     "description" => "<p>xz</p>"
    //     "sent_type" => "Individually"
    //     "Individually_users" => array:1 [▼
    //       0 => "307"
    //     ]
    //   ]

    if(isset($request->id)){
        $notice = DB::table('notices')->where('id',$request->id)->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'sent_type'=>$request->sent_type,
            'created_by'=>Auth::user()->id,
            'created_at'=>date('Y-m-d H:i:s')
        ]);
    }else{
        $notice = DB::table('notices')->insertGetId([
            'title'=>$request->title,
            'description'=>$request->description,
            'sent_type'=>$request->sent_type,
            'created_by'=>Auth::user()->id,
            'created_at'=>date('Y-m-d H:i:s')
        ]);
    }
  

if($request->sent_type == 'Individually')
{
       if(isset($request->id)){
        $notice  =  $request->id;
            DB::table('notice_users')->where('notice_id',$request->id)->delete();
        
       }
       if(isset($request->Individually_users)){

            foreach($request->Individually_users as $key=>$value){

            
                $notice_user = DB::table('notice_users')->insert([

                    'notice_id'=>$notice,

                    'user_id'=>$value,

                    'created_at'=>date('Y-m-d H:i:s')

                ]);
            }
       }
}elseif($request->sent_type == 'lead')
{   
   // echo Auth::user()->id;
//   $leads  = DB::table('users as u')
//                     ->select('us.*')
//                         ->join('users as us','us.lead_id','=','u.id')
//                             ->where('u.assigned_to',Auth::user()->id)
//                                     ->get();
$data  = DB::table('users');
        // $data = $data->where('users.id',Auth::user()->id);

        if(Auth::user()->roles[0]->type == 'manager'){

            $data = $data->orWhere('users.assigned_to',Auth::user()->id);

        }else{
            
            if(Auth::user()->is_lead){

                $data = $data->orWhere('users.lead_id',Auth::user()->id);



            }

           


        }

        $result = $data->where('users.is_lead',1)->get();
        if(isset($request->id)){
            $notice  =  $request->id;
            DB::table('notice_users')->where('notice_id',$request->id)->delete();
           }
         foreach($result as $key=>$value){

            $notice_user = DB::table('notice_users')->insert([

                'notice_id'=>$notice,

               'user_id'=>$value->id,

               'created_at'=>date('Y-m-d H:i:s')

             ]);
          }
  
 
    //  echo '<pre>';
    //  print_r($key);die;
}


elseif($request->sent_type == 'all_team')
{   
    echo Auth::user()->id;

$data  = DB::table('users');
        // $data = $data->where('users.id',Auth::user()->id);

            
            if(Auth::user()->is_lead){

                $data = $data->orWhere('users.lead_id',Auth::user()->id)->get();

            

        }

        if(isset($request->id)){
            $notice  =  $request->id;
            DB::table('notice_users')->where('notice_id',$request->id)->delete();
           }
        foreach($data as $key=>$value){

            $notice_user = DB::table('notice_users')->insert([

                'notice_id'=>$notice,

               'user_id'=>$value->id,

               'created_at'=>date('Y-m-d H:i:s')

             ]);
          }
        
  
 
    //   echo '<pre>';
    //   print_r($data);die;
}
         


   // return redirect()->back()->with('success', 'Notification successfully Created!');
  return redirect()->route('noticeboard.index')->with('success', 'Notice save successfully!');
    
    }
}
