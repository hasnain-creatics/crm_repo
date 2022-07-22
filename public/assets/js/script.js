let order_message_start = false;
let message_order_id = null;
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

        html+="<option value=''></option>";

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

    //   console.log('lead')
    //   $('.is_qa').removeClass('d-none');
      
    }else{
        

        // $('.is_qa').addClass('d-none');
        // $('#is_qa').prop('checked',false);

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

function orderDocs(ele){
                
    $.ajax({

        type: "get",

        url : main_url+'/orders/all_docs/'+ele,

        dataType: "html",

        success:function(response){

            $('#all-modals').html(response);

            $('#order_docs_modal').modal('show');

        }

    });
}
function orderDelete(ele){
         
    swal({
        title: "Are you sure?",
        text: 'yes, continue it for delete order',
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Continue it!",
        cancelButtonText: "No, Cancel Delete!",
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

                type: "get",
        
                url : main_url+'/orders/delete/'+ele,
        
                dataType: "json",
        
                success:function(response){

                    if(response.status =='success'){

                        swal('Delete!', response.message, response.success);

                        setTimeout(function(){
                            
                            // window.location.href = main_url+'/orders';

                            $('#orders_data_table').DataTable().ajax.reload();

                        },1000);

                    }
                  
                }
        
            });

        } else {
          swal("Cancelled", "Task Not Aassigned", "error");
        }
    });

}



function upSell(ele){


    swal({
        title: "Are you sure?",
        text: 'yes, continue it for re order',
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Continue it!",
        cancelButtonText: "No, Cancel Re-order!",
        closeOnConfirm: false,
        closeOnCancel: false,
              customClass: {
              confirmButton: 'btn btn-primary',
              cancelButton: 'btn btn-secondary',
          }
      },
      function(isConfirm){

        if (isConfirm) {
            
            window.location.href =  main_url+'/orders/add/'+ele+'/upsell';

        } else {
          swal("Cancelled", "No more upsell", "error");
        }
    });


}




function deleteOrderDocs(ele){

            
    swal({
        title: "Are you sure?",
        text: 'yes, continue it for delete docs',
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Continue it!",
        cancelButtonText: "No, Cancel Delete!",
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

        type: "get",

        url : main_url+'/orders/delete_doc/'+ele,

        dataType: "json",

        success:function(response){
            if(response.status == 'success'){

                $('#order_docs_modal .tr_'+ele).remove();

                swal("Inform", response.message, response.status);

            }

        }

    });

        } else {

          swal("Cancelled", "No more upsell", "error");
          
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

        swal({
            title: "Are you sure?",
            text: 'yes, continue it for transfer lead',
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Continue it!",
            cancelButtonText: "No, Cancel transfere!",
            closeOnConfirm: false,
            closeOnCancel: false,
                  customClass: {
                  confirmButton: 'btn btn-primary',
                  cancelButton: 'btn btn-secondary',
              }
          },
          function(isConfirm){
    
            if (isConfirm) {
                 
                // $.ajax({
    
                //     type: "get",
            
                //     url : main_url+'/orders/delete/'+ele,
            
                //     dataType: "json",
            
                //     success:function(response){
                //         if(response.status =='success'){
                //             swal('Delete!', response.message, response.success);
                //         }
                      
                //     }
            
                // });
    

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
                        
                        // alert(response.message);
                        swal("Transfered", "Lead Transfered Successfully", "success");
       
                    }
                    // $('#all-modals').html(response);
    
                    // $('#lead_transfer_modal').modal('show');
                    
                }
            
            });            } else {
              swal("Cancelled", "Task Not Aassigned", "error");
            }
        });
    
        // if(confirm('Are you sure')){

            // $.ajax({
    
            //     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                
            //     type: "post",
            
            //     url : main_url+'/leads/lead_transfers',
            
            //     data: {lead_id:ele,user_id:user},
            
            //     dataType: "json",
            
            //     success:function(response){
    
            //         if(response.status == 'error'){
                        
            //             alert(response.message);

            //         }else if(response.status == 'success'){
                        
            //             alert(response.message);
                    
            //         }
            //         // $('#all-modals').html(response);
    
            //         // $('#lead_transfer_modal').modal('show');
                    
            //     }
            
            // });
        // }
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
   
                $('#feed_back_form').ajaxSubmit({

                    beforeSubmit:function(formData,formObject,formOptions){
                        $('.files-error').addClass('d-none');
                        $('.files-error').css('display','none');
                        var total_size = 0;
                        for(f = 0;f<formData.length;f++){
                            if(formData[f].type == 'file'){
                                total_size+=formData[f].value.size;
                            }
                        }   
                        var orignal_file = bytesToSize(total_size);
                        var size_check = orignal_file.split(' ');
                        if(size_check[1]){
                            if(size_check[1] == 'M'){
                                if(size_check[0] > 50){
                                    $('.files-error').removeClass('d-none');
                                    $('.files-error').css('display','block');
                                    $('#file-error').css('display','block');
                                    $('#file-error').html('Maximum 50 mb file you can post here, and you are trying '+orignal_file);
                                    return false;
                                }
                            }else if(size_check[1] == 'G'){
                                $('.files-error').removeClass('d-none');
                                $('.files-error').css('display','block');
                                $('#file-error').css('display','block');
                                $('#file-error').html('Maximum 50 mb file you can post here, and you are trying '+orignal_file);
                                return false;
                            }
                        }
                        },
                    beforeSend:function(){
                        // $('.upload-btn-glbl').addClass('btn-loaders btn-icon');
                    },
                    uploadProgress:function(event,position,total,percentComplete){
                      $('.progress-bar').css('width',percentComplete+'%');
                      $('.progress-bar').html(percentComplete+'%');
                    },
                    success: function(response){
                      
                     if(response.status == 'success'){

                        order_feedbacks(response.order_id)
                        $('#feed_back_form').trigger("reset");
                      
                     } 	
                    }
                });
  

        }); 
   
