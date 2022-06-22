<style>

	.video-list-content{
		padding:5px;
	}
	.active-video{
		background-color:lightblue;
		border-radius:5px;
		cursor:pointer;
	}
	.video-list-content:hover{
		background-color:lightblue;
		border-radius:5px;
		cursor:pointer;
	}

</style>
<div class="modal fade" id="video_list_modal">
			<div class="modal-dialog modal-dialog modal-lg" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">Watch Video /{{$screen_name}}</h6>
					</div>
					<div class="modal-body">
		
					<div class="container mt-5">
							
                    <div class="row justify-content-center">
                        <div class="col-6 video-played-src video-player-div" video-url-data="{{asset('storage/app/tutorial')}}" >
							@if($found_video)
						<video width="400" controls>
							<source src="{{asset('storage/app/tutorial')}}/{{$first_video_link}}" type="video/mp4">
						</video>
						<label for="">
							<h3>{{$first_video_title}}</h3>
						</label>
						@else
						<h3> No video Found</h3>
						@endif
                        </div>
                        <div class="col-6" style="max-height: 200px;overflow: auto;">
                                <ul>
                                @foreach($result as $key=>$value)
                                    <li class="video-list-content video-link-{{$value->id}} {{$first_video_id == $value->id ? 'active-video' : ''}}" onClick="play_video('{{$value->id}}')"><img src="{{asset('storage/app/tutorial/thumb')}}/{{$value->image}}" style="width:50px;"> <span style="">{{$value->title}}</span></li>
                                @endforeach
                                </ul>
                        </div>
                
                    </div>
											

					</div>
					<div class="modal-footer">
				         <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
					</div>
					</form>
				</div>
			</div>
		</div>
    
