<?php

 class Investment
 {
     private string $package;
     private string $percentage;
     private string $return;
     private string $min_dep;
     private string $max_dep;
    
     public  $dbc_obj;

     public function __construct(Database $Db)
     {
        $this->dbc_obj = $Db;
     }

     public function create($package,$percentage,$return,$min_dep,$max_dep)
     {
        $this->package = $package;
         $this->percentage = $percentage;
         $this->return = $return;
         $this->min_dep = $min_dep;
         $this->max_dep = $max_dep;
          
         $sql = "INSERT INTO investments SET package =:package, 
                  percentage=:percentage, 
                  returns=:return,
                  min_dep=:min_dep,
                  max_dep = :max_dep";

         $stmt = $this->dbc_obj->con->prepare($sql);
 
          $result = $stmt->execute(['package'=>$this->package,'percentage'=>$this->percentage,
                                    'return'=>$this->return,
                                    'min_dep'=>$this->min_dep,
                                    'max_dep'=>$this->max_dep]);
 
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

     
    public function investments():array
    {
        $sql = "SELECT * FROM investments";
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

    public function update($id,$package,$percentage,$return,$min_dep,$max_dep):array
    {
        
         $this->package = $package;
         $this->percentage = $percentage;
         $this->return = $return;
         $this->min_dep = $min_dep;
         $this->max_dep = $max_dep;
          
         $sql = "UPDATE investments SET package =:package, 
                  percentage=:percentage, 
                  returns=:return,
                  min_dep=:min_dep,
                  max_dep = :max_dep WHERE id=:id";

         $stmt = $this->dbc_obj->con->prepare($sql);
 
          $result = $stmt->execute(['id'=>$id,'package'=>$this->package,'percentage'=>$this->percentage,
                                    'return'=>$this->return,
                                    'min_dep'=>$this->min_dep,
                                    'max_dep'=>$this->max_dep]);
 
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
        $sql = "DELETE FROM investments WHERE id=:id";
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