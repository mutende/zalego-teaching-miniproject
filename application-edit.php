<?php
 include "header.php";
 //view courses applied.
   $id = $_GET['id'];
    $sql = "SELECT `courseapplied`.`appliedId`,`courseapplied`.`timeApplied`,`courseapplied`.`status`,`course`.`courseName`,`course`.`courseDuration`,`course`.`courseFee`,`student`.`fullName`,`student`.`regNo`,`student`.`phoneNo` FROM `courseapplied`,`student`,`course` WHERE `student`.`studentId`=`courseapplied`.`studentId` AND `course`.`courseId`=`courseapplied`.`courseId` ORDER BY `courseapplied`.`appliedId` DESC
";
    $query = mysqli_query($conn, $sql) or die("Error while processing");
    //UPDATE application
    if(isset($_POST['update']))
    {
        $courseId = $_POST['courseId'];
        $appliedId = $_POST['appliedId'];
        $sql1 = "UPDATE `courseapplied` SET `courseId`='$courseId' WHERE `appliedId`='$appliedId'";
        $query1 = mysqli_query($conn, $sql1) or die("Error While processing");
        if($query1)
        {
            echo '<script type="text/javascript">
           window.location = "applications.php?msg=Updated Successfully"
      </script>';
        }
    }
// fetch courses
    $sql2 = "SELECT * FROM `course`";
    $query2 = mysqli_query($conn, $sql2) or die("Error while processing");
    
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

    <!-- Main content -->
<section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Student Details</h3>
          </div>
          <div class="box-body">
            <div class="row">
          <div class="col-md-4">
          <a href="applications.php"><button type="button" class="btn btn-default">< Go Back</button></a>
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
                                                <label>Course Name</label>
                  <select name="courseId" class="form-control select2" style="width: 100%;" style="border-radius:0px;">
                  <option selected="selected" value="">-Select Course-</option> 
                  <?php while($row_courses = mysqli_fetch_assoc($query2)) { ?>
                           <option value="<?php $row_courses['courseId']?>"><?php echo $row_courses['courseName'] . " for " . $row_courses['courseDuration']. " months at " .$row_courses['courseFee'] ;?></option>    
               <?php } ?>
             </select>
                  </div>
                  <div class="form-group">
                                                
                  <button type="submit" name="update" onclick="return confirm('Update Application Details?')" class="btn btn-info btn-fill pull-right">Update Application</button>
                  <input type="hidden" value="<?php $row_student['appliedId']?>" name="appliedId">
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