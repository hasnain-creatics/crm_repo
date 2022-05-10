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
                                                    <input type="hidden" name="id" value="{{$result->id}}">
                                                    <div class="form-group col-md-4">
                                                                <label for="" class="form-label">First Name</label>
                                                                <input type="text" value="{{$result->first_name}}" class="form-control @error('first_name') is-invalid @enderror" name="first_name">
                                                                @error('first_name')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                    <div class="form-group col-md-4">
                                                                <label for="" class="form-label">Last Name</label>
                                                                <input type="text"   value="{{$result->last_name}}" class="form-control @error('last_name') is-invalid @enderror" name="last_name">
                                                                @error('last_name')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>  
                                                    <div class="form-group col-md-4">
                                                                <label for=""  class="form-label @error('email') is-invalid @enderror">Email</label>
                                                                <input type="text"  value="{{$result->email}}"  class="form-control" name="email">
                                                                @error('email')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>        
                                                </div>


                                                <div class="input-group">
                                                    
                                                    <div class="form-group col-md-4">
                                                        <label for="" class="form-label">Nickname</label>
                                                        <input type="text" id="nickname" class="form-control" name="nickname" value="{{@$result->nickname}}">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="" class="form-label">Password</label>
                                                        <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                                        @error('password')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="" class="form-label">Confirm Password</label>
                                                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"  name="password_confirmation">
                                                        @error('password_confirmation')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>          
                                                </div>



                                     

                                                <div class="input-group">
                                                    <div class="form-group col-md-3">
                                                        <label for="" class="form-label">Designation</label>
                                                        <select name="designation" class="form-control custom-select designation_id select2 select2-hidden-accessible @error('designation') is-invalid @enderror"  id="designation">
                                                           
                                                        </select>
                                                        @error('designation')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="assignTo form-group col-md-3 d-none" >
                                                        <label for="" class="form-label">Assign To</label>
                                                        <select name="assigned_to" class="form-control custom-select select2 select2-hidden-accessible" tabindex="-1" id="assigned_to"   aria-hidden="true">
                                                            
                                                        </select>
                                                    </div> 
                                                    
                                                    <div class="assignTo form-group col-md-3 d-none" style="margin-top: 35px;">
                                                        <label for="lead" >Make this user Lead</label>
                                                        <input type="checkbox" id="lead" name="is_lead" >
                                                    </div> 
                                                    
                                                    <div class="assignTo assignLead form-group col-md-3 d-none" id="assignLead" >
                                                        <label for="" class="form-label">Assign Lead</label>
                                                        <select name="lead_id" class="form-control custom-select select2 select2-hidden-accessible" tabindex="-1" id="lead_id"   aria-hidden="true">
                                                            
                                                        </select>
                                                    </div> 
                                                     
                                                </div>


                                                <div class="input-group">
                                                    <div class="form-group col-md-6">
                                                        <label for="" class="form-label">Phone Number</label>
                                                        <input type="number" value="{{$result->phone_number}}" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number">
                                                        @error('phone_number')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="" class="form-label">Alterante Phone Number</label>
                                                        <input type="number"  value="{{$result->alternate_phone_number}}" class="form-control @error('alternate_phone_number') is-invalid @enderror" name="alternate_phone_number">
                                                        @error('alternate_phone_number')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>          
                                                </div>

                                                <div class="input-group">
                                                    <div class="form-group col-md-6">
                                                        <label for="" class="form-label">Salary</label>
                                                        <input type="number" class="form-control  @error('salary') is-invalid @enderror" value="{{$result->salary}}" name="salary">
                                                        @error('salary')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="" class="form-label">City</label>
                                                        <select name="city_id" id="city_id" class="form-control custom-select select2 select2-hidden-accessible " tabindex="-1" id="city_id" aria-hidden="true">
                                                            
                                                        </select>
                                                        @error('city_id')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    
                                                    </div>          
                                                </div>

                                                <div class="input-group">
                                                    <div class="form-group col-md-6"> <label for="" class="form-label">Status</label>
                                                    <select name="status" class="form-control custom-select select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                                            <option value="inactive" {{$result->status == 'INACTIVE' ? 'selected' : ''}}>Inactive</option>
                                                            <option value="active" {{$result->status == 'ACTIVE' ? 'selected' : ''}}>Active</option>
                                                    </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="" class="form-label">Date</label>
                                                        <div class="wd-200 mg-b-30">
                                                            <div class="input-group">
                                                                <input class="form-control datepicker fc-datepicker hasDatepicker @error('dob') is-invalid @enderror"  value="{{$result->dob}}"  name="dob" type="date" id="dp1650702357798">
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
                                                        <img id="user_image_view" class="user_image_view" src="
                                                <?php echo (trim($result->profile_image_id) ? url('storage/app/'.trim($result->profile_image_id)) : asset('public/assets/images/no_image.jpg')); ?>" alt="your image" />

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

<script>

$(document).ready(function(){
    
    $('#designation').html(all_designations("{{route('fetch_all_designation')}}","{{$result->designation}}"));
    
    $('#city_id').html(all_cities("{{route('fetch_cities')}}","{{$result->city_id}}"));
   
    var checked_value = "{{$result->is_lead}}";

    if(checked_value){

     $('input[name="is_lead"]').prop('checked',true);   
     
         $('#assignLead').removeClass('d-block').addClass('d-none');
     
    }

    setTimeout(function(){lead_checkes('{{url("admin/user/fetch_leads")}}',"{{$result->lead_id}}");},1000);

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
            }, 
            email:{
                required: true,
                         email: true,
                         // accept:"[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}" 
            },  
            password:{
  
              minlength : 8,

            },
            password_confirmation:{
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
              required:true,
            },
            salary:{
              required:true,
            },
            // city_id:{
            //   required:true,
            // }
        },
        submitHandler: function (form) { // for demo
            form.submit();
            
            // return false; // for demo
        }
    });

});

function manager_designation(id=null){
    var designation = $('#designation').val();
        $.ajax({
            url:'{{url("admin/user/fetch_managers")}}/'+designation,
            dataType:'json',
            type:'get',
            success:function(data){
                if(data.status == 'success'){
                    var html = "";
                    html +="<option value=''>Select Manager</option>";
                    for(i = 0;i<data.data.length;i++){
                        html +="<option value="+data.data[i].id+">"+data.data[i].name+"</option>";
                    }
                    $('.assignTo').removeClass('d-none').addClass('d-block');
                    $('#assigned_to').html(html);
                }else{
                    $('.assignTo').removeClass('d-block').addClass('d-none');
                    $('#assignLead').removeClass('d-block').addClass('d-none');
                }
                if(id){
                    $('#assigned_to').val(id).trigger('change');

            }
            }
           

        });
}

$(document).on('change','#designation',function(){
  
    manager_designation("{{$result->assigned_to}}");

});


$(document).on('change',"input[name='email']",function(){
    var email = $("input[name='email']").val();
    var id = $("input[name='id']").val(); 
    $.ajax({
        url:"{{route('check_email_exists')}}",
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
        dataType:'json',
        type:'post',
        data: {email:email,id:id},
        success:function(data){
           if(data.status == 'error')
           alert('email already exists!');
           $("input[name='email']").val("{{$result->email}}");
        }
    });
})


$(document).on('click','#lead',function(){

   lead_checkes('{{url("admin/user/fetch_leads")}}');

});


</script>
@endsection
