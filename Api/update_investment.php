<?php
//API Headers
 header("Access-Control-Allow-Origin: *");
 header("Access-Control-Allow-Method: POST");
 header("Content-Type: application/json");
 header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Method,Authorization, X-Requested-With"); 
 

 require_once("../auto_loader.php");

 //Instantiate Database & connect
 $Db = new Database();
 
 //Get submited data
 

 $data = json_decode(file_get_contents("php://input"));

 $investment_obj = new Investment($Db);
 
  $result = $investment_obj->update($data->id,$data->package,$data->percentage,$data->return,$data->minDep,$data->maxDep);

 if($result['status'])
 {
     echo json_encode(['status'=>true,'message'=>$result['message']]);
 }
 else 
 {
    echo json_encode(['status'=>false,'message'=>$result['message']]);
 }