function order_feedbacks(ele){
    $.ajax({

        type: "get",

        url : main_url+'/orders/fetch_all_feedback/'+ele,

        dataType: "json",

        beforeSend:function(){
            // $('.video-player-div').html('<div class="dimmer active"><div class="sk-circle"><div class="sk-circle1 sk-child"></div><div class="sk-circle2 sk-child"></div><div class="sk-circle3 sk-child"></div><div class="sk-circle4 sk-child"></div><div class="sk-circle5 sk-child"></div><div class="sk-circle6 sk-child"></div><div class="sk-circle7 sk-child"></div><div class="sk-circle8 sk-child"></div><div class="sk-circle9 sk-child"></div><div class="sk-circle10 sk-child"></div><div class="sk-circle11 sk-child"></div><div class="sk-circle12 sk-child"></div></div></div>');
            // console.log('wait....');
        },
        success:function(response){
           
            var html =  "";
            var result = response.result;
            for(i  = 0;i < result.length;i++){
                if(result[i].created_by == current_user){
                    if(result[i].users){
                        html +="<div class='float-end' style='width:100%';>";
                            html +='<div class="message-feed right float-end">';
                            html +='<div class="float-end ps-2">';
                            if(result[i].users.profile_image_id){
                                html +='<img src="'+site_url+'/storage/app/'+result[i].users.profile_image_id+'" alt="" class="avatar avatar-md brround">';
                            }else{
                                html +='<img src="'+public_url+'/assets/images/no_image.jpg" alt="" class="avatar avatar-md brround">';
                            }
                            html +='</div>';
                            if(result[i].feedback_documents){
                                html +='<div class="media-body">';
                                html +='<div class="mf-content" style="width:100%">'+result[i].feedback+'</div>';
                                html +='<small sclass="mf-date">';
                                for(j = 0;j<result[i].feedback_documents.length;j++){

                                   html +=' <a href="'+result[i].feedback_documents[j].link+'"  target="_blank">'+result[i].feedback_documents[j].file_name+'</a>';
                                }
                                html +='</small>';
                                html+='<small class="mf-date">'+moment(result[i].created_at).format('dddd, MMMM Do YYYY, h:mm:ss a')+'</small></div>';
                            }else{
                                html +='<div class="media-body"><div class="mf-content">'+result[i].feedback+'</div><small class="mf-date">'+moment(result[i].created_at).format('dddd, MMMM Do YYYY, h:mm:ss a')+'</small></div>';
                            }
                            html +='</div>';
                        html +='</div>';
                    }
                }else{
                    if(result[i].users){
                        html +="<div class='float-start' style='width:100%';>";
                            html +='<div class="message-feed media receivers float-start" >';
                            html +='<div class="float-end ps-2">';
                            if(result[i].users.profile_image_id){
                                html +='<img src="'+site_url+'/storage/app/'+result[i].users.profile_image_id+'" alt="" class="avatar avatar-md brround">';
                            }else{
                                html +='<img src="'+public_url+'/assets/images/no_image.jpg" alt="" class="avatar avatar-md brround">';
                            }
                            html +='</div>';
                            if(result[i].feedback_documents){
                                html +='<div class="media-body"><div class="mf-content" style="width:100%">'+result[i].feedback+'</div>';
                                html +='<small sclass="mf-date">';
                                for(j = 0;j<result[i].feedback_documents.length;j++){
                                   html +=' <a href="'+result[i].feedback_documents[j].link+'" target="_blank">'+result[i].feedback_documents[j].file_name+'</a>';
                                }
                                html +='</small>';
                                html+='<small class="mf-date">'+moment(result[i].created_at).format('dddd, MMMM Do YYYY, h:mm:ss a')+'</small></div>';
                            }else{
                                html +='<div class="media-body"><div class="mf-content">'+result[i].feedback+'</div><small class="mf-date">'+moment(result[i].created_at).format('dddd, MMMM Do YYYY, h:mm:ss a')+'</small></div>';
                            }
                            html +='</div>';
                        html +="</div>";
                    }
                }
            }
            $('#ChatBody').html(html);
            // $("#ChatBody").animate({ scrollTop: $('#ChatBody').height()}, 1000);
            // $('#ChatBody').scrollTop($('#ChatBody').height())
            $("#ChatBody").animate({
                scrollTop: $('#ChatBody')[0].scrollHeight - $('#ChatBody')[0].clientHeight
            }, 100);
        }

        });
}


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

