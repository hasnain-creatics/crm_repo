@extends('layouts.app')

@section('content')
<!--Page header-->
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title mb-0 text-primary"></h4>
    </div>
    <div class="page-rightheader">
        <div class="btn-list">
        <a href="{{url('admin/roles')}}" class="btn btn-primary btn-pill" >
            
        <i class="fa fa-arrow-left"></i> Back</a>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Roles & Permissions</div>
            </div>
            
                      <form method="POST" action="{{url('admin/roles/permissions/update_permission')}}"> 
                   
                    
                   <!--   <form method="POST" action="{{url('admin/roles/permissions/update_permission')}}"> --> 
                        @csrf
                        
                            <!-- <roles-permission-component role_id="{{$id}}"></roles-permission-component> -->
                              
                                <input type="hidden" name="name" value="{{$role->id}}">
                        

                        
                             <!-- <roles-permission-component role_id="{{$id}}"></roles-permission-component>  -->
                             <?php 

                                    $modules_array = [];
                                    $permission_array = [];
                                    $permission_id_array =[];
                             ?>
                             @foreach($permissions as $value)
                              
                                      <?php   
                                        $modules_array[] = explode('-',$value->name)[0];
                                        $permission_array[] = $value->name;
                                        $permission_id_array[] = $value->id;
                                      ?> 
                                    
                            @endforeach
                       


                    <div class="row" style="margin-top: 20px; margin-left: 20px;margin-right: 20px;">
                    <div class="col-xs-12" >
                  <table class="table  table-hover table-responsive table-striped">
                  		<tr >
                        <tr>
                                	<td>
                                
                                    {{$role->name}}
                                <input type="hidden" name="name" value="{{$role->id}}">
                                </td>
                                    
                                </tr>
                            <td style="width:5%;">Module</td>
                        	<td style="width:5%;">View</td>
                            <td style="width:5%;">Add</td>
                            <td style="width:5%;">Update</td>
                            <td style="width:5%;">Delete</td>
                         
                           
                        </tr>
                       
                     @foreach($modules as $keys=>$values)
                  
                    <tr>
                   
                              
                    <td style="text-transform: capitalize;">{{$values->name}} </td>
                        @if(in_array($values->name, $modules_array)) 
                                     @foreach($permission_array as $perm_key=>$perm_value)
                                        <?php 
                                            $exp_perm = explode('-',$perm_value)[0];
                                            $exp_perm1 = explode('-',$perm_value);
                                            if($values->name == $exp_perm){ ?>
                                            <td>
                                            <?php 
                                                if(isset($exp_perm1[1])){ ?>
                                                     <input type="checkbox" name="permission[]"  id="{{ $perm_value }}" value="{{$permission_id_array[$perm_key]}}" class="name" {{in_array($permission_id_array[$perm_key], $rolePermissions) ? 'checked'     :''}}>
                                                   <?php 
                                                }else{?>
                                                    <input type="checkbox" name="permission[]"  id="{{ $perm_value }}" value="{{$permission_id_array[$perm_key]}}" class="name" {{in_array($permission_id_array[$perm_key], $rolePermissions) ? 'checked'     :''}}>
                                                   <?php
                                                }
                                            ?>
                                            </td>
                                            <?php   
                                            }
                                        ?>

                                     @endforeach

                        @endif
  
                </tr>
                
                @endforeach
                       

              
                       
                  </table>
                  
                </div>
                          <div class="col-12" style="margin-bottom: 25px;" >
                        <div class="row">
                       
                        <input type="submit" class="btn btn-primary" >
                        
                         </div>      
                        </div>        
                        </div>
                     
                      
                       <!--  </form> -->
                    </div>
                     </form>  
            </div>
        </div>

   
@endsection



