@extends('layouts.app')

@section('content')
<!--Page header-->
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title mb-0 text-primary"></h4>
    </div>
    <div class="page-rightheader">
                    <div class="btn-list">
                          <button class="btn btn-secondary" onclick='orderMessages("{{$id}}")' style='cursor:pointer' title='Order Messages'>Order Chats</button>
                          <button class="btn btn-primary" onclick='add_feedback("{{$id}}")' style='cursor:pointer' title='Order Feedbacks'>Order Feedbacks</button>
                    </div>
                </div>
          
</div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Task Details / ORDER-{{$id}}</div>

                </div>
                <div class="card-body">
                  <task-details-component task_id="{{$id}}" role="{{Auth::user()->roles[0]->name}}"></task-details-component>
                </div>
            </div>
       
        </div>
    </div>
@endsection

@section('after_script')

@endsection