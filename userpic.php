<?php

require "config/config.php";

$myid = $_GET['id'];
$userid = $_SESSION['fid'];

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
$pic_cap = array();
$likes = array();
while ($f = mysqli_fetch_array($post_dis)) {
    if ($f!='..' && $f!='.') {
        $allfile[] = $f['post_name'];
        $pic_id[] = $f['id'];
        $pic_cap[] = $f['post_caption'];
        $likes[] = $f['likes'];
    }
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
    <input type="hidden" id="likers-id" value="<?php echo $myid;?>">
    <input type="hidden" id="user-id" value="<?php echo $userid;?>">
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
                                    <!-- Follower cannnot Delete the photo of the user -->
                                    <div class="post-options">
                                        <div class="dropbtn"><i class="op ion-android-more-vertical"></i></div>
                                        <div class="dropdown-content">
                                            <form action="" method="POST">
                                                <input type="hidden" value="<?php echo $pic_id[$c]; //This Fetches Image id from Table?>" name="post_id">
                                                <input type="hidden" value="<?php echo $allfile[$c]; //This Fetches Image id from Table?>" name="post_name">
                                                <!-- <input type="submit" value="Status" name="stat"> -->
                                                <!-- <input type="submit" value="Delete" name="del"> -->
                                                <button type="button" name="button" class="repo" data-st="<?php echo $pic_id[$c]; ?>">Report</button>
                                            </form>
                                        </div>
                                    </div>
                              </div>
                                <!-- Post Photo -->
                                <div class="post-photo">
                                  <form action="" method="POST">
                                    <img src="<?php echo $direct.$allfile[$c]; //This Fetches the image name from table?>" width="100%" height="550" value="<?php echo $direct.$allfile[$c];?>"/>
                                  </form>
                                </div>
                                <!-- Post Sharing And Like Options -->
                                <div class="post-footer">
                                <div class="num-of-likes">
                                <p class="likes"><?php echo $likes[$c];?></p>
                                </div>
                                   <div class="post-actions">
                                       <div class="post-like">
                                         <form action="" method="POST">
                                           <input type="hidden" value="<?php echo $pic_id[$c]; //This Fetches Image id from Table?>" name="post_like_id">
                                           <button type="button" class="like"  name="like" data-id="<?php echo $pic_id[$c]; //This Fetches Image id from Table?>">
                                             <i class="dill ion-android-favorite"></i>
                                           </button>
                                         </form>
                                       </div>
                                       <div class="post-comment">
                                           <button class="pos-comment">
                                             <i class="ion-chatbox-working"></i>
                                           </button>
                                       </div>
                                       <div class="post-share">
                                         <form action="" method="POST">
                                           <button type="submit" name="messg">
                                             <i class="ion-paper-airplane"></i>
                                           </button>
                                         </form>
                                       </div>
                                   </div>

                                   <!--For using the dropdown idea-->
                                   <div class="post-save">
                                       <button class="sav_act" data-sv="<?php echo $pic_id[$c];?>">
                                           <i class="ion-android-bookmark"></i>
                                       </button>
                                   </div>
                                   </div>
                                   <div class="post-caption">
                                 <b><p class="caption"><?php echo $myname; ?></p></b>
                                 <span><?php echo $pic_cap[$c];?></span>
                               </div>

                                   <div class="comment-section">
                                             <input type="text" name="comment-post" class="write-comment" placeholder="Comment" autocomplete="off">
                                             <button class="comment" data-com="<?php echo $pic_id[$c];?>">Comment</button>
                                    </div>
                                    <div class="see-comments">
                                      <button class="tap-comment">Comments</button>
                                      <div class="display-comment">
                                      <?php
                                      $com_query = mysqli_query($con,"SELECT comments.*,users.*  from `comments` JOIN `users` ON comments.`commenters_id`= users.`Id` where `post_id`='$pic_id[$c]'");
                                      $commner = array();
                                      $com = array();
                                      $comprofile = array();
                                      while ($f = mysqli_fetch_array($com_query)) {
                                        if ($f!='..' && $f!='.') {
                                            $commner[] = $f["Username"];
                                            $com[] = $f['comment'];
                                            $comprofile[] = $f["profile_pic"];
                                        }
                                        // print_r($commner);
                                        // print_r($com);
                                    }
                                    if(isset($commner)){
                                      $totalcomments = count($commner);
                                      $x = 0;
                                    for($m = 0;$m<$totalcomments;$m++){
                                        ?>
                                        <div class="commenter-info">
                                          <div class="commenter-profile">
                                            <img src="<?php echo $comprofile[$x];?>" alt="">
                                          </div>
                                          <div class="name-and-comment">
                                            <p class="commenters-name"><?php echo $commner[$x];?></p>
                                            <p class="commenters-comment"><?php echo $com[$x];?></p>
                                          </div>
                                        </div>
                                        <?php
                                        // echo $x;
                                        $x++;
                                    }
                                  }
                                      ?>
                                      </div>
                                    </div>
                               </div>
                        <?php
                        $c++;
                    }
                }
            ?>
    </div>
    <script type="text/javascript" src="assets/js/jquery.js">
    </script>
    <script type="text/javascript" src="assets/js/userpic.js">
    </script>
</body>
</html>
