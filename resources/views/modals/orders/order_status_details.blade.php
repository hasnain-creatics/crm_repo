<div class="modal fade effect-slide-in-right " id="order_status_details" style="display: block; padding-right: 17px;" aria-modal="true" role="dialog">
			<div class="modal-dialog modal-lg modal-dialog-centered text-center" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">Order Current Status / ORDER-{{$id}}</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
					</div>
             
				<div class="modal-body" style="max-height:500px;overflow:auto">

<style type="text/css">
    .pcontainer{
        overflow: hidden;
        padding: 10px;
        position: relative;


    }
    .pcontainer:before{
        content: '';
        width: 8px;
        min-height: 100%;
        max-height: 1000%;
        background: #313131;
        position: absolute;
        left: 20px;
    }
    .content{
        background: lightblue;
        padding: 20px;
        margin: 20px 60px;
        width: 200px;
        border-radius: 8px;
        position: relative;      
    }
    .content:before{
        content: '';
        width: 20px;
        height: 20px;
        background: lightblue;
        border-radius: 0%;
        position: absolute;
        left: -10px;
        top: 50%;
       transform: translateY(-50%) rotate(45deg);
    }
     .content:after{
        content: '';
        width: 20px;
        height: 20px;
        background: #3498db;
        border-radius: 50%;
        position: absolute;
        left: -56px;
        border: solid 4px #313131;
        top: 50%;
       transform: translateY(-50%);
    }







  .current_status{
        background: lightgreen;
        padding: 20px;
        margin: 20px 60px;
        width: 500px;
        border-radius: 8px;
        position: relative;      
    }
    .current_status:before{
        content: '';
        width: 20px;
        height: 20px;
        background: lightgreen;
        border-radius: 0%;
        position: absolute;
        left: -10px;
        top: 50%;
       transform: translateY(-50%) rotate(45deg);
    }
     .current_status:after{
        content: '';
        width: 20px;
        height: 20px;
        background: #3498db;
        border-radius: 50%;
        position: absolute;
        left: -56px;
        border: solid 4px #313131;
        top: 50%;
       transform: translateY(-50%);
    }

  .status_done{
        background: lightgray;
        padding: 20px;
        margin: 20px 60px;
        width: 400px;
        border-radius: 8px;
        position: relative;      
    }
    .status_done:before{
        content: '';
        width: 20px;
        height: 20px;
        background: lightgray;
        border-radius: 0%;
        position: absolute;
        left: -10px;
        top: 50%;
       transform: translateY(-50%) rotate(45deg);
    }
     .status_done:after{
        content: '';
        width: 20px;
        height: 20px;
        background: #3498db;
        border-radius: 50%;
        position: absolute;
        left: -56px;
        border: solid 4px #313131;
        top: 50%;
       transform: translateY(-50%);
    }

</style><?php 

$current_statuss = 'New';
$old_status = "New";

if($current_statuss == "New"){
    $old_status = "New";
}

if($current_statuss == "Pending"){
    $old_status = "New";
}

if($current_statuss == "In Progress"){
    $old_status = "Pending";
}

?>
                    <div class="pcontainer">
                        @foreach($result->order_statuses as $key=>$value)
                            @if($key==0)
                                <div class="content current_status">
                                    <h3 style="text-align: left">{{$value->title}}</h3>
                                    <p style="text-align: left">Status Changed By {{$value->status_first_name}} {{$value->status_last_name}}</p>
                                    <p style="text-align: left">Status Changed At {{$value->created_at}}</p>
                                </div>
                                @else
                                
                                <div class="content status_done">
                                    <h4 style="text-align: left">{{$value->title}}</h4>
                                    <p style="text-align: left">Status Changed By {{$value->status_first_name}} {{$value->status_last_name}}</p>
                                    <p style="text-align: left">Status Changed At {{$value->created_at}}</p>
                                </div>

                            @endif
                        @endforeach
                    </div>
                    
				</div>
			</div>
		</div>