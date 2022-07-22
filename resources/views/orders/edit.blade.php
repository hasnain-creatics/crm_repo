@extends('layouts.app')

@section('content')

<!--Page header-->
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title mb-0 text-primary"></h4>
    </div>
    <div class="page-rightheader">
        <div class="btn-list"> <button class="btn btn-secondary" onclick='orderMessages("{{$id}}")' style='cursor:pointer' title='Order Messages'>Order Chats</button> 
            <a href="{{route('orders.home')}}" class="btn btn-primary btn-pill" >
            <i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Add Order</div>
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
                        @if(isset($upsell))
                            <orders-edit-component id="{{$id}}" upsell='yes'> </orders-edit-component>
                            @else
                            <orders-edit-component id="{{$id}}" upsell='no'> </orders-edit-component>
                        @endif
                        
                            
                        
                        
            </div>
        </div>
    </div>
</div>
@endsection

@section('after_script')

@endsection
