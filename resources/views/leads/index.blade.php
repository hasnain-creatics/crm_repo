@extends('layouts.app')

@section('content')
<!--Page header-->
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title mb-0 text-primary"></h4>
    </div>
    <div class="page-rightheader">
    @can('user-add')
        <div class="btn-list">
            <a href="{{route('leads.add')}}" class="btn btn-primary btn-pill" >
                <i class="fa fa-plus"></i> Add New</a>
        </div>
    @endcan
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Leads</div>


                
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                      
                        <div class="row">

                      <form >
                                @if(Session::has('success'))
                                    <div class="alert alert-success">
                                        {{ Session::get('success') }}
                                        @php
                                            Session::forget('success');
                                        @endphp
                                    </div>
                                    @endif
                                <div class="row">
                                <div class="col-md-2">
                                    <div class="input-group mb-4">
                                         <input type="text" class="form-control input-text"  name="email" placeholder="Search Email...." aria-label="Recipient's username" aria-describedby="basic-addon2"  id="filter_email">
                                        
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="input-group mb-4"> <input type="text"   name="phone_number"  class="form-control input-text" id="filter_phone" placeholder="Search Phone...." aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    
                                    </div>
                                </div>


                                <div class="col-md-2">
                                    <div class="input-group mb-4"> 
                                        <select    name="role" id="filter_designation" class="form-control input-text" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                       
                                        </select>
                                    </div>
                                
                                </div>

                                <div class="col-md-2">
                                    <div class="input-group mb-4"> 
                                        <select    name="status" id="filter_status" class="form-control input-text" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                            <option value="">Status</option>
                                            <option value="ACTIVE">Active</option>
                                            <option value="INACTIVE">Inactive</option>
                                        </select>
                                    </div>
                                
                                </div>
                                <div class="col-md-1">
                                    <div class="input-group mb-1"> 
                                        <button class="btn btn-outline-primary" id="filter" type="button"><i class="fa fa-search"></i> Filter</button> 
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group mb-2"> 
                                        <button class="btn btn-outline-primary" id="reset" type="button"><i class="fa fa-undo"></i> Reset</button> 
                                    </div>
                                </div>

                            </div>

                            </div>
                      </form>
                          
                    </div>
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