<?php
//API Headers
 header("Access-Control-Allow-Origin: *");
 header("Access-Control-Allow-Method: POST");
 header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Method,Authorization, X-Requested-With"); 
 header("Content-Type: application/json");


 require_once("../auto_loader.php");
    
    //Instantiate Database & connect
    $Db = new Database();

    $data = json_decode(file_get_contents("php://input"));

    $user_obj = new User($Db);

    $result = $user_obj->recover_password($data->email,$data->token,$data->newPassword);

    if($result['status'])
    {
        echo json_encode(['status'=>true,'message'=>'Operation successful']);
    }
    else 
    {
        echo json_encode(['status'=>false,'message'=>$result['message']]);
    }



