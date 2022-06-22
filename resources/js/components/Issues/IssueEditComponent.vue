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
											  <input type="text" class="form-control" :value="form.issue" id="validationCustom01" @change="changeIssue($event)" required>   
											       <span class="validate">{{name}}</span>
											</div>
                      
                      
                  		<div class="col-md-4">
                          	  <label for="validationCustom01" class="form-label">Status</label>
                                  <select  name="type" @change="changeStatus($event)" :value="form.status" id="status" class="form-control">
                                  
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
  props:['id'],
  data() {
    return {
         form: new Form({
              id : '',
                issue: '',
                status: '',
                message: ''
            }),
           name: '',
           status: '',
           message: '',
           success: '',
           alerts: false,
    }
  },
  methods:{
    changeIssue(e){
      this.form.issue = e.target.value;
    },
    changeStatus(e){
      this.form.status = e.target.value;
    },
    submitDetails(){
      if(this.form.issue == ""){
        this.name = 'Issue name field is required'
      }else if(this.form.status==""){
        this.status = 'Status name field is required'
      }else{
       const headers = {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
       };
        const url = this.$hostname+'issue';
        axios.post(this.$hostname+'issue/add',this.form,{headers}).then((response)=>{

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
  },
   mounted(){
     axios.get(this.$hostname+'issue/fetch_issue/'+this.id).then((response)=>{

       this.form.issue = response.data.issue;
  
       this.form = response.data;
   

    }); 
  }

}
</script>

<style>

</style>