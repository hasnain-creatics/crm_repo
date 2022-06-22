
<div class="modal fade" id="knowledge_modal">
			<div class="modal-dialog modal-dialog" role="document">
				<div class="modal-content modal-content-demo">
                <form onsubmit="return false;" class="course_video_upload" action="{{route('knowledge.add')}}" method="POST" id="course_video_upload" enctype="multipart/form-data">
			
					<div class="modal-header">
						<h6 class="modal-title">Upload Video / {{$screen_name}}</h6>
					</div>
					<div class="modal-body">
		
					<div class="container mt-5">
							@csrf
							<div class="form-group">
							<div class="form-group col-md-12">
                                <input type="hidden" name="screen_name" value="{{$screen_name}}">
                                <label for="" class="form-label" >Title</label>
                                <input type="text" class="form-control " name="video_title"  value="{{ old('video_title') }}" required>
							</div> 
                            </div>
							<div class="form-group">
							<div class="form-group col-md-12">
							<label for="" class="form-label" >Thumbnail</label>
							<input name="image" type="file" class="form-control" accept="image/*" required><br/>
							<label for="" class="form-label" >Video</label>
							<input name="file" type="file" class="form-control" accept="video/mp4,video/x-m4v,video/*" required><br/>
                            <div class="progress progress-md">
								<div class="progress-bar progress-bar-striped 
                                   progress-bar-animated bg-green">0%</div>
							</div>
							
						</div>
							</div>
											

					</div>
					<div class="modal-footer">
					<input type="submit"  value="Submit" class="btn btn-primary" id="upload_video_btn"> <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
					</div>
					</form>
				</div>
			</div>
		</div>
    
