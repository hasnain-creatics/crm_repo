@extends('layouts.app')

@section('content')
<!--Page header-->
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title mb-0 text-primary"></h4>
    </div>
    <div class="page-rightheader">
    @can('role-add')
        <div class="btn-list">
                <a href="{{route('subjects.add')}}" class="btn btn-primary btn-pill" >
                    <i class="fa fa-plus"></i> Add New</a>
        </div>
    @endcan
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Subjects</div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                        <div class="row">
                       
                        </div>
                        <div class="row">
                        <?php 
                            $edit_subjects = "hide-btn";
                            $delete_subjects = "hide-btn";
                        ?>    
                        @can('subjects-edit')

                                <?php 
                                            $edit_subjects  = "";
                                                                       
                                ?>

                        @endcan
                        @can('subjects-delete')

<?php 
            $delete_subjects  = "";
                                       
?>

@endcan

                        
                    
                            <subjects-list-component edit_subjects="{{$edit_subjects}}"  delete_subjects="{{$delete_subjects}}"></subjects-list-component>
                            
                        </div>
                  
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection



