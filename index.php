<?php
 include "header.php";
 //dashboard details count rows
 //students
 $sql = "SELECT count(`student`.`studentId`) AS students,`student`.`timeRegistered`,`student`.`fullName`,`student`.`regNo`,`student`.`phoneNo` FROM `student` ORDER BY `student`.`studentId` DESC
";
    $query = mysqli_query($conn, $sql) or die("Error while processing");
    $count_students = mysqli_fetch_assoc($query);
//courses
$sql1 = "SELECT count(`course`.`courseId`) AS courses FROM `course`";
    $query1 = mysqli_query($conn, $sql1) or die("Error while processing");
    $count_courses = mysqli_fetch_assoc($query1);
    //applications
    $sql2 = "SELECT COUNT(`courseapplied`.`appliedId`) AS applications,`courseapplied`.`timeApplied`,`courseapplied`.`status`,`course`.`courseName`,`course`.`courseDuration`,`course`.`courseFee`,`student`.`fullName`,`student`.`regNo`,`student`.`phoneNo` FROM `courseapplied`,`student`,`course` WHERE `student`.`studentId`=`courseapplied`.`studentId` AND `course`.`courseId`=`courseapplied`.`courseId` ORDER BY `courseapplied`.`appliedId` DESC
";
    $query2 = mysqli_query($conn, $sql2) or die("Error while processing");
    $count_applics = mysqli_fetch_assoc($query2);
?>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li class="active"><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        
      </ol>
    </section>

    <!-- Main content -->
<section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Dashboard</h3>
          </div>
          <div class="box-body">
          <div class="row">
            <div class="col-md-4">
            <!--infobox-->
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-envelope-o"></i></span>

                <div class="info-box-content">
                <span class="info-box-text">Courses</span>
              <span class="info-box-number"><?php echo $count_courses['courses'];?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!--infobox-->
          </div>
           <div class="col-md-4">
          <!--infobox-->
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-envelope-o"></i></span>

                <div class="info-box-content">
                <span class="info-box-text">Students</span>
              <span class="info-box-number"><?php echo $count_students['students'];?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!--infobox-->
        </div>
        <div class="col-md-4">
          <!--infobox-->
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-envelope-o"></i></span>

                <div class="info-box-content">
                <span class="info-box-text">Applications</span>
              <span class="info-box-number"><?php echo $count_applics['applications'];?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!--infobox-->
        </div>
          </div>
          </body>
        </div>
    </section>
    <!--end sect-->
  <?php
 include "footer.php";
?>