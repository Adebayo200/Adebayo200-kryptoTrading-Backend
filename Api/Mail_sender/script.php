<?php

 require 'PHPMailer/src/Exception.php';
 require 'PHPMailer/src/PHPMailer.php';
 require 'PHPMailer/src/SMTP.php';

 use PHPMailer\PHPMailer\Exception;
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;

//  Config file
 require 'config.php';


 function sendMail($email,$subject,$message)
 {
    $mail = new PHPmailer(true);

    $mail->isSMTP();

    $mail->SMTPAuth = true;

    $mail->Host = MAILHOST;

    $mail->Username = USERNAME;

    $mail->Password = PASSWORD;

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    $mail->Port = 587;

    $mail->setFrom(SEND_FROM,SEND_FROM_NAME);

    $mail->addAddress($email);

    $mail->addReplyTo(REPLY_TO,REPLY_TO_NAME);

    $mail->isHTML(true);

    $mail->Subject = $subject;

    $mail->Body = $message;

    $mail->AltBody = $message;

    if(!$mail->send())
    {
        return true;
    }else
    {
        return false;
    }
 }


 