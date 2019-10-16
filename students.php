<?php
 include "header.php";
 //view courses applied
    $sql = "SELECT `student`.`studentId`,`student`.`timeRegistered`,`student`.`fullName`,`student`.`regNo`,`student`.`phoneNo` FROM `student` ORDER BY `student`.`studentId` DESC
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