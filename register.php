<?php
include_once("conn.php");
session_start();
/* Registration process, inserts user info into the database

 */
if(isset($_POST['submit'])){
// // Set session variables to be used on profile.php page
 $_SESSION['email'] = $_POST['email'];
 $_SESSION['user_name'] = $_POST['username'];


// Escape all $_POST variables to protect against SQL injections
$user_name = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
// $hash = $mysqli->escape_string( md5( rand(0,1000) ) );

// Check if user with that email already exists
$result = $conn->query("SELECT * FROM user WHERE email='$email'") or die($conn->error());

// We know user email exists if the rows returned are more than 0
if ( $result->num_rows > 0 ) {

    $_SESSION['message'] = 'User with this email already exists!';


}
else { // Email doesn't already exist in a database, proceed...


    $sql = $conn->query("INSERT INTO `user` (email,userName, password) VALUES ('$email','$user_name','$password')")or die($conn->error());

            header("location: login.php");

}

}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Zalego </title>
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
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <b>Zalego management system</b>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register a new member</p>
    <p>
    <?php
    if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ):
       echo $_SESSION['message'];
    else:
       header( "location: register.php" );
    endif;
    ?>
    </p>
    <form action="register.php" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="username" placeholder="User name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="email" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="row">

        <div class="col-xs-4">

          <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>



    <a href="login.php" class="text-center">Login</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../plugins/iCheck/icheck.min.js"></script>

</body>
</html>
