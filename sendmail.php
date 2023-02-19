<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer\PHPMailer\PHPMailer();

$name = $_POST['name'];
$email = $_POST['email'];
$semm = $_POST['semm'];

$body = "
<h2>Новое письмо</h2>
<b>Имя:</b> $name<br>
<b>Почта:</b> $email<br><br>
<b>Сообщение:</b><br>$semm
";

    //Server settings
   //  $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
   $mail->isSMTP();   
   $mail->CharSet = "UTF-8";
   $mail->SMTPAuth   = true;      
   
   //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through                                //Enable SMTP authentication
    $mail->Username   = 'maikl.korvin.99@gmail.com';                     //SMTP username
    $mail->Password   = 'qjwfbctrxtbdfvry';                               //SMTP password
    $mail->SMTPSecure = 'ssl';           //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    $mail->setFrom('maikl.korvin.99@gmail.com', 'Maikle');
    
    //Recipients
    $mail->addAddress($email);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
   $mail->Subject = 'Here is the subject';
   $mail->Body = $body ;

   if(!$mail->send()){
      $message = 'Ошибка';
   } else{
      $message = '«Ваша заявка успешно отправлена и находится в обработке. Ожидайте email с подтверждением бронирования.»';
   }

   $response = ['message' => $message];

   echo json_encode($response)
?>