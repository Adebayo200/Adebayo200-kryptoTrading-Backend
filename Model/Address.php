<?php

 class Address
 {
     private string $coin_name;
     private string $address;


    
     public  $dbc_obj;

     public function __construct(Database $Db)
     {
        $this->dbc_obj = $Db;
     }

     public function create($coin_name,$address)
     {
        $this->coin_name = $coin_name;
         $this->address = $address;

          
         $sql = "INSERT INTO addresses SET coin_name =:coin_name, 
                  address=:addr";

         $stmt = $this->dbc_obj->con->prepare($sql);
 
          $result = $stmt->execute(['coin_name'=>$this->coin_name,'addr'=>$this->address]);
 
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

     
    public function addresses():array
    {
        $sql = "SELECT * FROM addresses";
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

    public function update($id,$coin_name,$address):array
    {
        
        $this->coin_name = $coin_name;
        $this->address = $address;

          
        $sql = "UPDATE addresses SET coin_name =:coin_name, 
        address=:addr WHERE id=:id";

        $stmt = $this->dbc_obj->con->prepare($sql);
        
        $result = $stmt->execute(['id'=>$id,'coin_name'=>$this->coin_name,'addr'=>$this->address]);

        
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
        $sql = "DELETE FROM addresses WHERE id=:id";
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

