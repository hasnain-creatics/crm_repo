@extends('layouts.app')

@section('content')

<!--Page header-->
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title mb-0 text-primary"></h4>
    </div>
    <div class="page-rightheader">
        <div class="btn-list">
            <a href="{{route('user.index')}}" class="btn btn-primary btn-pill" >
                <i class="fa fa-arrow-left"></i> Back</a>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Add User</div>
            </div>
            <div class="card-body">
                            @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                            @php
                                Session::forget('success');
                            @endphp
                        </div>
                        @endif
    
                                    <form action="{{route('user.update')}}" method="post" class="user_form" id="user_form" enctype="multipart/form-data">
                                    @csrf
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="input-group">
                                                    
                                                    <div class="form-group col-md-4">
                                                                <label for="" class="form-label">First Name</label>
                                                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="first_name"  value="{{ old('first_name') }}">
                                                                @error('first_name')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                    <div class="form-group col-md-4">
                                                                <label for="" class="form-label">Last Name</label>
                                                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}">
                                                                @error('last_name')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>  
                                                    <div class="form-group col-md-4">
                                                                <label for="" class="form-label @error('email') is-invalid @enderror">Email</label>
                                                                <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                                                                @error('email')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>        
                                                </div>


                                                <div class="input-group">
                                                    <div class="form-group col-md-4">
                                                        <label for="" class="form-label">Nickname</label>
                                                        <input type="text" id="nickname" class="form-control" name="nickname" value="{{ old('nickname') }}">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="" class="form-label">Password</label>
                                                        <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}">
                                                        @error('password')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="" class="form-label">Confirm Password</label>
                                                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"  name="password_confirmation" value="{{ old('password_confirmation') }}">
                                                        @error('password_confirmation')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>          
                                                </div>



                                                <div class="input-group">
                                                    <div class="form-group col-md-3">
                                                        <label for="" class="form-label">Designation</label>
                                                        <select name="designation" class="form-select designation_id @error('designation') is-invalid @enderror"  id="designation">
                                                           
                                                        </select>
                                                        <span class="arrow "><label id="designation-error" class="error" for="designation" style="display:none">This field is required.</label></span>
                                                    </div>
                                                    <div class="assignTo form-group col-md-3 d-none" >
                                                        <label for="" class="form-label">Assign To</label>
                                                        <select name="assigned_to" class="form-select" tabindex="-1" id="assigned_to"   aria-hidden="true">
                                                            
                                                        </select>
                                                    </div> 
                                                    
                                                    <div class="assignTo  form-group col-md-3 d-none" style="margin-top: 35px;">
                                                        <label for="lead" >Make this user Lead</label>
                                                        <input type="checkbox" id="lead" name="is_lead" >
                                                    </div> 
                                                    
                                                    <div class="assignTo assignLead form-group col-md-3 d-none"  id="assignLead">
                                                        <label for="" class="form-label">Assign Lead</label>
                                                        <select name="lead_id" class="form-select" tabindex="-1" id="lead_id"   aria-hidden="true">
                                                            
                                                        </select>
                                                    </div> 
                                                  
                                                </div>
                                                <div class="is_qa form-group col-md-3 d-block" style="margin-top: 35px;">
                                                        <label for="is_qa" >Make this user QA</label>
                                                        <input type="checkbox" id="is_qa" name="is_qa" value="{{ old('is_qa') }}">
                                                </div> 
                                                    
                                                <div class="is_qa form-group col-md-3 d-block" style="margin-top: 35px;">
                                                        <label for="is_qa" >Department</label>
                                                        <!-- <input type="checkbox" id="department_id" name="department_id" value="{{ old('department_id') }}"> -->
                                                        <select name="department_id" class="form-select" tabindex="-1" id="department_id"   aria-hidden="true">
                                                            
                                                        </select>
                                                </div> 

                                                <div class="input-group">
                                                    <div class="form-group col-md-6">
                                                        <label for="" class="form-label">Phone Number</label>
                                                        <input type="number" value="{{ old('phone_number') }}" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number">
                                                        @error('phone_number')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="" class="form-label">Alterante Phone Number</label>
                                                        <input type="number" class="form-control @error('alternate_phone_number') is-invalid @enderror" name="alternate_phone_number" value="{{ old('alternate_phone_number') }}">
                                                        @error('alternate_phone_number')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>          
                                                </div>

                                                <div class="input-group">
                                                    <div class="form-group col-md-6">
                                                        <label for="" class="form-label">Salary</label>
                                                        <input type="number" class="form-control  @error('salary') is-invalid @enderror" name="salary" value="{{ old('salary') }}">
                                                        @error('salary')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="" class="form-label">City</label>
                                                        <select name="city_id" id="city_id" class="form-select  @error('alternate_phone_number') is-invalid @enderror" tabindex="-1" id="city_id" aria-hidden="true">
                                                            
                                                        </select>
                                                        @error('city_id')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    
                                                    </div>          
                                                </div>

                                                <div class="input-group">
                                                    <div class="form-group col-md-6"> <label for="" class="form-label">Status</label>
                                                    <select name="status" class="form-select" tabindex="-1" aria-hidden="true">
                                                            <option value="inactive">Inactive</option>
                                                            <option value="active">Active</option>
                                                    </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="" class="form-label">Date</label>
                                                        <div class="wd-200 mg-b-30">
                                                            <div class="input-group">
                                                         
                                                                <input class="form-control datepicker fc-datepicker hasDatepicker @error('dob') is-invalid @enderror" name="dob"  type="date" value="{{ old('dob') }}" id="dp1650702357798">
                                                                @error('dob')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                                
                                                            </div>
                                                        </div>
                                                    </div>          
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-4">
                                                <div class="input-group">
                                                        <div class="form-group col-md-6"> 
                                                                <input type="file" name="profile_image_id" onchange="readURL(this);" >
                                                        </div>
                                                </div>

                                                <div class="input-group">
                                                        <div class="form-group col-md-6"> 
                                                        <img id="user_image_view" class="user_image_view" src="{{ asset('public/assets/images/no_image.jpg') }}" alt="your image" />

                                                        </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="input-group">
                                                        <div class="form-group col-md-6"> 
                                                                <input type="submit" value="submit" class="btn btn-primary" >
                                                        </div>
                                                </div>
                                            </div>
                                        </div>


                                    </form>





          
                </div>
             </div>

    </div>