function order_status_details(ele){

  $.ajax({

        type: "get",
    
        url : main_url+'/orders/order_status_details/'+ele,
    
        dataType: "html",
    
        success:function(response){
    
            $('#all-modals').html(response);

            $('#order_status_details').modal('show');
            
        }
    
    });




}
function upload_modal_method(ele){

    $.ajax({

        type: "get",
    
        url : main_url+'/knowledge/upload/'+ele,
    
        dataType: "html",
        beforeSend:function(){
        	$('.upload-btn-glbl').addClass('btn-loaders btn-icon');
        },
        success:function(response){
            $('.upload-btn-glbl').removeClass('btn-loaders btn-icon');
            $('#all-modals').html(response);

            $('#knowledge_modal').modal('show');
        }
    
    });
    
}



function video_listing(ele){

    $.ajax({

        type: "get",
    
        url : main_url+'/knowledge/video_listing/'+ele,
    
        dataType: "html",

        beforeSend:function(){
        	$('.watch-btn-glbl').addClass('btn-loaders btn-icon');
        },
    
        success:function(response){
    
            $('.watch-btn-glbl').removeClass('btn-loaders btn-icon');
            $('#all-modals').html(response);

            $('#video_list_modal').modal('show');
        }
    
    });
    
}


function play_video(ele){

    $('.video-list-content').removeClass('active-video');
    $.ajax({

        type: "get",
    
        url : main_url+'/knowledge/play_video/'+ele,
    
        dataType: "json",
    
        beforeSend:function(){
            $('.video-player-div').html('<div class="dimmer active"><div class="sk-circle"><div class="sk-circle1 sk-child"></div><div class="sk-circle2 sk-child"></div><div class="sk-circle3 sk-child"></div><div class="sk-circle4 sk-child"></div><div class="sk-circle5 sk-child"></div><div class="sk-circle6 sk-child"></div><div class="sk-circle7 sk-child"></div><div class="sk-circle8 sk-child"></div><div class="sk-circle9 sk-child"></div><div class="sk-circle10 sk-child"></div><div class="sk-circle11 sk-child"></div><div class="sk-circle12 sk-child"></div></div></div>');
        },
        success:function(response){
            $('.video-link-'+ele).addClass('active-video');
            var video_url = $('.video-played-src').attr('video-url-data');
            var html =  '<video width="400" controls><source src="'+video_url+'/'+response.doc+'" type="video/mp4"></video><label for=""><h3>'+response.title+'</h3></label>';
            $('.video-player-div').html(html);
        }
    
    });
    
}




