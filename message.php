<?php
require "config/config.php";
$myid = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insignia</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="vendors/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/home.css">
    <script type="text/javascript" src="assets/js/script.js"></script>
</head>
<body>
    <nav>
        <div class="logo">
            <h1>Insignia</h1>
        </div>
        
        <div class="navbar">
            <a href="mno.php?id=<?php echo $myid;?>"><i class="ion-home"></i></a> 
            <a href="search.php?id=<?php echo $myid;?>"><i class="ion-android-search"></i></a> 
            <a href="favorite.php?id=<?php echo $myid;?>"><i class="ion-android-favorite"></i></a> 
            <a href="#" class="active"><i class="ion-ios-paperplane"></i></a>
            <a href="bio.php?id=<?php echo $myid;?>"><i class="ion-person"></i></a>
          </div>

    </nav>