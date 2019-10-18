<?php
 include "header.php";
 //view courses applied.
   $id = $_GET['id'];
    $sql = "SELECT `student`.`studentId`,`student`.`email`,`student`.`timeRegistered`,`student`.`fullName`,`student`.`regNo`,`student`.`phoneNo` FROM `student` WHERE `student`.`studentId`='$id' ORDER BY `student`.`studentId` DESC
";
    $query = mysqli_query($conn, $sql) or die("Error while processing");
    //UPDATE
    if(isset($_POST['update']))
    {
        $studentId= $_POST['studentId'];
        $regNo = $_POST['regNo'];
        $email = $_POST['email'];
        $fullName = $_POST['fullName'];
        $phoneNo = $_POST['phoneNo'];
        $sql1 = "UPDATE `student` SET `fullName`='$fullName',`regNo`='$regNo',`phoneNo`='$phoneNo',`email`='$email' WHERE `studentId`='$studentId'";
        $query1 = mysqli_query($conn, $sql1) or die("Error While processing");
        if($query1)
        {
            echo '<script type="text/javascript">
           window.location = "students.php?msg=Updated Successfully"
      </script>';
        }
    }

?>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Students
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Student Details</li>
      </ol>
    </section>

    <!-- the Main content -->
<section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Student Details</h3>
          </div>
          <div class="box-body">
            <div class="row">
          <div class="col-md-4">
          <a href="students.php"><button type="button" class="btn btn-default">< Go Back</button></a>
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
                 
               <?php $row_student = mysqli_fetch_assoc($query); { ?>
              <form action="" method="post">
                                    <div class="form-group">
                                                <label>RegNo</label>
                  <input type="text" name="regNo" class="form-control" placeholder="Registration Number" value="<?php echo $row_student['regNo'];?>">
                  </div>
                  <div class="form-group">
                                                <label>Full Name</label>
                  <input type="text" name="fullName" class="form-control" placeholder="Registration Number" value="<?php echo $row_student['fullName']?>">
                  </div>
                 <div class="form-group">
                                                <label>Phone Number</label>
                  <input type="text" name="phoneNo" class="form-control" placeholder="Phone Number" value="<?php echo $row_student['phoneNo'];?>">
                  </div>
                  <div class="form-group">
                                                <label>Email</label>
                  <input type="email" name="email" class="form-control" placeholder="Email Address" value="<?php ECHO $row_student['email']?>">
                  </div>
                  <button type="submit" name="update" onclick="return confirm('Update Student Details?')" class="btn btn-info btn-fill pull-right">Update Student</button>
                  <input type="hidden" value="<?php $row_student['studentId']?>" name="studentId">
                  <div class="clearfix"></div>
                  </form>
               <?php } ?>
               </div>
               </div>
               </div>
           </div>
          </body>
        </div>
    </section>
  <?php
 include "footer.php";
?>