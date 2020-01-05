<?php
if(isset($_POST['email']) === true && empty($_POST['email']) === false){

	 $con = mysqli_connect('localhost','root','','db_project');
	 if(mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_errno();
	}
	$sql =  mysqli_query($con,"SELECT * 
			FROM customer 
			WHERE Email = '".mysqli_real_escape_string($con,trim($_POST['email']))."'
			");

	if($row = mysqli_fetch_array($sql)){
		echo "This email was registered.";
	}else echo "You can use this email.";

	mysqli_close($con);
}
?>