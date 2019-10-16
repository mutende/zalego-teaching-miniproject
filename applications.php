<?php
 include "header.php";
 //view courses applied
    $sql = "SELECT `courseapplied`.`appliedId`,`courseapplied`.`timeApplied`,`courseapplied`.`status`,`course`.`courseName`,`course`.`courseDuration`,`course`.`courseFee`,`student`.`fullName`,`student`.`regNo`,`student`.`phoneNo` FROM `courseapplied`,`student`,`course` WHERE `student`.`studentId`=`courseapplied`.`studentId` AND `course`.`courseId`=`courseapplied`.`courseId` ORDER BY `courseapplied`.`appliedId` DESC
";
    $query = mysqli_query($conn, $sql) or die("Error while processing");
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
          <h3 class="box-title">Applications</h3>
          </div>
          <div class="box-body table-responsive">
            <table class="table table-hover table-bordered table-striped no-padding" id="myTable">
                <thead><tr>
                  <th>ID</th>
                  <th>Course Name</th>
                  <th>Reg No.</th>
                  <th>Student Name</th>
                  <th>Phone No.</th>
                  <th>Time Applied</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead><?php while($row_applic = mysqli_fetch_assoc($query)) { ?>
                <tr>
                  <td><?php echo $row_applic['appliedId'];?></td>
                  <td><?php echo $row_applic['courseName'];?></td>
                  <td><?php echo $row_applic['regNo'];?></td>
                  <td><?php echo $row_applic['phoneNo'];?></td>
                  <td><?php echo $row_applic['fullName']?></td>
                  <td><?php echo $row_applic['timeApplied']?></td>
                  <td><?php echo $row_applic['status'];?></td>
                  <td> 
                  <input type="hidden" name="cuid" value=">">
                  <button type="submit" name="rej" class="btn btn-success">View</button>
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