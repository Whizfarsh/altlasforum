<?php
session_start();
?>
<?php
$username = "";
if(isset($_SESSION['username']));
$username = $_SESSION['username'];
//if(isset($_GET['postid'])){
//    $postid = $_GET['id'];
//}

?>
<?php include_once "../includes/db.php" ?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>My Account || Atlas-forum</title>
        <meta name="twitter:title" content="WakaNewz | redefining for financial freedom">
        <meta name="twitter:card" content="summary_large_image">
        <meta property="og:type" content="website">
        <meta name="description" content="Earn from daily news updates">
        <meta property="og:image" content="../assets/img/atlasbig.jpg">
        <meta name="twitter:image" content="../assets/img/atlasbig.jpg">
        <link rel="icon" type="image/jpeg" sizes="16x16" href="../assets/img/atlasfav.jpg">
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/fonts/ionicons.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
        <link rel="stylesheet" href="../assets/css/styles.min.css">
        <style>

            .hkey{
                margin-right: 15px;
                font-size: 20px;
                color: #eb5d23;
                margin-bottom: 10px;
            }
            .hkey:hover{
                color: #eb5d23;
                text-decoration: underline;
                margin-bottom: 200px;

            }
            .hkey:active{
                color: #000000;
            }
            .term{
                color: #000000;
                font-weight: bold;
                text-decoration: none;
                font-size: 18px;
                margin-bottom: 30px;
            }

            .cont{
                height: auto;
                padding-right: 10px;
                background-color: rgba(249,224,224,0);
                margin-top: 30px;
                padding-left: 10px;
                padding-bottom: 10PX;
                padding-top: 10PX;
                margin-bottom: 30px;
            }
            .hmkey{
                margin-right: 15px;
                font-size: 20px;
                padding: 30px;
            }
            .hmkey:hover{
                color: #e6e6fa;
                background-color: #eb5d23;

            }

            .term{
                color: #000;
                font-weight: bold;
                text-decoration: none;
            }
            .term:hover{
                color: #eb5d23;
            }

            .mypbtn{
                background-color: #eb5d23;
                width: 300PX;
                margin-bottom: 10px;
            }
            .mypbtn2{
                background-color: #4b4e65;
                width: 300PX;
                margin-bottom: 10px;
            }


        </style>
    </head>

<body style="background-color: #e6e6fa;">
<nav class="navbar navbar-light navbar-expand" style="height: 80px;background-color: #eb5d23;">
    <div class="container"><a class="navbar-brand text-center"><img class="img-fluid mx-auto d-block" src="../assets/img/atlas200w.png" style="width: 200px;height: 88px;margin-top: -15%;"></a></div>
</nav>
<?php
if(isset($username)){

$login_query = "SELECT * FROM users WHERE uname='$username'";
$login_query_datta = mysqli_query($connection, $login_query);

while($row = mysqli_fetch_assoc($login_query_datta)){
$user_role = $row['user_role'];
$at_earning = $row['at_earnings'];
$af_earning = $row['af_earnings'];
$refa_count = $row['referral_count'];
$user_earning = $af_earning + $at_earning;
}

if($user_role == 'subscriber') {

echo '<div class="container">';
    echo '<div class="text-center overflow-auto" style="padding-right: 10px;background-color: rgba(249,224,224,0);margin-top: 30px;padding-left: 10px; padding-bottom: 10PX; padding-top: 10px; margin-bottom: 30px;">
    <a href="../dashboard" class="hkey"><strong>HOME&nbsp;</strong></a>
        <a href="my-account.php" class="hkey"><strong>MY ACCOUNT</strong></a>
        <a href="#" class="hkey"><strong>HOW TO EARN</strong></a>
        <a href="logout.php" class="hkey"><strong>LOG OUT</strong></a>
        <a href="#" class="hkey"><strong>SUPPORT</strong></a>
    </div>';
    echo '</div>';
}else{
if($user_role == 'agent'){
echo '<div class="container">';
    echo '<div class="text-center overflow-auto cont">
        <a href="../dashboard" class="hkey"><strong>HOME</strong></a>
        <a href="my-account.php" class="hkey"><strong>MY ACCOUNT</strong></a>
        <a href="coupon.php" target="_blank" class="hkey"><strong>GENERATE COUPON</strong></a>
        <a href="#" class="hkey"><strong>HOW TO EARN</strong></a>
        <a href="logout.php" class="hkey"><strong>LOG OUT</strong></a>
        <a href="#" class="hkey"><strong>SUPPORT</strong></a>
    </div>';
    echo '</div>';
}
}
}else{
echo '<div class="container">
    <div class="text-center scroll menu overflow-auto" style="padding-right: 10px;background-color: rgba(249,224,224,0);margin-top: 30px;padding-left: 10px;padding-bottom: 10PX;padding-top: 10PX;margin-bottom: 50px;">
        <a href="../index.php" class="hmkey"><strong>HOME</strong></a>
        <a href="register.php" class="hmkey"><strong>REGISTER</strong></a>
        <a href="../login.php" class="hmkey"><strong>LOGIN</strong></a>
        <a href="#" class="hmkey"><strong>HOW TO EARN</strong></a>
        <a href="#" class="hmkey"><strong>GET COUPON</strong></a>
        <a href="#" class="hmkey"><strong>SUPPORT</strong></a>
        <a href="#" class="hmkey"><strong>FAQ</strong></a>
    </div>
</div>';
}
?>
<div class="hdspace">
    <div class="container">
        <div class="text-center"><img src="../assets/img/970.jpg"></div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-3 col-xl-1"></div>
        <div class="col-md-6 col-xl-6" style="background-color: rgba(255,255,255,0);margin-bottom: 30px;margin-right: 10px;margin-left: 10px;">
            <div class="text-center"></div>
            <div class="container" style="background-color: #fff; padding: 10px 0 0 10px;">
                    <h3 class="text-center" style="color: #000000;"><strong></strong></h3>
                <?php

                if(isset($username)){

                    $act_query = "SELECT * FROM users WHERE uname='$username'";
                    $act_query_datta = mysqli_query($connection, $act_query);

                    while($row = mysqli_fetch_assoc($act_query_datta)){
                        $at_earning = $row['at_earnings'];
                        $af_earning = $row['af_earnings'];
                        $refa_count = $row['referral_count'];
                        $user_earning = $af_earning + $at_earning;
                        $ref_link = $row['reflink'];
                        $user_email = $row['email'];
                    }

                    echo '<div class="text-center" style="margin-left: 0px; padding: 15px;">
        <p class="btn mypbtn hmkey"><strong>WNZA Earnings: NGN'.$at_earning.'</strong></p><br>
        <p class="btn mypbtn2 hmkey"><strong>WNZP Earnings: NGN'.$af_earning.'</strong></p><br>
        <p class="btn mypbtn hmkey"><strong style="">My Referral(s): '.$refa_count.'</strong></p><br>
        <p class="btn mypbtn2 hmkey"><strong>My Referral link: <a href="'.$ref_link.'" style="font-size: 15px; color: #fff;">'.$ref_link.'</a></strong></p><br>
         <a href="withdraw.php?request" class="hmkey"><strong>WITHDRAWAL</strong></a><br>
         
  </div>';



                }
                if(isset($_GET['withdraw'])){

                    if($af_earning >= 5000){
                        echo 'yess';
                    }else{
                        echo 'nooo';
                    }

                }else{
                    echo 'no';
                }


                ?>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 col-xl-4" style="">
            <div class="side sida"></div>
        </div>
    </div>
</div>
<?php include_once "../includes/footer.php" ?>