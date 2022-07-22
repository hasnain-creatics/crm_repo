<template>
  <div class="col-sm-12">
    
      <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills">
   
                <li class="nav-item">
                    <a class="nav-link" href="#" :class="ready_to_delivered ? 'active' : ''"  @click="readyToDeliver()">Ready To Deliver </a>
                </li>
                   &nbsp;
                <li class="nav-item">
                    <a class="nav-link"  href="#"  :class="delivered ? 'active' : ''"    @click="order_delivered()">Delivered</a>
                </li>         &nbsp;
                 <li class="nav-item">
                    <a class="nav-link"  href="#"  :class="failed ? 'active' : ''"    @click="order_failed()">Failed</a>
                </li>    
                    &nbsp;
                 <li class="nav-item">
                    <a class="nav-link"  href="#"  :class="completed ? 'active' : ''"    @click="order_completed()">Completed</a>
                </li>    
     
            </ul>
        </div>
    </div>
<br>
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
      id="delivery_data_table"
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

          <th >Payment Status</th>

          <th >Order Status</th>
          
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
        status:"",
      },
      ready_to_delivered: true,
      delivered: false,
      failed: false,
      completed: false,
      more_filter : false,
      less_filter : true,
      less_filterbutton :false,
      filter_url : this.$hostname + "delivery",
      filtered_url : this.$hostname + "delivery?status=ready_to_delivered",
      filter_array : {},
    };
  },
  methods: {
    
    filter_button() {

        var filter_array = this.filter_array;     

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

       this.filter.date_start="";

       this.filter.date_end="";

       this.filter_array.status = this.filter.status

       var u = new URLSearchParams(this.filter_array).toString();

       this.filtered_url = this.filter_url+"?"+u;

       this.dataTables(this.filtered_url);


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


    readyToDeliver(){
      this.failed = false;
      
      this.ready_to_delivered = true;
      
      this.delivered = false;
      this.completed = false;
      this.filter_array.status = "ready_to_delivered"
      this.filter.status = this.filter_array.status;
       var u = new URLSearchParams(this.filter_array).toString();

       this.filtered_url = this.filter_url+"?"+u;

       this.dataTables(this.filtered_url);


    },

    order_delivered(){
      
      this.ready_to_delivered = false;
       this.failed = false;
      this.delivered = true;
           this.completed = false;
      this.filter_array.status = "delivered"
this.filter.status = this.filter_array.status;
       var u = new URLSearchParams(this.filter_array).toString();

       this.filtered_url = this.filter_url+"?"+u;

       this.dataTables(this.filtered_url);

    },
    
    order_failed(){
      
      this.ready_to_delivered = false;
      
      this.completed = false;
      this.delivered = false;

      this.failed = true;
      
      this.filter_array.status = "failed"
this.filter.status = this.filter_array.status;
       var u = new URLSearchParams(this.filter_array).toString();

       this.filtered_url = this.filter_url+"?"+u;

       this.dataTables(this.filtered_url);

    },

    
    order_completed(){
      
      this.ready_to_delivered = false;
      
      this.delivered = false;

      this.failed = false;

      this.completed = true;
      
      this.filter_array.status = "completed"
this.filter.status = this.filter_array.status;
       var u = new URLSearchParams(this.filter_array).toString();

       this.filtered_url = this.filter_url+"?"+u;

       this.dataTables(this.filtered_url);

    },
    dataTables(search_url){

            // search_url = this.filtered_url;

            $(document).ready(function () {

              $("#delivery_data_table").DataTable({

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
                  { data: "order_status", render: function ( data, type, row ) {
                      return "<span class='"+(row.order_status.replace(/\s+/g, '-').toLowerCase())+"'  onClick='order_status_details("+row.id+")'>"+row.order_status+"</span>";
                  }},
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
  mounted() {
    this.dataTables(this.filtered_url);
    // this.interval = setInterval(() =>this.dataTables(this.filtered_url), 5000);
  },
};
</script>

<style>
.orders_data_table tbody tr td {
    white-space: pre-wrap;
    text-align:left ;
   
    word-wrap:break-word; 
    
}
.new{font-size:8px;padding:5px;background:lightgreen;border-radius:5px; box-shadow:0px 0px 12px 0px lightgray;}
.in-progress, .pending{font-size:8px;color:#eee;padding:5px;background:rgb(67, 112, 67);border-radius:5px; box-shadow:0px 0px 12px 0px lightgray;}
.qa-in-progress{font-size:8px;color:rgb(23, 19, 19);padding:5px;background:rgb(160, 179, 201);border-radius:5px; box-shadow:0px 0px 12px 0px lightgray;}
.qa-approved{font-size:8px;color:rgb(253, 253, 253);padding:5px;background:rgb(152, 166, 179);border-radius:5px; box-shadow:0px 0px 12px 0px lightgray;}
.delivered{font-size:8px;color:rgb(253, 253, 253);padding:5px;background:rgb(26, 102, 173);border-radius:5px; box-shadow:0px 0px 12px 0px lightgray;}
</style>

