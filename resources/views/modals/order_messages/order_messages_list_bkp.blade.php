
<div class="modal fade" id="order_message_modal">
			<div class="modal-dialog  modal-lg" role="document">
				<div class="modal-content">
                	<div class="modal-header">
						<h6 class="modal-title">Message Section </h6>
					</div>
					<div class="modal-body">
		
					<div class="container mt-5">

                                <div class="row">
                                    <div class="col-md-12">
                                        <ul class="nav nav-pills">
                                            <?php
                                                $first_user = '';
                                            ?>
                                            @if(count($assigned_user->order_assigns) > 0)
                                                @foreach($assigned_user->order_assigns as $key=>$value)
                                                    <?php 
                                                        if($key == 0){
                                                            $first_user = $value->user_id;
                                                        }  
                                                    
                                                    ?>
                                                    <li class="nav-item">
                                                        <a class="nav-link select_user "  data-user="{{$value->user_id}}" href="#" >{{$value->first_name}} {{$value->last_name}}</a>
                                                    </li>
                                                    &nbsp;
                                                @endforeach
                                            @else
                                                No writer assign yet
                                            @endif            
                                            
                                        </ul>
                                    </div>
                                </div>
                            <br>
                         <form onsubmit="return false;" class="send-message-form" action="{{route('order_message.add')}}" method="POST" id="send-message-form" enctype="multipart/form-data">
                            @csrf
                                <div class="form-group">

                                    <div class="form-group col-md-12">

                                        <input type="hidden" class="message_user_id" name="user_id" value="">

                                        <input type="hidden" name="order_id" value="{{$id}}">

                                        <label for="" class="form-label" >Message <span style="color:red">*</span></label>

                                        <input type="text" class="form-control " name="message"  value="{{ old('message') }}" required >

                                    </div> 

                                </div>

                                <div class="form-group">

                                    <div class="form-group col-md-12">
                                        
                                        <label for="" class="form-label" >Documents</label>

                                        <input name="files" type="file" class="form-control" multiple><br/>
                                
                                    </div>

                                </div>
										
                                <div class="form-group">
                                    
                                    <div class="form-group col-md-12">
                                        
                                        <input type="submit"  value="Submit" class="btn btn-primary" id="submit_message">

                                    </div>
                                    <div class="form-group col-md-12">
                                        
                                    <div class="progress progress-md">
                                            <div class="progress-bar progress-bar-striped 
                                            progress-bar-animated bg-green">0%</div>
                                        </div>
							
                                    </div>
                                 



                                </div>
                            </form>
					</div>
                    <div class="container mt-5">
                        <div class="form-group">

                        </div>
                    </div>
					<div class="modal-footer">
				            <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
					</div>
		
				</div>
			</div>
</div>

<script>
$(document).ready(function(){
    alert();
    // console.log("fetch");
    // fetch_all_messages("{{$id}}");
    
}); 
</script>
    
