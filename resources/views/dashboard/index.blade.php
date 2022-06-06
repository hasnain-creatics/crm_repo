@extends('layouts.app')

@section('content')
                        <div class="page-header">
							<div class="page-leftheader">
								<h4 class="page-title mb-0 text-primary">Dashboard</h4>
							
							</div>
							<div class="page-rightheader">
								<!-- <div class="btn-list"> -->
										<div>
										Excellent Rate: <span>{{$user_rating}}%</span>
										
										</div>
										<div>
										<i class='fa fa-star stars star1 {{$user_rating >=0 ? "checked" : ""}}' style="font-size:20px"></i>
										<i class='fa fa-star stars star2 {{$user_rating >=39  ? "checked" : ""}} ' style="font-size:20px"></i>
										<i class='fa fa-star stars star3 {{$user_rating >=59 ? "checked" : ""}} ' style="font-size:20px"></i>
										<i class='fa fa-star stars star4 {{$user_rating >=89 ? "checked" : ""}} ' style="font-size:20px"></i>
										<i class='fa fa-star stars star5 {{$user_rating >=99 ? "checked" : ""}} ' style="font-size:20px"></i>
										</div>
								<!-- </div> -->
							</div>
						</div>

                            <dashboard-count-component role="{{Auth::user()->roles[0]->name}}"></dashboard-count-component>

							<div class="row">


							<!-- lead_manager_admin -->
		@if(!$lead_manager_admin )
			
			<urgent-task-component></urgent-task-component>

			<new-task-component></new-task-component>

			<inprogress-task-component></inprogress-task-component>

			<feedback-task-component></feedback-task-component>
						
		@endif

		@if($lead_manager_admin)
			
			<urgent-task-component></urgent-task-component>
			<new-task-component></new-task-component>
			<unassigned-component></unassigned-component>
			<inprogress-task-component></inprogress-task-component>
			<feedback-task-component></feedback-task-component>

			<required-qa-component></required-qa-component>

		@endif




							</div>









@endsection
<!-- <script src="{{asset('public')}}/assets/plugins/bootstrap/js/bootstrap.min.js"></script>  -->