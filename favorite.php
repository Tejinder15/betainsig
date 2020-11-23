<?php
require "config/config.php";

$myid = $_GET['id'];

//Fetching  Everything(likers_id,likers_profile_photo,likers_username,post_liked_photo) For notifications
$my_post_query = mysqli_query($con,"SELECT * from likes where `Post_of`='$myid'");
$likers_profile = array();  //For getting the liker's profile
$likers_name = array();     //For getting the liker's name
$post_liked = array();     //For getting the post which is lifed
while ($f = mysqli_fetch_assoc($my_post_query)) {
        $likers_profile[] = $f['user_id'];
        $likers_name[] = $f['Id'];
        // $post_liked[] = $f[''];
        // $likers_profile[] = $f['profile_pic'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insignia</title>
</head>
<body>
  <?php
  print_r($likers_name);
   ?>
</body>
</html>
