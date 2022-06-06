<div class="modal fade effect-slide-in-right " id="add_order_feedback" style="display: block; padding-right: 17px;" aria-modal="true" role="dialog">
			<div class="modal-dialog modal-lg modal-dialog-centered text-center" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">Add Order Feedback  / ORDER-{{$id}}</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
					</div>
             
				<div class="modal-body">
                        <input type="hidden" class="delivered_order_id" value="{{$id}}">
                        <textarea name="feedback" class="form-control" id="feedback" cols="25" rows="5"></textarea>
	           </div>
               <div class="modal-footer">
						 <button class="btn btn-danger"  type="button" id="submit_feedback" >Submit</button>
						 <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
				</div>
			</div>
		</div>