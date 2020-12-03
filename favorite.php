<?php
require "config/config.php";

$myid = $_GET['id'];

//Fetching  Everything(likers_id,likers_profile_photo,likers_username,post_liked_photo) For notifications
$my_post_query = mysqli_query($con,"SELECT likes.`likers_id`,users.* from `likes` JOIN `users` ON likes.`likers_id`= users.`Id` where `user_id` = '$myid'");
$likers_profile = array();  //For getting the liker's profile
$likers_name = array();  //For getting the Liker's name
$likers_id = array();     //For getting the liker's name
$post_liked = array();     //For getting the post which is lifed
while ($f = mysqli_fetch_assoc($my_post_query)) {
        $likers_id[] = $f['Id'];
        $likers_profile[] = $f['profile_pic'];
        $likers_name[] = $f['Username'];
}

$post_result = mysqli_query($con,"SELECT likes.`Id`,posts.* from `likes`")
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/fav.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insignia</title>
</head>
<body>
   <div class="main">
     <?php
     if(isset($likers_profile)){
       $notifications = count($likers_profile);
       $a = 0;
       $c = 0;
           for ($i=0; $i<$notifications; $i++) {
               $a++;
               ?>
               <div class="notifications">
                 <div class="likers-profile">
                   <div class="profile">
                     <img src="<?php echo $likers_profile[$c]; ?>" alt="">
                   </div>
                 </div>
                 <div class="likers-username">
                   <span><b><?php echo $likers_name[$c];?></b> liked your Post.</span>
                 </div>
                 <div class="post-liked">
                   <img src="<?php echo $liked_post[$c];?>" alt="">
                 </div>
               </div>
               <hr>
               <?php
               $c++;
     }
   }
      ?>
   </div>
</body>
</html>
