<?php
    session_start();
    require_once __DIR__. '/dbConnection.php';

    // Get user input and check the db, if there's a user with 
    // data. if true return a message, else login to dashboard.
     $pass = $email ="";

    if($_SERVER['REQUEST_METHOD']=='POST'){
 
            $pass = md5($_POST['pass']);
            $email = filter_var($_POST['email_2'],FILTER_SANITIZE_EMAIL);
        
    }
  
    // get check data in database

    //create error variable to store error information

    // check to see if the user has registered before
    
       if(!empty($_POST['submit'])){
           
            $user_data = $con->get_username_password($table,$email,$pass);
            
            if(!empty($user_data)){
               
                    $_SESSION['user'] = $user_data;

                header('location:../pages/dashboard.php');  
                
            }else{
                $_SESSION['invalid']="Incorrect login Details";
                $_SESSION['email'] =$email;
                header('location:../index.php');  
            }
       }

     
?>