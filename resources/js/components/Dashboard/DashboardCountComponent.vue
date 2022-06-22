<template>
  <div>

    <!--sales manager start-->
    <div class="row">
      <div v-if="role == 'Sale Manager' || role == 'Sale Agent'"
        class="col-xl-3 col-lg-12 col-md-12 col-xm-12 task urgent_task"
      
      >
        <div class="card overflow-hidden dash1-card border-0 dash1">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-12">
                <div class="">
                  <span class="fs-14 font-weight-normal">TODAY'S SALES</span>
                  <h2 class="mb-2 number-font carn1 font-weight-bold">
                    ${{ result.todays_paid}}/${{ result.todays_sale }}
                  </h2>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div v-if="role == 'Sale Manager' || role == 'Sale Agent'"
        class="col-xl-3 col-lg-12 col-md-12 col-xm-12 task urgent_task"
      
      >
        <div class="card overflow-hidden dash1-card border-0 dash1">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-12">
                <div class="">
                  <span class="fs-14 font-weight-normal">TODAY'S FEEDBACKS</span>
                  <h2 class="mb-2 number-font carn1 font-weight-bold">
                    {{result.todays_feedback}}
                  </h2>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div v-if="role == 'Sale Manager' || role == 'Sale Agent'"
        class="col-xl-3 col-lg-12 col-md-12 col-xm-12 task urgent_task"
       @click="load_card_details('today_deliverable')"
      >
        <div class="card overflow-hidden dash1-card border-0 dash1">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-12">
                <div class="">
                  <span class="fs-14 font-weight-normal">TODAY'S DELIVERABLES</span>
                  <h2 class="mb-2 number-font carn1 font-weight-bold">
                    {{result.todays_deliveries}}
                  </h2>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>



      
      <div v-if="role == 'Sale Manager' || role == 'Sale Agent'"
        class="col-xl-3 col-lg-12 col-md-12 col-xm-12 task urgent_task"

      >
        <div class="card overflow-hidden dash1-card border-0 dash1">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-12">
                <div class="">
                  <span class="fs-14 font-weight-normal">THIS MONTH SALES</span>
                  <h2 class="mb-2 number-font carn1 font-weight-bold">
                   ${{result.month_paid}}/${{result.month_sale}}
                  </h2>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>



      
      <div v-if="role == 'Sale Manager' || role == 'Sale Agent'"
        class="col-xl-3 col-lg-12 col-md-12 col-xm-12 task urgent_task"
    
      >
        <div class="card overflow-hidden dash1-card border-0 dash1">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-12">
                <div class="">
                  <span class="fs-14 font-weight-normal">THIS MONTH FEEDBACKS</span>
                  <h2 class="mb-2 number-font carn1 font-weight-bold">
               {{result.month_feedback}}
                  </h2>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div v-if="role == 'Sale Manager' || role == 'Sale Agent'"
        class="col-xl-3 col-lg-12 col-md-12 col-xm-12 task urgent_task"
         @click="load_card_details('monthly_deliverable')"
      >
        <div class="card overflow-hidden dash1-card border-0 dash1">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-12">
                <div class="">
                  <span class="fs-14 font-weight-normal">THIS MONTH DELIVERABLES</span>
                  <h2 class="mb-2 number-font carn1 font-weight-bold">
                 

                      {{result.month_deliveries}}
                  
                  </h2>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

