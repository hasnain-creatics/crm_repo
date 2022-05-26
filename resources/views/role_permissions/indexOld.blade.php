@extends('layouts.app')

@section('content')
<!--Page header-->
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title mb-0 text-primary"></h4>
    </div>
    <div class="page-rightheader">
        <div class="btn-list">
            <a href="{{route('role.add')}}" class="btn btn-primary btn-pill" >
                <i class="fa fa-plus"></i> Add New</a>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Roles & Permissions</div>
            </div>
            <div class="card-body">
                      <form method="POST" action="{{url('admin/roles/permissions/update_permission')}}"> 
                   
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                   <!--   <form method="POST" action="{{url('admin/roles/permissions/update_permission')}}"> 
                    -->     @csrf
                        <div class="row">
                            <!-- <roles-permission-component role_id="{{$id}}"></roles-permission-component> -->
                                {{$role->name}}
                                <input type="hidden" name="name" value="{{$role->id}}">
                        </div>
                        <br>
                        <br>

                         <div class="row">       
                          <div class="col-lg-12">
                                     <div class="input-group">
                            <!-- <roles-permission-component role_id="{{$id}}"></roles-permission-component> -->
                            @foreach($permissions as $value)
                               <div class="form-group col-md-6">     
                                    <label for="{{ $value->name }}"> 
                                      {{ ucwords(str_replace("-", " ", $value->name)); }}
                                    </label>   
                                </div>    
                                <div class="form-group col-md-6">      
                                            <input type="checkbox" name="permission[]"  id="{{ $value->name }}" value="{{$value->id}}" class="name" {{in_array($value->id, $rolePermissions) ? 'checked'     :''}}>
                            
                               </div>    
                            @endforeach
                        </div>
                        </div>  
                    </div>
                        <div class="row">
                        <input type="submit" class="btn btn-primary">
                                
                        </div>
                       <!--  </form> -->
                    </div>
                     </form>  
            </div>
        </div>

    </div>
</div>
@endsection



