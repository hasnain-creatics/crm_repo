<style>

.media-body-relative{
position:relative;
}

.user-chat-name{
    top: -20px;
    position: absolute;
    left: 18px;
}

.own-chat-name {
    top: -20px;
    position: absolute;
    right: 0;
}

</style>
<div class="modal fade" id="order_message_modal">
			<div class="modal-dialog  modal-lg" role="document">
				<div class="modal-content">
                	<div class="modal-header">
						<h6 class="modal-title">Message Section / ORDER-{{$id}}</h6>
					</div>
					<div class="modal-body">
		
                        <div class="container mt-5 form-group messages_here" >
                        <!-- style="max-height:300px;overflow: auto;" -->
                       
                                <div class="chat-body-style  ps--active-y" id="ChatBody" style="max-height:400px;overflow:auto;">
                                                    
                                </div>
                               
                        </div>
					<div class="container mt-5">
                         <form onsubmit="return false;" class="send-message-form" action="{{route('order_message.add')}}" method="POST" id="send-message-form" enctype="multipart/form-data">
                            @csrf
                                <div class="form-group">

                                    <div class="form-group col-md-12">

                                        <input type="hidden" name="order_id" value="{{$id}}">

                                        <label for="" class="form-label" >Message <span style="color:red">*</span></label>

                                        <input type="text" class="form-control " name="message"  value="{{ old('message') }}" required >

                                    </div> 

                                </div>

                                <div class="form-group">

                                    <div class="form-group col-md-12">
                                        
                                        <label for="" class="form-label" >Documents</label>
                                        <input name="files[]" type="file" class="form-control" multiple><br/>
                                        <span class="arrow files-error d-none"><label id="file-error" class="error " for="message" ></label></span>
                                    </div>

                                </div>
										
                                <div class="form-group">
                                    
                                    <div class="form-group col-md-12">
                                        
                                        <input type="submit"  value="Submit" class="btn btn-primary" id="submit_message">

                                    </div>
                                    <div class="form-group col-md-12">
                                        
                                    <div class="progress progress-md d-none">
                                            <div class="progress-bar progress-bar-striped 
                                            progress-bar-animated bg-green">0%</div>
                                        </div>
							
                                    </div>

                                </div>
                            </form>
					</div>
					<div class="modal-footer">
				            <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
					</div>
		
				</div>
			</div>
</div>

<script>
    $(document).ready(function(){
       
        var ele = "{{$id}}";
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
               $("#ChatBody").animate({
                    scrollTop: $('#ChatBody')[0].scrollHeight - $('#ChatBody')[0].clientHeight
                }, 100);
          
            // $('#ChatBody').scrollTop($('#ChatBody').height())
            // $("#ChatBody").animate({
            //     scrollTop: $('#ChatBody')[0].scrollHeight - $('#ChatBody')[0].clientHeight
            //   }, 1000);
                }

                });

    });
</script>