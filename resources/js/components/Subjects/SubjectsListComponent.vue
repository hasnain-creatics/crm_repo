<template>
           <div class="col-sm-12">
         
               <table class="table table-bordered text-nowrap dataTable no-footer" id="example1"
                                    role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="wd-15p border-bottom-0 sorting sorting_asc" tabindex="0">Name</th>                                 
                                            <th class="wd-15p border-bottom-0 sorting sorting_asc" tabindex="0">Action</th>                                 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="user in results" :key="user.id">
                                            <td>{{user.name}}</td>
                                            <td><a :href="'./subjects/add/'+user.id" :class="'btn btn-primary edit_ '+edit_subjects" >Edit</a>
                                               <button :class="'btn btn-danger delete_ '+delete_issue" @click="deleteIssue(user.id)">Delete</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                                </div>
</template>

    <script>
    export default {
    data() {
        return {
        results:[],
        edit_: '',
        perm_: ''
        }
    },

    props: ['edit_subjects','delete_subjects'],
    
    methods:{
        deleteIssue(ele){
            event.preventDefault(); // prevent form submit
            // var forms = event.target.form; // storing the form
           var form = $('.delete_submit');
                    swal({
              title: "Are you sure?",
              text: "When you click the Yes data will deleted",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes, delete it!",
              cancelButtonText: "No, cancel delete!",
              closeOnConfirm: false,
              closeOnCancel: false,
                     customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-secondary',
                }
            },
            function(isConfirm){
              if (isConfirm) {

                swal('Congratulations!', 'Data is delete successfully', 'success');
                    // setTimeout(function(){
                        window.location.href = main_url+'/subjects/delete/'+ele;
                    // },1000);
                    
              } else {
                swal("Cancelled", "Data is safe now", "error");
              }
            });

        }
    },
    async created() {
        const response = await fetch(this.$hostname+"subjects/get_all_subjects");
            const data = await response.json();
            this.results = data;
            }
    }
    </script>

    <style>
    .hide-btn{
        display:none
    }
    </style>