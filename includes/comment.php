<?php
$con = mysqli_connect("localhost","root","","social");
if (mysqli_connect_errno()) {
	echo "Failed to connect:". mysqli_connect_errno();
}
$pic_id = $_POST['com'];
$commenter = $_POST['commenter'];
$userid = $_POST['userid'];
$commentval = $_POST['coment'];

$inser_comment = mysqli_query($con,"INSERT INTO comments(`commenters_id`,`post_id`,`comment`) Values('$commenter','$pic_id','$commentval') ");

if($inser_comment){
    echo 1;
}else{
    echo 0;
}
?>