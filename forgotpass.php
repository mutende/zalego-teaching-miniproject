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

  $to = $email;
  $subject = "Reset Password";
  $message = '<p>We received your request to reset your password.
              Click the link below to reset your password.
              If you did not send the request just ignore the email</p>';
  $message .= '<p>Click <a href="'.$url.'">here</a> to reset your password</p>';

  $headers = "From: Zalego <info@theopportunity.co.ke>\r\n";
  $headers .= "Reply-To: info@theopportunity.co.ke\r\n";
  $headers .="Content-type: text/html\r\n";

  if(mail($to,$subject,$message,$headers)){

    $_SESSION['success'] = 'Check your email to complete reset password';
    header("Location: forgotpwd.php");
  }else{

    $_SESSION['error'] = 'There is a problem, try later';
    header("Location: forgotpwd.php");
  }

  }


  }


 ?>
