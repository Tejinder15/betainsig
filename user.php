<?php

require "config/config.php";

$followerid = $_GET['id']; // For the Follower id

$userid = $_SESSION['fid'];

// For Fetching Username from database
$user_query = mysqli_query($con,"SELECT `Username` from users where `Id`='$userid'");
$us_result = mysqli_fetch_array($user_query);
$user_name = $us_result['Username'];

// For Fetching Number of Posts
$num_of_post = mysqli_query($con,"SELECT * FROM `posts` where `user_id`='$userid'");
$total_post_result = mysqli_num_rows($num_of_post);
$total_post = $total_post_result;

// For Fetching the Number Of Followers
$Follower_query = mysqli_query($con,"SELECT * from followers where `user_id`='$userid' AND `follower_id`='$followerid'");
$num_of_followers = mysqli_num_rows($Follower_query);

// For Fetching the Number Of Followers
$Following_query = mysqli_query($con,"SELECT * from followers where `user_id`='$userid'");
$num_of_following = mysqli_num_rows($Following_query);

// $prof_direct = "profiles"."/".$user_name."."."*"; // Profile Directory;
// $openimages = glob($prof_direct);
//
// $dp = array();
// foreach($openimages as $image) {
//     $dp = $image;
// }

$dp = array();
$profile_query = mysqli_query($con,"SELECT * from `users` where `Id`='$userid'");
while($row = mysqli_fetch_assoc($profile_query)){
  if ($row!='..' && $row!='.') {
      $dp[] = $row['profile_pic'];
  }
}
$profile_dp = implode("",$dp);

//For the Directory of the user
$direc_name = $user_name;
$direct = "users_data"."/".$direc_name."/";

// For Openinng directory
// For Retrieving Images from mysql Table
$post_dis = mysqli_query($con,"SELECT * from `posts` where `user_id`='$userid'");
$pic_id = array();
$allfile = array();
while ($f = mysqli_fetch_array($post_dis)) {
    if ($f!='..' && $f!='.') {
        $allfile[] = $f['post_name'];
        $pic_id[] = $f['id'];
    }
}

    // For Follow and unfollow
    $isFollowing = "";
    $msg = array();
    if (isset($_POST['follow'])) {
        $check_query = mysqli_query($con,"SELECT * from followers Where `user_id`='$userid' AND `follower_id`='$followerid'");
        $check_result = mysqli_num_rows($check_query);
            if ($check_result ==0) {
                $query2 = mysqli_query($con,"INSERT INTO followers(`user_id`,`follower_id`,`followers_id2`,`status`) VALUES('$userid','$followerid','$followerid',1)");
                if($query2){
                  echo 'Started Following';
                  $isFollowing = True;
                }
                else{
                  echo "Sorry Could Not Follow";
                  // echo mysqli_errno($query2);
                  // echo mysqli_error();
                }
            }
            else{
                array_push($msg,"Already Following!.<br>");
            }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insignia</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Montserrat:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="vendors/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/profile.css">
</head>
<body>
    <nav>
        <div class="logo">
            <h1>Insignia</h1>
        </div>
    </nav>

    <section class="main">
      <!--For Profile Photo,Likes ,Followers,Following etc.-->
      <div class="bio-container">
          <div class="profile-container">
            <div class="prof">
              <div class="profile-photo">
                  <img src="<?php echo $profile_dp;
                  ?>" alt=""  width="100%" height="140" style="border-radius:50%">
                </div>
              </div>
            </div>
          <div class="bio-details">
              <div class="bio-name">
                  <span><?php echo "$user_name";?></span>
              </div>

              <div class="strength">
                <a href="userpic.php?id=<?php echo $myid;?>"><b><?php if($total_post){ echo $total_post;}?></b>Posts</a>
                <a href="Followers.php?id=<?php echo $myid;?>"><b><?php echo $num_of_followers;?></b>Followers</a>
                <a href="Following.php?id=<?php echo $myid;?>"><b><?php echo $num_of_following;?></b>Following</a>
              </div>

              <div class="follow-form">
              <form action="" method="post">
                <input type="submit" name="follow" value="Follow" class="followbtn">
              </form>
              </div>
          </div>
      </div>

      <div class="posts-container">
      <?php
      if(isset($allfile))
          {
          $totalimages = count($allfile);
          $col = 3;
          $row = ceil($totalimages/3);
          $c = 0;
          for ($j=0; $j < $row; $j++) {
              echo "<tr>";
              for ($i=0; $i <$col && $c<$totalimages; $i++) {
                  ?>
                  <div class="post"><a href="userpic.php?id=<?php echo $followerid;?>"><img src="<?php echo $direct. $allfile[$c];?>" width="100%" height="230"></a></div>
                  <?php
                  $c++;
              }
          }

      }

          ?>
      </div>
      <footer>
        <div class="nav2">
          <a href="index.php?id=<?php echo $myid;?>"><i class="ion-home"></i></a>
          <a href="search.php?id=<?php echo $myid;?>"><i class="ion-android-search"></i></a>
          <a href="favorite.php?id=<?php echo $myid;?>"><i class="ion-android-favorite"></i></a>
          <a href="message.php?id=<?php echo $myid;?>"><i class="ion-ios-paperplane"></i></a>
          <a href="#" class="active"><i class="ion-person"></i></a>
        </div>
      </footer>
    </section>
    <script>
        function myFunction(){
            document.getElementById("myDropdown").classList.toggle("show");
        }
        window.onclick = function(event)
        {
            if(!event.target.matches('.dropbtn')){
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for(i=0;i<dropdowns.length;i++){
                    var openDropdown = dropdowns[i];
                    if(openDropdown.classList.contains('show')){
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
</body>
</html>
