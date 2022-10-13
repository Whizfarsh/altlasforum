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
    <meta property="og:image" content="assets/img/atlasbig.jpg">
    <meta name="twitter:image" content="assets/img/atlasbig.jpg">
    <link rel="icon" type="image/jpeg" sizes="16x16" href="/assets/img/atlasfav.jpg">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="assets/css/styles.min.css">
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
include 'includes/db.php';


if(isset($_GET['atfp'])){
    $referral = $_GET['atfp'];

    $ref_count = "SELECT * FROM users WHERE uname='$referral'";
    $ref_count_data = mysqli_query($connection, $ref_count);

    while($row = mysqli_fetch_assoc($ref_count_data)){
        $refa_count = $row['referral_count'];
        $refa_count = $refa_count+1;
    }
    $refa_count_update = "UPDATE users SET referral_count='$refa_count' WHERE uname='$referral'";
    $refa_count_update_query = mysqli_query($connection, $refa_count_update);

    if($refa_count_update_query){
        echo 'yes';
    }else{
        echo 'mistake';
    }

}
//function redirect()
//{
//    header('Location: login.php');
//    exit();
//}
//
//if (!isset($_GET['email'])) {
//    redirect();
//    exit();
//} else {
//
//    $email = mysqli_real_escape_string($connection, $_GET['email']);
//
//    $sql = "SELECT * FROM users WHERE email='$email'";
//    $result = mysqli_query($connection, $sql);
//
//    while($row = mysqli_fetch_assoc($result)) {
//        $user_id = $row['user_id'];
//        $db_username = $row['uname'];
//        $db_fullname = $row['fname'];
//        $db_refa = $row['referral'];
//        $db_pass = $row['password'];
//        $confirmation = $row['isEmailConfirmed'];
//        $activation = $row['isActivated'];
//        $user_daily_login = $row['user_daily_login'];
//        $user_earnings = $row['user_earnings'];
//
//    }
//if(isset($_GET['activate'])) {
//    $amount = "1500";
//    $uname = "Farsh";
//
//    echo "<div>";
//    echo "<div class=\"container tpspace\" style=\"\">";
//    echo "<div class=\"row\">";
//    echo "<div class=\"col-md-3\">";
//    echo "</div>";
//    echo "<div class=\"col-md-6\">";
//    echo "<div class=\"text-center\"><img src=\"assets/img/atlas200c.png\"></div>";
//    echo "<div class=\"text-center pspace\" style=\"background-color: #ffffff;\">";
//    echo "<h2 class=\"text-center\"><strong>Hello, $uname</strong></h2>";
//    echo "<hr>";
//    echo "<p>";
//    echo "The purpose for activation is to initiate the earning functionality, which can be done by using either of the method below.";
//    echo " Please take note that the activation cost just NGN$amount.";
//    echo "<br>";
//    echo "<b>Buy coupon code from our trusted agent to avoid scamming</b>";
//    echo "<br>";
//    echo "<a id=\"link\" href=\"../activate.php?activate\"><b>Buy coupon code here</b></a>";
//    echo "</p>";
//    echo "<br>";
//    echo "<h3 class=\"text-center\" style=\"margin-top: 10px;\">";
//    echo "<a class=\"href\" href=\"../activate.php?activate\">USE FLUTTERWAVE</a>";
//    echo "</h3>";
//    echo "<b>OR</b>";
//    echo "<br>";
//    echo "<h3 class=\"text-center\" style=\"margin-top: 10px;\">";
//    echo "<a class=\"href\" href=\"../atlas/checker.php?usecoupon\">USE A COUPON CODE</a>";
//    echo "</h3>";
//    echo "</div>";
//    echo "</div>";
//    echo "<div class=\"col-md-3\">";
//    echo "</div>";
//    echo "</div>";
//    echo "</div>";
//    echo "</div>";
//}
//if (isset($_GET['usecoupon'])) {
//    echo "<div>";
//    echo "<div class=\"container tpspace\" style=\"\">";
//    echo "<div class=\"row\">";
//    echo "<div class=\"col-md-3\">";
//    echo "</div>";
//    echo "<div class=\"col-md-6\">";
//    echo "<div class=\"text-center\"><img src=\"assets/img/atlas200c.png\"></div>";
//    echo "<div class=\"text-center pspace\" style=\"background-color: #ffffff;\">";
//    echo "<form>";
//    echo "<input class='text-center' type=\"text\" name='usercoupon' placeholder='INSERT COUPON CODE HERE'>";
//    echo "<br>";
//    echo "<input class=\"btn mypbtn\" type=\"button\" name='coupon' value='ACTIVATE'>";
//    echo "</form>";
//    echo "</div>";
//    echo "</div>";
//    echo "<div class=\"col-md-3\">";
//    echo "</div>";
//    echo "</div>";
//    echo "</div>";
//    echo "</div>";
//}else {
//    redirect();
//    exit();
//}

//    $select_referral = "SELECT * FROM users WHERE uname='$db_referral'";
//    $selected = mysqli_query($connection, $select_referral);
//
//    while($row= mysqli_fetch_array($selected)){
//        $user_earnings = $row['user_earnings'];
//    }


?>
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
