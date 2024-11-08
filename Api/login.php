<?php
//API Headers
 header("Access-Control-Allow-Origin: *");
 header("Access-Control-Allow-Method: POST");
 header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Method,Authorization, X-Requested-With"); 
 header("Content-Type: application/json");

 require_once("../auto_loader.php");

 //Instantiate Database & connect
 $Db = new Database();
 
 //Get submited data
 $data = json_decode(file_get_contents('php://input'));

 $user = new Login($Db,$data->email,$data->pwd);
 
 $auth = $user->login();

 if($auth['status'])
 {
     echo json_encode(['status'=>true,'data'=>$auth['data'],'message'=>'User login successful']);
 }
 else 
 {
    echo json_encode(['status'=>false,'data'=>[],'message'=>$auth['message']]);
 }


