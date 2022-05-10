@extends('layouts.app')

@section('content')

<!--Page header-->
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title mb-0 text-primary"></h4>
    </div>
    <div class="page-rightheader">
        <div class="btn-list">
            <a href="{{route('leads.home')}}" class="btn btn-primary btn-pill" >
                <i class="fa fa-arrow-left"></i> Back</a>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Add Lead</div>
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
                                                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="first_name">
                                                                @error('first_name')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                    <div class="form-group col-md-4">
                                                                <label for="" class="form-label">Last Name</label>
                                                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name">
                                                                @error('last_name')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>  
                                                    <div class="form-group col-md-4">
                                                                <label for="" class="form-label @error('email') is-invalid @enderror">Email</label>
                                                                <input type="text" class="form-control" name="email">
                                                                @error('email')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>        
                                                </div>


                                                <div class="input-group">
                                                    <div class="form-group col-md-4">
                                                        <label for="" class="form-label">Nickname</label>
                                                        <input type="text" id="nickname" class="form-control" name="nickname">
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
                                                        <select name="designation" class="form-control designation_id custom-select select2 select2-hidden-accessible @error('designation') is-invalid @enderror"  id="designation">
                                                           
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
                                                    
                                                    <div class="assignTo  form-group col-md-3 d-none" style="margin-top: 35px;">
                                                        <label for="lead" >Make this user Lead</label>
                                                        <input type="checkbox" id="lead" name="is_lead" >
                                                    </div> 
                                                    
                                                    <div class="assignTo assignLead form-group col-md-3 d-none"  id="assignLead">
                                                        <label for="" class="form-label">Assign Lead</label>
                                                        <select name="lead_id" class="form-control custom-select select2 select2-hidden-accessible" tabindex="-1" id="lead_id"   aria-hidden="true">
                                                            
                                                        </select>
                                                    </div> 
                                                     
                                                </div>


                                                <div class="input-group">
                                                    <div class="form-group col-md-6">
                                                        <label for="" class="form-label">Phone Number</label>
                                                        <input type="number" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number">
                                                        @error('phone_number')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="" class="form-label">Alterante Phone Number</label>
                                                        <input type="number" class="form-control @error('alternate_phone_number') is-invalid @enderror" name="alternate_phone_number">
                                                        @error('alternate_phone_number')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>          
                                                </div>

                                                <div class="input-group">
                                                    <div class="form-group col-md-6">
                                                        <label for="" class="form-label">Salary</label>
                                                        <input type="number" class="form-control  @error('salary') is-invalid @enderror" name="salary">
                                                        @error('salary')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="" class="form-label">City</label>
                                                        <select name="city_id" id="city_id" class="form-control custom-select select2 select2-hidden-accessible  @error('alternate_phone_number') is-invalid @enderror" tabindex="-1" id="city_id" aria-hidden="true">
                                                            
                                                        </select>
                                                        @error('city_id')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    
                                                    </div>          
                                                </div>

                                                <div class="input-group">
                                                    <div class="form-group col-md-6"> <label for="" class="form-label">Status</label>
                                                    <select name="status" class="form-control custom-select select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                                            <option value="inactive">Inactive</option>
                                                            <option value="active">Active</option>
                                                    </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="" class="form-label">Date</label>
                                                        <div class="wd-200 mg-b-30">
                                                            <div class="input-group">
                                                         
                                                                <input class="form-control datepicker fc-datepicker hasDatepicker @error('dob') is-invalid @enderror" name="dob"  type="date" id="dp1650702357798">
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
    

</script>
@endsection
