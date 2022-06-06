<template>

  <div class="row">
    <div class="col-xl-3 col-lg-12 col-md-12 col-xm-12">
      <div class="card overflow-hidden dash1-card border-0 dash1">
        <div class="card-body">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-12">
              <div class="">
                <span class="fs-14 font-weight-normal">Urgent Task</span>
                <h2 class="mb-2 number-font carn1 font-weight-bold">
                  {{ result.urgent_count }}
                </h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-lg-12 col-md-12 col-xm-12" v-if="lead_manager_admin">
      <div class="card overflow-hidden dash1-card border-0 dash2">
        <div class="card-body">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-12">
              <div class="">
                <span class="fs-14 font-weight-normal">Unassigned</span>
                <h2 class="mb-2 number-font carn1 font-weight-bold">
                  {{ result.unassigned }}
                </h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="col-xl-3 col-lg-12 col-md-12 col-xm-12"  v-if="role == 'Writer'">
      <div class="card overflow-hidden dash1-card border-0 dash3">
        <div class="card-body">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-12">
              <div class="">
                <span class="fs-14 font-weight-normal" >New Task</span>
                <h2 class="mb-2 number-font carn1 font-weight-bold">
                  {{ result.new_count }}
                </h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="col-xl-3 col-lg-12 col-md-12 col-xm-12 "  v-if="role == 'Writer'">
      <div class="card overflow-hidden dash1-card border-0 dash4">
        <div class="card-body">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-12">
              <div class="">
                <span class="fs-14 font-weight-normal">Inprogress</span>
                <h2 class="mb-2 number-font carn1 font-weight-bold">
                  {{ result.in_progress }}
                </h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    
    <div class="col-xl-3 col-lg-12 col-md-12 col-xm-12">
      <div class="card overflow-hidden dash1-card border-0 dash2">
        <div class="card-body">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-12">
              <div class="">
                <span class="fs-14 font-weight-normal">Feedback</span>
                <h2 class="mb-2 number-font carn1 font-weight-bold">
                  {{ result.in_progress }}
                </h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    
    <div class="col-xl-3 col-lg-12 col-md-12 col-xm-12"  v-if="lead_manager_admin">
      <div class="card overflow-hidden dash1-card border-0 dash3">
        <div class="card-body">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-12">
              <div class="">
                <span class="fs-14 font-weight-normal">Required QA</span>
                <h2 class="mb-2 number-font carn1 font-weight-bold">
                  {{ result.ready_to_qa }}
                </h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>





  </div>
</template>

<script>
export default {
  props:['role'],
  data() {
    return {
      result: [],
      lead_manager_admin: false,
    };
  },
  methods:{
        async data_method(){
            await axios.get(this.$hostname + "dashboard/countes").then((response) => {
                this.result = response.data;
                this.lead_manager_admin = response.data.lead_manager_admin;
            });
        }
  },
  async created() {
   
    this.data_method();
  },
};
</script>