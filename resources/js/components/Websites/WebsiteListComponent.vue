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
      url: this.$hostname + "websites/get_website?page=1",
      current_page : 1,
      total_record: 0,
    }
  },
  props: ['edit_role'],
  methods: {
    async page_links_method(ele) {

        this.url = ele

        this.fetch_urgent_record(this.url);

    },
   async fetch_urgent_record(url){
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
     
    this.fetch_urgent_record(this.url);
        }
 }
</script>

<style>
.hide-btn{
    display:none
}
</style>