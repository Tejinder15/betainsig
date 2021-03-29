<?php

require "config/config.php";

$myid = $_GET['id'];

$sav_query = mysqli_query($con,"SELECT saved.`pic_id`,posts.*  from `saved` JOIN `posts` ON saved.`pic_id` = posts.`id` where saved.`user_id`='$myid'");
$pic_id = array();
$allfile = array();
$pic_path = array();
while ($f = mysqli_fetch_array($sav_query)) {
    if ($f!='..' && $f!='.') {
        $allfile[] = $f['post_name'];
        $pic_path[] = $f['post_path'];
        $pic_id[] = $f['pic_id'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="vendors/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/save.css">
    <title>Insignia</title>
</head>
<body>
    <nav>
        <div class="logo">
            <h1>Saved</h1>
        </div>
    </nav>

    <section class="main">
        <input type="hidden" id="myid" value="<?php echo $myid;?>">
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
                    <div class="post">
                        <div class="post-options">
                            <div class="dropbtn"><i class="op ion-android-more-vertical"></i></div>
                                <div class="dropdown-content">
                                    <button data-pid="<?php echo $pic_id[$c];?>" class="del"><i class="ion-trash-b"></i> Delete</button>
                                </div>
                        </div>
                        <img src="<?php echo $pic_path[$c].$allfile[$c];?>" width="100%" height="230">
                    </div>
                    <?php
                    $c++;
                }
            }

        }

            ?>
    </section>
    <script type="text/javascript" src="assets/js/jquery.js"></script>
    <script type="text/javascript" src="assets/js/del_sav.js"></script>
</body>
</html>