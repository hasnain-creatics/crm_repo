function readURL(input) {
  
    if (input.files && input.files[0]) {
  
      var reader = new FileReader();
  
      reader.onload = function (e) {
  
        $('.user_image_view').attr('src', e.target.result).width(100).height(90);
  
      };
  
      reader.readAsDataURL(input.files[0]);
  
    }
  }
  


function all_designations(route,id=null){

    $.ajax({

        type: "get",

        url : route,

        dataType: "json",

        success:function(response){

            var html = "";

            html+="<option></option>";

            for(i = 0; i<response.length;i++){

         
                    html+="<option value="+response[i].id+">"+response[i].name+"</option>";


                
            }

            $('#designation').html(html);
            if(id)
            $('#designation').val(id).trigger('change');
        }

    });

}



function all_cities(route,id=null){

$.ajax({

    type: "get",

    url : route,

    dataType: "json",

    success:function(response){

        var html = "";

        // html+="<option></option>";

        for(i = 0; i<response.length;i++){

         
            html+="<option value="+response[i].id+">"+response[i].title+"</option>";
            

        }

        $('#city_id').html(html);
 
        if(id)
        $('#city_id').val(id).trigger('change');
    }

});

}


function lead_checkes(request_url,lead=null){
    

    if($('input[name="is_lead"]').is(':checked') ){

        $('#assignLead').removeClass('d-block').addClass('d-none');


    }else{

        $('#assignLead').removeClass('d-none').addClass('d-block');

         var designation = $('.designation_id').val();
         
          $.ajax({

            url:request_url+'/'+designation,
            
            dataType:'json',
            
            type:'get',
            
            success:function(data){

                var html = "";

                if(data['status'] == 'success'){
            
                    html +="<option value=''>Select Lead</option>";
            
                    for(i = 0;i<data['data'].length;i++){
            
                        html +="<option value="+data['data'][i].id+" "+(lead ? (lead == data['data'][i].id ? 'selected' : '') : '')+">"+data['data'][i].name+"</option>";
            
                    }
                    $('#lead_id').html(html);

                }else{

                    $('#assignLead').addClass('d-none').removeClass('d-block');

                }
            
            
            
            }
         
          });



    }

}


function check_team(ele){

    alert(ele);
}


function userView(ele){
    
$.ajax({

    type: "get",

    url : main_url+'/user/show/'+ele,

    dataType: "html",

    success:function(response){

        $('#all-modals').html(response);
        $('#modaldemo8').modal('show');
    }

});

}

