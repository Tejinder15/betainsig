<?php

require "config/config.php";

$mid = $_GET['id'];

$error = array(); // For Holding error messages

// Getting Username from users table
$get_name = mysqli_query($con,"SELECT `Username` from users where `Id`=$mid");
$name_res = mysqli_fetch_array($get_name);
$myname = $name_res['Username'];

// echo $myname;

// For Fetching Profile Photo of the User
$prof_direct = "profiles"."/".$myname."."."*"; // Profile Directory;
$openimages = glob($prof_direct);

$dp = array();
foreach($openimages as $image) {
    $dp = $image;
}

// For Retrieving Images from mysql Table
$direct = "users_data"."/".$myname."/";
$post_dis = mysqli_query($con,"SELECT * from `posts` where `user_id` = '$mid'");
$pic_id = array();
$allfile = array();
$pic_cap = array();
while ($f = mysqli_fetch_array($post_dis)) {
    if ($f!='..' && $f!='.') {
        $allfile[] = $f['post_name'];
        $pic_id[] = $f['id'];
        $pic_cap[] = $f['post_caption'];
    }
}

// For Deleting the post from the user data and table
if(isset($_POST['del'])){
    $pid = $_POST['post_id'];
    $pname = $_POST['post_name'];
    $post_del = $direct.$pname;
    $del_query = mysqli_query($con,"DELETE from `posts` where `id`='$pid'");
    $update_total_post = mysqli_query($con,"UPDATE users set `num_posts`=`num_posts`-1 where `Id`='$mid'");
    unlink($direct.$pname);
    header("Location:pictures.php?id={$mid}");
 }
 else{
     echo "";
 }

 // For Liking POST
//  if (isset($_POST['like'])) {
//    $poid = $_POST['post_like_id'];
//      $like_check = mysqli_query($con,"SELECT `User_id` from `likes` where `Id`='$poid'");
//      $like_check_result = mysqli_num_rows($like_check);
//      if($like_check_result == 1){
//         echo "Already Liked the Post";
//      }
//      else {
//        $pos_like = mysqli_query($con,"INSERT INTO likes(`Id`,`User_id`,`likes`) Values('$poid','$mid',1)");
//        $update_likes = mysqli_query($con,"UPDATE posts set `likes`=`likes`+1 where `id`='$poid'");
//        if($pos_like && $update_likes){
//          echo "You Liked the Post";
//        }
//        else{
//          echo "Could not Like the Photo";
//        }
//      }
// }
//  else{
//    echo "";
//  }

// For Checking the status of the Post
// if(isset($_POST['stat'])){
//   $pic = $_POST['post_id'];
//   $status_query = mysqli_query($con,"SELECT `likes` from posts where `id`='$pic'");
//   $status_result = mysqli_fetch_assoc($status_query);
//   $num_of_likes = $status_result['likes'];
//   echo"<script>
//   alert('You have $num_of_likes Likes on this post!');
//   </script>";
// }
// else{
//   echo "";
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insignia</title>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="vendors/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/pictures.css">
</head>
<body>
    <nav>
        <div class="logo">
            <h1>Posts</h1>
        </div>
    </nav>
    <div class="main">
                <?php
            if(isset($allfile)){
                $totalimages = count($allfile);
                $a = 0;
                $c = 0;
                    for ($i=0; $i<$totalimages; $i++) {
                        $a++;
                        ?>
                        <div class="post-container">
                          <!-- For Displaying Username and Profile -->
                            <div class="post-header">
                                <div class="post-user">
                                    <div class="post-profile">
                                        <img src="<?php if(isset($dp))echo $dp;?>" alt="">
                                    </div>
                                    <div class="post-username">
                                      <label for="" class="person"><?php echo $myname;?></label>
                                    </div>
                                  </div>
                                    <!-- For Post Options -->
                                    <div class="post-options">
                                        <div class="dropbtn"><i class="op ion-android-more-vertical"></i></div>
                                        <div class="dropdown-content">
                                            <form action="" method="POST">
                                                <input type="hidden" value="<?php echo $pic_id[$c]; //This Fetches Image id from Table?>" name="post_id">
                                                <input type="hidden" value="<?php echo $allfile[$c]; //This Fetches Image id from Table?>" name="post_name">
                                                <!-- <input type="submit" value="Status" name="stat"> -->
                                                <!-- <input type="submit" value="Delete" name="del"> -->
                                                <button type="button" name="button" class="stbtn" data-st="<?php echo $pic_id[$c]; ?>"><i class="ion-stats-bars"></i> Status</button>
                                                <button type="submit" name="del" data-id="<?php echo $pic_id[$c];?>" name="del"><i class="ion-trash-b"></i> Delete</button>
                                            </form>
                                        </div>
                                    </div>
                              </div>
                                <!-- Post Photo -->
                                <div class="post-photo">
                                  <form action="" method="POST">
                                    <img src="<?php echo $direct.$allfile[$c]; //This Fetches the image name from table?>" value="<?php echo $direct.$allfile[$c];?>" name="delete_file">
                                  </form>
                                </div>
                                <!-- Post Sharing And Like Options -->
                                <div class="post-footer">
                                   <div class="post-actions">
                                       <div class="post-like">
                                         <form action="" method="POST">
                                           <input type="hidden" value="<?php echo $pic_id[$c]; //This Fetches Image id from Table?>" name="post_like_id">
                                           <button name="like" class="like">
                                             <i class="dill ion-android-favorite"></i>
                                           </button>
                                         </form>
                                       </div>
                                       <div class="post-comment">
                                         <form action="" method="POST">
                                           <button  name="comment" class="comment">
                                             <i class="ion-chatbox-working"></i>
                                           </button>
                                         </form>
                                       </div>
                                       <div class="post-share">
                                         <form action="" method="POST">
                                           <button name="messg" class="messag">
                                             <i class="ion-paper-airplane"></i>
                                           </button>
                                         </form>
                                       </div>
                                   </div>
                               </div>
                               <div class="post-caption">
                                 <b><span class="caption"><?php echo $myname; ?></span></b>
                                 <span><?php echo $pic_cap[$c];?></span>
                               </div>
                           </div>
                        <?php
                        $c++;
                    }
                }
            ?>
    </div>
    <script type="text/javascript" src="assets/js/jquery.js"></script>
    <script src="assets/js/Pictures.js">
    // $(document).ready(function(){
    //   $(document).on("click",".delbtn", function(){
    //     alert("Hello World");
    //   });
    // });
    </script>
</body>
</html>
