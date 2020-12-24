<?php
$con = mysqli_connect("localhost","root","","social");
if (mysqli_connect_errno()) {
	echo "Failed to connect:". mysqli_connect_errno();
}

$poid = $_POST['st'];
$userid = $_POST['userid'];
  $report_check = mysqli_query($con,"SELECT * from `report` where `pic_id`='$poid'");
  if(mysqli_num_rows($report_check) >=1){
     echo 0;
  }
  else {
    $pos_report = mysqli_query($con,"INSERT INTO report(`pic_id`,`us_id`) values('$poid','$userid')");
    $update_report = mysqli_query($con,"UPDATE posts set `reports`=`reports`+1 where `id`='$poid'");
    if($pos_report && $update_report){
      // echo "<script>
      // alert('You Reported the Post');  
      // </script>";
      echo 1;
    }
    else{
      echo 0;
    }
    // echo 1;
  }
?>