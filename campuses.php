<?php

// session_start();
 include "header.php";
 require_once('conn.php');
 require('manageCourses.php');
 require('manageCampuses.php');
?>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Campuses
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><span class="glyphicon glyphicon-dashboard"></span> Home</a></li>
        <li class="active"><a href="#"><span class="glyphicon glyphicon-folder-close"></span> Campuses</a></li>
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
                   Add campus
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle">Add Campuses</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                                         <!-- form start -->
                          <form role="form" method="post" action="manageCampuses.php">
                            <div class="box-body">
                              <div class="form-group">
                                <label for="campusName">Campus Name</label>
                                <input type="text" class="form-control" id="campusName" name="cname" placeholder="Campus Name" required>
                              </div>
                              <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" class="form-control" name="location" id="location" placeholder="Campus Location" required>
                              </div>
                              <!-- courses-->
                               <div class="form-group">
                                 <label for="courses">Courses</label>
                                 <select class="form-control" id="courses" name="courses">

                                   <?php

                                   $courses=array();
                                   $courses = getCauses($conn);
                                   $countCourses = count($courses);

                                    if( $countCourses == 0){
                                      ?>
                                       <option value="0">--None--</option>
                                      <?php
                                    }else{
                                      foreach($courses as $course)
                                      {
                                      ?>
                                         <option value="<?php echo $course['courseId'];?>"><?php echo $course['courseName'];?></option>
                                      <?php
                                    }
                                  }
                                    ?>


                                 </select>
                               </div>

                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                              <button type="submit" class="btn btn-primary" name="addcampus">Add Campus</button>
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

            $campuses=array();
            $campuses = getCampuses($conn);
            $countCampuses = count($campuses);


            if($countCampuses > 0){

            ?>
          <h3 class="text-center">Available Campuses</h3>
          <table class="table table-sm table-hover">
            <thead class="thead-dark">
              <th>#</th>
              <th>Campus Name</th>
              <th>Campus Location</th>
              <th>Couse Offered</th>
              <th>Action</th>
            </thead>
            <tbody>
            <?php

          foreach($campuses as $campus)
          {
        ?>
         <tr>
            <td><?php echo $campus['id'];?></td>
            <td><?php echo $campus['campus'];?></td>
            <td><?php echo $campus['location'];?></td>
            <td><?php echo getCourseWithId($campus['courses'],$conn);?></td>

            <td>
              <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#<?php echo $campus['id'];?>">Update</a>
              <a href="manageCampuses.php?campus_id=<?php echo $campus['id'];?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this record ??')">Delete</a></td>

               <!-- update modal -->
    <div class="modal fade" id="<?php echo $campus['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update Campus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <form action="manageCampuses.php" method="POST">
                <div class="form-group">
                  <label for="cid">Id</label>
                  <input type="text" class="form-control" id="cid" name="campus_id" readonly value="<?php echo $campus['id'];?>">
                </div>
                <div class="form-group">
                  <label for="campusName">Course Name</label>
                  <input type="text" class="form-control" id="campusName" name="campus_name" value="<?php echo $campus['campus'];?>">
                </div>
                <div class="form-group">
                  <label for="duration">Course Duration</label>
                  <input type="text" class="form-control" id="duration" name="campus_location" value="<?php echo $campus['location'];?>">
                </div>




                <div class="form-group">
                  <label for="courses">Courses</label>
                  <select class="form-control" id="courses" name="courses">

                    <?php

                    $courses2=array();
                    $course2= getCauses($conn);
                    $countCourses2 = count($course2);

                     if( $countCourses2 == 0){
                       ?>
                         <option value="0"><?php echo '--None--';?></option>

                       <?php
                     }else{
                       ?>
                         <option value="<?php echo $campus['courses']?>"><?php echo getCourseWithId($campus['courses'],$conn);?></option>
                         <?php
                       foreach($course2 as $course)
                       {
                       ?>
                          <option value="<?php echo $course['courseId'];?>"><?php echo $course['courseName'];?></option>
                       <?php
                     }
                   }
                     ?>


                  </select>
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
        <?php }else{

          ?>

        <h1 class="text-warning text-center">No Campuses Set</h1>

          <?php
        }

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
