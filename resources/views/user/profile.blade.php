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
                <div class="card-title">User Profile</div>
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
                      
                                    <form action="{{route('user.profile_update')}}" method="post" class="user_form" id="user_form" enctype="multipart/form-data">
                                    @csrf
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="input-group">
                                                <input type="hidden" name="id" value="{{$user->id}}">
                                                    <div class="form-group col-md-4">
                                                                <label for="" class="form-label">First Name</label>
                                                                <input readonly type="text" value="{{$user->first_name }}" class="form-control @error('name') is-invalid @enderror" name="first_name">
                                                                @error('first_name')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                    <div class="form-group col-md-4">
                                                                <label for="" class="form-label">Last Name</label>
                                                                <input readonly type="text"  value="{{$user->last_name }}" class="form-control @error('last_name') is-invalid @enderror" name="last_name">
                                                                @error('last_name')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>  
                                                    <div class="form-group col-md-4">
                                                                <label for="" class="form-label @error('email') is-invalid @enderror">Email</label>
                                                                <input readonly  type="text" value="{{$user->email }}" class="form-control" name="email">
                                                                @error('email')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>        
                                                </div>


                                                <div class="input-group">
                                                    
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
                                                        <?php echo (trim($user->profile_image_id) ? url('storage/app/'.trim($user->profile_image_id)) : asset('public/assets/images/no_image.jpg')); ?>" alt="your image" />

     
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


       




</script>
@endsection
