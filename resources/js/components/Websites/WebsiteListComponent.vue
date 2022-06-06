<template>
           <div class="col-sm-12">
         
               <table class="table table-bordered text-nowrap dataTable no-footer" id="example1"
                                    role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="wd-15p border-bottom-0 sorting sorting_asc" tabindex="0">Name</th>                                 
                                            <th class="wd-15p border-bottom-0 sorting sorting_asc" tabindex="0">Status</th>                                 
                                            <th class="wd-15p border-bottom-0 sorting sorting_asc" tabindex="0">Action</th>                                 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="user in results" :key="user.id">
                                            <td>{{user.name}}</td>
                                            <td>{{user.status}}</td>
                                            <td><a :href="'./websites/add/'+user.id" :class="'btn btn-primary edit_ '+edit_role" >Edit</a></td>
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
  props: ['edit_role'],
  async mounted() {
     
    const response = await fetch(this.$hostname+"websites/get_website");
        const data = await response.json();
        this.results = data;
    // alert();
        }
 }
</script>

<style>
.hide-btn{
    display:none
}
</style>