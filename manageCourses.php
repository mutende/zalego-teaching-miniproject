<?php

session_start();
require_once('conn.php');
// get students
function getCauses($conn){
    $query="SELECT * FROM course ORDER BY courseId DESC";
    $result = mysqli_query($conn, $query);
    $rows=mysqli_num_rows($result);
    if ($rows>0) {
        while($row = mysqli_fetch_assoc($result))
        {
            $courses[]=$row;
        }
    }else{
        $courses = array();
    }
    return $courses;
    }


function deleteCause($id, $conn){
    $delete = "DELETE FROM course WHERE courseId ='$id'";
    if (mysqli_query($conn, $delete)) {
	    $_SESSION["success"] = "Course deleted";
	    header('location: courses.php');
	} else {

		$_SESSION["error"] = "Unable to delete course";
		header('location: courses.php');		
	}

	mysqli_close($conn);
}


function updateCause($id,$name,$duration,$fee,$conn){
    $update = "UPDATE course SET courseName='$name',courseDuration='$duration', courseFee='$fee' WHERE courseId='$id'";

    $execute = mysqli_query($conn, $update);
    if ($execute ) {
	    $_SESSION["success"] = "Course updated";
	    header('location: courses.php');
	} else {

		$_SESSION["error"] = "Unable to update course";
		header('location: courses.php');		
	}

	mysqli_close($conn);
}

if(isset($_POST['updateCourse'])){
	$id = $_POST['cid'];
	$name = $_POST['name'];
	$duration = $_POST['duration'];
	$fee = $_POST['fee'];
	updateCause($id,$name,$duration,$fee,$conn);
}

if(isset($_GET['id'])){
	$id = $_GET['id'];

 deleteCause($id, $conn);
}

?>