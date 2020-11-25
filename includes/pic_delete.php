<?php
include "config/config.php";

$pic_id = $_POST["id"];
$all_query = mysqli_query($con,"SELECT * from `posts` WHERE `id`='$pic_id'");
$username = array();
$userid = array();
$pos_id = array();
$pos_name = array();
if(mysqli_num_rows($all_query)>0){
while ($f = mysqli_fetch_assoc($all_query)) {
    $pos_path = $f["post_path"];
    $userid[] = $f["user_id"];
    $pos_id[] = $f["id"];
    $pos_name[] = $f["post_name"];
}
}
$direct = .$pos_name;
$del_query = mysqli_query($con,"DELETE from `posts` where `id`='$pic_id'");
$update_total_post = mysqli_query($con,"UPDATE `users` set `num_posts`=`num_posts`-1 where `Id`='$userid'");
unlink($direct);
if($del_query && $update_total_post){
  echo 1;
}
else {
  echo 0;
}
 ?>
