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
 {  $message = "<div style='border: 1px solid rgba(0, 0, 0, 0.336);font-family: sans-serif;max-width: 400px;margin: auto; box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.253);border-radius:  0 0 8px 8px;'>
                    <div style='padding:15px 10px; background-color:blue;color:white;text-align: center;border-radius: 8px 8px 0 0;'>
                        <h2 style='margin: 0;'>KRYPTO TRADING</h2>
                    </div>
                    <div style='padding:10px'>
                    <p style='margin-top:5px;font-size: 14px;color: rgba(0, 0, 0, 0.699);'><b>Hello $data->firstName</b><br>Welcome to Krypto Trading, we're delighted to have you with us.<br> Please click on the button below to  verify your account.</p>
                    <a href='https://www.kryptotrade.org/verify/user/$data->email' style='display: inline-block;padding: 3px 8px; border-radius: 3px;font-weight: 600;background: rgba(0, 128, 0, 0.664);color: white;font-size: 14px;text-decoration: none;'>Verify</a>
                    </div>
                </div>";
    sendMail($data->email,"Account verification",$message);
    echo json_encode(['status'=>true,'message'=>$auth['message']]);
 }
 else
 {
    echo json_encode(['status'=>false,'message'=>$auth['message']]);
 }
