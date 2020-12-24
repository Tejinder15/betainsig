<?php
$con = mysqli_connect("localhost","root","","social");
if (mysqli_connect_errno()) {
	echo "Failed to connect:". mysqli_connect_errno();
}

$poid = $_POST['st'];
$userid = $_POST['userid'];
  $report_check = mysqli_query($con,"SELECT * from `report` where `pic_id`='$poid'");
  // $report_check_result = mysqli_num_rows($report_check);
  // $like_check_result = mysqli_fetch_assoc($like_check);
  if(mysqli_num_rows($report_check) >=1){
     echo 0;
  }
  else {
    $pos_report = mysqli_query($con,"INSERT INTO report(`pic_id`,`us_id`) values('$poid','$userid')");
    // $update_likes = mysqli_query($con,"UPDATE posts set `likes`=`likes`+1 where `id`='$poid'");
    if($pos_report){
      // echo "<script>
      // alert('You Reported the Post');  
      // </script>";
      echo 1;
    }
    else{
      echo 0;
    }
  }
?>