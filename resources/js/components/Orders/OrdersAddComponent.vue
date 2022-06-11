<template>
  			<div>   <div class="alert alert-success" v-if="success">{{success_msg}}</div>
										<form class="row g-3"  @submit.prevent="orderCreate" enctype="multipart/form-data">
											
											<div class="col-md-4">
											  <label for="validationCustom01" class="form-label">Lead</label>
													<input type="text" class="form-control" @change="leadDetails" placeholder="Enter Customer Name" id="Customer_Name"  autoComplete="off"  :value="lead"  >
											 	
											</div>
											<div class="col-md-4">
											  <label for="validationCustom01" class="form-label">Customer Name</label>
											  <input type="text" class="form-control" :value="lead_name" placeholder="Enter Customer Name" id="Customer_Name" @change="customerName" name="Customer_Name">
											 		  <span  :class="'error'" v-if="errorss.customer_name">{{errorss.customer_email[0]}}</span>
											</div>
											<div class="col-md-4">
											  <label for="validationCustom01" class="form-label">Customer Email</label>
											  <input type="text" class="form-control" @change="customerEmail" :value="lead_email" placeholder="Enter Customer Email" id="customer_email"  name="customer_email"  >
											 	<span  :class="'error'" v-if="errorss.customer_email">{{errorss.customer_email[0]}}</span>
											</div>

											<div class="col-md-4">
											  <label for="validationCustom01" class="form-label">Select Customer Type</label>
											  <select   @change="customer_type" class="form-select border" id="customer_type" name="customer_type" >
												<option selected disabled value="">Choose...</option>

												<option  value="EXISTING">Existing</option>
												<option  value="REFFERAL">Refferral</option>
												<option  value="NEW">New</option>
											 </select>
											 	 <span  :class="'error'" v-if="errorss.customer_type">{{errorss.customer_type[0]}}</span>
											</div>

											<!--End First Row-->

											<div class="col-md-4">
											  <label for="validationCustom01" class="form-label">Title</label>
											  <input type="text" class="form-control"  @change="change_title"  placeholder="Enter Title" id="order_title"  name="order_title" >
												 	 <span  :class="'error'" v-if="errorss.title">{{errorss.title[0]}}</span>
											</div>
											<div class="col-md-4">
											  <label for="validationCustom01" class="form-label">Word Count</label>
											  <input type="number" class="form-control"  @change="change_word"   placeholder="Enter Word Count" id="word_count"  name="word_count"  >
											 				 	 <span  :class="'error'" v-if="errorss.word_count">{{errorss.word_count[0]}}</span>
											</div>

											<div class="col-md-4">
											  <label for="validationCustom01" class="form-label">Select Subject</label>
											  <select  @change="change_subject"   class="form-select border" id="subject" name="subject">
												<option :value="''">Choose...</option>
												  <option  v-for="subject in all_subjects" :key="subject.id" :value="subject.id">{{subject.name}}</option>
											
											  </select>
			 	 								<span  :class="'error'" v-if="errorss.subject_id">{{errorss.subject_id[0]}}</span>
											</div>

								<!--End Second Row-->


										<div class="col-md-4">
											  <label for="validationCustom01" class="form-label">Deadline</label>
											  <input type="datetime-local"  @change="change_deadline"  class="form-control"  id="deadline"  name="deadline" >
											
											</div>
											<div class="col-md-4">
											  <label for="validationCustom01" class="form-label">Select Payment Status</label>
											  <select class="form-select border"  @change="change_payment_status"  id="payment_status" name="payment_status" >
												<option selected disabled value="">Choose...</option>
												<option  value="Paid">Paid</option>
												<option  value="UnPaid">UnPaid</option>
												<option  value="Partially Paid">Partially Paid</option>
													
																								
											  </select>
											<span  :class="'error'" v-if="errorss.payment_status">{{errorss.payment_status[0]}}</span>
											</div>

											<div class="col-md-4">
											  <label for="validationCustom01" class="form-label">Select Currency</label>
											  <select class="form-select border" @change="currencyRates" id="currency" name="currency" >
												<option selected disabled value="">Choose...</option>
											    <option v-for="currency in all_currency" :key="currency.id" :data-rate="currency.rate" :value="currency.id">{{currency.currency}}</option>
											  </select>
												<span  :class="'error'" v-if="errorss.currency_id">{{errorss.currency_id[0]}}</span>
											</div>

									<!--End Third Row-->
											<div class="col-md-4">
											  <label for="validationCustom01" class="form-label">Order Amount</label>
											  <input type="number"  @change="change_amount"   class="form-control" placeholder="Enter Order Amount" id="order_amount"  name="order_amount" value="0" >
											 <span  :class="'error'" v-if="errorss.amount">{{errorss.amount[0]}}</span>
											</div>

											<div class="col-md-4" v-if=partial>
											  <label for="validationCustom01" class="form-label">Received Amount</label>
											  <input type="number"  @change="change_receive_amount"  class="form-control" placeholder="Enter Received Amount" id="Received"  name="Received" value="" >
											  		 <span  :class="'error'" v-if="errorss.amount_received">{{errorss.amount_received[0]}}</span>
											</div>

												<div class="col-md-12">
											  <label for="validationCustom01" class="form-label">Amount in Dollar</label>
											  <input type="text" class="form-control"  @change="change_amount_dollar" :value="(form.amount/currency_rate).toFixed(2)"  id="amount_doller"  name="amount_doller"  :readonly="true">
											  		 <span  :class="'error'" v-if="errorss.amount_doller">{{errorss.amount_doller[0]}}</span>
											</div>

										<!--End Forth Row-->



										<div class="col-md-6">
											  <label for="validationCustom01" class="form-label">Notes <span class="">*</span></label>
											  <textarea style="resize: none;"  @change="change_notes"   rows="5" name="Notes" id="Notes"  cols="50" class="form-control">												</textarea>
												  		 <span  :class="'error'" v-if="errorss.notes">{{errorss.notes[0]}}</span>
											</div>


								<div class="col-md-6">
											  <label for="validationCustom01" class="form-label">Notes by Writer<span class="">*</span></label>
											  <textarea style="resize: none;"   @change="change_additional_notes"   rows="5" name="Notes_by_writer" id="Notes_by_writer" cols="50" class="form-control">												</textarea>
											 				  		 <span  :class="'error'" v-if="errorss.additional_notes">{{errorss.additional_notes[0]}}</span>
											</div>

											<!--End Fifth Row-->

										<div class="col-md-6">
											  <label for="validationCustom01" class="form-label">Website</label>

											  <select name="" class="form-select border" @change="customerWebsite" id="">
												  	<option value=""></option>
													  <option :value="web.name" :selected="lead_website == web.id ? 'selected' : ''" v-for="web in websites" :key="web.id"  >
														  {{web.name}}
													  </option>
											  </select>

											  <span  :class="'error'" v-if="errorss.website">{{errorss.website[0]}}</span>
											</div>


										
										<div class="col-md-6">
											  
											 
												<label class="custom-control custom-checkbox custom-control-md" style=" margin-top: 25px;">
															<input    v-model="form.is_urgent" type="checkbox" class="custom-control-input" name="is_urgent" value="Yes">
															<span class="custom-control-label custom-control-label-md">Is Urgent?</span>
														</label>
											</div>
	


											<div class="col-12  upload_docs">
											 <label for="validationCustom01" class="form-label"></label>
												<div class="form-group mb-0">
													<input name="files"  @change="processFile($event)"  id="multi_file_upload_1" type="file" accept=".xlsx,.xls,image/*,.doc,audio/*,.docx,video/*,.ppt,.pptx,.txt,.pdf" multiple>
												</div>
											</div>

											<div class="col-12 upload_invoice">
											 <label for="validationCustom01" class="form-label"></label>
												<div class="form-group mb-0">
													 <input name="files"  @change="processInvoice($event)"  id="multi_file_upload_2" type="file" accept=".xlsx,.xls,image/*,.doc,audio/*,.docx,video/*,.ppt,.pptx,.txt,.pdf" multiple>
								
												</div>
											</div>
											
											
											
											
											<div class="col-12" v-if=btn_disabled>
											  <button class="btn btn-primary pull-right submt_button"  type="submit">Submit form</button>
											</div>
										  </form></div>
								
