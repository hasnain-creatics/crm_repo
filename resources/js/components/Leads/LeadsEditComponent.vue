<template>
        <div>
          
										   <div class="alert alert-success" v-if="success">{{success_msg}}</div>
                        
										<form class="row g-3 form newtopic" @submit.prevent="register" enctype="multipart/form-data">
                                 
											<div class="col-md-4">
											  <label for="validationCustom01" class="form-label">First Name</label>
											  <input type="text" class="form-control" :value="response_details.first_name" placeholder="Enter First Name" id="first_name" name="first_name" @change="onChangeFirstName" >
											  <span v-if="errorss.first_name">{{errorss.first_name[0]}}</span>
											</div>
											<div class="col-md-4">
											  <label for="validationCustom01" class="form-label">Last Name</label>
											  <input type="text" class="form-control"  :value="response_details.last_name" placeholder="Enter Last Name" id="last_name"  name="last_name"  @change="onChangeLastName" >
							  				  <span v-if="errorss.last_name">{{errorss.last_name[0]}}</span>
											</div>

											<div class="col-md-4">
											  <label for="validationCustom01" class="form-label">Email Address</label>
											  <input type="email" class="form-control"  :value="response_details.email"  placeholder="Enter email Address" id="email"  name="email"  @change="onChangeEmail" >
												<span v-if="errorss.email">{{errorss.email[0]}}</span>
											</div>

											<!--End First Row-->

											<div class="col-md-4">
											  <label for="validationCustom01" class="form-label">Phone Number</label>
											  <input type="text" class="form-control"  :value="response_details.phone_number"  placeholder="Enter Phone Number" id="phone_number"  name="phone_number"  @change="onChangePhone" >
												  <span v-if="errorss.phone_number">{{errorss.phone_number[0]}}</span>
											
											</div>
											<div class="col-md-4">
											  <label for="validationCustom01" class="form-label">Select Status</label>
                                                <select  :value="response_details.lead_status" class="form-select border" id="lead_status" name="lead_status"  @change="lead_status($event)"  @blur="onChangeLeadStatus" >
                                                    <option selected disabled>Choose...</option>
                                                    <option  value="Paid">Paid</option>
                                                    <option  value="Un-Paid">Un-Paid</option>
                                                    <option  value="Followup">Followup</option>
													<option  value="Transfer-Paid">Transfer Paid</option>
                                                </select>
												<span v-if="errorss.lead_status">{{errorss.lead_status[0]}}</span>
											</div>

											<div class="col-md-4" v-if="issue_view">
											  <label for="validationCustom01" class="form-label">Select Issue</label>
												<select  :value="response_details.lead_issue_id" class="form-select border" id="issue" name="lead_issue_id"   @change="onChangeIssue" >
													<option selected disabled value="">Choose...</option>
													<option  value="5">Client's payment merchant is not working</option>
													<option  value="4">Price Issue</option>
													<option  value="3">Can't be done</option>
													<option  value="2">Trust Issues</option>
													<option  value="1">Otherse</option>							
												</select>
												<span v-if="errorss.lead_issue_id">{{errorss.lead_issue_id[0]}}</span>
											</div>

											<div class="col-md-4">
											  <label for="validationCustom01" class="form-label">Website Url</label>
											  <input type="text" :value="response_details.url" class="form-control" placeholder="Enter website url"  id="url"  name="url"   @change="onChangeUrl" >
												 <span v-if="errorss.url">{{errorss.url[0]}}</span>
											</div>


								<!--End Second Row-->

		
								<div class="col-md-12">
											  <label for="validationCustom01" class="form-label">Description<span class="required">*</span></label>
											  <textarea  :value="response_details.description"  style="resize: none;" rows="5" name="description" id="description"   @change="onChangeDescription"  cols="50" class="form-control"></textarea>
                                              <span v-if="errorss.description">{{errorss.description[0]}}</span>
											</div>

											<!--End Fifth Row-->

											<div class="col-12">
											  <label for="validationCustom01" class="form-label">Attachments</label>
												<div class="form-group mb-0">
											<!-- class="dropify"  -->
											<input id="demo1" class="dropify" type="file" name="files[]" multiple @change="processFile($event)">
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
  props:['lead_id'],
  data() {
    return {
      form: new Form({
        id          : this.lead_id,
        first_name  : "",
        last_name   : "",
        email       : "",
        phone_number: "",
        lead_status : "",
        url         : "",
        description : "",
		lead_issue_id:"",
		files       : ""
      }),
		errorss     :[],
		issue_view  :false,
		success_msg :"",
		success     :false,
        response_details: {}
    };
  },
  mounted(){
	  alert();
  },
  methods: {
    onChangeFirstName(e){
        this.form.first_name = e.target.value;
    },
    onChangeLastName(e){
        this.form.last_name = e.target.value;
    },
    onChangeEmail(e){
        this.form.email = e.target.value;
    },
    onChangePhone(e){
        this.form.phone_number = e.target.value;
    },
    onChangeLeadStatus(e){
        this.form.lead_status = e.target.value;
    },
    onChangeIssue(e){
        this.form.lead_issue_id = e.target.value;
    },
    onChangeUrl(e){
        this.form.url = e.target.value;
    },
    onChangeDescription(e){
        this.form.description = e.target.value;
    },

    register() {


	 	 const headers = {

		  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),

		  'Content-Type': 'multipart/form-data'

		  };
		  
        const url =this.$hostname+'leads';
		
		this.form.post(this.$hostname+'leads/insert',null,{headers}).then((response)=>{
			
			if(response.data.success == false){

				this.errorss = response.data.message

			}else{
				
				this.success = true

				this.success_msg = response.data.message

				setTimeout(function(){

					window.location.href = url;
			
				},1000);
				
			}

		});

    },
	
	lead_status(event){
		
		if(event.target.value == 'Un-Paid'){

			this.issue_view = true;

		}else{

			this.issue_view = false;

		}

	},
    
	processFile(event) {

    	let file = event.target.files;

        let reader = new FileReader();  

		this.form.files = event.target.files;

  	},
   
  },
 mounted(){
   
            const headers = {'Content-Type': 'multipart/form-data'};
            axios.get(this.$hostname+'leads/fetch_lead/'+this.lead_id,null,{headers}).then((response)=>{
                this.response_details = response.data;
                this.form.first_name = response.data.first_name;
                this.form.last_name = response.data.last_name;

                this.form.email = response.data.email;
                this.form.phone_number = response.data.phone_number;
                this.form.lead_status= response.data.lead_status;
                this.form.lead_issue_id= response.data.lead_issue_id;
                this.form.url= response.data.url;
                this.form.description= response.data.description;
                if(response.data.lead_status == 'Un-Paid'){
                    this.issue_view = true;
                }else{
                    this.issue_view = false;

                }
            })
 }
};
</script> 
<style>
</style>