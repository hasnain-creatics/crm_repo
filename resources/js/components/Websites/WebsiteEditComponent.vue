<template>
    <div class="card">
        <div v-if="alerts" class="alert alert-success" role="alert">{{ message }} </div>
        <div class="card-header">
          	<h3 class="card-title">Edit Website</h3>  
        </div>
        <div class="card-body">
            <p id="text" style="color:green; margin-left:100px;"></p>

            <div class="col-md-4">
                <label for="validationCustom01" class="form-label">Name</label>
                <input type="text" :value="form.name" @change="changeName($event)" class="form-control" id="validationCustom01" >
                <span class="error">{{name}}</span>

            </div>
            <div class="col-md-4">
                <label for="validationCustom01" class="form-label">Status</label>

                <select  name="type" :value="form.status"   @change="changeStatus($event)" id="status" class="form-control">
                 
                    
                    <option :value="'ACTIVE'">ACTIVE</option>
                    
                    <option :value="'INACTIVE'">INACTIVE</option>

                </select>
             <span class="error">{{status}}</span>

            </div><br><br><br><br><br><br>
            <div class="col-12">
                <button class="btn btn-primary" type="submit" v-on:click="submitDetails()">Submit form</button>
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
                name: '',
                status: '',
                id : this.id,
                message: ''
            }),
            name: '',
            status: '',
            message: '',
            success: '',
            alerts: false


        }
    },
     mounted(){
   
        axios.get(this.$hostname+'websites/get_single_website/'+this.id).then((response)=>{

              this.form = response.data;
         
        });
    },
    methods: {
        changeStatus(e){
            this.form.status = e.target.value;
        },

        changeName(e){
            this.form.name = e.target.value;
        },
        submitDetails() {
        if(this.form.name == ""){
        this.name = 'Website  name field is required'
      }else if(this.form.status==""){
        this.status = 'Status name field is required'
      }else{    


            const url = this.$hostname+'websites';
            axios.post(this.$hostname+'websites/add',this.form).then((response)=>{
                  if(response.data.status == 'error'){
              this.name = response.data.message;
            }else{
              this.name = ""
                this.alerts = true;
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