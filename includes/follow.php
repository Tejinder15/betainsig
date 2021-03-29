<?php
$con = mysqli_connect("localhost","root","","social");
if (mysqli_connect_errno()) {
	echo "Failed to connect:". mysqli_connect_errno();
}

$follower = $_POST['fo'];
$user = $_POST['uid'];
$check_query = mysqli_query($con,"SELECT * from followers Where `follower_id`='$user' AND `user_id`='$follower'");
$check_result = mysqli_num_rows($check_query);
if($check_result==0){
    $follow_query = mysqli_query($con,"INSERT INTO followers(`user_id`,`follower_id`,`follower_id2`,`status`) VALUES('$follower','$user','$user',1)");
    if($follow_query){
        echo 1;
    }
    else{
        echo 0;
    }
}else{
    echo 2;
}

?>