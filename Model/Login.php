<?php

 class Login
 {
     private string $email;
     private string $password;
     public  $dbc_obj;

     public function __construct(Database $Db, string $email, string $password)
     {
        $this->email = $email;
        $this->password = $password;
        $this->dbc_obj = $Db;
     }

     public function login():array
     {

        $sql = "SELECT * FROM user WHERE email = :email"; 
        $stmt = $this->dbc_obj->con->prepare($sql);
        $stmt->execute(['email'=>$this->email]);
        $row_count = $stmt->rowCount();

         if($row_count > 0)
         {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $password = $row['pwd'];

            if($this->password == $password)
            {
                return ['status'=>true,'data'=>$row];
                exit();
            }
            else
            {
                return ['status'=>false,'message'=>"Incorrect password. Please try again"];
                exit();         
            }
         }
         else
         {
             return ['status'=>false,'message'=>"Invalid email. Please try again"];
             exit();
         }
     }
 }