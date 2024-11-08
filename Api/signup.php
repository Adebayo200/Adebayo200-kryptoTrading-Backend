<?php
//API Headers
 header("Access-Control-Allow-Origin: *");
 header("Access-Control-Allow-Method: POST");
 header("Content-Type: application/json");
 header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Method,Authorization, X-Requested-With"); 
 
//  script
 require 'Mail_sender/script.php';

 require_once("../auto_loader.php");

 //Instantiate Database & connect
 $Db = new Database();
 
 //Get submited data
 

  $data = json_decode(file_get_contents("php://input"));

  $signup_obj = new Signup($Db);
 
  $auth = $signup_obj->sign_up($data->firstName,$data->lastName,$data->email,$data->userName,$data->pwd);

 if($auth['status'])
 {   
    sendMail($data->email,"Account verification","New message from krypto trading");
    echo json_encode(['status'=>true,'message'=>$auth['message']]);
 }
 else
 {
    echo json_encode(['status'=>false,'message'=>$auth['message']]);
 }
