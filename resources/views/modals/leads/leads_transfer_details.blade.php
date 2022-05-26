<div class="modal fade effect-slide-in-right " id="lead_transfer_details_modal" style="display: block; padding-right: 17px;" aria-modal="true" role="dialog">
			<div class="modal-dialog modal-lg modal-dialog-centered text-center" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">Lead Transfer Details / LEAD-{{$lead_id}}</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
					</div>
             
					<div class="modal-body">

    <div class="table-responsive">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                      
                        <div class="row">

                    <div class="col-sm-12">

                        @if($lead_details)
                        <div class="form-group col-md-12"> 
                        <div class="input-group">
                                        
                        
                                <table   class="table table-bordered text-nowrap dataTable no-footer"
                                                    id="lead_docs_table"
                                                    role="grid"
                                                    aria-describedby="example1_info">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Date</th>
                                                        <th>Transfered User</th>
                                                        <th>Lead/Manager</th>
                                                        <th>Created By</th>
                                                    </tr>
                                                </thead>
                                            <tbody>
                                                            @foreach($lead_details as $key=>$value)
                                                                <tr class="lead_tr_{{$value->id}}">
                                                                    <td>{{$value->id}}</td>
                                                                    <td>{{$value->created_at}}</td>
                                                                    <td>{{$value->first_name =="" && $value->last_name =="" ? 'Admin' : $value->first_name .' '. $value->last_name }}</td>
                                                                    <td>{{$value->f_name =="" && $value->l_name =="" ? 'Admin' : $value->f_name .' '. $value->l_name }}</td>
                                                                    <td>{{$value->fs_name =="" && $value->ls_name =="" ? 'Admin' : $value->fs_name .' '. $value->ls_name }}</td>
                                                                </tr>
                                                            @endforeach
                                                
                                            </tbody>
                                </table>           </div>
                        </div>
                        
                                @else
                                    No Leads Find
                                @endif
                        </div>


                        </div>
                        </div>       </div>


					<div class="modal-footer">
                        <!-- <button class="btn btn-primary" onClick="lead_transfer_user({{$lead_id}})" type="button">Transfer Submit</button> -->
					    <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
					</div>
				</div>
			</div>
		</div>
		</div>