<?php
  
  require_once __DIR__. '\dbConnection.php';
    // Get user input and check the db, if there's a user with 
    // data. if true return a message, else login to dashboard.
    $fname = $lname = $phone = $dob = $gender = $pics =$pass = $conf_pass =$final_pass = $email ="";
    
    if($_SERVER['REQUEST_METHOD']=='POST'){
            $fname = sanitize_input($_POST['fname']);
            $lname = sanitize_input($_POST['lname']);
            $phone = sanitize_input($_POST['phone']);
            $dob = sanitize_input($_POST['dob']);
            $gender = sanitize_input($_POST['gender']);
            $confirm_pass =  md5(sanitize_input($_POST['password_confirm']));
            $pass = md5(sanitize_input($_POST['password']));
            $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
            $pics = $con->profile_pics();
            $state_code = rand(10,1000);
    }

    //create error variable to store error information
    $error = array();
    // check to see if the user has registered before
    $user = $con->get_all_user_data($table,$email);

       if(!empty($_POST['submit'])){
           
        if(!empty($user)){
                
                $error['email'] = "Email Already Exist";
            }else{
                if($pass == $confirm_pass){

                    $insert_data = $con->insert_into_table($table,$fname,$lname,$dob,$email,$gender,
                    $phone,$state_code,$pics,$pass
                    );
                    $user_data = $con->get_all_user_data($table,$email);
                    $_SESSION['user'] = $user_data;
                    
                }else{
                    $error['password']="Confirm password";
                }
               
            }
       }
       

    //  Sanitize input
    function sanitize_input($param){
        $param = trim($param);
        $param = stripslashes($param);
        $param = htmlspecialchars($param);
        
        return $param;
    }

    $con->close_db();
    
    
       
?>