<?php
include_once("conn.php");
session_start();

if(isset($_POST['submit'])){
$user_name = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

$hash = password_hash($password, PASSWORD_DEFAULT);
$query = "SELECT * FROM user WHERE email='$email'";
$execute = mysqli_query($conn, $query);
if($execute){
  $rows = mysqli_num_rows($execute);
if($rows > 0){
  $_SESSION['message'] = 'User with this email already exists!';
}else{
  $insert = "INSERT INTO `user` (email,userName, type, password) VALUES ('$email','$user_name','admin','$hash')";
  $run = mysqli_query($conn, $insert);
  if($run){
    header('location: login.php?registration successful');
  }else{
    echo mysqli_error($conn);
  }


}
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
    if($_SESSION['message'] != null ){
       echo $_SESSION['message'];
       $_SESSION['message'] = null;
    }
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
