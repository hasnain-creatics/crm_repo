<template>
        <div class="card">
          <div v-if="alerts" class="alert alert-success" role="alert">{{message}}	</div>
								
									<div class="card-body">   <p id="text" style="color:green; margin-left:100px;"></p>
						
											<div class="col-md-4">
											  <label for="validationCustom01" class="form-label">Name</label>
											  <input type="text" class="form-control" id="validationCustom01" v-model="form.name" >   
                                             <span  :class="'error'">{{name}}</span>
											 
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

          const url =this.$hostname+'subjects';

                  if(response.data.success==0){
                    
                      this.name = response.data.message  
                  
                    if(response.data.message.name[0]){
                         this.name = response.data.message.name;
                    }
                    
                  }else{
                
                    this.message = response.data.message

                    this.alerts = true;

                       setTimeout(function(){
                          window.location.href = url;  
                      },1000);
              
                  }
        },
        submitDetails(){
          
            axios.post(this.$hostname+'subjects/add', this.form)
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