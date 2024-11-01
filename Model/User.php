<?php

 class User
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

     public function create($first_name,$last_name,$email,$username,$pwd,$pwd_token)
     {
        $this->first_name = $first_name;
         $this->last_name = $last_name;
         $this->email = $email;
         $this->username = $username;
         $this->pwd = $pwd;
         $this->pwd_token = $pwd_token;
          
         $sql = "INSERT INTO user SET first_name =:firstname, 
                  last_name=:lastname, 
                  email=:email,
                  username = :username,
                  pwd=:pwd, 
                  pwd_token = :pwd_token";

         $stmt = $this->dbc_obj->con->prepare($sql);
 
          $result = $stmt->execute(['firstname'=>$this->first_name,'lastname'=>$this->last_name,
                                    'email'=>$this->email,
                                    'username'=>$this->username,
                                    'pwd'=>$this->pwd,
                                    'pwd_token'=>$this->pwd_token]);
 
         if($result)
         {
             return ['status'=>true,'message'=>'User created'];
             exit();
         }
         else
         {
             return ['status'=>false,'message'=>'Unable to create new user'];
             exit();
         }
     }

     
    public function users():array
    {
        $sql = "SELECT * FROM user";
        $stmt = $this->dbc_obj->con->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $row_count = $stmt->rowCount();
        if($row_count > 0)
        {
            return ['status'=>true,'data'=>$result,'message'=>'Operation successful'];
            exit();
        }
        else
        {
            return ['status'=>false,'data'=>[],'message'=>'Operation not successful'];
            exit();
        }
    }

    public function update_password($id,$current_password,$new_password):array
    {

        $sql = "select * from user where pwd = :current && id = :id";
        $stmt = $this->dbc_obj->con->prepare($sql);
        $stmt->execute(['id'=>$id,'current'=>$current_password]);
 
        $row_count = $stmt->rowCount();
        if($row_count <= 0 )
        {
            return ['status'=>false,'message'=>'Operation not successful: Invalid current password'];
            exit();
        }

         $sql = "UPDATE user SET pwd = :pwd WHERE id = :id";
         $stmt = $this->dbc_obj->con->prepare($sql);
         $result = $stmt->execute(['id'=>$id,'pwd'=>$new_password]);
         if($result)
         {
            return ['status'=>true,'message'=>'Operation successful'];
            exit();
         }
         else
         {
            return ['status'=>false,'message'=>'Operation not successful'];
            exit();
         }
       
    }

}