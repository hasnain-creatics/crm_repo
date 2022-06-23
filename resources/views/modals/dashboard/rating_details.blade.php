<div class="modal fade " id="ratings_modal" style="display: block; padding-right: 17px;" aria-modal="true" role="dialog">
			<div class="modal-dialog modal-lg modal-dialog-centered text-center" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">Rating Details </h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
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
                                                        <th>Ref</th>
                                                        <th>Order</th>
                                                        <th>User Name</th>
                                                        <th>Compliance & Relevance</th>
                                                        <th>Overall Quality Of The Content</th>
                                                        <th>Referencing</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php  $i =1;?>
                                                    @foreach($user_ratings as $key=>$value)
                                                        @if(count($value['results']) > 1)
                                                            @foreach($value['results'] as $rk=>$rv)
                                                                <tr>
                                                                    <?php echo ($rk==0 ? "<td style='vertical-align: middle;' rowspan='".count($value['results'])."'>".$i."</td>" : ''); ?>
                                                                    <?php echo ($rk==0 ? "<td style='vertical-align: middle;' rowspan='".count($value['results'])."'>ORDER-".$value['order_id']."</td>" : ''); ?>
                                                                    <td  style='vertical-align: middle;' >{{$rv['first_name']}} {{$rv['last_name']}}</td> 
                                                                    <td  style='vertical-align: middle;' >
                                                                 
                                                                  <?php 
                                                                    $compilance = $rv['compliance_and_relevance'];
                                                                    ?>
                                                                      <i class="fa fa-star" style="<?php echo  $compilance >= 1  ?  'color : red' : ''; ?>"></i>
                                                                      <i class="fa fa-star" style="<?php echo  $compilance >= 2 ?  'color : red' : ''; ?>"></i>
                                                                      <i class="fa fa-star" style="<?php echo  $compilance >= 3 ?  'color : red' : ''; ?>"></i>
                                                                      <i class="fa fa-star" style="<?php echo  $compilance == 4 ?  'color : red' : ''; ?>"></i>
                                                                </td> 
                                                                <td  style='vertical-align: middle;' >
                                                                 
                                                                    <?php $overall =$rv['overall_quality_of_the_content']; ?>
                                                                      <i class="fa fa-star" style="<?php echo  $overall >= 1  ?  'color : red' : ''; ?>"></i>
                                                                      <i class="fa fa-star" style="<?php echo  $overall >= 2 ?  'color : red' : ''; ?>"></i>
                                                                      <i class="fa fa-star" style="<?php echo  $overall >= 3 ?  'color : red' : ''; ?>"></i>
                                                                      <i class="fa fa-star" style="<?php echo  $overall == 4 ?  'color : red' : ''; ?>"></i>
                                                                      
                                                                </td> 
                                                                <td  style='vertical-align: middle;' >
                                                                  
                                                                    <?php $reference = $rv['referencing'];?>
                                                                    <i class="fa fa-star" style="<?php echo  $reference >= 1  ?  'color : red' : ''; ?>"></i>
                                                                      <i class="fa fa-star" style="<?php echo  $reference >= 2 ?  'color : red' : ''; ?>"></i>
                                                                      <i class="fa fa-star" style="<?php echo  $reference >= 3 ?  'color : red' : ''; ?>"></i>
                                                                      <i class="fa fa-star" style="<?php echo  $reference == 4 ?  'color : red' : ''; ?>"></i>
                                                                </td> 
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                <td  style='vertical-align: middle;' >{{$i}}</td> 
                                                                <td  style='vertical-align: middle;' >ORDER-{{$value['order_id']}}</td> 
                                                                <td  style='vertical-align: middle;' >{{$value['results'][0]['first_name']}} {{$value['results'][0]['last_name']}}</td> 
                                                                <td  style='vertical-align: middle;' >
                                                                 
                                                                  <?php 
                                                                    $compilance = $value['results'][0]['compliance_and_relevance'];
                                                                    ?>
                                                                      <i class="fa fa-star" style="<?php echo  $compilance >= 1  ?  'color : red' : ''; ?>"></i>
                                                                      <i class="fa fa-star" style="<?php echo  $compilance >= 2 ?  'color : red' : ''; ?>"></i>
                                                                      <i class="fa fa-star" style="<?php echo  $compilance >= 3 ?  'color : red' : ''; ?>"></i>
                                                                      <i class="fa fa-star" style="<?php echo  $compilance == 4 ?  'color : red' : ''; ?>"></i>
                                                                </td> 
                                                                <td  style='vertical-align: middle;' >
                                                                 
                                                                    <?php $overall =$value['results'][0]['overall_quality_of_the_content']; ?>
                                                                      <i class="fa fa-star" style="<?php echo  $overall >= 1  ?  'color : red' : ''; ?>"></i>
                                                                      <i class="fa fa-star" style="<?php echo  $overall >= 2 ?  'color : red' : ''; ?>"></i>
                                                                      <i class="fa fa-star" style="<?php echo  $overall >= 3 ?  'color : red' : ''; ?>"></i>
                                                                      <i class="fa fa-star" style="<?php echo  $overall == 4 ?  'color : red' : ''; ?>"></i>
                                                                      
                                                                </td> 
                                                                <td  style='vertical-align: middle;' >
                                                                  
                                                                    <?php $reference = $value['results'][0]['referencing'];?>
                                                                    <i class="fa fa-star" style="<?php echo  $reference >= 1  ?  'color : red' : ''; ?>"></i>
                                                                      <i class="fa fa-star" style="<?php echo  $reference >= 2 ?  'color : red' : ''; ?>"></i>
                                                                      <i class="fa fa-star" style="<?php echo  $reference >= 3 ?  'color : red' : ''; ?>"></i>
                                                                      <i class="fa fa-star" style="<?php echo  $reference == 4 ?  'color : red' : ''; ?>"></i>
                                                                </td> 
                                                            </tr>
                                                        @endif
                                                        <?php $i++;?>
                                                    @endforeach
                                                </tbody>
                                            </table>           
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                        </div>  
                    </div>

					<div class="modal-footer">
                     
					    <!-- <button class="btn btn-primary"  type="button">Make Order</button> -->

					    <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>

					</div>
				</div>
			</div>
		</div>
		</div>