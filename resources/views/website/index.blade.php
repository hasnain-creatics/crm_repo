@extends('layouts.app')

@section('content')
<!--Page header-->
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title mb-0 text-primary"></h4>
    </div>
    <div class="page-rightheader">
    @can('websites-add')
        <div class="btn-list">
                <a href="{{route('website.add')}}" class="btn btn-primary btn-pill" >
                    <i class="fa fa-plus"></i> Add New</a>
        </div>
    @endcan
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Websites</div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                        <div class="row">
                       
                        </div>
                        <div class="row">
                        <?php 
                            $edit_role = "hide-btn";
                        ?>    
                        @can('websites-edit')

                                <?php 
                                            $edit_role  = "";
                                                                       
                                ?>

                        @endcan

                        
                       
                            <website-list-component edit_role="{{$edit_role}}" ></website-list-component>
                            
                        </div>
                  
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection



