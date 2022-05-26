<div class="modal fade effect-slide-in-right " id="lead_transfer_modal" style="display: block; padding-right: 17px;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered text-center" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Lead Transfer / LEAD-{{$lead_id}}</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
            </div>

            <div class="modal-body">

                <div class="table-responsive">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">

                        <div class="row">

                         
                                @if($results)
                              
                                    <div class="input-group">


                                        <!-- <table class="table table-bordered text-nowrap dataTable no-footer" id="lead_docs_table" role="grid" id="table_id"  aria-describedby="example1_info"> -->
                                        <table class="table table-bordered text-nowrap" id="example2">   
                                        <thead>
                                                <tr>
                                                 <th>S#</th>
                                                    <th>User ID</th>
                                                    <th>User Name</th>
                                                    <th>Email</th>
                                                    <th>Designation</th>
                                                    <th>Transfer</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i=1; ?>
                                                @foreach($results as $key=>$value)
                                                <tr class="lead_tr_{{$value->id}}">
                                                <td>{{ $i++ }}</td>
                                                    <td>{{$value->user_id}}</td>
                                                    <td>{{$value->name}}</td>
                                                    <td>{{$value->email}}</td>
                                                    <td>{{$value->role_name}}</td>
                                                    <td>
                                                        <input type="radio" class="leads_radio" {{
                                                                         
                                                          @$transfere_user_id ? $value->user_id == $transfere_user_id->user_id ? 'checked' : ''
                                                                        : ""                                                                     
                                                                    
                                                                    }} name="transfer" value="{{$value->user_id}}">
                                                    </td>

                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                              

                                @else
                                No Users Find
                                @endif
                           


                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button class="btn btn-primary" onClick="lead_transfer_user('{{$lead_id}}')" type="button">Transfer Submit</button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
       $(document).ready( function () {
    $('#example2').DataTable();
} );

</script>