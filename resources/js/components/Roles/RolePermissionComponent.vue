<template>
                               
</template>
<script>
import axios from 'axios';
export default {
  data() {
    return {
      role: "",
      permission: [],
      modules:{},
    }
  },
  props:['role_id'],
  methods:{

      getPermission(){
            axios.get(this.$hostname+'roles/permissions/get_role_permissions/'+this.role_id)
                .then((response)=>{
                    this.role = response.data.role;
                    this.permission = response.data.permissions;
                    this.modules = response.data.modules;
                });
      },
//         responseMethods(response){
//                   if(response.data.success==0){
//                       this.name = response.data.message  
                  
//                   if(response.data.message.name[0]){
//                         this.name = response.data.message.name[0];
//                     }
                    
                    
                  
//                   }else{
                
//                     this.message = response.data.message
//                     this.alerts = true;
//                     setTimeout(function(){
//                       window.location.reload();
//                     },1000); 
//                   }
//         },
//         submitDetails(){
//             axios.post('http://localhost/crm/admin/roles/update', this.form)
//                   .then( 
//                   function( response ){
//                     this.responseMethods( response );
//                 }.bind(this)
//                 );
//         }

    },created(){
        this.getPermission();
    }
}
</script>

<style>

</style>