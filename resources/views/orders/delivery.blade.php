@extends('layouts.app')

@section('content')
<!--Page header-->
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title mb-0 text-primary"></h4>
    </div>
    <div class="page-rightheader">
  
    </div>
</div>
<div class="row">
                        @if(Session::has('message'))
                        <div class="alert alert-danger">
                            
                            {{ Session::get('message') }}
                            @php
                                Session::forget('message');
                            @endphp
                        </div>
                        @endif
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Ready To Deliver</div>


                
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                        <delivery-list-component></delivery-list-component>
                    </div>
                </div>
            </div>
        </div>
                                                   
    </div>
</div>
@endsection
@section('after_script')

@endsection