<div class="modal fade effect-slide-in-right " id="lead_modal" style="display: block; padding-right: 17px;" aria-modal="true" role="dialog">
			<div class="modal-dialog modal-lg modal-dialog-centered text-center" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">Lead Documents</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
					</div>
             
					<div class="modal-body">

    <div class="table-responsive" style="max-height:200px;">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                      
                        <div class="row">

                    <div class="col-sm-12">

                        @if($all_docs)
                        <div class="form-group col-md-12"> 
                        <div class="input-group">
                                        
                        
                                <table   class="table table-bordered text-nowrap dataTable no-footer"
                                                    id="lead_docs_table"
                                                    role="grid"
                                                    aria-describedby="example1_info">
                                                <thead>
                                                    <tr>
                                                        <th>Lead ID</th>
                                                        <th>File Name</th>
                                                        <th>Original Name</th>
                                                        <th>Type</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                            <tbody>
                                                            @foreach($all_docs as $key=>$value)
                                                                <tr class="lead_tr_{{$value->files->id}}">
                                                                    <td>LEAD-{{$value->lead_id}}</td>
                                                                    <td>{{$value->files->name}}</td>
                                                                    <td>{{$value->files->original_name}}</td>
                                                                    <td>{{$value->files->type}}</td>
                                                                    <td>
                                                                        <i  onclick="deleteDocs({{$value->files->id}})" style="cursor:pointer" class="fa fa-trash"></i>&nbsp;
                                                                        <a href="{{$value->files->directory}}/{{$value->files->name}}" download target="_blank" ><i class="fa fa-download"></i></a>
                                                                    </td>
                                                                    
                                                                </tr>
                                                            @endforeach
                                                
                                            </tbody>
                                </table>           </div>
                        </div>
                        
                                @else
                                    No documents attached
                                @endif
                        </div>


                        </div>
                        </div>       </div>


					<div class="modal-footer">
					    <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
					</div>
				</div>
			</div>
		</div>