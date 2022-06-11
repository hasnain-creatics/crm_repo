function readURL(input) {
  
    if (input.files && input.files[0]) {
  
      var reader = new FileReader();
  
      reader.onload = function (e) {
  
        $('.user_image_view').attr('src', e.target.result).width(100).height(90);
  
      };
  
      reader.readAsDataURL(input.files[0]);
  
    }
  }
  


function all_designations(route,id=null){

    $.ajax({

        type: "get",

        url : route,

        dataType: "json",

        success:function(response){

            var html = "";

            html+="<option></option>";

            for(i = 0; i<response.length;i++){

         
                    html+="<option value="+response[i].id+">"+response[i].name+"</option>";


                
            }

            $('#designation').html(html);
            if(id)
            $('#designation').val(id).trigger('change');
        }

    });

}



function all_cities(route,id=null){

$.ajax({

    type: "get",

    url : route,

    dataType: "json",

    success:function(response){

        var html = "";

        // html+="<option></option>";

        for(i = 0; i<response.length;i++){

         
            html+="<option value="+response[i].id+">"+response[i].title+"</option>";
            

        }

        $('#city_id').html(html);
 
        if(id)
        $('#city_id').val(id).trigger('change');
    }

});

}


function lead_checkes(request_url,lead=null){
    

    if($('input[name="is_lead"]').is(':checked') ){

        $('#assignLead').removeClass('d-block').addClass('d-none');

      console.log('lead')
      $('.is_qa').removeClass('d-none');
      
    }else{
        

        $('.is_qa').addClass('d-none');
        $('#is_qa').prop('checked',false);

        $('#assignLead').removeClass('d-none').addClass('d-block');

         var designation = $('.designation_id').val();
         
          $.ajax({

            url:request_url+'/'+designation,
            
            dataType:'json',
            
            type:'get',
            
            success:function(data){

                var html = "";

                if(data['status'] == 'success'){
            
                    html +="<option value=''>Select Lead</option>";
            
                    for(i = 0;i<data['data'].length;i++){
            
                        html +="<option value="+data['data'][i].id+" "+(lead ? (lead == data['data'][i].id ? 'selected' : '') : '')+">"+data['data'][i].name+"</option>";
            
                    }
                    $('#lead_id').html(html);

                }else{

                    $('#assignLead').addClass('d-none').removeClass('d-block');

                }
            
            
            
            }
         
          });



    }

}


function check_team(ele){

    alert(ele);
}


function userView(ele){
    
$.ajax({

    type: "get",

    url : main_url+'/user/show/'+ele,

    dataType: "html",

    success:function(response){

        $('#all-modals').html(response);
        $('#modaldemo8').modal('show');
    }

});

}



function leadDocs(ele){
                
            $.ajax({

                type: "get",

                url : main_url+'/leads/all_docs/'+ele,

                dataType: "html",

                success:function(response){

                    $('#all-modals').html(response);

                    $('#lead_modal').modal('show');

                }

            });
}


function deleteDocs(ele){

    if(confirm('Are you sure')){
 
        $.ajax({

            type: "get",
    
            url : main_url+'/leads/docs/delete/'+ele,
    
            dataType: "json",
    
            success:function(response){
                
                if(response.status == 'success')
                {
                    $('.lead_tr_'+ele).hide(500);
                }
    
            }
    
        });
    }      
}

function transferLead(ele){

    $.ajax({

        type: "get",
    
        url : main_url+'/leads/lead_transfers/'+ele,
    
        dataType: "html",
    
        success:function(response){
    
            $('#all-modals').html(response);
            $('#lead_transfer_modal').modal('show');
        }
    
    });
    
}



function lead_transfer_user(ele){

    var user = $("input[name='transfer']:checked").val();
    if(user !=""){

        if(confirm('Are you sure')){

            $.ajax({
    
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                
                type: "post",
            
                url : main_url+'/leads/lead_transfers',
            
                data: {lead_id:ele,user_id:user},
            
                dataType: "json",
            
                success:function(response){
    
                    if(response.status == 'error'){
                        
                        alert(response.message);

                    }else if(response.status == 'success'){
                        
                        alert(response.message);
                    
                    }
                    // $('#all-modals').html(response);
    
                    // $('#lead_transfer_modal').modal('show');
                    
                }
            
            });
        }
    }else{
        alert('please select the user')
    }
}

