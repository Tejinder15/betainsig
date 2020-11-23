<?php

require "config/config.php";

$myid = $_GET['id'];
$userid = $_SESSION['uid'];

$error = array(); // For Holding error messages

// Getting Username from users table
$get_name = mysqli_query($con,"SELECT `Username` from users where `Id`=$userid");
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
$post_dis = mysqli_query($con,"SELECT * from `posts` where `user_id` = '$userid'");
$pic_id = array();
$allfile = array();
while ($f = mysqli_fetch_array($post_dis)) {
    if ($f!='..' && $f!='.') {
        $allfile[] = $f['post_name'];
        $pic_id[] = $f['id'];
    }
}

// For Liking the Post of the User
if (isset($_POST['like'])) {
  $poid = $_POST['post_like_id'];
    $like_check = mysqli_query($con,"SELECT * from `likes` where `Id`='$poid' AND `user_id`='$myid'");
    $like_check_result = mysqli_num_rows($like_check);
    // $like_check_result = mysqli_fetch_assoc($like_check);
    if($like_check_result >=1){
       // echo "Already Liked the Post";
       echo "<script>
       alert('Already Liked the Post');
       </script>";
    }
    else {
      $pos_like = mysqli_query($con,"INSERT INTO likes(`Id`,`user_id`,`Post_of`,`likes`) Values('$poid','$myid','$userid',1)");
      $update_likes = mysqli_query($con,"UPDATE posts set `likes`=`likes`+1 where `id`='$poid'");
      if($pos_like && $update_likes){
        echo "<script>
        alert('You Liked the Post');
        </script>";
      }
      else{
        echo "<script>
        alert('Could not Like the Photo')
        </script>";
      }
    }
}
else{
  echo "";
}

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
                                      <label for=""><?php echo $pic_id[$c]; ?></label>
                                    </div>
                                  </div>
                                    <!-- For Post Options -->
                                    <!-- Follower cannnot Delete the photo of the user -->
                              </div>
                                <!-- Post Photo -->
                                <div class="post-photo">
                                  <form action="" method="POST">
                                    <img src="<?php echo $direct.$allfile[$c]; //This Fetches the image name from table?>" width="100%" height="550" value="<?php echo $direct.$allfile[$c];?>"/>
                                  </form>
                                </div>
                                <!-- Post Sharing And Like Options -->
                                <div class="post-footer">
                                   <div class="post-actions">
                                       <div class="post-like">
                                         <form action="" method="POST">
                                           <input type="hidden" value="<?php echo $pic_id[$c]; //This Fetches Image id from Table?>" name="post_like_id">
                                           <button type="submit" name="like">
                                             <i class="dill ion-android-favorite"></i>
                                           </button>
                                         </form>
                                       </div>
                                       <div class="post-comment">
                                         <form action="" method="POST">
                                           <button type="submit" name="comment">
                                             <i class="ion-chatbox-working"></i>
                                           </button>
                                         </form>
                                       </div>
                                       <div class="post-share">
                                         <form action="" method="POST">
                                           <button type="submit" name="messg">
                                             <i class="ion-paper-airplane"></i>
                                           </button>
                                         </form>
                                       </div>
                                   </div>
                                   <div class="post-save">
                                       <button class="sav_act">
                                           <i class="ion-ios-download-outline"></i>
                                       </button>
                                       <div class="save-options">
                                         <form class="" action="index.html" method="post">
                                           <button type="submit" name="save"><i class="ion-android-bookmark"></i> Save</button>
                                           <button type="submit" name="download"><i class="ion-ios-cloud-download"></i> Download</button>
                                         </form>
                                       </div>
                                   </div>
                               </div>
                           </div>
                        <?php
                        $c++;
                    }
                }
            ?>
    </div>
</body>
</html>
