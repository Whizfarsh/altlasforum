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
function redirect()
{
    header('Location: login.php');
    exit();
}

//    $query = "SELECT coupon FROM agent";
//    $select_coupon = mysqli_query($connection, $query);
//
//    if(!$select_coupon){
//        die("QUERY FAILED" . mysqli_error($connection));
//    }
//
//    while ($row = mysqli_fetch_array($select_coupon)){
//
//        $couponuse = $row['coupon'];
//    }


if(isset($_GET['user'])){
    $username = mysqli_real_escape_string($connection, $_GET['user']);

    $sql = "SELECT * FROM users WHERE uname='$username'";
    $result = mysqli_query($connection, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $user_id = $row['user_id'];
        $db_username = $row['uname'];
        $db_fullname = $row['fname'];
        $db_refa = $row['referral'];
        $db_pass = $row['password'];
        $confirmation = $row['isEmailConfirmed'];
        $activation = $row['isActivated'];
        $user_daily_login = $row['user_daily_login'];
        $at_earnings = $row['at_earnings'];
    }

}
if($activation == 1){
    redirect();
    exit();
}
if(isset($_POST['usercoupon'])) {
    $usercoupon = $_POST['usercoupon'];

    $query = "SELECT * FROM coupon WHERE coupon='$usercoupon'";
    $select_coupon = mysqli_query($connection, $query);

    if (!$select_coupon) {
        die("QUERY FAILED" . mysqli_error($connection));
    }

    while ($row = mysqli_fetch_array($select_coupon)) {

        $coupon = $row['coupon'];
        $coupon_use = $row['coupon_use'];
        $coupon_agent = $row['agent'];
    }
    if ($usercoupon == $coupon && $coupon_use == 0) {

        $activate = "UPDATE users SET isActivated=1 WHERE uname='$username'";
        $user_activate = mysqli_query($connection, $activate);

        if ($user_activate) {
            $coupon_update = "UPDATE coupon SET coupon_use=1 WHERE coupon='$coupon'";
            $coupon_used = mysqli_query($connection, $coupon_update);

            if ($coupon_used) {

                $select_agent = "SELECT * FROM users WHERE uname='$coupon_agent'";
                $agent_selected = mysqli_query($connection, $select_agent);

                while ($row = mysqli_fetch_array($agent_selected)) {
                    $agent_at_earnings = $row['at_earnings'];
                    $agent_af_earnings = $row['af_earnings'];
                    $user_role = $row['user_role'];
                    $referral_count = $row['referral_count'];

                }

                $select_referral = "SELECT * FROM users WHERE uname='$db_refa'";
                $selected = mysqli_query($connection, $select_referral);

                while ($row = mysqli_fetch_array($selected)) {
                    $af_earnings = $row['af_earnings'];

                }
                $agent_af_earnings = $agent_af_earnings + 100;
                $af_earnings = $af_earnings + 1000;

                $query = "UPDATE users SET af_earnings='$af_earnings' WHERE uname='$db_refa'";
                $user_earnings_query = mysqli_query($connection, $query);

                $a_query = "UPDATE users SET af_earnings='$agent_af_earnings' WHERE uname='$coupon_agent'";
                $agent_earnings_query = mysqli_query($connection, $a_query);

                if ($user_earnings_query && $agent_earnings_query) {

                    $sql_user = "SELECT * FROM users WHERE uname='$username'";
                    $result = mysqli_query($connection, $sql_user);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $user_id = $row['user_id'];
                        $db_username = $row['uname'];
                        $db_fullname = $row['fname'];
                        $db_refa = $row['referral'];
                        $db_pass = $row['password'];
                        $confirmation = $row['isEmailConfirmed'];
                        $activation = $row['isActivated'];
                        $user_daily_login = $row['user_daily_login'];
                        $at_earnings = $row['at_earnings'];
                    }

                    $at_earnings = $at_earnings+900;

                    $usa_query = "UPDATE users SET at_earnings='$at_earnings' WHERE uname='$username'";
                    $usa_earnings_query = mysqli_query($connection, $usa_query);
                    if($usa_earnings_query){
                        header("Location: ../atlas/login.php");
                    }

                } else {
                    die("QUERY FAILED" . mysqli_error($connection));
                }
            } else {
                die("QUERY FAILED" . mysqli_error($connection));
            }

        } else {
            die("QUERY FAILED" . mysqli_error($connection));
        }
    } else {
        echo "<div>";
        echo "<div class=\"container tpspace\" style=\"\">";
        echo "<div class=\"row\">";
        echo "<div class=\"col-md-3\">";
        echo "</div>";
        echo "<div class=\"col-md-6\">";
        echo "<div class=\"text-center\"><img src=\"assets/img/atlas200c.png\"></div>";
        echo "<div class=\"text-center pspace\" style=\"background-color: #ffffff;\">";
        echo "<h4>";
        echo "COUPON HAS BEEN USED";
        echo "</h4>";
        echo "<a id=\"link\" href=\"../activate.php?activate\"><b>Buy coupon code here</b></a>";
        echo "</div>";
        echo "</div>";
        echo "<div class=\"col-md-3\">";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
}

//echo $couponuse;
//echo "<br>";
//echo $usercoupon;
//echo "<br>";
//echo $username;

?>
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>