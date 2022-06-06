@extends('layouts.app')

@section('content')
<!--Page header-->
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title mb-0 text-primary"></h4>
    </div>
    <div class="page-rightheader">
    @can('issue-add')
        <div class="btn-list">
                <a href="{{route('issue.add')}}" class="btn btn-primary btn-pill" >
                    <i class="fa fa-plus"></i> Add New</a>
        </div>
    @endcan
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Issue</div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                        <div class="row">
                       
                        </div>
                        <div class="row">
                        <?php 
                            $edit_issue = "hide-btn";
                            $delete_issue = "hide-btn";
                        ?>    
                        @can('issue-edit')

                                <?php 
                                            $edit_issue  = "";
                                ?>

                        @endcan

                        @can('issue-delete')

                                <?php 
                                            $delete_issue  = "";
                                                                       
                                ?>

                        @endcan

                            <issue-list-component edit_issue="{{$edit_issue}}"  delete_issue="{{$delete_issue}}"></issue-list-component>
                            
                        </div>
                  
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection



