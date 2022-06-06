<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User; 
use Spatie\Permission\Models\Role;
use App\Models\City;
use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserEditRequest;
use DB;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
class UserController extends Controller
{
    public function __construct(){

        $this->middleware('permission:user-add', ['only' => ['create','update']]);
         
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);

        $this->middleware('permission:user-view', ['only' => ['index']]);
         
    }

    public function index(Request $request){

        if ($request->ajax()) {
            
                                $data = User::select('users.id',DB::raw('CONCAT(users.first_name," ",users.last_name) AS name'),

                                     'users.email',

                                     'users.profile_image_id as profile_image',
            
                                     'users.phone_number',
            
                                     'users.status',
            
                                     'users.designation',

                                     'users.is_lead',
            
                                     DB::raw('CONCAT(assu.first_name," ",assu.last_name) AS assigned_name'),

                                     DB::raw('CONCAT(assl.first_name," ",assl.last_name) AS lead_name')
            
            );
                            
           if(isset($_GET['role']) && !empty($_GET['role'])){

               $role = $_GET['role'];
           
               $data = $data->where('users.designation',$_GET['role']);

           }

           $data = $data->with('roles');

           $data = $data->leftJoin('users as assu','users.assigned_to','=','assu.id');

           $data = $data->leftJoin('users as assl','users.lead_id','=','assl.id');       

           if(isset($_GET['status']) && !empty($_GET['status'])){
       
               $status = $_GET['status'];
   
               $data = $data->where('users.status',$status);  
       
           }

           if(isset($_GET['phone']) && !empty($_GET['phone'])){
       
               $phone = $_GET['phone']; 

               $data = $data->where('users.phone_number','LIKE','%'.$phone.'%');     
       
           }

           if(isset($_GET['email']) && !empty($_GET['email'])){
       
               $email = $_GET['email'];

               $data = $data->where('users.email','LIKE','%'.$email.'%');    
           
           }
       
        //    if($this->is_admin() != true){

            //    $data->where(['users.id'=>Auth::user()->id]);

            //    $data->orWhere(['users.assigned_to'=>Auth::user()->id]);

            if($this->is_admin() != true){

                $data = $data->where('users.id',Auth::user()->id);

                if(Auth::user()->roles[0]->type == 'manager'){

                    $data = $data->orWhere('users.assigned_to',Auth::user()->id);

                }else{
                    
                    if(Auth::user()->is_lead){

                        $data = $data->orWhere('users.lead_id',Auth::user()->id);
     
                    }
                }
              
            }


        //    }

        //    $data = $data->orderBy('users.id','DESC');             

           return $this->table($data,'users');   

        }

        $data['designation'] = Role::get();

        return view('user.index',$data);

    }

    public function get_users(){

        $users = User::orderBy('id','desc')->paginate(10);
        
        return response()->json($users);

    }

    public function get_all_users(){



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
        
        return response()->json($data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $data['roles'] = Role::get();

        return view('user.add',$data);

    }

    public function edit($id){

        $result = User::findOrFail($id);

        return view('user.edit',compact('result'));

    }


    public function fetch_all_designation(){

        $data = $roles = new Role();

        // if($this->is_admin() != true){  
        
        //     $data = $data->where('name',Auth::user()->roles[0]->name);
        
        // }
        
        $data = $data->get();
        
        return response()->json($data,200);

    }

    public function fetch_cities(){

        return response()->json(City::get(),200);

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
        $data['user_details']= DB::table('users')

        ->leftJoin('cities','cities.id','=','users.city_id')

        ->leftJoin('roles','roles.id','=','users.designation')

        ->leftJoin('users as assu','users.assigned_to','=','assu.id')

        ->leftJoin('users as assl','users.lead_id','=','assl.id')

            ->select('users.id',DB::raw('CONCAT(users.first_name," ",users.last_name) AS f_name'),
                        
                        'roles.name',

                        'roles.type as role_type',
                        
                        'cities.title',
                        
                        'users.email',

                         'users.profile_image_id as profile_image',

                         'users.phone_number',
                
                         'users.salary',

                         'users.status as statuss',

                         'users.designation',
                        
                         'users.nickname',

                         'users.lead_id as lead_idd' ,

                         'users.is_lead as is_leadd' ,

                         DB::raw('CONCAT(assu.first_name," ",assu.last_name) AS assigned_name'),

                         DB::raw('CONCAT(assl.first_name," ",assl.last_name) AS lead_name')

                )->where('users.id',$id)->first();

                $data['teams'] = [];
                // if($data['user_details']->role_type == 'manager'){

                // }
      
            
                  $teams = DB::table('users')

                    ->leftJoin('roles','roles.id','=','users.designation')

                    ->select('users.id',DB::raw('CONCAT(users.first_name," ",users.last_name) AS f_namemm'),
                    
                    'roles.name',   

                    'users.email',

                     'users.profile_image_id as profile_image',

                     'users.phone_number',
            
                     'users.salary',

                     'users.status as statuss',

                     'users.designation',
                    
                     'users.nickname',

                     'users.lead_id as lead_idd' ,

                     'users.is_lead as is_leadd' ,

                    

                );
                if($data['user_details']->role_type == 'manager'){
                    $teams = $teams->where('users.assigned_to','=',$data['user_details']->id);
                }
                if($data['user_details']->is_leadd ){
                    $teams = $teams->where('users.lead_id','=',$data['user_details']->id);
                }
                $data['teams'] =     $teams->get();

                return view('modals.users.view_user',$data);

    }

    public function fetch_leads($id){
        $role = "";

        $role_name = Role::find($id)->name;

        $data['status'] = 'error';

        $data['data'] = [];

        if($role_name == 'Sale Agent' || $role_name == 'sale agent'){

            $role = 'Sale Agent';

            $data['status'] = 'success';

        }


        if($role_name == 'Writer' || $role_name == 'write'){

            $role = 'Writer';

            $data['status'] = 'success';


        }

        if($data['status'] == 'success'){

            $data['data'] = User::select('id',DB::raw('CONCAT(first_name," ",last_name) AS name','is_lead','lead_id'))
            ->where('is_lead','!=',NULL)
            ->whereHas('roles', function($q) use ($role){
                $q->whereIn('name', [$role]);
                })->get();

        }
    
        return response()->json($data);
    }

    public function fetch_managers($id){

        $role = "";

        $role_name = Role::find($id)->name;

        $data['status'] = 'error';

        $data['data'] = [];

        if($role_name == 'Sale Agent' || $role_name == 'sale agent'){

            $role = 'Sale Manager';

            $data['status'] = 'success';

        }

        if($role_name == 'Writer' || $role_name == 'write'){

            $role = 'Writer Manager';

            $data['status'] = 'success';

        }

        if($data['status'] == 'success'){

            $data['data'] = User::select('id',DB::raw('CONCAT(first_name," ",last_name) AS name','is_lead','lead_id'))->whereHas('roles', function($q) use ($role){
                $q->whereIn('name', [$role]);
            })->get();
    
        }
        
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserAddRequest $request,User $user)
    {
            Artisan::call('cache:forget spatie.permission.cache');
        $validated = $request->validated();
        
        $user_update = $user;

        if(isset($request->id)){

            $user_update = $user->find($request->id);

        }   

        $user_update->first_name = $request->first_name;

        $user_update->last_name = $request->last_name;

        $user_update->email = $request->email;

        $user_update->password =  Hash::make($request->password);
     
        $user_update->designation = $request->designation;

        $user_update->phone_number = $request->phone_number;

        $user_update->alternate_phone_number = $request->alternate_phone_number;

        $user_update->salary = $request->salary;

        $user_update->city_id = $request->city_id;

        $user_update->nickname = $request->nickname;

        if(isset($request->assigned_to)){

            $user_update->assigned_to = $request->assigned_to;

        }

        $user_update->status = $request->status;

        $user_update->dob = $request->dob;
        
        $user_update->is_lead = NULL;

        $user_update->lead_id = NULL;

        if($request->is_lead){

            $user_update->is_lead = 1;            

        }

        if($request->lead_id){

            $user_update->lead_id = $request->lead_id;

        }

        $user_update->save();

        if ($request->file('profile_image_id')) {

            $file = $request->file('profile_image_id');

            $this->user_profile_update($request->file('profile_image_id'), $user_update->id);

        }

        DB::table('model_has_roles')->where('model_id',$user_update->id)->delete();
    
        $user_update->assignRole($request->designation);

        // return  redirect()->back()->with('success', 'User save successfully!');   
        return  redirect()->route('user.index')->with('success', 'User save successfully!');    
    }



    public function profile()
    {
       
        $user = Auth::user();
        return view('user.profile', compact('user'));

            
        //    $data['user_details']= DB::table('users')->where('id',$id)->first();
       
        // return view('user.profile',$data);

    }


    public function profile_update(Request $request,User $user)
    {
        
         $user_update = $user;

        if(isset($request->id)){

           $user_update = $user->find($request->id);

        }  
      
        // $user_update->first_name = $request->first_name;

        // $user_update->last_name = $request->last_name;

        // $user_update->email = $request->email;

        $user_update->password =  Hash::make($request->password);
     
        $user_update->save();

        if ($request->file('profile_image_id')) {

            $file = $request->file('profile_image_id');

            $this->user_profile_update($request->file('profile_image_id'), $user_update->id);

        }


        return  redirect()->back()->with('success', 'User Profile successfully Updated!');   
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,User $user)
    {   
        $users =  $user->findOrFail($id);
        $users->delete();
        return redirect()->back()->with('success', 'User deleted successfully!');   
    }

    public function check_email_exists(Request $request, User $user){

        $user_email = $user->where('email',$request->email);

        if(isset($request->id)){
        
            $user->where('id','!=',$request->id);
        
        }
        
        $user_email = $user_email->get();
        
        $data['email'] = $request->email;
        
        $data['status'] = 'success';
        
        if(count($user_email)>0){
        
            $data['data'] = $user_email;
        
            $data['email'] = $request->email;
        
            $data['status'] = 'error'; 
        
        }

        return response()->json($data);

    }

    public function status_update($id,User $user){

        $users = $user->findOrFail($id);

        if($users->status == "ACTIVE"){

            $users->status = 'INACTIVE';

        }else 
        
        if($users->status == NULL || $users->status == 'INACTIVE'){

            $users->status = 'ACTIVE';

        }

        $users->save();

        return response()->json(['status'=>'success']);

    }

}
