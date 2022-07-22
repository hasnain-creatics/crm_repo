<div class="modal fade effect-slide-in-right " id="order_docs_modal" style="display: block; padding-right: 17px;" aria-modal="true" role="dialog">
			<div class="modal-dialog modal-lg modal-dialog-centered text-center" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">Order Documents / ORDER-{{$id}}</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
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
                                                        <th>Reference</th>
                                                        <th>File Name</th>
                                                        <th>Type</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                            <tbody><?php $i = 1;?>
                                                            @foreach($all_docs as $key=>$value)
                                                                    <tr class="tr_{{$value->id}}">
                                                                        <td>{{$i}}</td>
                                                                        <td><a href="{{$value->url}}">{{$value->name}}</a></td>
                                                                        <td>{{$value->file_type}}</td>
                                                                        <td><i onclick="deleteOrderDocs('{{$value->id}}')" style="cursor:pointer" class="fa fa-trash"></i></td>
                                                                    </tr>   
                                                                    <?php $i++;?>
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