$(document).on('click','#upload_video_btn',function(){

    $('#course_video_upload').validate({
          errorPlacement: function(label, element) {
          label.addClass('arrow');
          label.insertAfter(element);
      },
      wrapper: 'span',
          rules: {
              video_title: {
                  required: true
              },
              
          },
          submitHandler: function (form) { 
  
              $('#course_video_upload').ajaxSubmit({
  
                    beforeSubmit:function(formData,formObject,formOptions){
                        formData.push({
                          name:'website',
                          value:'https:youtube.com'
                        });
                      },
                      beforeSend:function(){
                          // $('.upload-btn-glbl').addClass('btn-loaders btn-icon');
                      },
                      uploadProgress:function(event,position,total,percentComplete){
                        $('.progress-bar').css('width',percentComplete+'%');
                        $('.progress-bar').html(percentComplete+'%');
                      },
                      success: function(response){
                        
                       if(response.status == 'success'){

                           $('.progress-bar').css('width','2%');
                            $('.progress-bar').html('0 %');
                            $('#course_video_upload').trigger("reset");
                            $('#knowledge_modal').modal('hide');
                        
                            swal('Congratulations!', 'Video Uploaded Successfully', 'success');

                            setTimeout(function(){

                                swal.close();

                              //  video_listing(response.id);

                            },1000);

                        
                       } 	
                      }
                    });
            }
      });
  
  });

  function orderMessages(ele){
   const message_order_id = ele
    order_message_start = true;
    $.ajax({

        type: "get",
    
        url : main_url+'/order_message/order_message_list/'+ele,
    
        dataType: "html",

        beforeSend:function(){
        	// $('.watch-btn-glbl').addClass('btn-loaders btn-icon');
            // console.log('feting......?');
        },
    
        success:function(response){
            
            Pusher.logToConsole = true;

            var pusher = new Pusher('a9e17b308b857320b4bd', {

                encrypted: true,

                cluster: 'ap2'

            });

		    var channel = pusher.subscribe('my-message-channel');

		    channel.bind('my-message-event',function(data){

            if(data.update_notifications == 'yes'){

                fetch_all_messages(message_order_id,current_user);

                // $(".chat-body-style").animate({

                //     scrollTop: $('.chat-body-style').get(0).scrollHeight
                    
                // }, 100);
                
            }
            
		});

            $('#all-modals').html(response);

            $('#order_message_modal').modal('show');
                // window.setInterval(function(){
                //     fetch_all_messages(message_order_id,current_user);
                // }, 10000);
               
        },
        error: function (jqXHR, textStatus, errorThrown) {
            if (jqXHR.status == 500) {
                alert('Internal error: ' + jqXHR.responseText);
            } else {
                alert('Unexpected error.');
            }
        }
    
    });

  }

  function bytesToSize(bytes) {
    var sizes = ['B', 'K', 'M', 'G', 'T', 'P'];
    for (var i = 0; i < sizes.length; i++) {
      if (bytes <= 1024) {
        return bytes + ' ' + sizes[i];
      } else {
        bytes = parseFloat(bytes / 1024).toFixed(2)
      }
    }
    return bytes;
  }
  
