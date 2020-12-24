<?php

require "config/config.php";

$myid = $_GET['id'];

// Getting Username from users table
$get_name = mysqli_query($con,"SELECT `Username` from users where `Id`=$myid");
$name_result = mysqli_fetch_array($get_name);
$myname = $name_result['Username'];

$dt = date('Y-m-d H:i:s');

$error = array(); // For Holding error messages
$total_post = 0; // For holding the number of total posts

// For Fetching the total number of post
$num_of_post = mysqli_query($con,"SELECT * FROM `posts` where `posted_by`='$myname'");
$total_post_result = mysqli_num_rows($num_of_post);
$total_post = $total_post_result;

// For Fetching the Number Of Following
$Following_query = mysqli_query($con,"SELECT * from followers where `follower_id`='$myid'");
$num_of_following = mysqli_num_rows($Following_query);

// For Fetching the Number Of Followers
$Follower_query = mysqli_query($con,"SELECT * from followers where `user_id`='$myid'");
$num_of_followers = mysqli_num_rows($Follower_query);

//For the Directory of the user
$direc_name = $myname;
$direct = "users_data"."/".$direc_name."/";
// For Fetching Profile Photo of the user
$dp = array();
$profile_query = mysqli_query($con,"SELECT * from `users` where `Id`='$myid'");
while($row = mysqli_fetch_assoc($profile_query)){
  if ($row!='..' && $row!='.') {
      $dp[] = $row['profile_pic'];
  }
}
$profile_dp = implode("",$dp);


// For Retrieving Images from mysql Table
$post_dis = mysqli_query($con,"SELECT * from `posts` where `user_id`='$myid'");
$post_path = array();
$pic_id = array();
$allfile = array();
while ($f = mysqli_fetch_array($post_dis)) {
    if ($f!='..' && $f!='.') {
        $allfile[] = $f['post_name'];
        $post_path[] = $f['post_path'];
        $pic_id[] = $f['id'];
    }
}
$total_post = count($allfile);

// For Uploading Posts(Photos)
$errors= array();
if(isset($_POST['upload'])){
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $pic_cap = $_POST['caption'];
    $targetfile = $direct.basename($_FILES['image']['name']);
    $post_type = strtolower(pathinfo($targetfile,PATHINFO_EXTENSION));

    $extensions= array("jpg","jpeg","png");

    if(in_array($post_type,$extensions)){

        //for Post Checking in database
        $check_post_query = mysqli_query($con,"SELECT `post_name` FROM `posts` WHERE `posted_by` = '$myname'");
        $found_result = mysqli_fetch_assoc($check_post_query);
        if ($found_result!=$file_name) {
            move_uploaded_file($file_tmp,$direct.$file_name);
            $post_query = mysqli_query($con,"INSERT INTO posts(`id`,`posted_by`,`profile`,`posted_on`,`post_name`,`post_path`,`post_caption`,`user_id`,`likes`) VALUES('','$myname','$profile_dp','$dt','$file_name','$direct','$pic_cap','$myid','')");
            $total_post++;
            $my_post = mysqli_query($con,"UPDATE `users` SET `num_posts`='$total_post' where `Id`='$myid'");
            array_push($error,"Successfully Posted!.<br>");
            if($post_query){
                header("Location:bio.php?id={$myid}");
            }
        }
        else{
            array_push($error,"Post Already Uploaded.<br>");
        }
    }
    else{
       array_push($error,"Invalid File Type, please choose a JPG,JPEG or PNG file.<br>");
    }
    mysqli_close($con);
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

        <div class="navbar">
            <a href="index.php?id=<?php echo $myid;?>"><i class="ion-home"></i></a>
            <a href="search.php?id=<?php echo $myid;?>"><i class="ion-android-search"></i></a>
            <a href="favorite.php?id=<?php echo $myid;?>"><i class="ion-android-favorite"></i></a>
            <a href="message.php?id=<?php echo $myid;?>"><i class="ion-ios-paperplane"></i></a>
            <a href="#" class="active"><i class="ion-person"></i></a>
          </div>
    </nav>

    <section class="main">
        <!--For Profile Photo,Likes ,Followers,Following etc.-->
        <div class="bio-container">
            <div class="profile-container">
              <div class="prof">
                <div class="profile-photo">
                    <img src="<?php
                        echo $profile_dp;
                    ?>" >
                    <div class="pp">
                      <button class="prof_btn" onclick="document.location.href='settings.php?id=<?php echo $myid;?>';">
                        <i class="ion-camera"></i>
                      </button>
                    </div>
                  </div>
                </div>
          </div>
            <div class="bio-details">
                <div class="dropdown" style="float: right;">
                    <button class="dropbtn" onclick="myFunction()">
                        <i class="ion-android-settings"></i>
                    </button>
                    <div id="myDropdown" class="dropdown-content">
                        <a href="settings.php?id=<?php echo $myid;?>"><i class="ion-settings"></i> Settings</a>
                        <a href="logout.php"><i class="ion-log-out"></i> Logout</a>
                    </div>
                    <br>
                </div>

                <div class="bio-name">
                    <span><?php echo "$myname"; ?></span>
                </div>

                <div class="strength">
                    <a href="pictures.php?id=<?php echo $myid;?>"><b><?php if($total_post){ echo $total_post;}?></b>Posts</a>
                    <a href="Followers.php?id=<?php echo $myid;?>"><b><?php echo $num_of_followers;?></b>Followers</a>
                    <a href="Following.php?id=<?php echo $myid;?>"><b><?php echo $num_of_following;?></b>Following</a>
                </div>

                <button class="trigger"><i class="ion-android-upload"></i> Upload</button>
                <div class="messages">
                    <?php
                    if (in_array("Successfully Posted!.<br>",$error)) {
                        echo '<span style="color:green">Successfully Posted!.<br></span>';
                    }
                    else if(in_array("Invalid File Type, please choose a JPG,JPEG or PNG file.<br>",$error)) {
                        echo '<span style="color:red">Invalid File Type, please choose a JPG,JPEG or PNG file.<br></span>';
                    }
                    else if(in_array("Post Already Uploaded.<br>",$error)){
                        echo '<span style="color:#ff007f">Post Already Uploaded.<br></span>';
                    }
                    else{
                        echo '';
                    }
                    ?>
                </div>

                <div class="modal">
                    <div class="modal-content">
                        <form action="" method="POST" enctype="multipart/form-data">
                          <input type="file" name="image">
                        <b><span class="close-button">&times;</span></b>
                        <div class="caption-section">
                          <b><label for="">Caption</label></b>
                          <input type="text" name="caption" id="cap" autocomplete="off" placeholder="Enter Caption">
                        </div>
                        <br>
                        <center><input type="submit" name="upload" value="Post" class="postup"></center>
                      </form>
                    </div>
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
                    <div class="post"><a href="pictures.php?id=<?php echo $myid;?>"><img src="<?php echo $post_path[$c]. $allfile[$c];?>" width="100%" height="230"></a></div>
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
        var modal = document.querySelector(".modal");
        var trigger = document.querySelector(".trigger");
        var closeButton = document.querySelector(".close-button");

        function toggleModal(){
            modal.classList.toggle("show-modal");
        }

        function windowOnClick(event){
            if(event.target === modal){
                toggleModal();
            }
        }

        trigger.addEventListener("click",toggleModal);
        closeButton.addEventListener("click",toggleModal);
        window.addEventListener("click",windowOnClick);
    </script>

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
