<?php
$con = mysqli_connect("localhost","root","","social");
if (mysqli_connect_errno()) {
	echo "Failed to connect:". mysqli_connect_errno();
}
$poid = $_POST['id'];
$myid = $_POST['likerid'];
$userid = $_POST['userid'];
  $like_check = mysqli_query($con,"SELECT * from `likes` where `Id`='$poid' AND `likers_id`='$myid'");
  // $like_check_result = mysqli_num_rows($like_check);
  // $like_check_result = mysqli_fetch_assoc($like_check);
  if(mysqli_num_rows($like_check) >=1){
     echo 0;
  }
  else {
    $pos_like = mysqli_query($con,"INSERT INTO likes(`Id`,`likers_id`,`user_id`,`likes`) Values('$poid','$myid','$userid',1)");
    $update_likes = mysqli_query($con,"UPDATE posts set `likes`=`likes`+1 where `id`='$poid'");
    if($pos_like && $update_likes){
      echo 1;
    }
    else{
      echo 0;
    }
    echo 1;
  }
?>
