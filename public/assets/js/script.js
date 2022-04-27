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
