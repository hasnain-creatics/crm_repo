<template>
  <div class="col-lg-6">
    <div class="card">
      <div class="card-header bg-primary">
        <h3 class="card-title text-white">FEEDBACK TASK</h3>
        <div class="card-options">
          <a
            href="javascript:void(0);"
            class="card-options-collapse me-2 text-white"
            data-bs-toggle="card-collapse"
            ><i class="fe fe-chevron-up"></i
          ></a>
          <a
            href="javascript:void(0);"
            class="card-options-remove text-white"
            data-bs-toggle="card-remove"
            ><i class="fe fe-x"></i
          ></a>
        </div>
      </div>
      <div class="card-body" style="max-height:300px;overflow: auto">
        <!-- sale_order_uploaded_document -->

       <dashboard-table-component :result="result" :total_record="total_record"></dashboard-table-component>
      </div>
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
  </div>
</template>


<script>
export default {
  data() {
    return {
      s_no: 1,
      result: [],
      page_links: "",
      url: this.$hostname + "dashboard/writer_feedback_tasks?page=1",
      current_page : 1,
      total_record: 0,
    };
  },
  methods: {
    async page_links_method(ele) {

        this.url = ele

        this.fetch_urgent_record(this.url);

    },
    async fetch_urgent_record(url) {
      await axios

        .get(url)

        .then((response) => {

          this.result = response.data.data;

          this.page_links = response.data.links;

          this.current_page = response.data.current_page;

          this.total_record = response.data.total;

        });
    },
  },
  async mounted() {
    this.fetch_urgent_record(this.url);
   // this.interval = setInterval(() =>this.fetch_urgent_record(this.url), 5000);
    

  },
};
</script>