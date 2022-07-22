<div class="modal fade effect-slide-in-right " id="add_order_feedback" style="display: block; padding-right: 17px;" aria-modal="true" role="dialog">
			<div class="modal-dialog modal-lg modal-dialog-centered text-center" role="document">
				
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">Order Feedback  / ORDER-{{$id}}</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
					</div>
		
				<div class="modal-body">
					<div class="form-group">
						<div class="form-group col-md-12">
						<div class="container mt-5 form-group messages_here">
                                <div class="chat-body-style  ps--active-y" id="ChatBody" style="max-height:400px;overflow:auto;">
									
								</div>
                        </div>
						</div>

					</div>
					@if(Auth::user()->roles[0]->name == 'Admin' || Auth::user()->roles[0]->name == 'Sale Manager' || Auth::user()->roles[0]->name == 'Sale Agent')
						<form  onsubmit="return false;"  action="{{route('orders.store_feedback')}}" method="POST" class="feed_back_form" id="feed_back_form" enctype="multipart/form-data">
						@csrf
							<div class="form-group">

										<div class="form-group col-md-12">
											<input type="hidden" name="order_id" value="{{$id}}">
											<textarea name="feedback" class="form-control" id="feedback" cols="25" rows="5"></textarea>
											<span class="arrow files-error d-none">
												<label id="file-error" class="error " for="message" ></label>
											</span>
										</div><div class="form-group col-md-12">
											
											<input type="datetime-local" name="deadline" class="form-control" id="deadline"> 
											<span class="arrow files-error d-none">
												<label id="file-error" class="error " for="deadline" ></label>
											</span>
										</div>
										
										<div class="form-group col-md-12">
											<input name="files[]" id="files" type="file" class="form-control" multiple><br/>
											<span class="arrow files-error d-none"><label id="file-error" class="error " for="message" ></label></span>
										</div>
										<div class="form-group col-md-12">
												
												<div class="progress progress-md d-none">
														<div class="progress-bar progress-bar-striped 
														progress-bar-animated bg-green">0%
                                                       </div>
												</div>
										
										</div>
											
							</div>

						</form>
					@endif
	           </div>
               @if(Auth::user()->roles[0]->name == 'Admin' || Auth::user()->roles[0]->name == 'Sale Manager' || Auth::user()->roles[0]->name == 'Sale Agent')
               <div class="modal-footer">
						 <button class="btn btn-danger"  type="button" id="submit_feedback" >Submit</button>
						 <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
				</div>
				@endif
			</div>
		</div>
		

		
<script>

	
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
                                html +='<div class="media-body" style="text-align:left"><div class="mf-content" style="width:100%">'+result[i].feedback+'</div>';
                                html +='<small sclass="mf-date">';
                                for(j = 0;j<result[i].feedback_documents.length;j++){
                                   html +=' <a href="'+result[i].feedback_documents[j].link+'" target="_blank">'+result[i].feedback_documents[j].file_name+'</a>';
                                }
                                html +='</small>';
                                html+='<small class="mf-date">'+moment(result[i].created_at).format('dddd, MMMM Do YYYY, h:mm:ss a')+'</small></div>';
                            }else{
                                html +='<div class="media-body"><div class="mf-content" style="">'+result[i].feedback+'</div><small class="mf-date">'+moment(result[i].created_at).format('dddd, MMMM Do YYYY, h:mm:ss a')+'</small></div>';
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

    $(document).ready(function(){
       
        var ele = "{{$id}}";

		order_feedbacks(ele)

    });
</script>