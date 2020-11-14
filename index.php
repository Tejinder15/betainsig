<?php
require "config/config.php";

if(!(isset($_SESSION['uid']) && $_SESSION['uid'] !='')){
  header("Location:login.php");
}
else{
  $myid = $_SESSION['uid'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insignia</title>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Noto+Sans+JP:wght@300&display=swap" rel="stylesheet">
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
            <a href="search.php"><i class="ion-android-search"></i></a>
            <a href="favorite.php"><i class="ion-android-favorite"></i></a>
            <a href="message.php"><i class="ion-ios-paperplane"></i></a>
            <a href="bio.php?id=<?php echo $myid;?>"><i class="ion-person"></i></a>
          </div>
    </nav>

    <section class="main">
    </section>
</body>
</html>
