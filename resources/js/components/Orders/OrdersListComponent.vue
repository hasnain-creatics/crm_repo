<template>
  <div class="col-sm-12">
    <div class="row">
      <div class="col-md-4">
        <div class="input-group mb-4">
          <input
            type="text"
            v-model="filter.order_id"
            class="form-control input-text"
            name="order_id"
            placeholder="Reference No"
            aria-describedby="basic-addon2"
            id="filter_order_id"
          />
        </div>
      </div>
      <div class="col-md-4">
        <div class="input-group mb-4">
          <input
            type="text"
            v-model="filter.customer_email"
            class="form-control input-text"
            name="customer_email"
            placeholder="Email"
            aria-describedby="basic-addon2"
            id="filter_customer_email"
          />
        </div>
      </div>

   <div class="col-md-4">
        <div class="input-group mb-4">
          <select v-model="filter.payment_status"
            class="form-select border"
            name="payment_status"
            placeholder="Status"
           
            id="filter_payment_status">
           	<option selected disabled value="">Choose...</option>
											<option  value="PAID">Paid</option>
												<option  value="UNPAID">UnPaid</option>
												<option  value="PARTIALLY PAID">Partially Paid</option>
            </select> 

  

        </div>
      </div>


      <div class="col-md-6" v-if="more_filter">
        <div class="input-group mb-4">
          <input
            type="date"
            v-model="filter.date_start"
            class="form-control input-text"
            name="date_start"
            placeholder="Website date_start"
            aria-describedby="basic-addon2"
            id="date_start"
          />
        </div>
      </div>
      <div class="col-md-6" v-if="more_filter">
        <div class="input-group mb-4">
          <input
            type="date"
            v-model="filter.date_end"
            class="form-control input-text"
            name="date_end"
            placeholder="Website date_end"
            aria-describedby="basic-addon2"
            id="date_end"
          />
        </div>
      </div>

      </div>
      
     <div class="row">
     
      <div class="col-md-1">
        <div class="input-group mb-1">
          <button
            class="btn btn-outline-primary"
            id="filter"
            @click="filter_button"
            type="button"
          >
            <i class="fa fa-search"></i> Filter
          </button>
        </div>
      </div>

      <div class="col-md-1" v-if="less_filter">
        <div class="input-group mb-1">
          <button
            class="btn btn-outline-primary"
            id="more"
            @click="add_button"
            type="button"
          >
            <i class="fa fa-plus"></i> More
          </button>
        </div>
        
      </div>


        <div class="col-md-1" v-if="less_filterbutton">
        <div class="input-group mb-1">
          <button
            class="btn btn-outline-primary"
            id="more"
            @click="less_button"
            type="button"
          >
            <i class="fa fa-minus"></i> Less
          </button>
        </div>
        
      </div>


      <div class="col-md-2">
        <div class="input-group mb-2">
          <button class="btn btn-outline-primary" id="reset" type="button" @click="reset_button">
            <i class="fa fa-undo"></i> Reset
          </button>
        </div>
      </div>
    </div>
    <table
      class="orders_data_table table table-bordered text-nowrap dataTable no-footer"
      id="orders_data_table"
      role="grid"
      aria-describedby="example1_info"
    >
      <thead>

        <tr role="row">

          <th >S.No</th>

          <th >Ref No.</th>

          <th>Name</th>

          <th >Email</th>

          <th >Order Date</th>

          <th >Deadline</th>

          <th >Words</th>

          <th >Price (USD)</th>

          <th >Status</th>
          
          <th >Paid Amount</th>

          <th >Placed By</th>


          <th >Action</th>

        </tr>

      </thead>

      <tbody>

      </tbody>
    </table>
  </div>
</template>
<script>
export default {
  data() {
    return {
      filter: {
        order_id:"",
        customer_email:"",
        payment_status:"",
        name:"",
        url:"",
      },
      more_filter : false,
      less_filter : true,
      less_filterbutton :false,
      filter_url : this.$hostname + "orders",
      filtered_url : ""
    };
  },
  methods: {
    
    filter_button() {

      var filter_array = {};    

      filter_array.order_id = "";

      if(this.filter.order_id){

        filter_array.order_id = this.filter.order_id;

      }

      filter_array.customer_email = "";

      if(this.filter.customer_email){

        filter_array.customer_email = this.filter.customer_email;

      }

      filter_array.payment_status = "";

      if(this.filter.payment_status){

        filter_array.payment_status = this.filter.payment_status;

      }

      filter_array.name = "";

      if(this.filter.name){
          
        filter_array.name = this.filter.name;

      }

      filter_array.url = "";

      if(this.filter.url){

        filter_array.url = this.filter.url;

      }
      filter_array.date_start = "";
      if(this.filter.date_start){
        filter_array.date_start = this.filter.date_start;
      }
      
      filter_array.date_end = "";
      if(this.filter.date_end){
        filter_array.date_end = this.filter.date_end;
      }
       const u = new URLSearchParams(filter_array).toString();

       this.filtered_url = this.filter_url+"?"+u;

       this.dataTables(this.filtered_url);

    },

    reset_button(){

       this.filter.order_id="";

       this.filter.customer_email="";

       this.filter.payment_status="";

      
       this.filter.date_start="";

       this.filter.date_end="";

       this.dataTables(this.filter_url);

    },
    add_button(){
       
       this.more_filter = true;
      this.less_filter =false;
       this.less_filterbutton =true;
       
      
    },


    less_button(){
       
       this.more_filter = false;
      this.less_filter =true;
       this.less_filterbutton =false;
        this.filter.name="";
       this.filter.url="";
       
      
    },
    dataTables(search_url){

            // search_url = this.filtered_url;

            $(document).ready(function () {

              $("#orders_data_table").DataTable({

                processing: true,

                serverSide: true,

                ajax: search_url,

                destroy: true,

                columns: [
                  
                  { data: "id", name: "id" },
                  { data: "order_id", name: "order_id" },
                  { data: "customer_name", name: "customer_name" },
                  { data: "customer_email", name: "customer_email" },
                  { data: "created_at", name: "created_at" },
                  { data: "deadline", name: "deadline" },
                  { data: "word_count", name: "word_count" },
                  { data: "amount", name: "amount" },
                  { data: "payment_status", name: "payment_status" },
                  { data: "amount_received", name: "amount_received" },
                  { data: "first_name", name: "first_name" },
                  { data: "action",name: "action", orderable: false,searchable: false },
                ],
                filter: false,
                sort: false,
              });
            });
    }
  },
  created() {
    this.dataTables(this.filtered_url);
  },
};
</script>

<style>
.orders_data_table tbody tr td {
    white-space: pre-wrap;
    text-align:left ;
   
    word-wrap:break-word; 
    
}
</style>

