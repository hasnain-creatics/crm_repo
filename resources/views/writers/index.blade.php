@extends('layouts.app')

@section('content')
<!--Page header-->
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title mb-0 text-primary"></h4>
    </div>
  
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Task Management</div>
           
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                        <writers-list-component show_tab="{{$user_show_new_table}}"></writers-list-component>
                    </div>
                </div>
            </div>
        </div>
                                                   
    </div>
</div>
@endsection
@section('after_script')

@endsection