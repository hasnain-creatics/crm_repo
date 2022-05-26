<div class="modal fade effect-slide-in-right " id="convert_lead" style="display: block; padding-right: 17px;" aria-modal="true" role="dialog">
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
                        <div class="form-group col-md-12"> 
                        <div class="input-group">
                                        
                        
                                <table   class="table table-bordered text-nowrap dataTable no-footer"
                                                    id="lead_docs_table"
                                                    role="grid"
                                                    aria-describedby="example1_info">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Order Ref</th>
                                                        <th>Customer Name</th>
                                                        <th>Deadline</th>
                                                        <th>Action</th>
                                                   </tr>
                                                </thead>
                                            <tbody>
                                                        @foreach($orders as $key=>$value)
                                                            <tr>
                                                                <td>{{$value->id}}</td>
                                                                <td>{{$value->order_id}}</td>
                                                                <td>{{$value->customer_name}}</td>
                                                                <td>{{$value->deadline}}</td>
                                                                <td>Action</td>
                                                            </tr>
                                                        @endforeach                                                         
                                            </tbody>
                                </table>           </div>
                        </div>
                        
                             
                        </div>


                        </div>
                        </div>       </div>


					<div class="modal-footer">
                     
					    <button class="btn btn-primary" onClick="redirect_lead('{{$lead_id}}')"  type="button">Make Order</button>

					    <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>

					</div>
				</div>
			</div>
		</div>
		</div>