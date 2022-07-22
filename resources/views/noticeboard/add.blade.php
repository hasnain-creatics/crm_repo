@extends('layouts.app')

@section('content')

<!--Page header-->
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title mb-0 text-primary"></h4>
    </div>
    <div class="page-rightheader">
        <div class="btn-list">
            <a href="{{route('noticeboard.index')}}" class="btn btn-primary btn-pill" >
                <i class="fa fa-arrow-left"></i> Back</a>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Add Notice</div>
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
    
                                    <form action="{{route('noticeboard.update')}}" method="post" class="notice_form" id="notice_form" enctype="multipart/form-data">
                                    @csrf
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="input-group">
                                                    
                                                    <div class="form-group col-md-4">
                                                                <label for="" class="form-label">Title</label>
                                                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title">
                                                                @error('title')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                   
                                                    
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label for="" class="form-label">Notice</label>
                                                    <textarea name="description" class="ckeditor" id="" ></textarea>
                                                    @error('editor')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
															
											<div class="form-group col-md-3">
                                                        <label for="" class="form-label">Send Type</label>
                                                        <select  name="sent_type" id="sent_type" class="form-control input-text" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                            <option value="" >Select Send Type</option>
                                                                <option value="department">Departments</option>
                                                            @if(Auth::user()->roles[0]->type == 'manager')
                                                                <option value="Individually">Individually</option>
                                                                <option value="lead">Team Lead</option>
                                                            @elseif(Auth::user()->is_lead == '1')
                                                                <option value="Individually">Individually</option>
                                                                <option value="Individually" data-option="all_team">All Team Members</option>
                                                            @else
                                                                <option value="all">All</option>
                                                                <option value="Individually">Individually</option>
                                                                <option value="managers">Only Managers</option>
                                                            @endif        

                                                        </select>
                                                        <span class="arrow "><label id="sent_type-error" class="error" for="sent_type" style="display:none">This field is required.</label></span>
                                                    </div>
                                                    <div class="sentTo_all form-group col-md-3 d-none" >
                                                        <label for="" class="form-label">Select Users</label>
                                                        
                                                        <select name="Individually_users[]"   class="form-control custom-select  all_users"  id="Individually_users"   multiple  aria-hidden="true">
                                                            
                                                        </select>
                                                    </div> 
                                                    
                                                    <div class="send_to_department form-group col-md-3 d-none" >

                                                        <label for="" class="form-label">Select Departments</label>
                                                        <select name="departments[]" class="form-control custom-select departments" id="department_id" multiple aria-hidden="true">
                                                            
                                                        </select>
                                                    </div> 
                                                    
                                                   
                                                    	
															
												  
                                            <div class="col-lg-4">
                                                <div class="input-group">
                                                        <div class="form-group col-md-6"> 
                                                                <input type="submit" value="submit" class="btn btn-primary" >
                                                        </div>
                                                </div>
                                            </div>			
                                                   
                                                    
                                                </div>

                                               

                                               
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

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>


<script>
    

$(document).ready(function(){

  
    $('#notice_form').validate({

    errorPlacement: function(label, element) {
        label.addClass('arrow');
        label.insertAfter(element);
    },
    wrapper: 'span',
        rules: {
            title: {
                required: true
            },
           
            sent_type:{
              required:true
            },
            
          
        },
        submitHandler: function (form) { // for demo
            form.submit();
            
          
        }
    });

$(document).on('change','#sent_type',function(){
  var sent_type_value = $('#sent_type').val();


  if(sent_type_value == 'department'){
    $('.sentTo_all').removeClass('d-block').addClass('d-none');
    $('.send_to_department').removeClass('d-none').addClass('d-block');
    fetch_departments("{{route('departments.active_departments')}}");
    $("#department_id").select2();
      
  }else if(sent_type_value =='Individually'){

    $('.send_to_department').removeClass('d-block').addClass('d-none');

    if($('option:selected', this).attr('data-option')!='all_team'){

        $('.sentTo_all').removeClass('d-none').addClass('d-block');

    }else{

    }

    $("#Individually_users").select2({});
      

         $.ajax({
                    url:'{{url("admin/user/get_all_users")}}',

                    dataType:'json',

                    type:'GET',

                    success:function(data){

                        if(data['status'] == 'success'){
                           
                            var html = "";
                        
                            for(i = 0;i<data['data'].length;i++){

                                html +="<option value="+data['data'][i].id+">["+data['data'][i].id+"]"+data['data'][i].first_name+" "+data['data'][i].last_name+"</option>";
                           
                            }
                            // $('.assignTo').removeClass('d-none').addClass('d-block');
                            $('#Individually_users').html(html);
                        }
                    }
                });




    }else{      
            $('.send_to_department').removeClass('d-block').addClass('d-none');
            $('.sentTo_all').removeClass('d-block').addClass('d-none');
    }


    
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
