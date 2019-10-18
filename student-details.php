<?php
 include "header.php";
 //view courses applied.
   $id = $_GET['id'];
    $sql = "SELECT `student`.`studentId`,`student`.`email`,`student`.`timeRegistered`,`student`.`fullName`,`student`.`regNo`,`student`.`phoneNo` FROM `student` WHERE `student`.`studentId`='$id' ORDER BY `student`.`studentId` DESC
";
    $query = mysqli_query($conn, $sql) or die("Error while processing");

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
          <h3 class="box-title">View Student Details</h3>
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
                  <b>Reg No.: </b><?php echo $row_student['regNo'];?><br><br>
                  <b>Student Name: </b><?php echo $row_student['fullName']?><br><br>
                  <b>Phone No. </b><?php echo $row_student['phoneNo'];?><br><br>
                  <b>Email: </b><?php echo $row_student['email']?><br><br>
                  <b>Time Registered: </b><?php echo $row_student['timeRegistered']?><br>
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