<!--sales manager end-->




      <div v-if="role == 'Writer' || role == 'Writer Manager'"
        class="col-xl-3 col-lg-12 col-md-12 col-xm-12 task urgent_task"
        @click="load_card_details('urgent_task')"
      >
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

      <div
        class="col-xl-3 col-lg-12 col-md-12 col-xm-12 task"
        v-if="(role == 'Writer' || role == 'Writer Manager') && lead_manager_admin"
        @click="load_card_details('unassigned')"
      >
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

      <div
        class="col-xl-3 col-lg-12 col-md-12 col-xm-12 task"
        v-if="role == 'Writer Manager'"
        @click="load_card_details('new_task')"
      >
        <div class="card overflow-hidden dash1-card border-0 dash3">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-12">
                <div class="">
                  <span class="fs-14 font-weight-normal">New Task</span>
                  <h2 class="mb-2 number-font carn1 font-weight-bold">
                    {{ result.new_count }}
                  </h2>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div
        class="col-xl-3 col-lg-12 col-md-12 col-xm-12 task"
        v-if="role == 'Writer'"
        @click="load_card_details('inprogress')"
      >
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

      <div v-if="(role == 'Writer' || role == 'Writer Manager')"
        class="col-xl-3 col-lg-12 col-md-12 col-xm-12 task"
        @click="load_card_details('feedback')"
      >
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

      <div
        class="col-xl-3 col-lg-12 col-md-12 col-xm-12 task"
        v-if="(role == 'Writer' || role == 'Writer Manager') && lead_manager_admin"
        @click="load_card_details('require_qa')"
      >
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
    <div class="row">

      <sale-urgent-orders-component v-if="cards.sale_urgent_order"></sale-urgent-orders-component>

      <todays-deliverable-component v-if="cards.today_deliverable"></todays-deliverable-component>

      <monthly-deliverable-component v-if="cards.monthly_deliverable"></monthly-deliverable-component>

      <urgent-task-component v-if="cards.urgent_task"></urgent-task-component>

      <new-task-component v-if="cards.new_task"></new-task-component>

      <unassigned-component v-if="cards.unassigned"></unassigned-component>

      <inprogress-task-component v-if="cards.inprogress"></inprogress-task-component>

      <feedback-task-component v-if="cards.feedback"></feedback-task-component>

      <required-qa-component v-if="cards.require_qa"></required-qa-component>

    </div>
  </div>
</template>

<script>
export default {
  props: ["role"],
  data() {
    return {
      result: [],
      lead_manager_admin: false,
      cards: {
        urgent_task: (this.role == 'Writer' || this.role == 'Writer Manager') ? true : '',
        unassigned: false,
        new_task: false,
        inprogress: false,
        feedback: false,
        require_qa: false,
        sale_urgent_order: (this.role == 'Sale Agent' || this.role == 'Sale Manager' || this.role == 'Sale Agent') ? true : '',
        today_deliverable: (this.role == 'Sale Agent' || this.role == 'Sale Manager' || this.role == 'Sale Agent') ? true : '',
        monthly_deliverable:false
      },
    };
  },
  methods: {
    async data_method() {
      await axios.get(this.$hostname + "dashboard/countes").then((response) => {
        this.result = response.data;
        this.lead_manager_admin = response.data.lead_manager_admin;
      });
    },
    async load_card_details(ele) {
      this.cards.urgent_task = false;
      this.cards.unassigned = false;
      this.cards.new_task = false;
      this.cards.inprogress = false;
      this.cards.feedback = false;
      this.cards.require_qa = false;
      this.cards.today_deliverable = false;
      this.cards.monthly_deliverable = false;
      if (ele == "urgent_task") {
        this.cards.urgent_task = true;
      }

      if (ele == "unassigned") {
        this.cards.unassigned = true;
      }
      if (ele == "urgent_task") {
        this.cards.urgent_task = true;
      }
      if (ele == "new_task") {
        this.cards.new_task = true;
      }
      if (ele == "inprogress") {
        this.cards.inprogress = true;
      }
      if (ele == "feedback") {
        this.cards.feedback = true;
      }
      if (ele == "require_qa") {
        this.cards.require_qa = true;
      } 
      if (ele == "sale_urgent_order") {
        this.cards.sale_urgent_order = true;
      }
    if (ele == "today_deliverable") {
      console.log('here');
        this.cards.today_deliverable = true;
      }
    if (ele == "monthly_deliverable") {
        this.cards.monthly_deliverable = true;
      }
  
    },
  },
  async mounted() {
    this.data_method();
    // this.interval = setInterval(() =>this.data_method(), 5000);
    
  },
};
</script>

<style>
.task {
  cursor: pointer;
}
</style>