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
        //   Db connection with PDO 
           $mb = "mysql:host=$this->server;dbname=$this->db";

          try{
            $con =  new PDO($mb,$this->username,$this->password);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $con;
          }
          catch (PDOException $e){
            echo "connection error:" .$e->getMessage();
          }
          
       }
    
        //    Store the profile pics in the database
       function profile_pics(){

           $profile_pix = $_FILES['profile_pics'];
           $pics_folder = 'profile_pics/';
           $file_name = $profile_pix['name'];
           $final_des =$pics_folder.$file_name; //Final file Destination
           $tmp_loc = $profile_pix['tmp_name'];
           $img_format = strtolower(pathinfo($final_des,PATHINFO_EXTENSION));
           $require_file_format = array('jpg','jpeg','png');
           
        //    check if the file is an image 
            if(in_array($img_format,$require_file_format)){
                if(move_uploaded_file($tmp_loc,$final_des)==true){
                    return $final_des;
                } 
             }
             return false;
        }


          //Get login details
        function get_username_password($table,$email,$pass){

           try{
               $sql = "SELECT * FROM $table Where $email=':email' and password = ':pass' LIMIT 1 ";
               $stmt = $this->connect()->prepare($sql);
               $stmt->bindParam(':email', $email);
               $stmt->bindParam(':pass', $pass);
               $stmt->execute();

             return  $stmt->setFetchMode(PDO::FETCH_ASSOC);
           }
           catch(PDOException $e){
               echo "Error:". $e->getMessage();
           }               
        }


        // Update Password
        function update_password($table, $email,$pass,$new_pass){
           try{
                $sql= "UPDATE $table 
                SET password =':new_pass'
                WHERE password = ':pass' and email = ':email'";

                $stmt = $this->connect()->prepare($sql);    

                $stmt->bindParam(':new_pass', $new_pass);
                $stmt->bindParam(':pass', $pass);
                $stmt->bindParam(':email', $email);

                $stmt->execute();

                return $stmt->setFetchMode(PDO::FETCH_ASSOC);
            }
            catch(PDOException $error){
                echo 'Error'.$error->getMessage();
            }  
        }


        // Get all user information
        function check_user_email($table,$email){
            try{
                $sql = "SELECT * FROM $table WHERE email=':email' ";
                $stmt = $this->connect()->prepare($sql);

                $stmt->bindParam(':email', $email);

                $stmt->execute();

                return $stmt->setFetchMode(PDO::FETCH_ASSOC);
            }
            catch(PDOException $err){
                echo 'get users error: '.$err->getMessage();
            }   
        }

        // Login 
        function login($table, $email,$pass){
            try{
                $sql = "SELECT * FROM $table WHERE email =':email' &&
                password = ':pass'";

                $stmt = $this->connect()->prepare($sql);

                $stmt->bindParam(':pass', $pass);
                $stmt->bindParam(':email', $email);

                $stmt->execute();
                return $stmt->setFetchMode(PDO::FETCH_ASSOC);
            }
            catch(PDOException $err){
                echo "login Error ".$err->getMessage();
            }
        }


        // Insert data to database
        function insert_into_table($table,$fname,$lname,$dob,$email,$gender,$phone,$state_code,
            $pics,$password){

            try{
                
                $sql = "INSERT INTO $table(fname,lname,dob,email,sex,phone,state_code,profile_pics, 
                password) VALUES(':fname',':lname',':dob',
                                ':email',':gender',':phone',':state_code',':pics',':password'
                                )";
            
                $stmt = $this->connect()->prepare($sql);

                $stmt->bindParam(':fname',$fname);
                $stmt->bindParam(':lname',$lname);
                $stmt->bindParam(':dob',$dob);
                $stmt->bindParam(':email',$email);
                $stmt->bindParam(':gender',$gender);
                $stmt->bindParam(':state_code',$state_code);
                $stmt->bindParam(':pics',$pics);
                $stmt->bindParam(':password',$password);
                
                $stmt->execute();

                return $result = "Registration Successful";
            }
            catch(PDOException $err){
                echo "Registration Error: ".$err->getMessage();
            }
        }

        
        // close the database
       function close_db(){

            $con = $this->connect();
          return  $con = null;
       }
    }
?>