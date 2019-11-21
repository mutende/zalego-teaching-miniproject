<?php
include_once("conn.php");
session_start();
/* User login process, checks if user exists and password is correct */
error_reporting(0);
// Escape email to protect against SQL injections
if(isset($_POST['submit'])){

$email = $_POST['email'];
$result = $conn->query("SELECT * FROM user WHERE email='$email'");

if ( $result->num_rows == 0 ){ // User doesn't exist
    $_SESSION['message'] = "User with that email doesn't exist!";

}
else { // User exists
    $user = $result->fetch_assoc();

    if ( password_verify($_POST['password'], $user['password']) ) {

        $_SESSION['email'] = $user['email'];
        $_SESSION['user_name'] = $user['userName'];

        //$_SESSION['active'] = $user['active'];

        // This is how we'll know the user is logged in
        $_SESSION['logged_in'] = true;

        header("location: index.php");
    }
    else {
        $_SESSION['message'] = "Check your credentials again!";
       ;
    }
}
}
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Zalego | Forgot Password</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">


  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">

  <?php

  $selector = $_GET['selector'];
  $validator = $_GET['validator'];

  if(!empty($selector) && !empty($validator)){
    if(ctype_xdigit($selector) !== false && ctype_xdigit($selector) !== false){

      ?>
<!-- form -->
<div class="login-logo">
  <b>Create New Password</b>
</div>
<!-- /.login-logo -->
<div class="login-box-body">
  <p class="login-box-msg">Forgot Password</p>
  <?php

  if( $_SESSION['success'] != null){
     echo '<span class="text-success">'.$_SESSION['success'].'</span>';
     $_SESSION['success'] = null;
  }else
  if($_SESSION['error'] != null){
    echo '<span class="text-danger mb-2">'.$_SESSION['error'].'</span>';
    $_SESSION['error'] = null;
  }


  ?>
  <form action="resetpass.php" method="post">
    <input type="hidden" name="selector" value="<?php echo $selector; ?>">
    <input type="hidden" name="validator" value="<?php echo $validator; ?>">
    <div class="form-group has-feedback">
      <input type="password" class="form-control" name="pass" placeholder="New Password" required>
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
      <input type="password" class="form-control" name="pass1" placeholder="Confirm Password" required>
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="row">

      <!-- /.col -->
      <div class="col-xs-4">
        <button type="submit" name="resetPassword" class="btn btn-primary btn-inline btn-flat">Reset Password</button>
      </div>
      <!-- /.col -->
    </div>
  </form>

  <a href="index.php" class="text-center">Sign in </a>

</div>
<!-- /.login-box-body -->
<!-- end form -->

      <?php

    }else{
      // invalid hexadecimals
    }

  }else{
    // invalid tokens
  }


   ?>

</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>

</body>
</html>
