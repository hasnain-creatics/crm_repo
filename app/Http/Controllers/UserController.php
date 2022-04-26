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

class UserController extends Controller
{
    public function __construct(){

        //  $this->middleware('permission:user-view|user-create|user-edit|user-delete', ['only' => ['index','update']]);
        //  $this->middleware('permission:user-create', ['only' => ['create','update']]);
        //  $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:user-delete', ['only' => ['destroy']]);
        //  // $this->middleware('permission:user-list', ['only' => ['index']]);
        // $this->middleware('permission:user-view', ['only' => ['index']]);
    }

    public function index(Request $request)
    {
        // print_r(Auth::roles());
        // die;
        if ($request->ajax()) {

            $data = User::select('users.id',DB::raw('CONCAT(users.first_name," ",users.last_name) AS name'),
                                    'users.email',
                                    'users.phone_number',
                                    'users.status',
                                    'users.designation',
                                    DB::raw('CONCAT(assu.first_name," ",assu.last_name) AS assigned_name'));
                            
            if(isset($_GET['role']) && !empty($_GET['role'])){

                $role = $_GET['role'];
            
                $data = $data->where('users.designation',$_GET['role']);

            }

            $data = $data->with('roles');

            $data = $data->leftJoin('users as assu','users.assigned_to','=','assu.id');       

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
        

            $data = $data->orderBy('users.id','DESC');             

            return $this->table($data,'users');   

        }

        $data['designation'] = Role::get();

        return view('user.index',$data);

    }

    public function get_users(){

        $users = User::orderBy('id','desc')->paginate(10);
        
        return response()->json($users);

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

        $result = User::find($id);

        return view('user.edit',compact('result'));

    }


    public function fetch_all_designation(){

        return response()->json(Role::get(),200);

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
        //
    }

    public function fetch_managers($id){

        // $users = User::whereHas(['roles' => function($q){
        //     $q->where('id', $id);
        // }])->get();
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
            $data['data'] = User::select('id',DB::raw('CONCAT(first_name," ",last_name) AS name'))->whereHas('roles', function($q) use ($role){
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

        $user_update->assigned_to = $request->assigned_to;

        $user_update->status = $request->status;

        $user_update->dob = $request->dob;
       
        $user_update->save();

        if ($request->file('profile_image_id')) {

            $file = $request->file('profile_image_id');

            $this->user_profile_update($request->file('profile_image_id'), $user_update->id);

        }

        DB::table('model_has_roles')->where('model_id',$user_update->id)->delete();
    
        $user_update->assignRole($request->designation);

        return  redirect()->back()->with('success', 'User save successfully!');   
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
