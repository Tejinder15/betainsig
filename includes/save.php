<?php
$con = mysqli_connect("localhost","root","","social");
if (mysqli_connect_errno()) {
	echo "Failed to connect:". mysqli_connect_errno();
}

$pic_id = $_POST['sv'];
$who_saved = $_POST['saver'];

$inser_comment = mysqli_query($con,"INSERT INTO saved(`pic_id`,`user_id`) Values('$pic_id','$who_saved') ");

if($inser_comment){
    echo 1;
}else{
    echo 0;
}
?>