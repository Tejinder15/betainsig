<?php
require "config/config.php";

if(!(isset($_SESSION['uid']) && $_SESSION['uid'] !='')){
  header("Location:login.php");
}
else{
  $myid = $_SESSION['uid'];
}
unset($_SESSION['fid']);
$following_post = mysqli_query($con,"SELECT followers.*,posts.* from `followers` JOIN `posts` ON followers.`user_id`= posts.`user_id` where `follower_id` = '$myid'");
$following_names = array();
$allfile = array();
$following_post_path = array();
$pic_id = array();
$post_time = array();
$complete_path = array();
$profile = array();
$person_id = array();
while ($f = mysqli_fetch_array($following_post)) {
        $person_id[] = $f['user_id'];
        $pic_id[] = $f['id'];
        $following_names[] = $f['posted_by'];
        $following_post_path[] = $f['post_path'];
        $allfile[] = $f['post_name'];
        $profile[] = $f['profile'];
}
// print_r($following_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insignia</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="vendors/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/home.css">
</head>
<body>
    <nav>
        <div class="logo">
            <h1>Insignia</h1>
        </div>
        <div class="navbar">
            <a class="active" href="#"><i class="ion-home"></i></a>
            <a href="search.php?id=<?php echo $myid;?>"><i class="ion-android-search"></i></a>
            <a href="favorite.php?id=<?php echo $myid;?>"><i class="ion-android-favorite"></i></a>
            <a href="message.php?id=<?php echo $myid;?>"><i class="ion-ios-paperplane"></i></a>
            <a href="bio.php?id=<?php echo $myid;?>"><i class="ion-person"></i></a>
          </div>
    </nav>

    <input type="hidden" id="likers-id" value="<?php echo $myid;?>">
    <section class="main">
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
                              <img src="<?php echo $profile[$c];?>" alt="">
                          </div>
                          <div class="post-username">
                            <label for="" class="person"><?php echo $following_names[$c];?></label>
                          </div>
                        </div>
                          <!-- For Post Options -->
                          <div class="post-options">
                                        <div class="dropbtn"><i class="op ion-android-more-vertical"></i></div>
                                        <div class="dropdown-content">
                                            <!-- <form action="" method="POST"> -->
                                                <input type="hidden" class="us-id" value="<?php echo $person_id[$c];?>">
                                                <input type="hidden" value="<?php echo $pic_id[$c]; //This Fetches Image id from Table?>" name="post_id">
                                                <input type="hidden" value="<?php echo $allfile[$c]; //This Fetches Image id from Table?>" name="post_name">
                                                <!-- <input type="submit" value="Status" name="stat"> -->
                                                <!-- <input type="submit" value="Delete" name="del"> -->
                                                <button type="button" name="button" class="repo" data-st="<?php echo $pic_id[$c]; ?>">Report</button>
                                            <!-- </form> -->
                                        </div>
                                    </div>
                          <!-- Follower cannnot Delete the photo of the user -->
                    </div>
                      <!-- Post Photo -->
                      <div class="post-photo">
                        <form action="" method="POST">
                          <img src="<?php echo $following_post_path[$c].$allfile[$c]; //This Fetches the image name from table?>" width="100%" height="550" value="<?php echo $direct.$allfile[$c];?>"/>
                        </form>
                      </div>
                      <!-- Post Sharing And Like Options -->
                      <div class="post-footer">
                         <div class="post-actions">
                             <div class="post-like">
                             <!-- <form action="" method="POST"> -->
                             <input type="hidden" class="u-id" value="<?php echo $person_id[$c];?>">
                                           <input type="hidden" value="<?php echo $pic_id[$c]; //This Fetches Image id from Table?>" name="post_like_id">
                                           <button type="button" class="like"  name="like" data-id="<?php echo $pic_id[$c]; //This Fetches Image id from Table?>">
                                             <i class="dill ion-android-favorite"></i>
                                           </button>
                                         <!-- </form> -->
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
    </section>
    <script type="text/javascript" src="assets/js/jquery.js">
    </script>
    <script type="text/javascript" src="assets/js/app.js">
    </script>
</body>
</html>
