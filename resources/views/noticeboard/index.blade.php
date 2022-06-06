@extends('layouts.app')

@section('content')
<!--Page header-->
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title mb-0 text-primary"></h4>
    </div>
    <div class="page-rightheader">
   
        <div class="btn-list">
            @can('noticeboard-add')
            @if(Auth::user()->roles[0]->type == 'web' || Auth::user()->roles[0]->type == 'manager' || Auth::user()->is_lead == 1)
            <a href="{{route('noticeboard.add')}}" class="btn btn-primary btn-pill" >
                <i class="fa fa-plus"></i> Add New
            </a>

            @endif
            @endcan

        </div>

    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title"><i class="fa fa-bell " aria-hidden="true"></i> Notice Board</div>

            </div>
            <div class="card-body">

            @if(Session::has('success'))
                                    <div class="alert alert-success">
                                        {{ Session::get('success') }}
                                        @php
                                            Session::forget('success');
                                        @endphp
                                    </div>
                                    @endif

                @foreach($result as $key=>$value)
                             <div class="card overflow-hidden">
									<div class="card-header bg-primary ">
										<h3 class="card-title text-white">{{$value->title}}</h3>
										<div class="card-options ">
											<a href="javascript:void(0);" class="card-options-collapse me-2" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up text-white"></i></a>
											<!-- <a href="javascript:void(0);" class="card-options-remove" data-bs-toggle="card-remove"><i class="fe fe-x text-white"></i></a> -->
										</div>
									</div>
									<div class="card-body">
										{{strip_tags($value->description)}}
									</div>
									<div class="card-footer"
                                    >Created By:
										{{$value->first_name}} {{$value->last_name}} &nbsp;
                                        @can('noticeboard-edit')
                                            @if(Auth::user()->roles[0]->name !='Admin')
                                           
                                                <!-- <a href="{{route('noticeboard.edit',$value->id)}}"><i class="fa fa-pencil"></i></a> -->
                                                
                                                        @if($value->created_by == Auth::user()->id)
                                                                                                
                                                            <a href="{{route('noticeboard.edit',$value->id)}}"><i class="fa fa-pencil"></i></a>
    
                                                        @endif

                                                @else

                                                <a href="{{route('noticeboard.edit',$value->id)}}"><i class="fa fa-pencil"></i></a>
                                            @endif

                                        @endcan
                                        <span class="float-end">{{date('d M Y H:i:s',strtotime($value->created_at))}}</span>
									</div>
								</div>
                @endforeach
                                    {!! $result->withQueryString()->links('pagination::bootstrap-5') !!}
            </div>
      
        </div>
                                                   
    </div>
</div>
</div>



@endsection

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.js"></script>
@section('after_script')


@endsection

