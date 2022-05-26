@extends('layouts.app')

@section('content')
<!--Page header-->
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title mb-0 text-primary"></h4>
    </div>
    <div class="page-rightheader">
        <div class="btn-list">
            <a href="{{url('admin/currency')}}" class="btn btn-primary btn-pill" >
                <i class="fa fa-arrow-left"></i> Back</a>

        </div>
    </div>
</div>
<div class="row">
    
    <subjects-edit-component role_id="{{$id}}"></subjects-edit-component>
</div>
@endsection



