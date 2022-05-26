<template>
        <div class="card">
          <div v-if="alerts" class="alert alert-success" role="alert">{{message}}	</div>
								
									<div class="card-body">   <p id="text" style="color:green; margin-left:100px;"></p>
						
											<div class="col-md-4">
											  <label for="validationCustom01" class="form-label">Name</label>
											  <input type="text" class="form-control" id="validationCustom01" v-model="form.currency" >   
                        <span :class="'error'">{{currency}}</span>
											 
											</div>	
                                            
											<div class="col-md-4">
											  <label for="validationCustom01" class="form-label">Code</label>
											  <input type="text" class="form-control" id="validationCustom01" v-model="form.code" >   
                                             <span :class="'error'">{{code}}</span>
											 
											</div>	
                                            
											<div class="col-md-4">
											  <label for="validationCustom01" class="form-label">Rate</label>
											  <input type="number" class="form-control" id="validationCustom01" v-model="form.rate" >   
                                             <span :class="'error'">{{rate}}</span>
											 
											</div>	
                                            <br><br>
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
                currency: '',
                code: '',
                rate: '',
                message: '',
                type: ''
            },
           currency: '',
           rate: '',
           code: '',
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
                  
                    if(response.data.message.currency){
                            this.currency = response.data.message.currency[0];
                    }
                    if(response.data.message.code){
                            this.code = response.data.message.code[0];
                    }
                        if(response.data.message.rate){
                            this.rate = response.data.message.rate[0];
                    }
                    
                  }else{
                
                    this.message = response.data.message

                    this.alerts = true;

                    	window.scrollTo(0,0);
				
				        setTimeout(function(){

                        window.location.href = this.$hostname+'currency';
                
                    },1000);
              
                  }
        },
        submitDetails(){
          
            axios.post(this.$hostname+'currency/add', this.form)
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