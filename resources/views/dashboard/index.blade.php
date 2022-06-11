@extends('layouts.app')

@section('content')
                        <div class="page-header">
							<div class="page-leftheader">
								<h4 class="page-title mb-0 text-primary">Dashboard</h4>
							
							</div>
							<div class="page-rightheader">
							
							</div>
						</div>

                            <dashboard-count-component role="{{Auth::user()->roles[0]->name}}"></dashboard-count-component>

						
@endsection
<!-- <script src="{{asset('public')}}/assets/plugins/bootstrap/js/bootstrap.min.js"></script>  -->