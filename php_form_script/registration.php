<?php
  
  require_once __DIR__. '\dbConnection.php';
  require_once "./php_form_script/functions/validateForm.func.php";
    if(isset($_POST["submit"])){

        $error = array();
        // get store the user input into a variable for validation 

        $fname = "";
        $lname = "";
        $dob = "";
        $phone = "";
        $email = "";
        $gender = "";
        $password = "";
        $pass_final="";
        $state_code = rand(1000,4000);
        $profile_pics = ($con->profile_pics() !=false)?$con->profile_pics(): false;
        $pics="";

        //check if user input is empty
        if(checkEmpty($_POST['fname'])==true || checkEmpty($_POST['lname'])==true ||
            checkEmpty($_POST['email'])==true || checkEmpty($_POST['dob'])==true ||
            checkEmpty($_POST['phone'])==true || checkEmpty($_POST['email'])==true ||
            checkEmpty($_POST['email'])==true || checkEmpty($_POST['gender'])==true ||
            checkEmpty($_POST['password'])==true || checkEmpty($_POST['password_confirm'])==true){
            
                $error['input'] = "Fill all input";       
        }

        //errorMessage for pics
        if($profile_pics==false){
            $error['pics'] = "please ensure you are uploading the right file format(jpeg,jpg,png)";
        }
        else{
            $pics= $profile_pics;
        }

        // Validate fname input
        if(validateName($_POST['fname']) ==true){
            $error['fname'] = "Enter a valid fname";
        }
        else{
            $fname = $_POST['fname'];
        }
        
        //validate lname input
        if(validateName($_POST['lname']) ==true){
            $error['lname'] = "Enter a valid lname";
        }
        else{
            $lname = $_POST['lname'];
        }

        // Valide phone number 
        if(validateNum($_POST['phone']) ==true){
            $error['phone'] = "phone number should not be less than 12 digit";
        }
        else{
            $phone = $_POST['phone'];
        }


        // validate email
        if(validateEmail($_POST['email']) ==true){
            $error['email'] = "Enter a valid email address";
        }
        else{
            $email = $_POST['email'];
        }
        
        // validate password 
        if(validatePswd($_POST['password']) ==true){
            $error['password'] = "Password must contain digit, alphabet, character and a whitespace";
        }
        else{
            $password = $_POST['password'];
        }

        if(checkPwsd_again($_POST['password'],$_POST['password_confirm'])==true){
            $error['confirm_pss'] = "Password does'nt match";
        }
        else{
            $pass_final = $_POST['password'];
        }

        //check if email has already been registered
         $result = $con->check_user_email($table,$email);
         if(!empty($result)){
             $error['email']+="<br> User has already been registered";
         }
         else{
             //insert user data into the database
             $pass_final = md5($pass_final);
             $con->insert_into_table($table,$fname,$lname,$dob,$email,$gender,$phone,$state_code,$pics,$pass_final);
         }

    }
    else{
       
    }
   

    $con->close_db();
    
    
       
?>