function transferLeadDetails(ele){
    $.ajax({

        type: "get",
    
        url : main_url+'/leads/lead_transfers_details/'+ele,
    
        dataType: "html",
    
        success:function(response){
    
            $('#all-modals').html(response);

            $('#lead_transfer_details_modal').modal('show');
        }
    
    });
    
}


function convertLead(ele){

    $.ajax({

        type: "get",
    
        url : main_url+'/leads/convert_lead/'+ele,
    
        dataType: "html",
    
        success:function(response){
    
            $('#all-modals').html(response);

            $('#convert_lead').modal('show');
        }
    
    });
    

}


function redirect_lead(ele){
	window.location.href =  main_url+'/orders/lead/'+ele;
}

function sync_currency(){

    if(confirm('are you sure')){

        $.ajax({

            type: "get",
        
            url : main_url+'/currency/sync',
        
            dataType: "json",
        
            success:function(response){
                setTimeout(function(){
    
                    window.location.href = main_url+'/currency';

                },1000);
                    
    
            }
        
        });
        
    
    }

}


function change_order_status(item,ele){
    
    const status_value = item.value;

    $.ajax({

        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                
        type: "post",
    
        url : main_url+'/writers/change_status/'+ele,
    
        data: {title:item.value},
    
        dataType: "json",
    
        success:function(response){
            var status = [];
            status.push("New");
            status.push("In Progress");
            status.push("Completed");
            status.push("Feedback");
            status.push("Qa In Progress");
            status.push("Rejected");
            status.push("Qa Approved");
            status.push("Delivered");
            // console.log(response.id);
            //     $( ".status_type_"+response.id ).load(window.location.href +  ".status_type_"+response.id );  
            // var html ="<option></option>";
            // for(i =0;i<status.length;i++){
            //     if(status[i] == )
            // }
            // console.log(status);
        //  $(".status_type_"+response.id ).val();
        }
    
    });
    

}


function assign_writer(item,ele){


        if(item.value !=""){

            $.ajax({

                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        
                type: "post",
            
                url : main_url+'/writers/check_user_assignments/'+ele,
            
                data: {user_id:item.value},
            
                dataType: "json",
            
                success:function(response){
                    
                    swal({
                        title: "Are you sure?",
                        text: response.message,
                        type: "info",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, Continue it!",
                        cancelButtonText: "No, Cancel Asigning!",
                        closeOnConfirm: false,
                        closeOnCancel: false,
                              customClass: {
                              confirmButton: 'btn btn-primary',
                              cancelButton: 'btn btn-secondary',
                          }
                      },
                      function(isConfirm){
    
                        if (isConfirm) {
              
                                    $.ajax({
    
                                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                                
                                        type: "post",
                                    
                                        url : main_url+'/writers/assigned_user/'+ele,
                                    
                                        data: {user_id:item.value},
                                    
                                        dataType: "json",
                                    
                                        success:function(response){
    
                                            if(response.status == 'success'){
    
                                                swal('Congratulations!', response.message, response.success);
    
                                                $('#writers_data_table').DataTable().ajax.reload();

                                                // $( "#lead_docs_table" ).load(window.location.href + " #lead_docs_table" );
                         
                                            }
                                            
                                        }
                                    
                                    });
                        } else {
                          swal("Cancelled", "Task Not Aassigned", "error");
                        }
                      });
    
                }
            
            });
    
        }
        // $.ajax({

        //     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    
        //     type: "post",
        
        //     url : main_url+'/writers/assigned_user/'+ele,
        
        //     data: {user_id:item.value},
        
        //     dataType: "json",
        
        //     success:function(response){
              
        //     }
        
        // });
        

}


function assigned_users_details(ele){

    $.ajax({

        type: "get",
    
        url : main_url+'/writers/writers_assiged_lists/'+ele,
    
        dataType: "html",
    
        success:function(response){
    
            $('#all-modals').html(response);

            $('#writers_user_tasks').modal('show');
        }
    
    });
    

}


