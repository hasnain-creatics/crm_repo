<template>
          

		                            <div class="card">		
										<div v-if="alerts" class="alert alert-success" role="alert">{{message}}	</div>
							
									<div class="card-header">
										<h3 class="card-title">Edit Role</h3>
									</div>
									<div class="card-body">   <p id="text" style="color:green; margin-left:100px;"></p>
										<form class="row g-3 needs-validation" action="#">
											<div class="col-md-4">
											  <label for="validationCustom01" class="form-label">Name</label>
											  <input type="text" class="form-control" id="validationCustom01" :value="result.name" @blur="onChangeName" autofocus >
										     <span  :class="'error'">{{name}}</span>
											 
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
                 name: '',
                 message: '',
				 id: this.role_id,
            },
        name: '',
        message: '',
        success: '',
		alerts: false,
	 }
	 
 },

 methods:{
	 
		getRoles(){

			axios.get(this.$hostname+'subjects/get_subject/'+this.role_id).then((response)=>{

				this.result = response.data;

			});

		},
		 onChangeName (e) {

            this.form.name = e.target.value
			
         },
		 
		
	    responseMethods(response){

				  if(response.data.success==0){
				
                  	this.name = response.data.message  
                  
				  }else{
					const url = this.$hostname+'subjects';
					  this.message = response.data.message
					  this.alerts = true;
					 setTimeout(function(){
				 				window.location.href = url;  
					 },1000); 
				  }

                  if(response.data.message.name){
        
					this.name = response.data.message.name[0];
				  
                  }else{
					
                    this.form.name = this.name;
 					
                  }
        },
        updateContact(){
		
               axios.post(this.$hostname+'subjects/add', this.form)
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