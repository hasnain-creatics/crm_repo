<template>
          

		                            <div class="card">		
										<div v-if="alerts" class="alert alert-success" role="alert">{{message}}	</div>
							
								
									<div class="card-body">   <p id="text" style="color:green; margin-left:100px;"></p>
										<form class="row g-3 needs-validation" action="#">
											<div class="col-md-4">
											  <label for="validationCustom01" class="form-label">Currency</label>
											  <input type="text" class="form-control" id="validationCustom01" :value="result.currency" @change="onChangeCurrency" autofocus >
										     <span :class="'error'">{{currency}}</span>
											 
											</div><div class="col-md-4">
											  <label for="validationCustom01" class="form-label">Code</label>
											  <input type="text" class="form-control" id="validationCustom01" :value="result.code" @change="onChangeCode" autofocus >
										     <span :class="'error'">{{code}}</span>
											 
											</div><div class="col-md-4">
											  <label for="validationCustom01" class="form-label">Rate</label>
											  <input type="text" class="form-control" id="validationCustom01" :value="result.rate" @change="onChangeRate" autofocus >
										     <span :class="'error'">{{rate}}</span>
											 
											</div><br><br><br><br><br><br>
											<div class="col-12">
											  <button class="btn btn-primary" type="button" v-on:click="updateContact()"> Submit form</button>
											</div>
										  </form>
									</div>
								</div>
</template>
<script>

import axios from 'axios';

export default {

 props:['role_id'],

 data(){

	 return {

		result:{},
		form: {
                 currency: '',
                 code: '',
                 rate: '',
                 message: '',
				 id: this.role_id,
            },
        currency: '',
        code: '',
        rate: '',
        message: '',
        success: '',
		alerts: false,
	 }
	 
 },

 methods:{
	 
		getRoles(){

			axios.get(this.$hostname+'currency/get_subject/'+this.role_id).then((response)=>{

				this.result = response.data;
                this.form = response.data;
				this.onChangeCurrency(this.result.currency)
				this.onChangeCode(this.result.code)
				this.onChangeRate(this.result.rate)

			});

		},
		 onChangeCurrency (e) {
		
			 e.target  ?  this.form.currency = e.target.value	: this.form.currency = e;  

         },
		  onChangeCode (e) {
            
			e.target  ?  this.form.code = e.target.value	: this.form.code = e

         },
		 
		
		  onChangeRate (e) {

			e.target  ?    this.form.rate = e.target.value	:this.form.rate = e
			
         },
	    responseMethods(response){

				console.log(response);

				  if(response.data.success==0){
                      
                  	// this.currency = response.data.message  
                  	// this.code = response.data.message  
                  	// this.rate = response.data.message  
                  
				  }else{

					  this.message = response.data.message
					  this.alerts = true;
					//  setTimeout(function(){
					  window.location.reload();
					//  },1000); 
				  }

                  if(response.data.message.currency){
					  
					this.currency = response.data.message.currency[0];
				  
                  }
				  
                  if(response.data.message.code){
        
					this.code = response.data.message.code[0];
				  
                  }
        
                  if(response.data.message.rate){
        
					this.rate = response.data.message.rate[0];
				  
                  }
        
        },
        updateContact(){

               axios.post(this.$hostname+'currency/add', this.form)
                  .then( 
                  function( response ){
                    this.responseMethods( response );
                }.bind(this)
                );
        }
 },
 mounted(){
	 this.getRoles();
 }
}
</script>

<style>

</style>