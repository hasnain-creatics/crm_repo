<template>
        <div class="card">
          <div v-if="alerts" class="alert alert-success" role="alert">{{message}}	</div>
									<div class="card-header">
										<h3 class="card-title">Add Issue</h3>
									</div>
									<div class="card-body">   
                    <p id="text" style="color:green; margin-left:100px;"></p>
											<div class="col-md-4">
											  <label for="validationCustom01" class="form-label">Issue</label>
											  <input type="text" class="form-control" id="validationCustom01" v-model="form.issue" required>   
											  <span :class="'error'">{{issue}}</span>
											</div>
                  		<div class="col-md-4">
                        	  <label for="validationCustom01" class="form-label">Status</label>
                <select  name="type"  v-model="form.status" id="status" class="form-control">
                 
                    <option :value="''">Select Status</option>
                    <option :value="'ACTIVE'">ACTIVE</option>
                    
                    <option :value="'INACTIVE'">INACTIVE</option>

                </select>
                  <span :class="'error'">{{status}}</span>

	</div>
                      <br><br><br><br><br><br>
											<div class="col-12">
											  <button class="btn btn-primary" type="button"  v-on:click="submitDetails()" >Submit form</button>
											</div>
									</div>
								</div>
</template>
<script>
import axios from 'axios';
import $ from "jquery";
import Form from 'vform'
export default {
  data() {
    return {
         form: new Form({
                issue: '',
                status:'',
                message: ''
            }),
           issue: '',
           status: '',
           message: '',
           success: '',
           	alerts: false,
    }
  },
  methods:{
    submitDetails(){
      if(this.form.issue == ""){
        this.issue = 'Issue name field is required'
      }else if(this.form.status == ""){
          this.status = 'Status name field is required'
      }else{
       const headers = {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
       };
        const url =this.$hostname+'issue';
        this.form.post(this.$hostname+'issue/add',null,{headers}).then((response)=>{
            if(response.data.status == 'error'){
              this.name = response.data.message;
            }else{
              this.name = ""
              this.alerts = true
              this.message = response.data.message;
                setTimeout(function(){
                	window.location.href = url;  
              },1000);
            }
        });
      }
    }
  }

}
</script>

<style>

</style>