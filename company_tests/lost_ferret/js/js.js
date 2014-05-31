
function callPhpScriptToValidate(name, email, phone){

    $.ajax({

        url: './functions/ajaxcall.php',

        data: {
            name:    name,
            email:   email,
            phone:   phone
        },
        type: 'post',
        dataType: 'json',
        success: function(messages) {
            if(!messages['status']){
                $("#message").html(messages['error']);
            }else{
                alert("reload or whatever");
            }
        }

    });
}

