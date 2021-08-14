$(document).ready(function(){
    
    $.ajax({

        url:mp_ajax,
        data:{
            
        },
        method:'POST',
        success:function(data){
            $("#random_number").html(data);
        }

    });
})