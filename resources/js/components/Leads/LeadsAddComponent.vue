<template>
        <div>
          
										   <div class="alert alert-success" v-if="success">{{success_msg}}</div>
                        
										<form class="row g-3 form newtopic" @submit.prevent="register" enctype="multipart/form-data">
											<div class="col-md-4">
											  <label for="validationCustom01" class="form-label">First Name</label>
											  <input type="text" class="form-control" v-model="form.first_name" placeholder="Enter First Name" id="first_name" name="first_name" >
											  <span class="error" v-if="errorss.first_name">{{errorss.first_name[0]}}</span>
											</div>
											<div class="col-md-4">
											  <label for="validationCustom01" class="form-label">Last Name</label>
											  <input type="text" class="form-control"  v-model="form.last_name" placeholder="Enter Last Name" id="last_name"  name="last_name" value="" >
							  				  <span class="error" v-if="errorss.last_name">{{errorss.last_name[0]}}</span>
											</div>

											<div class="col-md-4">
											  <label for="validationCustom01" class="form-label">Email Address</label>
											  <input type="email" class="form-control"  v-model="form.email"  placeholder="Enter email Address" id="email"  name="email" value="" >
												<span class="error" v-if="errorss.email">{{errorss.email[0]}}</span>
											</div>

											<!--End First Row-->

											<div class="col-md-4">
											  <label for="validationCustom01" class="form-label">Phone Number</label>
											  <input type="text" class="form-control"  v-model="form.phone_number"  placeholder="Enter Phone Number" id="phone_number"  name="phone_number" value="" >
												  <span class="error" v-if="errorss.phone_number">{{errorss.phone_number[0]}}</span>
											
											</div>
																					<div class="col-md-4">
											  <label for="validationCustom01" class="form-label">Select Status</label>
											  <select  v-model="form.lead_status" class="form-select border" id="lead_status" name="lead_status"  @change="lead_status($event)">

												<option selected disabled value="">Choose...</option>
												<option  value="Paid">Paid</option>
												<option  value="Un-Paid">Un-Paid</option>
												<option  value="Followup">Followup</option>
												<option  value="Transfer-Paid">Transfer Paid</option>
														
																								
											  </select>
												  <span v-if="errorss.lead_status">{{errorss.lead_status[0]}}</span>
											</div>

											<div class="col-md-4" v-if="issue_view">
											  <label for="validationCustom01" class="form-label">Select Issue</label>
												<select  v-model="form.lead_issue_id" class="form-select border" id="issue" name="lead_issue_id" >
													<option selected disabled value="">Choose...</option>
													<option  v-for="(links, index) in all_issues"
                                            :key="index" :value="links.id">{{links.issue}}</option>
												</select>
												<span class="error" v-if="errorss.lead_issue_id">{{errorss.lead_issue_id[0]}}</span>

											</div>

											<div class="col-md-4">
											  <label for="validationCustom01" class="form-label">Website Url</label>
											  <!-- <input type="text" v-model="form.url" class="form-control" placeholder="Enter website url"  id="url"  name="url" value="" > -->
												<select  v-model="form.url" class="form-select border" id="url" name="url" >
													<option selected disabled value="">Choose...</option>
													<option  v-for="(links, index) in all_website"
                                           		 :key="index" :value="links.id">{{links.name}}</option>
												</select>

												 <span class="error" v-if="errorss.url">{{errorss.url[0]}}</span>
											</div>


								<!--End Second Row-->

		
								<div class="col-md-12">
											  <label for="validationCustom01" class="form-label">Description<span class="required">*</span></label>
											  <textarea  v-model="form.description"  style="resize: none;" rows="5" name="description" id="description"  cols="50" class="form-control"></textarea>
                                              <span v-if="errorss.description">{{errorss.description[0]}}</span>
											</div>

											<!--End Fifth Row-->

										<div class="col-12 upload_led_doc">
											<div class="form-group mb-0">
													 <input name="files" @change="processFile($event)"  id="multi_file_upload_lead" type="file" accept=".xlsx,.xls,image/*,.doc,audio/*,.docx,video/*,.ppt,.pptx,.txt,.pdf" multiple>
											</div>
										</div>	
											
											<div class="col-12">
											  <button class="btn btn-primary pull-right" type="submit">Submit form</button>
											</div>
										  </form>
									


								</div>
</template>
<script>
import Form from 'vform'
export default {
  data() {
    return {
      form: new Form({
        first_name: "",
        last_name: "",
        email: "",
        phone_number: "",
        lead_status: "",
        url: "",
        description: "",
		lead_issue_id:"",
		files : ""
      }),
		errorss:[],
		issue_view:false,
		success_msg: "",
		success:false,
		all_issues:[],
		all_website:[],
    };
  },
  methods: {
	
    select_all_active_issues(){
      axios.get(this.$hostname+'issue/select_all_active_issues').then((response)=>{
		  this.all_issues = response.data;
	  })
    },
	get_active_website(){
  		axios.get(this.$hostname+'websites/get_active_website').then((response)=>{
		  this.all_website = response.data;
	    })
	},
    register() {
		
	  const headers = {
		  
		  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),

		  'Content-Type': 'multipart/form-data' 

		  };
		  
	  	var urls =this.$hostname+'leads';

		this.form.post(this.$hostname+'leads/insert',null,{headers}).then((response)=>{
			
			if(response.data.success == false){

				this.errorss = response.data.message

			}else{
				
				this.success = true

				this.success_msg = response.data.message

				setTimeout(function(){

					window.location.href = urls;
			
				},1000);
				
			}
		

		});

    },
	lead_status(event){
		
			if(event.target.value == 'Un-Paid'){

				this.issue_view = true;
					this.select_all_active_issues();
			}else{

				this.issue_view = false;

			}

	},
	processFile(event) {

    	let file = event.target.files;

      	let reader = new FileReader();  

		this.form.files = event.target.files;

  	}
  },
  mounted(){
	  this.get_active_website();
  }
 
};
</script> 
<style>
</style>