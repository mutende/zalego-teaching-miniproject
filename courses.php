<?php
session_start();
 include "header.php";
?>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        courses
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><span class="glyphicon glyphicon-dashboard"></span> Home</a></li>
        <li class="active"><a href="#"><span class="glyphicon glyphicon-folder-close"></span> Courses</a></li>
      </ol>
    </section>

    <!-- Main content -->
<section class="content">
      <!-- Default box -->
      <div class="box">        
          <div class="box-body">
            <div class="container">
              <div class="row">
                <div class="col-md-4 ml-auto">
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                   Add course
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle">Add Course Form</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                                         <!-- form start -->
                          <form role="form" method="post" action="addCourse.php">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="courseName">Name of Course</label>
                                <input type="text" class="form-control" id="courseName" name="name" placeholder="Name of Course" required>
                              </div>
                              <div class="form-group">
                                <label for="courseDuration">Course Duration</label>
                                <input type="number" class="form-control" name="duration" id="courseDuration" placeholder="Duration in Months" required>
                              </div>
                              <div class="form-group">
                                <label for="courseFee">Course Fee</label>
                                <input type="number" class="form-control" id="courseFee" name="fee" placeholder="Ksh." required>
                              </div>                            
                              
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                              <button type="submit" class="btn btn-primary" name="addcourse">Add Course</button>
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Discard</button>
                          <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                        </div>
                      </div>
                    </div>
                  </div>

              <!-- end modal -->
                  
                </div>

              </div>
              <br>
              <div class="row">
                <div class="container">
                  <div class="col-md-8">   

                <?php 
                if(isset($_SESSION['success']) && $_SESSION['success'] != null ){
                  ?>

                  <div class="alert alert-success alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Success!</strong> <?php echo $_SESSION['success'];?>
                </div>
                  <?php  
                    $_SESSION['success'] = null;               

                }

                if(isset($_SESSION['success'])){
                  ?>
                  <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Error!</strong> <?php echo $_SESSION['error'];?>
                  </div>
                  <?php

            $_SESSION['error'] = null;
                  
                }
                ?>
                </div>

                </div>
              </div>

              <!-- course manipulation -->
              <div class="col-md-8">
            <?php
            require_once('conn.php');
            require('manageCourses.php');
            $courses=array();            
            $courses = getCauses($conn);
            $countCourses = count($courses);

           
            if($countCourses > 0){  
            
            ?>
          <h3 class="text-center">Available Courses</h3>
          <table class="table table-sm table-hover">
            <thead class="thead-dark">
              <th>#</th>
              <th>Course Name</th>
              <th>Course Duration</th>
              <th>Course Fee</th>
              <th>Action</th>           
            </thead>
            <tbody>
            <?php
          
          foreach($courses as $course)
          {
        ?>
         <tr>
            <td><?php echo $course['courseId'];?></td>
            <td><?php echo $course['courseName'];?></td>
            <td><?php echo $course['courseDuration'].' month(s)';?></td>
            <td><?php echo $course['courseFee'];?></td>
            
            <td>
              <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#<?php echo $course['courseId'];?>">Update</a>
              <a href="manageCourses.php?id=<?php echo $course['courseId'];?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this record ??')">Delete</a></td>

               <!-- update modal -->
    <div class="modal fade" id="<?php echo $course['courseId'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update Course</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <form action="manageCourses.php" method="POST">
                <div class="form-group">
                  <label for="cid">Id</label>
                  <input type="text" class="form-control" id="cid" name="cid" readonly value="<?php echo $course['courseId'];?>">
                </div>
                <div class="form-group">
                  <label for="Coursename">Course Name</label>
                  <input type="text" class="form-control" id="Coursename" name="name" value="<?php echo $course['courseName'];?>">
                </div>
                <div class="form-group">
                  <label for="duration">Course Duration</label>
                  <input type="text" class="form-control" id="duration" name="duration" value="<?php echo $course['courseDuration'];?>">
                </div>
                <div class="form-group">
                  <label for="courseFee">Course Fee</label>
                  <input type="text" class="form-control" id="courseFee"  name="fee" value="<?php echo $course['courseFee'];?>">
                </div>
                <button type="submit" class="btn btn-default" name="updateCourse">Update</button>
              </form>

              </div>
            </div>
          </div>
        </div>
        
        </tr>
          <?php }?>
            </tbody>
          </table>
          <?php }

           ?>
          </div>
       
    
              <!-- end course manipulation -->

            

            </div>
          </body>
        </div>
    </section>
  <?php
 include "footer.php";
?>