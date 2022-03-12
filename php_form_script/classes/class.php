<?php


    class dbconnect{
        private $server;
        private $username;
        private $password;
        private $db;

        function __construct($server, $username,$password,$db){
                $this->server = $server;
                $this->username=$username;
                $this->password = $password;
                $this->db = $db;
        }
       function connect(){
           $con = new mysqli($this->server,$this->username, $this->password, $this->db);
           if($con->connect_error){
               die("ERROR: ".$con->connect_error);
           }else{
            return $con;
           }
          
       }
        //    Create Table 
       function createTable($table){
       }
        //    Store the profile pics in the database
       function profile_pics(){

           $profile_pix = $_FILES['profile_pics'];
           $pics_folder = 'profile_pics/';
           $file_name = $profile_pix['name'];
           $final_des =$pics_folder.$file_name; //Final file Destination
           $tmp_loc = $profile_pix['tmp_name'];
           $img_format = strtolower(pathinfo($final_des,PATHINFO_EXTENSION));
           $require_file_format = array('jpg','jpeg','png','gif');
           
        //    check if the file is an image 
            if(in_array($img_format,$require_file_format)){
                if(move_uploaded_file($tmp_loc,$final_des)==true){
                    return $final_des;
                } 
             }
        }
          //Get login details
        function get_username_password($table,$email,$pass){
            $sql ="SELECT * FROM $table WHERE email='$email' && password='$pass'";
           $result = $this->connect()->query($sql);
           
                while($user = $result->fetch_assoc()){
                                
                    return $user;
                }
           
            
        }
        // Update Password
        function update_password($table, $email,$pass,$new_pass){
            $sql= "UPDATE $table 
                    SET password ='$new_pass'
                    WHERE password = '$pass' and email = '$email'";
            if($result = $this->connect()->query($sql)){
                return "it was successfull";
            }
        }
        // Get all user information
        function get_all_user_data($table,$email){
            $sql = "SELECT * FROM $table WHERE email='$email' ";
            $result = $this->connect()->query($sql);
            while($user = $result->fetch_assoc()){
                               
                return $user;
        }
            
        }
        function login($table, $email,$password){
            $sql = "SELECT * FROM $table WHERE email ='$email' &&
                password = '$password'
            ";
            $result = $this->connect()->query($sql);
                while($user = $result->fetch_assoc()){
                               
                    return $user;
                }

        }
        // Insert data to database
        function insert_into_table($table,$fname,$lname,$dob,$email,$gender,$phone,$state_code,
            $pics,$password){

            $sql = "INSERT INTO $table(fname,lname,dob,email,sex,phone,state_code,profile_pics, 
                password) VALUES('$fname','$lname','$dob','$email','$gender','$phone','$state_code','$pics','$password')";
         
            if( $result = $this->connect()->query($sql)){
                return $result;
            }else {
                echo 'ERROR';
            }
           
        }
        // sanitize Data
        function sanitize_data($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);

            return $data;
        }
        // close the database
       function close_db(){

            $this->connect()->close();
       }


    }
?>