<?php

require_once('conn.php');
// get students
function getCampuses($conn){
    $query="SELECT * FROM campuses ORDER BY id DESC";
    $result = mysqli_query($conn, $query);
    $rows=mysqli_num_rows($result);
    if ($rows>0) {
        while($row = mysqli_fetch_assoc($result))
        {
            $campuses[]=$row;
        }
    }else{
        $campuses = array();
    }
    return $campuses;
    }


function deleteCampus($id, $conn){
  session_start();
    $delete = "DELETE FROM campuses WHERE `id` = '$id' ";
    if (mysqli_query($conn, $delete)) {
	    $_SESSION["success"] = "Campus deleted";
	    header('location: campuses.php');
	} else {

		$_SESSION["error"] = "Unable to delete Campus";
		header('location: campuses.php');
        // echo mysqli_error($conn);
	}

	mysqli_close($conn);
}


function updateCampus($id,$name,$location,$causes,$conn){
  session_start();
    $update = "UPDATE campuses SET 	campus='$name',location='$location', courses='$causes' WHERE id='$id'";

    $execute = mysqli_query($conn, $update);
    if ($execute ) {
	    $_SESSION["success"] = "Campus updated";
	    header('location: campuses.php');
	} else {

		$_SESSION["error"] = "Unable to update course";
		header('location: campuses.php');
    // echo mysqli_error($conn);
	}

	mysqli_close($conn);
}

// update
if(isset($_POST['updateCourse'])){
	$cid = $_POST['campus_id'];
	$cname = $_POST['campus_name'];
	$location = $_POST['campus_location'];
	$course = $_POST['courses'];
	updateCampus($cid,$cname,$location,$course,$conn);
}
// delete
if(isset($_GET['campus_id'])){
	$id = $_GET['campus_id'];

 deleteCampus($id, $conn);
}




// add
if(isset($_POST['addcampus'])){
  session_start();
	$name = $_POST['cname'];
	$location = $_POST['location'];
	$courses = $_POST['courses'];

	require_once('conn.php');
	$query = "INSERT INTO `campuses`(campus,location,courses) VALUES ('$name','$location','$courses')";
	$execute = mysqli_query($conn, $query);

	if ($execute) {
	    $_SESSION["success"] = "Campus Added successfully";
	    header('location: campuses.php');
	} else {

		$_SESSION["error"] = "Error occured";
		 header('location: campuses.php');
    // echo 	$_SESSION["error"].' '.mysqli_error($conn);
	}

	mysqli_close($conn);
}

function getCourseWithId($id,$conn){

$query = "SELECT * FROM course WHERE `courseId` = $id ";
$result = mysqli_query($conn, $query);
$course = mysqli_fetch_assoc($result);

return $course['courseName'];
}
?>
