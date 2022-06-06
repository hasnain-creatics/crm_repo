<template>
        <div class="card">
          <div v-if="alerts" class="alert alert-success" role="alert">{{message}}	</div>
									<div class="card-header">
										<h3 class="card-title">Add Role</h3>
									</div>
									<div class="card-body">   
                    <p id="text" style="color:green; margin-left:100px;"></p>
						
											<div class="col-md-4">
											  <label for="validationCustom01" class="form-label">Name</label>
											  <input type="text" class="form-control" id="validationCustom01" v-model="form.name" >   
                        <span class="validate"  :class="'error'">{{name}}</span>
											 
											</div>	
                      <div class="col-md-4">
											  <label for="validationCustom01" class="form-label">Type</label>
											  <!-- <input type="text" class="form-control" id="validationCustom01" v-model="form.name" required>    -->
                        <select name="type" id="role_type" class="form-control" required v-model="form.type">
                          <option value="manager">Manager</option>
                          <option value="agent">Agent</option>
                          <option value="other">Other</option>
                        </select>
                        <span class="validate"  :class="'error'">{{type}}</span>
											 
											</div><br><br><br><br><br><br>
											<div class="col-12">
											  <button class="btn btn-primary" type="submit"  v-on:click="submitDetails()" >Submit form</button>
											</div>
			
									</div>
								</div>
</template>
<script>
import axios from 'axios';
import $ from "jquery";
export default {
  data() {
    return {
       form: {
                name: '',
                 message: '',
                 type: ''
            },
           name: '',
           message: '',
           type: '',
           success: '',
           	alerts: false,
    }
  },
 methods:{
        responseMethods(response){

                  if(response.data.success==0){
                    
                      this.name = response.data.message  
                  
                  if(response.data.message.name[0]){

                        this.name = response.data.message.name;

                  }
                  
                  if(response.data.message.type[0]){

                        this.type = response.data.message.type;

                  }
                    
                  }else{
                
                    this.message = response.data.message

                    this.alerts = true;
              
                  }
        },
        submitDetails(){
          
            axios.post(this.$hostname+'roles/update', this.form)
                  .then( 
                  function( response ){
                    this.responseMethods( response );
                }.bind(this)
                );
        }
    }
}
</script>

<style>

</style>