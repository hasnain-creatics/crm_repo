<template>
        <div class="card">
          <div v-if="alerts" class="alert alert-success" role="alert">{{message}}	</div>
									<div class="card-header">
										<h3 class="card-title">Add Role</h3>
									</div>
									<div class="card-body">   <p id="text" style="color:green; margin-left:100px;"></p>
										<form class="row g-3 needs-validation" >
											<div class="col-md-4">
											  <label for="validationCustom01" class="form-label">Name</label>
											  <input type="text" class="form-control" id="validationCustom01" v-model="form.name" required>   
                        <span class="validate">{{name}}</span>
											 
											</div><br><br><br><br><br><br>
											<div class="col-12">
											  <button class="btn btn-primary" type="submit"  v-on:click="submitDetails()" >Submit form</button>
											</div>
										  </form>
									</div>
								</div>
</template>
<script>
import axios from 'axios';
export default {
  data() {
    return {
       form: {
                name: '',
                 message: ''
            },
           name: '',
           message: '',
           success: '',
           	alerts: false,
    }
  },
 methods:{
        responseMethods(response){
                  if(response.data.success==0){
                      this.name = response.data.message  
                  
                  if(response.data.message.name[0]){
                        this.name = response.data.message.name[0];
                    }
                    
                    
                  
                  }else{
                
                    this.message = response.data.message
                    this.alerts = true;
                    // setTimeout(function(){
                    //   window.location.reload();
                    // },1000); 
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