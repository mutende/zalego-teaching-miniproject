<?php
 include "header.php";
 //view courses applied.
    $sql = "SELECT `courseapplied`.`appliedId`,`courseapplied`.`timeApplied`,`courseapplied`.`status`,`course`.`courseName`,`course`.`courseDuration`,`course`.`courseFee`,`student`.`fullName`,`student`.`regNo`,`student`.`phoneNo` FROM `courseapplied`,`student`,`course` WHERE `student`.`studentId`=`courseapplied`.`studentId` AND `course`.`courseId`=`courseapplied`.`courseId` ORDER BY `courseapplied`.`appliedId` DESC
";
    $query = mysqli_query($conn, $sql) or die("Error while processing");
    //delete application
    if(isset($_GET['id']))
    {
      $sid = $_GET['id'];
      $sql1 = "DELETE FROM courseapplied WHERE appliedId='$sid'";
      $query1 = mysqli_query($conn,$sql1) or die("Error while processing!");
      if($query1)
      {
      echo '<script type="text/javascript">
           window.location = "applications.php?msg=Cancelled Successfully"
      </script>';
      }
    }
?>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Applications
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Applications</li>
      </ol>
    </section>

    <!-- Main content -->
<section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Course Applications</h3>
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
            <table class="table table-hover table-bordered table-striped no-padding table-sm" id="myTable">
                <thead><tr>
                  <th>ID</th>
                  <th>Course Name</th>
                  <th>Reg No.</th>
                  <th>Student Name</th>
                  <th>Phone No.</th>
                  <th>Time Applied</th>
                  <th>Active</th>
                  <th>Action</th>
                </tr>
                </thead><?php while($row_applic = mysqli_fetch_assoc($query)) { ?>
                <tr>
                  <td><?php echo $row_applic['appliedId'];?></td>
                  <td><?php echo $row_applic['courseName'];?></td>
                  <td><?php echo $row_applic['regNo'];?></td>
                  <td><?php echo $row_applic['fullName']?></td>
                  <td><?php echo $row_applic['phoneNo'];?></td>
                  <td><?php echo $row_applic['timeApplied']?></td>
                  <td><?php
                  $active = $row_applic['status'];
                  if(  $active == True ){
                    ?>
                    <span class="text-success">Yes</span>
                    <!-- <i class="fa fa-check" aria-hidden="true"></i> -->
                    <?php
                  }else{

                    ?>
                      <span class="text-danger">No</span>

                    <?php
                  }
                  ?></td>
                  <td>
                  <a href="application-details.php?id=<?php echo $row_applic['appliedId'];?>"><button type="submit" name="view" class="btn btn-success">View</button></a>
                  <a href="application-edit.php?id=<?php echo $row_applic['appliedId'];?>"><button type="submit" name="edit" class="btn btn-warning">Edit</button> </a>
                  <a href="applications.php?id=<?php echo $row_applic['appliedId'];?>"><button type="submit" onclick="return confirm('Cancel Application?')" name="edit" class="btn btn-danger">Cancel</button> </a>
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
