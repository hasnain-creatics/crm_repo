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
                                            <td><a :href="'./roles/edit/'+user.id" class="btn btn-primary">Edit</a>
                                            <a :href="'./roles/permissions/'+user.id" class="btn btn-primary">Permissions</a></td>
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
    }
  },
 async created() {
     console.log(this.$hostname);
        const response = await fetch(this.$hostname+"roles/get_roles");
            const data = await response.json();
            this.results = data;
        }
}
</script>

<style>

</style>