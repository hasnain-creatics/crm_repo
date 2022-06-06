<template>
               <div class="card-body">
                  <form method="POST" action="">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                         <div class="row">       
                          <div class="col-lg-12">
                            <div class="input-group">
                              <div class="form-group col-md-6">  
                              </div>  
                            </div>
                          </div>
                          </div>                          
                        <div class="row">       
                          <div class="col-lg-12">
                            <div class="input-group">
                              <div class="form-group col-md-6">     
                                <label for="">Admin</label>   
                              </div>    
                              <div class="form-group col-md-6" v-for="permission in permissions" :key="permission.id">
                                <label :for="permission.name">{{permission.name}}</label>      
                                
                              </div>    
                            </div>
                          </div>  
                        </div> 
                    </div>
                  </form>  
            </div>                
</template>
<script>
import axios from 'axios';
export default {
  data() {
    return {
      role: "",
      permissions: [],
      modules:{},
    }
  },
  props:['role_id'],
  methods:{

      getPermission(){
            axios.get(this.$hostname+'roles/permissions/get_role_permissions/'+this.role_id)
                .then((response)=>{
                    this.role = response.data.role;
                    this.permissions = response.data.all_permissions;
                    this.modules = response.data.modules;
                });
      },


    },mounted(){
        this.getPermission();
    }
}
</script>

<style>

</style>