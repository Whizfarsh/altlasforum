
<?php
session_start();

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Atlas-forum</title>
    <meta name="twitter:title" content="Atlas-forum | Earn money from daily news update">
    <meta name="twitter:card" content="summary_large_image">
    <meta property="og:type" content="website">
    <meta name="description" content="Earn from daily news updates">
    <meta property="og:image" content="../assets/img/atlasbig.jpg">
    <meta name="twitter:image" content="../assets/img/atlasbig.jpg">
    <link rel="icon" type="image/jpeg" sizes="16x16" href="/assets/img/atlasfav.jpg">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="../assets/css/styles.min.css">
    <style>

        .hmkey{
            margin-right: 15px;
            font-size: 20px;
            color: #000000;
        }
        .hmkey:hover{
            color: #e6e6fa;
            background-color: #eb5d23;

        }

        .href{
            color: #fff;
            font-weight: bold;
            text-decoration: none;
            background-color: #eb5d23;
            border-radius: 15px;
            padding: 10px;
        }
        .href:hover{
            color: #eb5d23;
            background-color: #fff;

        }

        #link{
            color: #eb5d23;
        }

        .mypbtn{
            background-color: #eb5d23;
            width: 300PX;
            margin-bottom: 10px;

        @media screen(max-width: 400px) {
            .tpspace {
                margin-top: 50%;
            }
        }


        }


    </style>
</head>
<body>
<?php
$msg = "";

include_once "../includes/db.php";

if(isset($_SESSION['username']));
$username = $_SESSION['username'];
?>
<?php


if (isset($_POST['generate'])){

    $coupon = 'gncduksmccoutywnzjJDLQPROIWUDHGLAMZXVNM1236858';
    $coupon = str_shuffle($coupon);
    $coupon = substr($coupon, 0, 9);
    $coupon = strtoupper($coupon);


    $query = "INSERT INTO coupon(agent, coupon) VALUE('$username', '$coupon')";
    $result = mysqli_query($connection, $query);

    if($result){
        $msg = "your newly generated coupon is $coupon";
    }else{
        die("mysqli error" .mysqli_error($connection));
    }

    //echo $coupon;
}

?>
<?php
if(isset($username)) {

    $login_query = "SELECT * FROM users WHERE uname='$username'";
    $login_query_datta = mysqli_query($connection, $login_query);

    while ($row = mysqli_fetch_assoc($login_query_datta)) {
        $user_role = $row['user_role'];
        $user_earning = $row['user_earnings'];
    }
    if ($user_role == 'agent') {
        echo "<div>";
        echo "<div class=\"container tpspace\" style=\"\">";
        echo "<div class=\"row\">";
        echo "<div class=\"col-md-3\">";
        echo "</div>";
        echo "<div class=\"col-md-6\">";
        echo "<div class=\"text-center\"><img src=\"../assets/img/atlas200c.png\"></div>";
        echo "<div class=\"text-center pspace\" style=\"background-color: #ffffff;\">";
        echo "<form method='post' action='coupon.php'>";
        echo "<br>";
        echo "<input class=\"btn mypbtn\" type=\"submit\" name='generate' value='GENERATE COUPON HERE'>";
        echo "</form>";
        echo $msg;
        echo "</div>";
        echo "</div>";
        echo "<div class=\"col-md-3\">";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";


    }

}
?>
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
