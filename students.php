<?php
 include "header.php";
 //view courses applied
    $sql = "SELECT `student`.`studentId`,`student`.`timeRegistered`,`student`.`fullName`,`student`.`regNo`,`student`.`phoneNo` FROM `student` ORDER BY `student`.`studentId` DESC
";
    $query = mysqli_query($conn, $sql) or die("Error while processing");
    
    //delete dets
    if(isset($_GET['id']))
    {
      $sid = $_GET['id'];
      $sql1 = "DELETE FROM student WHERE studentId='$sid'";
      $query1 = mysqli_query($conn,$sql1) or die("Error while processing!");
      if($query1)
      {
      echo '<script type="text/javascript">
           window.location = "students.php?msg=Deleted Successfully"
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
        <li class="active">Students</li>
      </ol>
    </section>

    <!-- Main content -->
<section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Registered Students</h3>
          </div>
          <div class="box-body table-responsive">
          <?php if(isset($_GET['msg']))
          {
            $msg = $_GET['msg'];
            echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <p>'.$msg.'</p>
                </div>';
          }
          ?>
            <table class="table table-hover table-bordered table-striped no-padding" id="myTable">
                <thead><tr>
                  <th>ID</th>
                  <th>Reg No.</th>
                  <th>Student Name</th>
                  <th>Phone No.</th>
                  <th>Time Registered</th>
                  <th>Action</th>
                </tr>
                </thead><?php while($row_applic = mysqli_fetch_assoc($query)) { ?>
                <tr>
                  <td><?php echo $row_applic['studentId'];?></td>
                  <td><?php echo $row_applic['regNo'];?></td>
                  <td><?php echo $row_applic['fullName']?></td>
                  <td><?php echo $row_applic['phoneNo'];?></td>
                  <td><?php echo $row_applic['timeRegistered']?></td>
                  <td> 
                  <a href="student-details.php?id=<?php echo $row_applic['studentId'];?>"><button type="submit" name="view" class="btn btn-success">View</button></a>
                  <a href="student-edit.php?id=<?php echo $row_applic['studentId'];?>"><button type="submit" name="edit" class="btn btn-warning">Edit</button> </a>
                  <a href="students.php?id=<?php echo $row_applic['studentId'];?>"><button type="submit" name="edit" class="btn btn-danger">Delete</button> </a>
                 
                 </td>
                </tr>
               <?php } ?>
              </tbody></table>
          </body>
        </div>
    </section>
  <?php
 include "footer.php";
?>