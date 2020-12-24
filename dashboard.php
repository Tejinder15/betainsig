<?php
require "config/config.php";

$admin_id = $_SESSION['aid'];
// $get_admin_name = mysqli_query($con,"Select `Username` from users where `Id` = '$admin_id'");
// $name_result = mysqli_fetch_array($get_admin_name);
// $admin_name = $name_result['Username'];
// echo $admin_name;
// $get_reports = mysqli_query($con,"SELECT * from report");
$get_reports = mysqli_query($con,"SELECT report.*,posts.* from `report` JOIN `posts` ON report.`pic_id`= posts.`id`");
$post_id = array();
$user_id = array();
$poster_name = array();
$post_path = array();
$post_name = array();
$num_of_reports = array();
while ($f = mysqli_fetch_array($get_reports)) {
    if ($f!='..' && $f!='.') {
        $post_id[] = $f['pic_id'];
        $user_id[] = $f['us_id'];
        $poster_name[] = $f['posted_by'];
        $post_path[] = $f['post_path'];
        $post_name[] = $f['post_name'];
        $num_of_reports[] = $f['reports'];
    }
}
// print_r($post_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Roboto:wght@300;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/dash.css">
    <title>Insignia</title>
</head>
<body>
    <header>
    <h1>Dashboard</h1>
    <a href="logout.php"><i class="ion-log-out"></i> Logout</a>
    </header>
    <div class="report-container">
        <table>
            <tr>
                <th>S.No</th>
                <th>Post_id</th>
                <th>Poster_name</th>
                <th>Post_pic</th>
                <th>No_of_Reports</th>
                <th>Action</th>
            </tr>
            <?php
                if(isset($post_id)){
                    $total_reports = count($post_id);
                    $a = -1;
                    $c = 0;
                    for($i=1;$i<=$total_reports;$i++){
                        $a++;
                        ?>
                        <tr class="repo">
                        <td><?php echo $i;?></td>
                        <td><?php echo $post_id[$a];?></td>
                        <td><?php echo $poster_name[$a];?></td>
                        <td><img src="<?php echo $post_path[$a].$post_name[$a];?>">
                        </td>
                        <td><?php echo $num_of_reports[$a];?></td>
                        <td><button class="action" data-id="<?php echo $post_id[$a];?>">Delete</button></td>
                    </tr>
                        <?php
                    }
                }
                $c++;
            ?>
            
        </table>
    </div>
    <script src="./assets/js/jquery.js"></script>
    <script src="./assets/js/app.js">
    </script>
</body>
</html>