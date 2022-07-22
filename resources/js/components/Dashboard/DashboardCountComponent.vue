<template>
   <div>
      <section class="dashboard-task-carousel-section">
         <div class="container-fluid">
            <div class="row">
               <div class="owl-carousel owl-theme dashboard-task-carousel">

              

                     <div v-if="role == 'Sale Manager' || role == 'Sale Agent' || role == 'Admin'" class="item task urgent_task">
                        <div class="card overflow-hidden dash1-card border-0 dash1">
                           <div class="card-body">
                              <div class="row">
                                 <div class="col-md-12 col-sm-12 col-12">
                                    <div class="">
                                       <span class="fs-14 font-weight-normal">TODAY'S SALES</span>
                                       <h2 class="mb-2 number-font carn1 font-weight-bold">
                                          ${{ result.todays_paid }}/${{ result.todays_sale }}
                                       </h2>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>


                     <div class="item task" v-if="role == 'Admin'" @click="load_card_details('todays_leads')">
                    <div class="card overflow-hidden dash1-card border-0 dash1">
                           <div class="card-body">
                              <div class="row">
                                 <div class="col-md-12 col-sm-12 col-12">
                                    <div class="">
                                       <span class="fs-14 font-weight-normal">TODAYS LEADS</span>
                                       <h2 class="mb-2 number-font carn1 font-weight-bold">
                                          {{ result.todays_leads }}
                                       </h2>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="item task" v-if="role == 'Admin'"  @click="load_card_details('todays_orders')">
                        <div class="card overflow-hidden dash1-card border-0 dash1">
                           <div class="card-body">
                              <div class="row">
                                 <div class="col-md-12 col-sm-12 col-12">
                                    <div class="">
                                       <span class="fs-14 font-weight-normal">TODAYS ORDERS</span>
                                       <h2 class="mb-2 number-font carn1 font-weight-bold">
                                          {{ result.todays_orders }}
                                       </h2>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="item task" v-if="role == 'Admin'"  @click="load_card_details('monthly_leads')">
                        <div class="card overflow-hidden dash1-card border-0 dash2">
                           <div class="card-body">
                              <div class="row">
                                 <div class="col-md-12 col-sm-12 col-12">
                                    <div class="">
                                       <span class="fs-14 font-weight-normal">MONTHLY LEADS</span>
                                       <h2 class="mb-2 number-font carn1 font-weight-bold">
                                          {{ result.monthly_leads }}
                                       </h2>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="item task" v-if="role == 'Admin'"  @click="load_card_details('monthly_orders')">
                        <div class="card overflow-hidden dash1-card border-0 dash1">
                           <div class="card-body">
                              <div class="row">
                                 <div class="col-md-12 col-sm-12 col-12">
                                    <div class="">
                                       <span class="fs-14 font-weight-normal">MONTHLY ORDERS</span>
                                       <h2 class="mb-2 number-font carn1 font-weight-bold">
                                          {{ result.monthly_orders }}
                                       </h2>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>


                     <div v-if="role == 'Sale Manager' || role == 'Sale Agent' || role == 'Admin'"  class="item task urgent_task">
                        <div class="card overflow-hidden dash1-card border-0 dash4">
                           <div class="card-body">
                              <div class="row">
                                 <div class="col-md-12 col-sm-12 col-12">
                                    <div class="">
                                       <span class="fs-14 font-weight-normal">THIS MONTH SALES</span>
                                       <h2 class="mb-2 number-font carn1 font-weight-bold">
                                          ${{ result.month_paid }}/${{ result.month_sale }}
                                       </h2>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>


                     <!-- <div v-if="role == 'Sale Manager' || role == 'Sale Agent'" class="item task urgent_task">
                        <div class="card overflow-hidden dash1-card border-0 dash4">
                           <div class="card-body">
                              <div class="row">
                                 <div class="col-md-12 col-sm-12 col-12">
                                    <div class="">
                                       <span class="fs-14 font-weight-normal">THIS MONTH SALES</span>
                                       <h2 class="mb-2 number-font carn1 font-weight-bold">
                                          ${{ result.month_paid }}/${{ result.month_sale }}
                                       </h2>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div> -->



















                  <div v-if="role == 'Writer' || role == 'Writer Manager'" class="item task urgent_task"
                     @click="load_card_details('urgent_task')">
                     <div class="card overflow-hidden dash1-card border-0 dash1">
                        <div class="card-body">
                           <div class="row">
                              <div class="col-md-12 col-sm-12 col-12">
                                 <div class="">
                                    <span class="fs-14 font-weight-normal">URGENT TASK</span>
                                    <h2 class="mb-2 number-font carn1 font-weight-bold">
                                       {{ result.urgent_count }}
                                    </h2>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>


                  <div v-if="role == 'Sale Manager' || role == 'Sale Agent'" class="item task urgent_task">
                     <div class="card overflow-hidden dash1-card border-0 dash1">
                        <div class="card-body">
                           <div class="row">
                              <div class="col-md-12 col-sm-12 col-12">
                                 <div class="">
                                    <span class="fs-14 font-weight-normal">TODAY'S FEEDBACKS</span>
                                    <h2 class="mb-2 number-font carn1 font-weight-bold">
                                       {{ result.todays_feedback }}
                                    </h2>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>


                  <div v-if="role == 'Sale Manager' || role == 'Sale Agent'" class="item task urgent_task"
                     @click="load_card_details('today_deliverable')">
                     <div class="card overflow-hidden dash1-card border-0 dash1">
                        <div class="card-body">
                           <div class="row">
                              <div class="col-md-12 col-sm-12 col-12">
                                 <div class="">
                                    <span class="fs-14 font-weight-normal">TODAY'S DELIVERABLES</span>
                                    <h2 class="mb-2 number-font carn1 font-weight-bold">
                                       {{ result.todays_deliveries }}
                                    </h2>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>


                  <div v-if="role == 'Sale Manager' || role == 'Sale Agent'" class="item task urgent_task">
                     <div class="card overflow-hidden dash1-card border-0 dash1">
                        <div class="card-body">
                           <div class="row">
                              <div class="col-md-12 col-sm-12 col-12">
                                 <div class="">
                                    <span class="fs-14 font-weight-normal">THIS MONTH FEEDBACKS</span>
                                    <h2 class="mb-2 number-font carn1 font-weight-bold">
                                       {{ result.month_feedback }}
                                    </h2>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>




                  <div v-if="role == 'Sale Manager' || role == 'Sale Agent'" class="item task urgent_task"
                     @click="load_card_details('monthly_deliverable')">
                     <div class="card overflow-hidden dash1-card border-0 dash1">
                        <div class="card-body">
                           <div class="row">
                              <div class="col-md-12 col-sm-12 col-12">
                                 <div class="">
                                    <span class="fs-14 font-weight-normal">THIS MONTH DELIVERABLES</span>
                                    <h2 class="mb-2 number-font carn1 font-weight-bold">
                                       {{ result.month_deliveries }}
                                    </h2>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>



                     <div class="item task" v-if="(role == 'Writer' || role == 'Writer Manager')"
                        @click="load_card_details('unassigned')">
                        <div class="card overflow-hidden dash1-card border-0 dash2" v-if="lead_manager_admin">
                           <div class="card-body">
                              <div class="row">
                                 <div class="col-md-12 col-sm-12 col-12">
                                    <div class="">
                                       <span class="fs-14 font-weight-normal">UNASSIGNED</span>
                                       <h2 class="mb-2 number-font carn1 font-weight-bold">
                                          {{ result.unassigned }}
                                       </h2>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
          

                  <div class="item task" v-if="role == 'Writer Manager'" @click="load_card_details('new_task')">
                     <div class="card overflow-hidden dash1-card border-0 dash3">
                        <div class="card-body">
                           <div class="row">
                              <div class="col-md-12 col-sm-12 col-12">
                                 <div class="">
                                    <span class="fs-14 font-weight-normal">NEW TASK</span>
                                    <h2 class="mb-2 number-font carn1 font-weight-bold">
                                       {{ result.new_count }}
                                    </h2>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>


                  <div class="item task" v-if="role == 'Writer'" @click="load_card_details('inprogress')">
                     <div class="card overflow-hidden dash1-card border-0 dash4">
                        <div class="card-body">
                           <div class="row">
                              <div class="col-md-12 col-sm-12 col-12">
                                 <div class="">
                                    <span class="fs-14 font-weight-normal">INPROGRESS</span>
                                    <h2 class="mb-2 number-font carn1 font-weight-bold">
                                       {{ result.in_progress }}
                                    </h2>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>



                  <div v-if="(role == 'Writer' || role == 'Writer Manager')" class="item task"
                     @click="load_card_details('feedback')">
                     <div class="card overflow-hidden dash1-card border-0 dash2">
                        <div class="card-body">
                           <div class="row">
                              <div class="col-md-12 col-sm-12 col-12">
                                 <div class="">
                                    <span class="fs-14 font-weight-normal">FEEDBACK</span>
                                    <h2 class="mb-2 number-font carn1 font-weight-bold">
                                       {{ result.feedback }}
                                    </h2>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

          
                     <div class="item task" v-if="(role == 'Writer' || role == 'Writer Manager')"
                        @click="load_card_details('require_qa')">
                        <div class="card overflow-hidden dash1-card border-0 dash3"  v-if="lead_manager_admin">
                           <div class="card-body">
                              <div class="row">
                                 <div class="col-md-12 col-sm-12 col-12">
                                    <div class="">
                                       <span class="fs-14 font-weight-normal">REQUIRED QA</span>
                                       <h2 class="mb-2 number-font carn1 font-weight-bold">
                                          {{ result.ready_to_qa }}
                                       </h2>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
        

                  <div class="item task" v-if="(role == 'Writer')" @click="load_card_details('pending')">
                     <div class="card overflow-hidden dash1-card border-0 dash3">
                        <div class="card-body">
                           <div class="row">
                              <div class="col-md-12 col-sm-12 col-12">
                                 <div class="">
                                    <span class="fs-14 font-weight-normal">PENDING</span>
                                    <h2 class="mb-2 number-font carn1 font-weight-bold">
                                       {{ result.pending }}
                                    </h2>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>



                  <div class="item task" v-if="(role == 'Writer')" @click="load_card_details('qa_approved')">
                     <div class="card overflow-hidden dash1-card border-0 dash3">
                        <div class="card-body">
                           <div class="row">
                              <div class="col-md-12 col-sm-12 col-12">
                                 <div class="">
                                    <span class="fs-14 font-weight-normal">QA APPROVED</span>
                                    <h2 class="mb-2 number-font carn1 font-weight-bold">
                                       {{ result.qa_approved }}
                                    </h2>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>



                  <div class="item task" v-if="(role == 'Writer')" @click="load_card_details('qa_rejected')">
                     <div class="card overflow-hidden dash1-card border-0 dash3">
                        <div class="card-body">
                           <div class="row">
                              <div class="col-md-12 col-sm-12 col-12">
                                 <div class="">
                                    <span class="fs-14 font-weight-normal">QA REJECTED</span>
                                    <h2 class="mb-2 number-font carn1 font-weight-bold">
                                       {{ result.qa_rejected }}
                                    </h2>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>






               </div>
            </div>
         </div>
      </section>



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
         <pending-component v-if="cards.pending"></pending-component>
         <qa-rejected-component v-if="cards.qa_rejected"></qa-rejected-component>
         <qa-approved-component v-if="cards.qa_approved"></qa-approved-component>
         <todays-leads-component v-if="cards.todays_leads"></todays-leads-component>
         <todays-orders-component v-if="cards.todays_orders"></todays-orders-component>
         <monthly-leads-component v-if="cards.monthly_leads"></monthly-leads-component>
         <monthly-orders-component v-if="cards.monthly_orders"></monthly-orders-component>
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
            pending: false,
            qa_approved: false,
            qa_rejected: false,
            todays_leads: (this.role == 'Admin' ? true : false),
            todays_orders: false,
            monthly_leads: false,
            monthly_orders: false,
            sale_urgent_order: (this.role == 'Sale Agent' || this.role == 'Sale Manager' || this.role == 'Sale Agent') ? true : '',
            today_deliverable: (this.role == 'Sale Agent' || this.role == 'Sale Manager' || this.role == 'Sale Agent') ? true : '',
            monthly_deliverable: false
         },
      };
   },
   methods: {
      async data_method() {
         await axios.get(this.$hostname + "dashboard/countes").then((response) => {
            console.log(response)
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
         this.cards.pending = false;
         this.cards.qa_approved = false;
         this.cards.qa_rejected = false;
         this.cards.today_deliverable = false;
         this.cards.monthly_deliverable = false;
         this.cards.todays_leads = false;
         this.cards.monthly_leads = false;
         this.cards.todays_orders = false;
         this.cards.monthly_orders = false;
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


         if (ele == "pending") {
            this.cards.pending = true;
         }
         if (ele == "qa_approved") {
            this.cards.qa_approved = true;
         }
         if (ele == "qa_rejected") {
            this.cards.qa_rejected = true;
         }

         if (ele == "sale_urgent_order") {
            this.cards.sale_urgent_order = true;
         }
         if (ele == "today_deliverable") {
            this.cards.today_deliverable = true;
         }
         if (ele == "monthly_deliverable") {
            this.cards.monthly_deliverable = true;
         }
         if (ele == "todays_leads") {
            this.cards.todays_leads = true;
         }
         if (ele == "monthly_leads") {
            this.cards.monthly_leads = true;
         }
         if (ele == "todays_orders") {
            this.cards.todays_orders = true;
         }
         if (ele == "monthly_orders") {
            this.cards.monthly_orders = true;
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



.dashboard-task-carousel .owl-prev {
   position: absolute;
   top: 20%;
   left: -6px;
}

.dashboard-task-carousel .owl-prev span {
   background: #d9e8f3;
   display: inline-block;
   border-radius: 50%;
   font-size: 35px;
   line-height: 30px;
   width: 35px;
   height: 35px;
   font-weight: 600;
   color: #0f3854;
   box-shadow: 0px 0px 6px #1294f761;
}

.dashboard-task-carousel .owl-next {
   position: absolute;
   top: 20%;
   right: -6px;
}

.dashboard-task-carousel .owl-next span {
   background: #d9e8f3;
   display: inline-block;
   border-radius: 50%;
   font-size: 35px;
   line-height: 30px;
   width: 35px;
   height: 35px;
   font-weight: 600;
   color: #0f3854;
   box-shadow: 0px 0px 6px #1294f761;
}
</style>