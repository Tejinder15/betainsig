<?php

require "config/config.php";
$myid = $_GET['id'];
// For fetching the Followers from the table
$following_query = mysqli_query($con,"SELECT followers.`followers_id2`,users.* from `followers` JOIN `users` ON followers.`followers_id2`= users.`Id` where `user_id` = '$myid'");
$following_profile = array();
$following_names = array();
$follower_id = array();
while ($f = mysqli_fetch_array($following_query)) {
        $follower_id[] = $f['followers_id2'];
        $following_names[] = $f['Username'];
        $following_profile[] = $f['profile_pic'];
}
// print_r($following_profile);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insignia</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/follow.css">
</head>
<body>
    <nav>
        <div class="logo">
            <h1>Followers</h1>
        </div>
    </nav>

    <section class="main">
        <?php

        if (isset($following_names)) {
            $total = count($follower_id);
            $c = -1;
            for ($i=0; $i<$total; $i++) {
                $c++;
                ?>
                <div class="following-details">
                    <div class="following-profile">
                         <div class="photo">
                            <img src="<?php echo $following_profile[$c];?>" alt="">
                        </div>
                    </div>
                    <div class="username">
                        <span><?php echo $following_names[$c];?></span>
                    </div>
                    <div class="option">
                        <form action="" method="post">
                            <input type="submit" value="Unfollow" name="unfollow" class="unfo">
                        </form>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </section>
</body>
</html>
