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
                    <div class="card-title">Task Details / ORDER-{{$id}}</div>

                </div>
                <div class="card-body">
                  <task-details-component task_id="{{$id}}"></task-details-component>
                </div>
            </div>
            <!-- <modal-component></modal-component> -->
        </div>
    </div>
@endsection

@section('after_script')

@endsection