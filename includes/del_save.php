<?php
$con = mysqli_connect("localhost","root","","social");
if (mysqli_connect_errno()) {
	echo "Failed to connect:". mysqli_connect_errno();
}

$post_id = $_POST['pid'];
$us_id = $_POST['per'];

$del_query = mysqli_query($con,"DELETE FROM `saved` where `user_id`='$us_id' AND `pic_id`='$post_id'");
if($del_query){
    echo 1;
}else{
    echo 0;
}
?>