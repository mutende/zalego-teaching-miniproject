<?php
if(!isset($_GET['id'])){
  header('Location: index.php');
}else{

 include "header.php";

 require_once('conn.php');

 $user_id = $_GET['id'];

 $sql = "SELECT * FROM `user` where `userName` = '$user_id'";
 $results = mysqli_query($conn, $sql);
 $row = mysqli_fetch_assoc($results);


if(isset($_POST['update'])){
  $user = $_POST['username'];
  $email = $_POST['email'];

  $update_query  = "UPDATE user SET `email` = '$email' WHERE `userName` = '$user'";
  if(mysqli_query($conn, $update_query )){

       echo '<script> alert(\'Profile updated.\')</script>';
       echo '<script> window.open(\'profile.php\',\'_self\')</script>';
  }
}

?>
<!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Profile
          <small>My Profile</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="#">Profile</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">

        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">My Details</h3>
          </div>
          <div class="container-fluid">

          <div class="row">
          <div class="col-md-4">
                        <div class="card card-user">

                            <div class="content">
                                <div class="author">
                                     <a href="#">
                                    <img class="avatar border-gray" src="dist/img/face-0.jpg" alt="..."/>

                                      <h4 class="title"><br /><br />
                                         <small></small>
                                         <h3></h3>
                                      </h4>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">

                            <div class="content">
                                <form name="f1" action="" method="post">

                                  <div class="row">
                                      <div class="col-md-12">
                                          <div class="form-group">
                                              <label>Username </label>
                                              <input type="text" class="form-control"  name="username" value="<?php echo $row['userName']; ?>" readonly>
                                          </div>
                                      </div>
                                  </div>

                                          <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" name="email" class="form-control" placeholder="Email Address" value="<?php echo $row['email'];?>">
                                            </div>

                                    <!-- <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Sur Name</label>
                                                <input type="text" name="surname" class="form-control" placeholder="Sur Name" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Other Name</label>
                                                <input type="text" class="form-control" name="othername" placeholder="Other Name" value="">
                                            </div>
                                        </div>
                                    </div> -->



                                    <!-- <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Status.</label>
                                                <input type="text" class="form-control" placeholder="User Type." value="" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>ID No.</label>
                                                <input type="number" class="form-control" name="idno" placeholder="ID No." value="">
                                            </div>
                                        </div>
                                        </div> -->
                                        <div class="row">
                                          <div class="col-md-8">
                                              <button class="btn btn-primary btn-sm" name="update">Update Profile</button>
                                              <a href="change_pass.php">Change Password</a>
                                          </div>
                                        </div>
                                        <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
	</div>
        <!-- /.box -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->

<!-- ./wrapper -->
<?php
 include "footer.php";
}?>
