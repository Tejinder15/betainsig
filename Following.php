<?php

require "config/config.php";
$myid = $_GET['id'];
// unset($_SESSION['fid']);
// For fetching the Followers from the table
$following_query = mysqli_query($con,"SELECT followers.*,users.* from `followers` JOIN `users` ON followers.`user_id`= users.`Id` where `follower_id` = '$myid'");
$following_profile = array();
$following_names = array();
$follow_id = array();
while ($f = mysqli_fetch_array($following_query)) {
        $following_names[] = $f['Username'];
        $following_profile[] = $f['profile_pic'];
        $follow_id[] = $f['id'];
}
// print_r($follow_id);
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
            <h1>Following</h1>
        </div>
    </nav>

    <section class="main">
        <?php

        if (isset($following_names)) {
            $total = count($following_names);
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
                        <b><span><?php echo $following_names[$c];?></span></b>
                    </div>
                    <div class="option">
                        <form action="" method="post">
                            <input type="submit" value="Unfollow" name="unfollow" class="unfo" data-id="<?php echo $follow_id[$c];?>">
                        </form>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </section>
    <script type="text/javascript" src="assets/js/jquery.js">
    </script>
    <script type="text/javascript" src="assets/js/unfollow.js">
    </script>
</body>
</html>
