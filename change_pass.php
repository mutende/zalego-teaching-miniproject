<?php
session_start();
if(isset($_POST['changePassword'])){
  $user_id = $_POST['user'];
  $pass1 = trim($_POST['pass']);
  $pass2 = trim($_POST['pass1']);
  $current_password = trim($_POST['current_pass']);

  if ($pass1 !=  $pass2){
      $_SESSION['error'] = "Passwords do not match";
      header('Location: change_pass.php');
  }else{
    //get password
    require('conn.php');
    $getPassword = "SELECT password FROM user  WHERE userName = '$user_id' ";
    $results = mysqli_query($conn, $getPassword);
    $password = mysqli_fetch_assoc($results);
    if(password_verify($current_password,$password['password'])){
      $new_pass_hashed = password_hash($pass1, PASSWORD_DEFAULT);
      $update_password = "UPDATE user SET `password` = '$new_pass_hashed' WHERE `userName` = '$user_id' ";
      if(mysqli_query($conn, $update_password)){
          $_SESSION['success'] = "Password successfully updated";
      }else{
          $_SESSION['error'] = "Password not updated try again Later";
      }
    }else{
        $_SESSION['error'] = "Current Password is incorrect";
    }


  }
}
include('header.php');
?>

<section>
<div class="login-box">

<!-- form -->
<div class="login-logo">
  <b>Change Password</b>
</div>
<!-- /.login-logo -->
<div class="login-box-body">
  <p class="login-box-msg">Change Password</p>
  <?php
if(isset($_SESSION['success'])){

  if( $_SESSION['success'] != null){
     echo '<span class="text-success">'.$_SESSION['success'].'</span>';
     $_SESSION['success'] = null;
  }
}
if( isset($_SESSION['error'])){
  if($_SESSION['error'] != null){
    echo '<span class="text-danger mb-2">'.$_SESSION['error'].'</span>';
    $_SESSION['error'] = null;
  }
}

  ?>
  <form action="change_pass.php" method="post">
    <input type="hidden" name="user" value="<?php echo $_SESSION['user_name']; ?>">
    <div class="form-group has-feedback">
      <input type="password" class="form-control" name="current_pass" placeholder="Current Password" required>
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
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
        <button type="submit" name="changePassword" class="btn btn-primary btn-inline btn-flat">Change Password</button>
      </div>
      <!-- /.col -->
    </div>
  </form>


</div>


</div>
</section>