</div>
@endsection

@section('after_script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>
<script>
    

$(document).ready(function(){
    
    fetch_departments("{{route('departments.active_departments')}}");

    $('.date_picker input').datepicker({
           format: "dd.mm.yyyy",
           todayBtn: "linked",
           language: "de"
    });

   all_designations("{{route('fetch_all_designation')}}")
    
    all_cities("{{route('fetch_cities')}}")
  
    $('#user_form').validate({

    errorPlacement: function(label, element) {
        label.addClass('arrow');
        label.insertAfter(element);
    },
    wrapper: 'span',
        rules: {
            first_name: {
                required: true
            },
            last_name:{
              required:true
            },
            profile_image_id:{
                // required:true,
              accept: "image/jpg,image/jpeg,image/png,image/gif",
              // message: "only image accepted"
               // messages: {
               //      number: "only image accepted"
               //  },
            //    filesize: 1048576  
            }, 
            email:{
                required: true,
                         email: true,
                         // accept:"[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}" 
            },  
            password:{
              required:true,
              minlength : 8,

            },
            password_confirmation:{
              required:true,
              minlength : 8,
              equalTo : "#password"
            },
            designation:{
              required:true,
            },
            phone_number:{
              required:true,
            },
            alternate_phone_number:{
              required:false,
            },
            salary:{
              required:false,
            },
            department_id:{
              required:true,
            }
        },
        submitHandler: function (form) { // for demo
            form.submit();
            
            // return false; // for demo
        }
    });

$(document).on('change','#designation',function(){
  var designation = $('#designation').val();

  $.ajax({
    url:'{{url("admin/user/fetch_managers")}}/'+designation,
    dataType:'json',
    type:'get',
    success:function(data){
        if(data['status'] == 'success'){
            var html = "";
            html +="<option value=''>Select Manager</option>";
            for(i = 0;i<data['data'].length;i++){
                html +="<option value="+data['data'][i].id+">"+data['data'][i].name+"</option>";
            }
            $('.assignTo').removeClass('d-none').addClass('d-block');
            $('#assigned_to').html(html);            

        }else{
            $('.assignTo').removeClass('d-block').addClass('d-none');


        }
    }
  });
 
  lead_checkes('{{url("admin/user/fetch_leads")}}');
  

});


$(document).on('change',"input[name='email']",function(){
    var email = $("input[name='email']").val()
    $.ajax({
        url:"{{route('check_email_exists')}}",
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
        dataType:'json',
        type:'post',
        data: {email:email},
        success:function(data){
           if(data.status == 'error'){
            
            alert('Email already exists!');
            $("input[name='email']").val("");
            
           }
        }
    });
});

});


$(document).on('click','#lead',function(){

   lead_checkes('{{url("admin/user/fetch_leads")}}');
           
});


</script>
@endsection
