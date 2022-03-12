<?php
      session_start(); //Start the session 
      include './classes/classes.php';    // include the class library
      $server = '127.0.0.7';   
      $username = "Daniel";
      $password = "12345678";
      $db = "daniel";
      $table = "nysc";
  

    // Instantiate the class Object
    $con = new dbconnect($server,$username,$password,$db);
    
    $email = $old_ps = $new_ps = $confirm_ps = $final_ps = "";
    $Message = array(); 

    // Get the User input
    if($_SERVER["REQUEST_METHOD"]==="POST"){
        
        $email = $con->sanitize_data($_POST['email']);
        $old_ps = md5($con->sanitize_data($_POST['old-ps']));
        $new_ps = md5($con->sanitize_data($_POST['new-ps']));
        $confirm_ps = md5( $con->sanitize_data($_POST['c-ps']));
        $final_ps = ($new_ps === $confirm_ps)? $new_ps:null; 

    }
    
    // Store the data in the database
    if(!empty($_POST["submit"])){ 
        // check if the password and email is same with the one store in the db
        echo"am available";
        $result = $con->get_username_password($table,$email,$old_ps);
        
        if($result->num_rows>0){ //check if the old password and email tally with that in the db

            if(isset($final_ps)){ //check if new_ps and confirm_ps are same
                $data = $con->update_password($table,$email,$old_ps,$final_ps);
                $Message["success"] ="Password has change"; 
                $_SESSION['message'] = $Message;
                header('location:../pages/change_pass.php');
            }else{
                
             $Message['error2']="Confirm password";
             $_SESSION['message'] = $Message;
             header('location:../pages/change_pass.php');
            }
        }else{
            $Message['error1']="The password is incorrect";
            $_SESSION['message'] = $Message;
            header('location:../pages/change_pass.php');
        }
      
    }



    

?>