function OrderProgress(ele){


    $.ajax({

        type: "get",
    
        url : main_url+'/orders/order_timline/'+ele,
    
        dataType: "html",
    
        success:function(response){
    
            $('#all-modals').html(response);

            $('#orders_timline').modal('show');
        }
    
    });

}

function delete_user_task(order_id){

    swal({
        title: "Are you sure?",
        text: 'Click on yes, continue then assgined task will delete permenantly',
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Continue it!",
        cancelButtonText: "No, Cancel Deleting!",
        closeOnConfirm: false,
        closeOnCancel: false,
              customClass: {
              confirmButton: 'btn btn-primary',
              cancelButton: 'btn btn-secondary',
          }
      },
      function(isConfirm){

        if (isConfirm) {

                    $.ajax({

                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                
                        type: "post",
                    
                        url : main_url+'/writers/delete_assigned_user',
                    
                        data: {order_id:order_id},
                    
                        dataType: "json",
                    
                        success:function(response){

                            if(response.status == 'success'){

                                swal('Congratulations!', response.message, response.status);

                                // $('#writers_data_table').DataTable().ajax.reload();

                                // $( "#lead_docs_table" ).load(window.location.href + " #lead_docs_table" );
         
                            }
                            
                        }
                    
                    });
        } else {
          swal("Cancelled", "Task Not Deleted", "error");
        }
      });
}


function deliver_order(item,ele){
    
    var order_status = 'Delivered';
   
    swal({
        title: "Are you sure?",
        text: 'Click on yes deliver it!, your order will be deliver',
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Deliver it!",
        cancelButtonText: "No, Cancel Delivery!",
        closeOnConfirm: false,
        closeOnCancel: false,
              customClass: {
              confirmButton: 'btn btn-primary',
              cancelButton: 'btn btn-secondary',
          }
      },
      function(isConfirm){

        if (isConfirm) {
 
                    $.ajax({

                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                
                        type: "post",
                    
                        url : main_url+'/orders/change_order_status/'+ele,
                    
                        data: {status:order_status},
                    
                        dataType: "json",
                    
                        success:function(response){

                            if(response.status == 'success'){

                                swal('Congratulations!', response.message, response.status);

                                // $('#writers_data_table').DataTable().ajax.reload();

                                // $( "#lead_docs_table" ).load(window.location.href + " #lead_docs_table" );
         
                            }
                            
                        }
                    
                    });
        } else {
          swal("Cancelled", "Task Not Deleted", "error");
        }
      });

}

function add_feedback(ele){
    
    $.ajax({

        type: "get",
    
        url : main_url+'/orders/add_feedback/'+ele,
    
        dataType: "html",
    
        success:function(response){
    
            $('#all-modals').html(response);

            $('#add_order_feedback').modal('show');
        }
    
    });

}

$(document).on('click','#submit_feedback',function(){

    var id = $('.delivered_order_id').val();
    var feedback = $('#feedback').val().trim();
    if(feedback==""){

        alert('feed back required');
        return false;
    }

    $.ajax({

        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "post",

        data:{order_id:id,feedback:feedback},
    
        url : main_url+'/orders/add_feedback',
    
        dataType: "json",
    
        success:function(response){
    
            // $('#all-modals').html(response);

            // $('#add_order_feedback').modal('show');

            swal('Congratulations!', "Feedback Added Successfully", 'Success');

            setTimeout(function () {
                location.reload(true);
            }, 1000);


        }
    
    });

})


function OrderFullDetails(ele){

	window.location.href = main_url+'/orders/order_full_details/'+ele;
    
    // $.ajax({

    //     type: "get",
    
    //     url : main_url+'/orders/order_full_details/'+ele,
    
    //     dataType: "html",
    
    //     success:function(response){
    
    //         $('#all-modals').html(response);

    //         $('#order_full_deatils').modal('show');
    //     }
    
    // });



}

function order_fail(ele){

    console.log(ele)

}


// add_feedback(this,".$row->id.")
// order_fail(this,".$row->id.")