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
while ($f = mysqli_fetch_array($post_dis)) {
    if ($f!='..' && $f!='.') {
        $allfile[] = $f['post_name'];
        $pic_id[] = $f['id'];
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
    header("Location:Pictures.php?id={$mid}");
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
         $c = -1;
         for ($i=0;$i<$totalimages; $i++) {
             $a++;
             $c++;
             ?>
         <div class="post-conatiner">
             <!-- For Displaying the Username and Profile -->
             <div class="post-header">
                 <div class="post-user">
                     <div class="post-profile">
                         <img src="<?php if(isset($dp))echo $dp;?>">
                     </div>
                     <div class="post-username">
                         <label for="Username" class="person"><?php echo $myname;?></label>
                     </div>
                 </div>
                 <!-- For Post Options -->
                 <div class="post-options">
                     <button class="dropbtn"><i class="op ion-android-more-vertical"></i></button>
                     <div class="dropdown-content">
                         <form action="">
                         <input type="hidden" value="<?php echo $pic_id[$c]; //This Fetches Image id from Table?>" name="post_id">
                         <input type="hidden" value="<?php echo $allfile[$c]; //This Fetches Image id from Table?>" name="post_name">
                         <input type="submit" value="Delete" name="del" class="del" data-id="<?php echo $pic_id[$c];?>"/>
                         </form>
                     </div>
                 </div>
             </div>
             <!-- Post photo -->
             <div class="post-photo">
                 <form action="" method="POST" class="userpost">
                     <img src="<?php echo $direct.$allfile[$c]; // This is for Fetching Images Name?>" alt="" class="post">
                 </form>
             </div>
             <!-- Post sharing and like Options -->
             <div class="post-footer">
                 <div class="post-actions">
                     <div class="post-like">
                       <form class="" action="" method="post">
                         <button class="btn_act" type="submit" name="like">
                           <i class="dill ion-android-favorite"></i>
                         </button>
                       </form>
                     </div>
                     <div class="post-comment">
                         <button class="cmn_act" type="submit">
                             <i class="ion-chatbox-working"></i>
                         </button>
                     </div>
                     <div class="post-share">
                         <button class="shr_act">
                             <i class="ion-paper-airplane"></i>
                         </button>
                     </div>
                 </div>
                 <div class="post-save">
                     <button class="sav_act">
                         <i class="ion-ios-download-outline"></i>
                     </button>
                     <div class="save-options">
                         <input type="hidden" value="<?php echo $pic_id[$c]; //This Fetches Image id from Table?>" name="post_id">
                         <input type="hidden" value="<?php echo $allfile[$c]; //This Fetches Image id from Table?>" name="post_name">
                         <button type="submit" name="save" class="svf_btn"><i class="ion-android-bookmark"></i> Save</button>
                         <button type="submit" name="download" class="sv_btn"><i class="ion-ios-cloud-download"></i> Download</button>
                     </div>
                 </div>
             </div>
         </div>
         <?php
         }
     }
     ?>
    </div>
</body>
</html>
