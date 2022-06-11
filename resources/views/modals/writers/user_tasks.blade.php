<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<div class="modal fade effect-slide-in-right " id="writers_user_tasks" style="display: block; padding-right: 17px;" aria-modal="true" role="dialog">
			<div class="modal-dialog modal-lg modal-dialog-centered text-center" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">Task Details / {{$order_status}} / ORDER-{{$id}}</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
					</div>
             
					<div class="modal-body">

                <div class="table-responsive">

                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                      
                        <div class="row">

                    <div class="col-sm-12">

                    @if($lead_manager_admin == true)
                        @if($order_status == 'Ready to QA' || $order_status == 'QA In Progress' || $order_status == 'QA Approved'  || $order_status == 'QA Rejected')
                        @else
                            <div class="form-group col-md-12"> 
                                <div class="input-group">
                                    <!-- <input type="text" name="" id="" class="form-control" placeholder="Assign More"> -->
                                    <select id='all_writers' class="form-control select2" style='width: 200px;'   onChange='assign_writer(this,{{$id}})'>
                                        <option value=""></option>
                                        @foreach($users as $ukey=>$uvalue)
                                            <option value="{{$uvalue->id}}">{{$uvalue->name}} ({{$uvalue->order_assigns_count}})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                      
                    @endif
                        <div class="form-group col-md-12"> 
                        <div class="input-group">
                                        
                                <table   class="table table-bordered text-nowrap dataTable no-footer"
                                                    id="lead_docs_table"
                                                    role="grid"
                                                    aria-describedby="example1_info">
                                                <thead>
                                                    <tr>
                                                        <th>S.no</th>
                                                        <th>Assigned To</th>
                                                        <th>Current Status</th>
                                                        <th>Progress</th>
                                                        <th>Assigned_date</th>
                                                        @if($lead_manager_admin == true)
                                                            <th>Action</th>
                                                        @endif
                                                    </tr>
                                                </thead>
                                            <tbody>
                                            <?php $i=1;?>
                                            @foreach($result as $key=>$value)
                                                <tr>
                                                    <td>{{$i}}</td>
                                                    <td>{{$value->first_name}} {{$value->last_name}}</td>
                                                    <td>{{$value->status_id}}</td>
                                                    <td>
                                                        <div class="progress progress-md mb-3">
											                <div class="progress-bar progress-bar-striped progress-bar-animated bg-green" style="width: {{$value->completed}}%">{{$value->completed}}%</div>
										                </div>
                                                    </td>
                                                    <td>{{$value->created_at}}</td>
                                              
                                                    @if($lead_manager_admin == true)
                                                    
                                                    <td><i class="fa fa-trash" onClick="delete_user_task({{$value->order_assign_id}})" title="remove task" style="cursor:pointer"></i>  
                                                    <!-- <i class="fa fa-exchange"  style="cursor:pointer" title="task revoke"></i> -->
                                                    </td>  @endif
                                        
                                                </tr>

                                                <?php $i++;?>
                                            @endforeach
                                                
                                            </tbody>
                                </table>           
                            </div>
                        </div>
                        
                             
                        </div>


                        </div>
                        </div>       </div>


					<div class="modal-footer">
					    <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
					</div>
				</div>
			</div>
		</div>
		</div>