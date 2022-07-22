<?php

namespace App\Http\Controllers;

use App\Models\Notice_Board;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\User;

class NoticeBoardController extends Controller
{

    public function __construct()
    {

        // $this->middleware('permission:noticeboard-add', ['only' => ['create','update']]);

        // $this->middleware('permission:noticeboard-edit', ['only' => ['edit','update']]);

        // $this->middleware('permission:noticeboard-delete', ['only' => ['destroy']]);

        $this->middleware('permission:noticeboard-view', ['only' => ['index']]);
    }
    public function index(Request $request)
    {

        $notice_board = new Notice_Board();

        if (Auth::user()->roles[0]->name != 'Admin') {

            $notice_board = $notice_board->join('notice_users','notice_users.notice_id','notices.id');

            $notice_board = $notice_board->where('notice_users.user_id',Auth::user()->id);

        }
       
        $result = $notice_board->orderBy('notices.id', 'desc')->paginate(5);

        return view('noticeboard.index', compact('result'));

    }


    public function create()
    {

        return view('noticeboard.add');
    }

    public function edit($id)
    {
        $notice = new Notice_Board();

        $data['result'] = $notice->find($id);

        $data['users'] = DB::table('notice_users')->where('notice_id', $id)->get();
        $data['id'] = $id;


        return view('noticeboard.edit', $data);
    }

    public function get_users_notice($id)
    {

        $users = User::where('first_name', '!=', 'NULL')->where('last_name', '!=', 'NULL')->get();

        if (Auth::user()->roles[0]->name != 'Admin') {

            if (Auth::user()->roles[0]->type == 'manager') {

                $users = User::where('first_name', '!=', 'NULL')->where('last_name', '!=', 'NULL')->where('assigned_to', Auth::user()->id,)->get();
                
            } else {

                $users = User::where('first_name', '!=', 'NULL')->where('last_name', '!=', 'NULL')->where('lead_id', Auth::user()->id,)->get();

            }
        }

        $data['status'] = 'success';
        $data['data'] = $users;

        $data['users'] = DB::table('notice_users')->where('notice_id', $id)->get();



        $html = "<option></option>";

        foreach ($users as $key => $value) {
            $selected = "";
            if ($data['users']) {
                foreach ($data['users'] as $keyy => $valuee) {

                    if ($value->id == $valuee->user_id) {

                        $selected = 'selected';
                    }
                }
            }
            $html .= "<option " . $selected . " value='" . $value->id . "'>" . $value->first_name . " " . $value->last_name . "</option>";
        }
        return $html;
    }


