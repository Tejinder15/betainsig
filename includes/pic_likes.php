<?php

$con = mysqli_connect("localhost","root","","social");
if (mysqli_connect_errno()) {
	echo "Failed to connect:". mysqli_connect_errno();
}

$pos_id = $_POST["st"];
$likes_query = mysqli_query($con,"SELECT `likes` from `posts` where `id`='$pos_id'");
$like_res = mysqli_fetch_assoc($likes_query);
if (mysqli_num_rows($likes_query)  > 0) {
  $likes = $like_res["likes"];
  echo "$likes";
}
else{
  echo 0;
}
 ?>