$(document).on('click','#submit_message',function(){
    let message = $('input[name="message"]').val();
    if($.trim(message) == ""){
        return false;
    }

    $('#send-message-form').validate({
        errorPlacement: function(label, element) {
        label.addClass('arrow');
        label.insertAfter(element);
    },
    wrapper: 'span',
        rules: {
            'message': {
                required: true
            },
          
        },
        submitHandler: function (form) { 
            $('#send-message-form').ajaxSubmit({
                  beforeSubmit:function(formData,formObject,formOptions){
                    $('.files-error').addClass('d-none');
                    $('.files-error').css('display','none');
                    var total_size = 0;
                    for(f = 0;f<formData.length;f++){
                        if(formData[f].type == 'file'){
                            total_size+=formData[f].value.size;
                        }
                    }   
                    var orignal_file = bytesToSize(total_size);
                    var size_check = orignal_file.split(' ');
                    if(size_check[1]){
                        if(size_check[1] == 'M'){
                            if(size_check[0] > 50){
                                $('.files-error').removeClass('d-none');
                                $('.files-error').css('display','block');
                                $('#file-error').css('display','block');
                                $('#file-error').html('Maximum 50 mb file you can post here, and you are trying '+orignal_file);
                                return false;
                            }
                        }else if(size_check[1] == 'G'){
                            $('.files-error').removeClass('d-none');
                            $('.files-error').css('display','block');
                            $('#file-error').css('display','block');
                            $('#file-error').html('Maximum 50 mb file you can post here, and you are trying '+orignal_file);
                            return false;
                        }
                    }
                    },
                    beforeSend:function(){
                        $('#submit_message').prop('disabled',true);
                        // $('.upload-btn-glbl').addClass('btn-loaders btn-icon');

                    },
                    uploadProgress:function(event,position,total,percentComplete){
                      $('#submit_message').prop('disabled',true);
                      $('.progress').removeClass('d-none');
                      $('.progress-bar').css('width',percentComplete+'%');
                      $('.progress-bar').html(percentComplete+'%');
                    },
                    success: function(response){
                        $('#submit_message').prop('disabled',false);
                        if(response.status == 'success'){
                            $('.progress').addClass('d-none');
                            $('.progress-bar').css('width','2%');
                            $('.progress-bar').html('0 %');
                            $('.send-message-form').trigger("reset");
                            fetch_all_messages(response.order_id,response.user_id);

                        } 	
                    }
                  });
          }
    });
});



function fetch_all_messages(ele,current_user){

    $.ajax({
        type: "get",

        url : main_url+'/order_message/fetch_messages/'+ele,

        dataType: "json",

        beforeSend:function(){
            // $('.video-player-div').html('<div class="dimmer active"><div class="sk-circle"><div class="sk-circle1 sk-child"></div><div class="sk-circle2 sk-child"></div><div class="sk-circle3 sk-child"></div><div class="sk-circle4 sk-child"></div><div class="sk-circle5 sk-child"></div><div class="sk-circle6 sk-child"></div><div class="sk-circle7 sk-child"></div><div class="sk-circle8 sk-child"></div><div class="sk-circle9 sk-child"></div><div class="sk-circle10 sk-child"></div><div class="sk-circle11 sk-child"></div><div class="sk-circle12 sk-child"></div></div></div>');
            // console.log('wait....');
        },
        success:function(response){
    
            var html =  "";
            var result = response.result;
            for(i  = 0;i < result.length;i++){
                if(result[i].sender_id == current_user){
                    if(result[i].users){
                        html +="<div class='float-end' style='width:100%';>";
                            html +='<div class="message-feed right float-end">';
                            html +='<div class="float-end ps-2">';
                            if(result[i].users.profile_image_id){
                                html +='<img src="'+site_url+'/storage/app/'+result[i].users.profile_image_id+'" alt="" class="avatar avatar-md brround">';
                            }else{
                                html +='<img src="'+public_url+'/assets/images/no_image.jpg" alt="" class="avatar avatar-md brround">';
                            }
                            html +='</div>';
                            if(result[i].order_message_documents){
                                html +='<div class="media-body media-body-relative"><div class="own-chat-name">'+result[i].users.first_name+'</div><div class="mf-content" style="width:100%">'+result[i].message+'</div>';
                                html +='<small sclass="mf-date">';
                                for(j = 0;j<result[i].order_message_documents.length;j++){

                                   html +='<i class="fa fa-file"></i> <a href="'+result[i].order_message_documents[j].file_id+'"  target="_blank">'+result[i].order_message_documents[j].file_name+'</a>';
                                }
                                html +='</small>';
                                html+='<small class="mf-date"><i class="fa fa-clock-o"></i> '+moment(result[i].created_at).format('dddd, MMMM Do YYYY, h:mm:ss a')+'</small></div>';
                            }else{
                                html +='<div class="media-body">Name<div class="mf-content">'+result[i].message+'</div><small class="mf-date"><i class="fa fa-clock-o"></i> '+moment(result[i].created_at).format('dddd, MMMM Do YYYY, h:mm:ss a')+'</small></div>';
                            }
                            html +='</div>';
                        html +='</div>';
                    }
                }else{
                    if(result[i].users){
                        html +="<div class='float-start' style='width:100%';>";
                            html +='<div class="message-feed media receivers float-start" >';
                            html +='<div class="float-end ps-2">';
                            if(result[i].users.profile_image_id){
                                html +='<img src="'+site_url+'/storage/app/'+result[i].users.profile_image_id+'" alt="" class="avatar avatar-md brround">';
                            }else{
                                html +='<img src="'+public_url+'/assets/images/no_image.jpg" alt="" class="avatar avatar-md brround">';
                            }
                            html +='</div>';
                            if(result[i].order_message_documents){
                                html +='<div class="media-body media-body-relative"><div class="user-chat-name">'+result[i].users.first_name+'</div><div class="mf-content" style="width:100%">'+result[i].message+'</div>';
                                html +='<small sclass="mf-date">';
                                for(j = 0;j<result[i].order_message_documents.length;j++){
                                   html +='<i class="fa fa-file"></i>  <a href="'+result[i].order_message_documents[j].file_id+'" target="_blank">'+result[i].order_message_documents[j].file_name+'</a>';
                                }
                                html +='</small>';
                                html+='<small class="mf-date"><i class="fa fa-clock-o"></i> '+moment(result[i].created_at).format('dddd, MMMM Do YYYY, h:mm:ss a')+'</small></div>';
                            }else{
                                html +='<div class="media-body">Name<div class="mf-content">'+result[i].message+'</div><small class="mf-date"><i class="fa fa-clock-o"></i> '+moment(result[i].created_at).format('dddd, MMMM Do YYYY, h:mm:ss a')+'</small></div>';
                            }
                            html +='</div>';
                        html +="</div>";
                    }
                }
            }
            $('#ChatBody').html(html);
            //    $("#ChatBody").animate({
            //         scrollTop: $('#ChatBody')[0].scrollHeight - $('#ChatBody')[0].clientHeight
            //     }, 1000);
          
            // $('#ChatBody').scrollTop($('#ChatBody').height())
            // $("#ChatBody").animate({
            //     scrollTop: $('#ChatBody')[0].scrollHeight - $('#ChatBody')[0].clientHeight
            //   }, 1000);
        }

        });
    
}


