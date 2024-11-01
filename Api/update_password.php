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

 $user_obj = new User($Db);
 
  $result = $user_obj->update_password($data->id,$data->currentPassword,$data->newPassword);

 if($result['status'])
 {
     echo json_encode(['status'=>true,'message'=>$result['message']]);
 }
 else 
 {
    echo json_encode(['status'=>false,'message'=>$result['message']]);
 }
