<?php
    session_start();
?>
<?php

if(isset($_SESSION['username']));
    $username = $_SESSION['username'];
?>
<?php include_once "../includes/db.php" ?>
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
    <link rel="icon" type="image/jpeg" sizes="16x16" href="../assets/img/atlasfav.jpg">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="../assets/css/styles.min.css">
    <link rel="stylesheet" href="../assets/css/main.min.css">
    <link rel="stylesheet" href="../assets/css/styleo.min.css">
    <style>

        .hmkey{
            margin-right: 15px;
            font-size: 20px;
            color: #eb5d23;
            margin-bottom: 10px;
        }
        .hmkey:hover{
            color: #eb5d23;
            text-decoration: underline;
            margin-bottom: 200px;

        }
        .hmkey:active{
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


    </style>
</head>
<body style="background-color: #e6e6fa;">
<nav class="navbar navbar-light navbar-expand" style="height: 80px;background-color: #eb5d23;"><a class="navbar-brand text-center"><img class="img-fluid mx-auto d-block" src="../assets/img/atlas200w.png" style="width: 200px;height: 88px;margin-top: -15%;"></a>
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
        echo '<div class="text-center overflow-auto" style="padding-right: 10px;background-color: rgba(249,224,224,0);margin-top: 30px;padding-left: 10px; padding-bottom: 10PX; padding-top: 10px; margin-bottom: 30px;"><a href="../dashboard" class="hmkey"><strong>HOME&nbsp;</strong></a>
        <a href="my-account.php" class="hmkey"><strong>MY ACCOUNT</strong></a>
        <a href="#" class="hmkey"><strong>HOW TO EARN</strong></a>
        <a href="sponsored_post.php" class="hmkey"><strong>SPONSORED POSTS</strong></a>
        <a href="logout.php" class="hmkey"><strong>LOG OUT</strong></a>
        <a href="#" class="hmkey"><strong>SUPPORT</strong></a>
    </div>';
        echo '</div>';
    }else{
        if($user_role == 'agent'){
            echo '<div class="container">';
            echo '<div class="text-center overflow-auto cont">
        <a href="../dashboard" class="hmkey"><strong>HOME</strong></a>
        <a href="my-account.php" class="hmkey"><strong>MY ACCOUNT</strong></a>
        <a href="coupon.php" target="_blank" class="hmkey"><strong>GENERATE COUPON</strong></a>
        <a href="#" class="hmkey"><strong>HOW TO EARN</strong></a>
        <a href="sponsored_post.php" class="hmkey"><strong>SPONSORED POSTS</strong></a>
        <a href="logout.php" class="hmkey"><strong>LOG OUT</strong></a>
        <a href="#" class="hmkey"><strong>SUPPORT</strong></a>
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
<div class="container">
    <div class="text-center"><img src="../assets/img/970.jpg"></div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <div class="side sida" style="background-color: #ffffff;height: 100px;">
                <p>adscode here</p>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="spacer" style="height: 100%;background-color: #ffffff;margin-top: 15px;">
                <article class="hentry post">
                    <?php


                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                    }else{
                        $page = "1";
                    }

                    if($page == "" || $page ==1){

                        $page_1 = 0;
                    } else {
                        $page_1 = ($page * 5);
                    }
                    //
                    $post_count_query = "SELECT * FROM posts";
                    $find_count = mysqli_query($connection, $post_count_query);
                    $count = mysqli_num_rows($find_count);
                    $count = ceil($count / 20);


                    //                            $dbcheckr = "update wp_posts set post_title=replace(post_title,' - ','-')";
                    //                            $rcheck = mysqli_query($connection, $dbcheckr);

                    $query = "SELECT * FROM posts LIMIT $page_1, 15";
                    $sposts = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($sposts)){
                        $post_id = $row['id'];
                        $post_title = $row['post_title'];
                        $post_image = $row['post_image'];
                        $postimg = "../uploads/$post_image";
                        $post_title = str_replace("", "", $post_title);
//                                $sspost = str_replace("'", '', $post_title);
//                            $posttitle = mysqli_set_charset($post_title, 'utf8');
                        // $post_author = $row['post_author'];
                        $post_name = $row['post_name'];
                        // $post_status = $row['post_status'];
                        ?>

                        <div class="author vcard inline-items">
                            <div class="text-left author-date"><a href="../postsponsored?id=<?php echo $post_id ?>&name=<?php echo $post_name?>" style="color: #eb5d23;"><?php echo "<img src='$postimg'>" ?><br><strong><span style="text-decoration: none;"><?php echo $post_title ?></span></strong></a><br>
                                <!--                                    <span style="color: black; font-size: 10px;">posted by <b style="font-size: 13px;">ADMIN</b></span>-->

                            </div>

                        </div><hr>
                    <?php } ?>
                    <div class="container">
                        <ul class="pagination">
                            <?php

                            for($i =1; $i <= $count; $i++){

//                                    echo "<li class='page-item'><a class='page-link' href='?page={$i}'>{$i}</a> </li>";

                            }
                            echo "<li><a href='?page=".($page+1)."' class='btn' style='background-color: #eb5d23;'>NEXT</a></li>";

                            ?>
                        </ul>
                    </div>

                </article>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="side sida" style="background-color: #ffffff;height: 100px;">
                <p>adscode here</p>
            </div>
        </div>
    </div>
</div>

<div class="text-white footer-basic" style="margin-top: 30px;background-color: #eb5d23;">
    <footer>
        <div class="social"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-instagram"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a></div>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#">Home</a></li>
            <li class="list-inline-item"><a href="#">Services</a></li>
            <li class="list-inline-item"><a href="#">About</a></li>
            <li class="list-inline-item"><a href="#">Terms</a></li>
            <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
        </ul>
        <p class="copyright">Company Name © 2020</p>
    </footer>
</div>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>