function select_users(ele){

    let selected_user = ele;

    $('.select_user').each(function(index){

        $(this).removeClass('active');

        if($(this).attr('data-user') == selected_user){
            
            $(this).addClass('active')
             
            $('.message_user_id').val($(this).attr('data-user'));

        } 

    });

}


function rating_details(){
    
    $.ajax({

        type: "get",
    
        url : main_url+'/dashboard/rating_details/',
    
        dataType: "html",

        beforeSend:function(){
        	// $('.watch-btn-glbl').addClass('btn-loaders btn-icon');
        },
    
        success:function(response){
    
            // $('.watch-btn-glbl').removeClass('btn-loaders btn-icon');
            
            $('#all-modals').html(response);

            $('#ratings_modal').modal('show');
        }
    
    });
    
}

$(document).on('click','.select_user',function(){

    select_users($(this).attr('data-user'));
    
})


function fetch_departments(route_url,id=null){

    $.ajax({

        url:route_url,

        dataType: 'json',

        success:function(response){
            
            var html = "";

            if(response.status=='success'){

                    for(i = 0;i<response.data.length;i++){
                        
                        if(id){

                            if(id == response.data[i].id){

                                html+="<option value="+response.data[i].id+" selected >"+response.data[i].name+"</option>";

                            }else{
                                
                                html+="<option value="+response.data[i].id+" >"+response.data[i].name+"</option>";

                            }

                        }else{

                            html+="<option value="+response.data[i].id+" >"+response.data[i].name+"</option>";

                        }

                    }

                    $('#department_id').html(html);

            }

            $('#department_id').html(html);

        }

    });

}

// function call_message(order_message_start){
//     if(order_message_start){
//         window.setInterval(function(){
//             fetch_all_messages(message_order_id,current_user);
//         }, 8000);
//     }
// }
    


// add_feedback(this,".$row->id.")
// order_fail(this,".$row->id.")