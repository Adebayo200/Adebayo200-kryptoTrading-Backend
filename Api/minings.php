<?php
//API Headers
 header("Access-Control-Allow-Origin: *");
 header("Access-Control-Allow-Method: GET");
 header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Method,Authorization, X-Requested-With"); 
 header("Content-Type: application/json");

 require_once("../auto_loader.php");
    
    //Instantiate Database & connect
    $Db = new Database();

    $mining_obj = new Mining($Db);

    $result = $mining_obj->plans();

    if($result['status'])
    {
        echo json_encode(['status'=>true,'data'=>$result['data'],'message'=>'Operation successful']);
    }
    else 
    {
        echo json_encode(['status'=>false,'data'=>[],'message'=>$result['message']]);
    }