    public function update(Request $request){
        if (isset($request->id)) {
            $notice = DB::table('notices')->where('id', $request->id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'sent_type' => $request->sent_type,
                'created_by' => Auth::user()->id,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        } else {
            $notice = DB::table('notices')->insertGetId([
                'title' => $request->title,
                'description' => $request->description,
                'sent_type' => $request->sent_type,
                'created_by' => Auth::user()->id,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
        $ids = [];

        $notifications       = new \App\Models\InternalNotifications();
   
        $created_at = date('d M Y H:i:s', strtotime(date('Y-m-d H:i:s')));

        $notifications->data   =    json_encode([

                                        "message"=>"{$this->full_name(Auth::user()->id)}, Created new notice!",

                                        "url"=>url("admin/noticeboard")

                                    ]);

        $notifications->save();

        if($request->sent_type == 'all'){

            $users = new User();
            
            $department_wise_users = $users->where(['status'=>'ACTIVE'])->get();

            if($department_wise_users){

                foreach($department_wise_users as $key=>$value){

                    DB::table('notice_users')->insert(['notice_id'=>$notice,'user_id'=>$value->id,'created_at'=>date('Y-m-d H:i:s')]);

                        $ids[] = $value->id;

                        $notification_users  =   new \App\Models\NotificationUsers();
        
                        $notification_users->user_id = $value->id;
                        
                        $notification_users->notification_id = $notifications->id;
            
                        $notification_users->created_by = Auth::user()->id;
            
                        $notification_users->save();  
        
                }

            }
        }else
        if ($request->sent_type == 'managers') {

            $users = new User();

            $department_wise_users = $users->select('users.*')->whereHas('roles',function($query){
                $query->where('type','manager');
            })->where(['users.status'=>'ACTIVE'])->get();

            if($department_wise_users){

                foreach($department_wise_users as $key=>$value){

                    DB::table('notice_users')->insert(['notice_id'=>$notice,'user_id'=>$value->id,'created_at'=>date('Y-m-d H:i:s')]);

                        $ids[] = $value->id;

                        $notification_users  =   new \App\Models\NotificationUsers();
        
                        $notification_users->user_id = $value->id;
                        
                        $notification_users->notification_id = $notifications->id;
            
                        $notification_users->created_by = Auth::user()->id;
            
                        $notification_users->save();  
        
                }

            }

        }else
        if ($request->sent_type == 'Individually') {

            if (isset($request->id)) {

                $notice  =  $request->id;

                DB::table('notice_users')->where('notice_id', $request->id)->delete();

            }

            if (isset($request->Individually_users)) {
             

                foreach ($request->Individually_users as $key => $value) {

                    $notice_user = DB::table('notice_users')->insert([

                        'notice_id' => $notice,

                        'user_id' => $value,

                        'created_at' => date('Y-m-d H:i:s')

                    ]);

                    $ids[] = $value;

                    $notification_users  =   new \App\Models\NotificationUsers();

                    $notification_users->user_id = $value;
                    
                    $notification_users->notification_id = $notifications->id;
        
                    $notification_users->created_by = Auth::user()->id;
        
                    $notification_users->save();  

                }

            }

        } 
        
        elseif($request->sent_type == 'department'){
       
            $users = new User();
            
            $department_wise_users = $users->whereIn('department_id',$request->departments)->get();
            
            if($department_wise_users){

                foreach($department_wise_users as $key=>$value){

                    DB::table('notice_users')->insert(['notice_id'=>$notice,'user_id'=>$value->id,'created_at'=>date('Y-m-d H:i:s')]);

                        $ids[] = $value->id;

                        $notification_users  =   new \App\Models\NotificationUsers();
        
                        $notification_users->user_id = $value->id;
                        
                        $notification_users->notification_id = $notifications->id;
            
                        $notification_users->created_by = Auth::user()->id;
            
                        $notification_users->save();  
        
                }

            }

        }

        elseif ($request->sent_type == 'lead') {
            
            $users = new User();
            
            $department_wise_users = $users->where(['status'=>'ACTIVE','is_lead'=>1])->get();

            foreach ($department_wise_users as $key => $value) {

                $notice_user = DB::table('notice_users')->insert([

                    'notice_id' => $notice,

                    'user_id' => $value->id,

                    'created_at' => date('Y-m-d H:i:s')

                ]);

                $ids[] = $value->id;

                $notification_users  =   new \App\Models\NotificationUsers();

                $notification_users->user_id = $value->id;
                
                $notification_users->notification_id = $notifications->id;
    
                $notification_users->created_by = Auth::user()->id;
    
                $notification_users->save();  

            }

        }



        $this->alert_notify(null,null,$ids);
        return redirect()->route('noticeboard.index')->with('success', 'Notice save successfully!');
        
    }



    public function update_old(Request $request)
    {

        if (isset($request->id)) {
            $notice = DB::table('notices')->where('id', $request->id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'sent_type' => $request->sent_type,
                'created_by' => Auth::user()->id,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        } else {
            $notice = DB::table('notices')->insertGetId([
                'title' => $request->title,
                'description' => $request->description,
                'sent_type' => $request->sent_type,
                'created_by' => Auth::user()->id,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
        $ids = [];

        $notifications       = new \App\Models\InternalNotifications();
   
        $created_at = date('d M Y H:i:s', strtotime(date('Y-m-d H:i:s')));

        $notifications->data   =    json_encode([

                                        "message"=>"{$this->full_name(Auth::user()->id)}, Created new notice!",

                                        "url"=>url("admin/noticeboard")

                                    ]);

        $notifications->save();

        if ($request->sent_type == 'Individually') {

            if (isset($request->id)) {

                $notice  =  $request->id;

                DB::table('notice_users')->where('notice_id', $request->id)->delete();

            }

            if (isset($request->Individually_users)) {
             

                foreach ($request->Individually_users as $key => $value) {

                    $notice_user = DB::table('notice_users')->insert([

                        'notice_id' => $notice,

                        'user_id' => $value,

                        'created_at' => date('Y-m-d H:i:s')

                    ]);

                    $ids[] = $value;

                    $notification_users  =   new \App\Models\NotificationUsers();

                    $notification_users->user_id = $value;
                    
                    $notification_users->notification_id = $notifications->id;
        
                    $notification_users->created_by = Auth::user()->id;
        
                    $notification_users->save();  

                }

            }

        } 
        else if($request->sent_type == 'department'){

            $users = new User();
            
            $department_wise_users = $users->whereIn('department_id',$request->departments)->get();

            if($department_wise_users){

                foreach($department_wise_users as $key=>$value){

                    DB::table('notice_users')->insert(['notice_id'=>$notice,'user_id'=>$value->id,'created_at'=>date('Y-m-d H:i:s')]);

                        $ids[] = $value->id;

                        $notification_users  =   new \App\Models\NotificationUsers();
        
                        $notification_users->user_id = $value->id;
                        
                        $notification_users->notification_id = $notifications->id;
            
                        $notification_users->created_by = Auth::user()->id;
            
                        $notification_users->save();  
        
                }

            }

        }
        
        elseif ($request->sent_type == 'lead') {

            $data  = DB::table('users');

            if (Auth::user()->roles[0]->type == 'manager') {

                $data = $data->orWhere('users.assigned_to', Auth::user()->id);

            } else {

                if (Auth::user()->is_lead) {

                    $data = $data->orWhere('users.lead_id', Auth::user()->id);
                }
            }

            $result = $data->where('users.is_lead', 1)->get();

            if (isset($request->id)) {

                $notice  =  $request->id;

                DB::table('notice_users')->where('notice_id', $request->id)->delete();
            }

            foreach ($result as $key => $value) {

                $notice_user = DB::table('notice_users')->insert([

                    'notice_id' => $notice,

                    'user_id' => $value->id,

                    'created_at' => date('Y-m-d H:i:s')

                ]);


                $ids[] = $value->id;

                $notification_users  =   new \App\Models\NotificationUsers();

                $notification_users->user_id = $value->id;
                
                $notification_users->notification_id = $notifications->id;
    
                $notification_users->created_by = Auth::user()->id;
    
                $notification_users->save();  

            }

        } elseif ($request->sent_type == 'all_team') {
    
            $data  = DB::table('users');

            if (Auth::user()->is_lead) {

                $data = $data->orWhere('users.lead_id', Auth::user()->id)->get();
            }

            if (isset($request->id)) {

                $notice  =  $request->id;

                DB::table('notice_users')->where('notice_id', $request->id)->delete();

            }

            foreach ($data as $key => $value) {

                $notice_user = DB::table('notice_users')->insert([

                    'notice_id' => $notice,

                    'user_id' => $value->id,

                    'created_at' => date('Y-m-d H:i:s')

                ]);


                $ids[] = $value->id;

                $notification_users  =   new \App\Models\NotificationUsers();

                $notification_users->user_id = $value->id;
                
                $notification_users->notification_id = $notifications->id;
    
                $notification_users->created_by = Auth::user()->id;
    
                $notification_users->save();  


            }

        }
        $this->alert_notify(null,null,$ids);
        return redirect()->route('noticeboard.index')->with('success', 'Notice save successfully!');
    }
}
