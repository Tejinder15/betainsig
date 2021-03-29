<?php

require "config/config.php";

$myid = $_GET['id'];
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
    <link rel="stylesheet" href="assets/css/store.css">
    <title>Insignia</title>
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
            <a href="bio.php?id=<?php echo $myid;?>"><i class="ion-person"></i></a>
            <a class="active" href="#"><i class="ion-bag"></i></a>
          </div>
    </nav>
    <section class="main">
    <div class="store-art">
    <input type="file" src="" alt="" id="pic-upload">
    <div class="store-owner">
    <img src="" alt="">
    </div>
    </div>
    <div class="product-container">
    
    </div>
    </section>
    <div class="nav2">
    <button class="add-prod"
    ><i class="ion-plus-circled"></i></button>
    </div>
</body>
</html>