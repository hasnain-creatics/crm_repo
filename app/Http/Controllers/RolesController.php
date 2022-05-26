<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Modules;
use Validator;
use Illuminate\Support\Facades\Artisan;
use Auth;
class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct(){

        //  $this->middleware('permission:user-list|user-add|user-edit|user-delete', ['only' => ['index','update']]);
        //  $this->middleware('permission:user-add', ['only' => ['create','update']]);
        //  $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:user-delete', ['only' => ['destroy']]);
        //  $this->middleware('permission:role-list', ['only' => ['index']]);
        //  $this->middleware('permission:role-add', ['only' => ['create']]);
        //  $this->middleware('permission:user-view', ['only' => ['index']]);

         $this->middleware('permission:role-add', ['only' => ['create','store']]);
         
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);

         $this->middleware('permission:role-view', ['only' => ['index']]);
         

    }

    public function index()
    {
       return view('roles.index');
    }

    public function get_roles()
    {
        
        $roles = new Role();

        $data = $roles->where("id","!=",1)->get();

        return response()->json($data);

    }


    public function role_permissions($id){
        $data['id'] = $id;
        $data['role'] = Role::find($id);
        $data['modules'] = Modules::get();
        $data['permissions'] = Permission::get();

        $rolePermissions = Permission::select('permissions.id')->leftJoin("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
            $rolesPermission =[];    
            if($rolePermissions){
                foreach($rolePermissions as $key=>$value){
                        $rolesPermission[] = $value->id;
                }
            }
        $data['rolePermissions'] = $rolesPermission;
        return view('role_permissions.index',$data);

    }
    public function update_permmission(Request $request){
        Artisan::call('cache:forget spatie.permission.cache');
        $role=Role::find($request['name']);
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('roles.permission',$request['name'])->with('success','Role created successfully');
    }

    public function get_role_permissions($id=null,Role $roles,Permission $permissions){

        $data['usere_roles'] = $roles->find($id);
        $data['id'] = $id;
        // $data['all_roles'] = $roles->get(); 
        $data['all_permissions'] = $permissions->get();
        return response()->json($data);

    }

    public function create(){

        return view('roles.add');

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $roles = new Role();

        $roles->name = $request->name;

        $roles->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $roles              = Role::find($id);
        

        $data['roles']      = $roles;

     

        return response()->json($data);
    
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['id']  = $id;

        return view('roles.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = [
            'name'      =>'required',
            'type'      =>'required'
        ];
        $messages = [
            'name'      =>'Name is required',
            'type'      =>'Role Type is required'
        ];
        
        $validator = Validator::make( $request->all(), $rules, $messages );

        if ( $validator->fails() ) 
        {
            $data = [
                'success' => 0, 
                'message'=>$validator->errors()
            ];
        }else{
            
            $form_data = [
                'name'   =>$request['name'],
                'type'   =>$request['type']
            ];
            
            if(isset($request['role_id'])){

                $role_already_exists = Role::where('id','!=',$request['role_id'])->where('name',trim($request['name']))->first();
               
                if($role_already_exists){
                    return response([
                        'success' => 0, 
                        'message'=> 'Role already exists'
                    ], 200)->header('Content-Type', 'text/plain');
                }
                
                Role::where('id',$request['role_id'])->update($form_data);

                $message = "Role update successfully!";

            }else{

                
                $role_already_exists = Role::where('name',trim($request['name']))->first();
                
                if($role_already_exists){
                    return response([
                        'success' => 0, 
                        'message'=> 'Role already exists'
                    ], 200)->header('Content-Type', 'text/plain');
                }
                

                Role::create($form_data);

                $message ='Role Updated Successfully';

            }
            
            $data =  [
                'success' => 1, 
                'message'=> $message
            ];
        }
        return response($data, 200)->header('Content-Type', 'text/plain');
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
