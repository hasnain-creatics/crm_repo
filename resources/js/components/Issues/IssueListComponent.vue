<template>
           <div class="col-sm-12">
         
               <table class="table table-bordered text-nowrap dataTable no-footer" id="example1" role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="wd-15p border-bottom-0 sorting sorting_asc" tabindex="0">Name</th>                                 
                                            <th class="wd-15p border-bottom-0 sorting sorting_asc" tabindex="0">Action</th>                                 
                                            <th class="wd-15p border-bottom-0 sorting sorting_asc" tabindex="0">Stastus</th>                                 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="user in results" :key="user.id">
                                            <td>{{user.issue}}</td>
                                            <td>{{user.status}}</td>
                                            <td><a :href="'./issue/add/'+user.id" :class="'btn btn-primary edit_ '+edit_issue" >Edit</a>
                                           <button :class="'btn btn-danger delete_ '+delete_issue" @click="deleteIssue(user.id)">Delete</button>
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
      url: this.$hostname + "issue/issues?page=1",
      current_page : 1,
      total_record: 0,
    }
  },
  props: ['edit_issue','delete_issue'],
    methods:{

    async page_links_method(ele) {

        this.url = ele

        this.fetch_urgent_record(this.url);

    },
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
                        window.location.href = main_url+'/issue/delete/'+ele;
                    // },1000);
                    
              } else {
                swal("Cancelled", "Data is safe now", "error");
              }
            });

        },
        async fetch_urgent_record(ele){
            
            const response = await fetch(ele);
            
            const data = await response.json();
       
            this.results = data.data;

            this.page_links = data.links;

            this.current_page = data.current_page;

            this.total_record = data.total;
        }
    },
    
    async created() {
       this.fetch_urgent_record(this.url)
 }
 }
</script>

<style>
.hide-btn{
    display:none
}
</style>