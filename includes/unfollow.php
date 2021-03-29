<?php
$con = mysqli_connect("localhost","root","","social");
if (mysqli_connect_errno()) {
	echo "Failed to connect:". mysqli_connect_errno();
}
$follow_id = $_POST['id'];
$unfollow_query = mysqli_query($con,"DELETE from `followers` where `id`='$follow_id'");
if($unfollow_query){
  echo 1;
}
else{
  echo 0;
}
 ?>
