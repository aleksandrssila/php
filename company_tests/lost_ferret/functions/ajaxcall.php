<?php



if(is_ajax()){
    //Checks if action value exists
    if (isset($_POST["email"])
        && !empty($_POST["name"])
        && !empty($_POST["phone"])) {
        check_function();
    }
}
/**
 * Checks all post values
 */
function check_function(){
    $return = array();
    $status = true;
    if(strlen($_POST["name"]) <3){
        $return['error'] = " Name is bad ";
        $status = false;
    }
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $return['error'] = $return['error']." Email is bad ";
        $status = false;
    }
    if(!preg_match('/^[0-9 -]+$/i',$_POST['phone'])){
        $return['error'] = $return['error']." Phone is bad";
        $status = false;
    }
    $return['status'] = $status;
    $return["json"] = json_encode($return);
    echo json_encode($return);
}

/**
 * Function to check if the request is an AJAX request
 */
function is_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

