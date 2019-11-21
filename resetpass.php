<?php
if(isset($_POST['resetPassword'])){
  session_start();
  $selector = $_POST['selector'];
  $validator = $_POST['validator'];
  $pass = $_POST['pass'];
  $pass1 = $_POST['pass1'];

  if($pass1 != $pass){
      $_SESSION['error'] = "Password Do not match";
      header("Location: create_password.php?selector="$selector."&validator=".$validator);
      exit();
  }else{
    $currentDate = date("U");
    include_once("conn.php");
    // get tokens
    $query = "SELECT * FROM resetpassword WHERE `selector` = $selector AND `expires` >= $currentDate";
    $result = mysqli_query($conn, $query);
    if($row = mysqli_fetch_assoc($result)){
      $binaryToken = hex2bin($validator);
      $tokenCheck = password_verify($binaryToken,$row['token']);
      if($tokenCheck === false){
        echo 'Invalid Tokens';
        exit();
      }else
        if($tokenCheck === true){
          $tokenEmail = $row['email'];
          // updated
          $hashPwd = password_hash($pass, PASSWORD_DEFAULT);
          $updateQuery = "UPDATE user SET `password` = $hashPwd WHERE `email`=$tokenEmail";
            $execute = mysqli_query($conn, $updateQuery);
            // redirect
            if($execute){
              // delete tokens
              $delete = "DELETE FROM resetpassword WHERE `email` = '$tokenEmail'";

              if(mysqli_query($conn, $delete)){
                $_SESSION["message"] = "Password updated";
                 header('location: index.php');
              }else{
                echo "Delete Error: ".mysqli_error($conn);
                exit();
              }

           }else{
             echo "Update Error: ".mysqli_error($conn);
             exit();
           }

      }

    }else{
      echo 'Unable to get Data';
      exit();
    }

  }

}else{
  header("Location: index.php")
}
 ?>