</template>

<script>
import Form from 'vform'
export default {
  props:['lead_id'],
  data() {
    return {
      form: new Form({
        	customer_name : "",
			customer_email : "",
			customer_type : "",
			title : "",
			word_count : "",
			subject_id : "",
			deadline : "",
			payment_status : "",
			currency_id : "",
			amount : 0,
			amount_received : "",
			notes : "",
			additional_notes : "",
			website : "",
			is_urgent : "",
			files : "", 
			invoice_files : "", 
			lead_id : this.lead_id,	
      }),
		errorss:[],
		issue_view:false,
		success_msg: "",
		success:false,
		all_issues:[],
		btn_disabled : true,
		all_subjects : [],
		all_currency : [],
		partial: false,
		currency_rate : 0,
		lead_name: "",
		lead_email: "",
		lead_website: "",
		show_lead : false,
		lead : this.lead_id ? 'LEAD-'+this.lead_id : '',
		websites: []
    };
  },
  async mounted(){

	  		this.all_subjects_method();

			this.all_currency_method();

	        this.all_websites_method();
		
			
  },
  
  methods: {

	async all_currency_method(){

            var currency_response = await fetch(this.$hostname+"currency/get_all_active_currency");

            var currency_ = await currency_response.json();

            this.all_currency = currency_;
	},
	async all_subjects_method(){

			var response = await fetch(this.$hostname+"subjects/get_all_active_subjects");

            var subjects_ = await response.json();

            this.all_subjects = subjects_;
	},
	async all_websites_method(){
		
    			if(this.lead_id){

						this.leadDetails(this.lead_id,this.lead);			

	        }

			    var website_response = await fetch(this.$hostname+"websites/get_active_website");

       		 	var website_data = await website_response.json();

       		 	this.websites = website_data;
				
	},
  	async leadDetails(e,lead=null){	
  			var leeed = "";

				if(lead){

					var leeed = lead;
					var lead_id 	= lead.split('-')[1];
					
				}else{
					
					var lead_id = e.target.value.split('-')[1];	
					
					var leeed = e.target.value;
				
				}
				try{
				
						var lead_response = await fetch(this.$hostname+'leads/fetch_lead/'+lead_id);

						var lead_ = await lead_response.json();

						this.lead_record = lead_;

						this.lead_name = this.form.customer_name = this.lead_record.first_name + ' ' + this.lead_record.last_name 

						this.lead_email =this.form.customer_email= this.lead_record.email

						this.lead_website = this.form.website = this.lead_record.url

						this.show_lead = true; 

						this.lead = leeed;

						this.form.lead_id = lead_id;

				}catch(error){
				
					alert('no lead foung against this reference');

					this.form = {};

					this.lead_name = "";

					this.lead_email = "";

					this.lead_website = "";
					
					this.lead = "";

				}

  	},
  	async customerName(e){

  		this.form.customer_name = e.target.value;

		this.lead_name = this.form.customer_name;
  	},

  	async customerEmail(e){

  		this.form.customer_email = e.target.value;
		this.lead_email = this.form.customer_email;
  	},

  	async customerWebsite(e){

  		this.form.website = e.target.value;
		//   console.log(this.form)
		// this.lead_name = this.form.customer_name;
		// this.lead_email = this.form.customer_email;
		console.log(this.form);
  	},

	async currencyRates(e){
	
		this.currency_rate = e.target.selectedOptions[0].getAttribute("data-rate");
		
		this.form.currency_id = e.target.value;
	
	},	

	async change_payment_status(e){

		// const customers_name = this.form.customer_name;
				
		this.form.payment_status = e.target.value;
	
		this.form.payment_status == 'Partially Paid' ? this.partial = true : this.partial = false;
		
		// this.lead_name = customers_name
		// console.log(customers_name);
		// this.form.customer_name = customers_name;
		// return false;

	},

	async customer_type(e){

		this.form.customer_type = e.target.value;

	},

	async change_title(e){

		this.form.title = e.target.value;

	},

	async change_word(e){

		this.form.word_count = e.target.value;
	},
	async change_subject(e){

		this.form.subject_id = e.target.value;

	},
	async change_deadline(e){

		this.form.deadline = e.target.value;

	},
	async change_amount(e){

		this.form.amount = e.target.value;

	},
	
	async change_receive_amount(e){



		if(this.form.amount< e.target.value){
			alert('receive amount must be less then or equal to the order amount');
			e.target.value = 0;	
		}


		this.form.amount_received = e.target.value;

	},

	async change_amount_dollar(e){

		this.form.amount_received = (this.form.amount/this.currency_rate).toFixed(2)
	
	},
	async change_notes(e){

		this.form.notes =  e.target.value;
		
	},

	async change_additional_notes(e){

			this.form.additional_notes=  e.target.value;
	},

  async orderCreate() {
		
	  const headers = {
		  
		  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),

		  'Content-Type': 'multipart/form-data' 

		  };
	
		await this.form.post(this.$hostname+'orders/insert',null,{headers}).then((response)=>{

			var redirect_url =this.$hostname+'orders';

			if(response.data.success == false){

				this.errorss = response.data.message

			}else{
				
				this.success = true

				this.success_msg = response.data.message

				this.btn_disabled = false;
 				
				window.scrollTo(0,0);
				
				setTimeout(function(){

				window.location.href = redirect_url;
					
			
				},1000);
				
			}
		

		});

    },

	async processFile(event) {

    	let file = event.target.files;

      	let reader = new FileReader();  

		this.form.files = event.target.files;

  	},
	  
	async processInvoice(event) {

    	let file = event.target.files;

     	let reader = new FileReader();  

		this.form.invoice_files = event.target.files;

  	}
  },
 
};
</script>

<style>

</style>