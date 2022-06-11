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
                                               <!-- <button :class="'btn btn-danger delete_ '" @click="deleteIssue(user.id)">Delete</button> -->
                                               </td>
                                        </tr>
                                    </tbody>
                                </table>
                                    <ul class="pagination">
                                            <li
                                            v-for="(links, index) in page_links"
                                            :key="index"
                                            class="paginate_button page-item"
                                            :data-url="links.label"
                                            @click="page_links_method(links.url)"
                                            :class="current_page == links.label ? 'active' : ''"
                                            >
                                            <i class="page-link" v-html="links.label"></i>
                                            </li>
                                        </ul>
                                </div>
</template>

    <script>
    export default {
    data() {
        return {
        results:[],
        edit_: '',
        perm_: '',
        page_links: "",
        url: this.$hostname + "subjects/get_all_subjects?page=1",
        current_page : 1,
        total_record: 0,
        }
    },

    props: ['edit_subjects','delete_subjects'],
    
    methods:{
        deleteIssue(event){
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

        },
    async page_links_method(ele) {

        this.url = ele

        this.subject_method(this.url);

    },
        async subject_method(url){
                 const response = await fetch(url);

        const data = await response.json();
        // this.results = data;
         this.results = data.data;

          this.page_links = data.links;

          this.current_page = data.current_page;

          this.total_record = data.total;
            }
        },

    
    async mounted() {
     this.subject_method(this.url);
    }    
    }
    </script>

    <style>
    .hide-btn{
        display:none
    }
    </style>