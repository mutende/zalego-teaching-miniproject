<?php

if(isset($_POST['sendLink'])){
  session_start();
  include('conn.php');
  $email = trim($_POST['email']);

  // check if email exists
  $result = $conn->query("SELECT * FROM user WHERE email='$email'");

  if ( $result->num_rows == 0 ){ // User doesn't exist
      $_SESSION['error'] = "User with that email doesn't exist!";
      header("Location: forgotpwd.php");
      exit();
  }else{
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    $url = "http://theopportunity.co.ke/novtrain/create_password.php?selector=".$selector."&validator=".bin2hex($token);
    $expires = date("U")+1800;

    $delete = "DELETE FROM resetpassword WHERE email = '$email'";
    // delete token for the email
    mysqli_query($conn, $delete);
  //insert new reset token
  // hash the $token
  $hashedToken = password_hash($token,PASSWORD_DEFAULT);
  $insert = "INSERT INTO resetpassword (email,selector,token,expires) VALUES ('$email','$selector','$hashedToken','$expires');";
  mysqli_query($conn, $insert);
  mysqli_close($conn);



  // $headers = "From: Zalego <info@theopportunity.co.ke>\r\n";
  // $headers .= "Reply-To: info@theopportunity.co.ke\r\n";
  // $headers .="Content-type: text/html\r\n";

  // if(mail($to,$subject,$message,$headers)){
  //
  //
  //
  //
  //
  // }else{
  //
  //
  // }


  // start sending email hebrev
  include('PHPMailer/Exception.php');
  include('PHPMailer/SMTP.php');
  include('PHPMailer/PHPMailer.php');


   $mail = new PHPMailer\PHPMailer\PHPMailer(true);

  try {

    $to = $email;
    $subject = "Reset Password";
    $message = '<p>We received your request to reset your password.
                Click the link below to reset your password.
                If you did not send the request just ignore the email</p>';
    $message .= '<p>Click <a href="'.$url.'">here</a> to reset your password</p>';


      //Server settings
      // $mail->SMTPDebug = PHPMailer\PHPMailer\SMTP::DEBUG_SERVER;                      // Enable verbose debug output
      $mail->isSMTP();                                            // Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
      $mail->Username   = 'elvismutendemakale@gmail.com';                     // SMTP username
      $mail->Password   = 'G@emmi$95';                               // SMTP password
      $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
      $mail->Port       = 587;                                    // TCP port to connect to

      //Recipients
      $mail->setFrom('info@theopportunity.co.ke', 'Zalego Institue');
      $mail->addAddress('elvismutende@gmail.com');     // Add a recipient
      $mail->addReplyTo('info@novtrain.theopportunity.co.ke', 'Zalego Institue');

      // // Attachments
      // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
      // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

      // Content
      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = $subject;
      $mail->Body    = $message;
      // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

      $mail->send();
      $_SESSION['success'] = 'Check your email to complete reset password';
      header("Location: forgotpwd.php");
  } catch (Exception $e) {
    //  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

    $_SESSION['error'] = 'There is a problem, try later';
    header("Location: forgotpwd.php");
  }





  // endsendemail

  }


  }


 ?>
