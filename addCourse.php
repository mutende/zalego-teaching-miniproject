<?php
session_start();
if(isset($_POST['addcourse'])){
	$name = $_POST['name'];
	$duration = $_POST['duration'];
	$fee = $_POST['fee'];
	
	require_once('conn.php');
	$query = "INSERT INTO `course`(courseName,courseDuration,courseFee) VALUES ('$name','$duration','$fee')";
	$execute = mysqli_query($conn, $query);

	if ($execute) {
	    $_SESSION["success"] = "Course Added successfully";
	    header('location: courses.php');
	} else {

		$_SESSION["error"] = "Error occured";
		header('location: courses.php');		
	}

	mysqli_close($conn);
}
?>