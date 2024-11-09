<?php
//API Headers
 header("Access-Control-Allow-Origin: *");
 header("Access-Control-Allow-Method: POST");
 header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Method,Authorization, X-Requested-With"); 
 header("Content-Type: application/json");

 //  script
 require 'Mail_sender/script.php';

 require_once("../auto_loader.php");
    
    //Instantiate Database & connect
    $Db = new Database();

    $data = json_decode(file_get_contents("php://input"));

    $user_obj = new User($Db);

    $result = $user_obj->user_by_email($data->email);

    if($result['status'])
    {
        $token = $result['data']['pwd_token'];
        $message = "<div style='border: 1px solid rgba(0, 0, 0, 0.336);font-family: sans-serif;max-width: 400px;margin: auto; box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.253);border-radius:  0 0 8px 8px;'>
                        <div style='padding:15px 10px; background-color:blue;color:white;text-align: center;border-radius: 8px 8px 0 0;'>
                            <h2 style='margin: 0;'>KRYPTO TRADING</h2>
                        </div>
                        <div style='padding:10px'>
                        <p style='margin:5px 0;font-size: 14px;color: rgba(0, 0, 0, 0.699);'>Hello, please use the phrase below to recover your password</p>
                        <h3>$token</h3>
                        </div>
                    </div>";

        sendMail($data->email,"Account verification",$message);
        echo json_encode(['status'=>true,'data'=>$result['data'],'message'=>'Operation successful']);
    }
    else 
    {
        echo json_encode(['status'=>false,'data'=>[],'message'=>$result['message']]);
    }



