<?php
$con = mysqli_connect("localhost","root","","social");
if (mysqli_connect_errno()) {
	echo "Failed to connect:". mysqli_connect_errno();
}
$postid = $_POST['id'];
  $delete_from_post = mysqli_query($con,"DELETE from posts where `id`='$postid'");
  if($delete_from_post){
   echo 1;
  }
  else{
    echo 0;
  }
?>