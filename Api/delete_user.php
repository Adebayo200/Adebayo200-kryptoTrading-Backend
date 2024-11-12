<?php
//API Headers
 header("Access-Control-Allow-Origin: *");
 header("Access-Control-Allow-Method: GET");
 header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Method,Authorization, X-Requested-With"); 
 header("Content-Type: application/json");

 require_once("../auto_loader.php");
    
    //Instantiate Database & connect
    $Db = new Database();

    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $user_obj = new User($Db);

        $result = $user_obj->delete($id);

        if($result['status'])
        {
            echo json_encode(['status'=>true,'message'=>'Operation successful']);
        }
        else 
        {
            echo json_encode(['status'=>false,'message'=>$result['message']]);
        }
   }
   else
   {
    echo json_encode(['status'=>false,'message'=>"No Id supplied"]);
   }


