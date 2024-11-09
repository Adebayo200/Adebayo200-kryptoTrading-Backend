<?php

 class Signup
 {
     private string $first_name;
     private string $last_name;
     private string $email;
     private string $username;
     private string $pwd;
     private string $pwd_token;

     public  $dbc_obj;

     public function __construct(Database $Db)
     {
        $this->dbc_obj = $Db;
     }
     
     private function invalid_email():bool
     {
         $result;
         if(!filter_var($this->email, FILTER_VALIDATE_EMAIL))
         {
             $result = false;
         }
         else
         {
             $result = true;
         }
         return $result;
     }

     private function already_exists():bool
     {
         $sql = "SELECT * FROM user WHERE email= :email";
         $stmt = $this->dbc_obj->con->prepare($sql);
         $stmt->execute(['email'=>$this->email]);
         $count = $stmt->rowCount();
         
         if($count > 0)
         {
             return false;
         }
         else
         {
             return true;
         }

     }

     public function sign_up($first_name,$last_name,$email,$username,$pwd)
     {
         $this->first_name = $first_name;
         $this->last_name = $last_name;
         $this->email = $email;
         $this->username = $username;
         $this->pwd = $pwd;
         $this->pwd_token = substr(md5(mt_rand(0,1000000)),0,10);

         if($this->invalid_email() === false)
         {
            return ['status'=>false,'message'=>"Ivalid email. Please try again"];
            exit(); 
         }
         if($this->already_exists() === false)
         {
            return ['status'=>false,'message'=>"A user with this email already exists. Please try again"];
            exit();
         }

         $user_obj = new User($this->dbc_obj);

         return $user_obj->create($this->first_name,$this->last_name,$this->email,$this->username,$this->pwd,$this->pwd_token);   
     }
 }