<?php
//API Headers
 header("Access-Control-Allow-Origin: *");
 header("Access-Control-Allow-Method: GET");



 require_once("../auto_loader.php");
    
    //Instantiate Database & connect
    $Db = new Database();

    $user_obj = new User($Db);

    $user = $user_obj->users();

var_dump($user);
    // if($user['status'])
    // {
    //     echo json_encode(['status'=>true,'data'=>$user['data'],'message'=>'Operation successful']);
    // }
    // else 
    // {
    //     echo json_encode(['status'=>false,'data'=>[],'message'=>$user['message']]);
    // }