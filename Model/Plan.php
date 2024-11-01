<?php

 class Plan
 {
     private string $user_id;
     private string $username;
     private string $investment_type;
     private string $package;
     private string $address;
     private string $amount;
     private string|null $hash;
     private string|null $return;
     private string $confirmed;
    
     public  $dbc_obj;

     public function __construct(Database $Db)
     {
        $this->dbc_obj = $Db;
     }

     public function create($user_id,$username,$investment_type,$package,$address,$amount,$hash)
     {
        $this->user_id = $user_id;
        $this->username = $username;
         $this->investment_type = $investment_type;
         $this->package = $package;
         $this->address = $address;
         $this->amount = $amount;
         $this->hash = $hash;
          
         $sql = "INSERT INTO plans SET userId =:userid, username=:username,
                  investmentType=:it, 
                  package=:package, 
                  address=:address,
                  amount = :amount,
                  hash = :hash";

         $stmt = $this->dbc_obj->con->prepare($sql);
 
          $result = $stmt->execute(['userid'=>$this->user_id,
                                    'username'=>$this->username,
                                    'it'=>$this->investment_type,
                                    'package'=>$this->package,
                                    'address'=>$this->address,
                                    'amount'=>$this->amount,
                                    'hash'=>$this->hash]);
 
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

     
    public function plans():array
    {
        $sql = "SELECT * FROM plans";
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
    
    public function user_plans($id):array
    {
        $sql = "SELECT * FROM plans where userId=:u_id";
        $stmt = $this->dbc_obj->con->prepare($sql);
        $stmt->execute(['u_id'=>$id]);
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
    
     
    public function plan($id):array
    {
        $sql = "SELECT * FROM plans WHERE id=:id";
        $stmt = $this->dbc_obj->con->prepare($sql);
        $stmt->execute(['id'=>$id]);
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

    public function confirm($id,$status):array
    {
        
         $this->confirmed = $status;

          
         $sql = "UPDATE plans SET confirmed =:sts WHERE id=:id";

         $stmt = $this->dbc_obj->con->prepare($sql);
 
          $result = $stmt->execute(['id'=>$id,'sts'=>$this->confirmed]);
 
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

    
    public function update_hash($id,$hash):array
    {
        
         $this->hash = $hash;

          
         $sql = "UPDATE plans SET hash=:h WHERE id=:id";

         $stmt = $this->dbc_obj->con->prepare($sql);
 
          $result = $stmt->execute(['id'=>$id,'h'=>$this->hash]);
 
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


    public function update($id,$user_id,$username,$investment_type,$package,$address,$amount,$hash,$return)
    {
        $this->user_id = $user_id;
        $this->username = $username;
        $this->investment_type = $investment_type;
        $this->package = $package;
        $this->address = $address;
        $this->amount = $amount;
        $this->hash = $hash;
        $this->return = $return;
         
        $sql = "UPDATE plans SET userId =:userid, username=:username,
                 investmentType=:it, 
                 package=:package, 
                 address=:address,
                 amount = :amount,
                 hash = :hash,
                 returns = :returns WHERE id=:id";

        $stmt = $this->dbc_obj->con->prepare($sql);

         $result = $stmt->execute(['id'=>$id,
                                    'userid'=>$this->user_id,
                                   'username'=>$this->username,
                                   'it'=>$this->investment_type,
                                   'package'=>$this->package,
                                   'address'=>$this->address,
                                   'amount'=>$this->amount,
                                   'hash'=>$this->hash,
                                   'returns'=>$this->return]);

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

    public function delete($id):array
    {
        $sql = "DELETE FROM plans WHERE id=:id";
        $stmt = $this->dbc_obj->con->prepare($sql);
        $result = $stmt->execute(['id'=>$id]);
        
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

    public function delete_plans($id):array
    {
        $sql = "DELETE FROM plans WHERE userId=:id";
        $stmt = $this->dbc_obj->con->prepare($sql);
        $result = $stmt->execute(['id'=>$id]);
        
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