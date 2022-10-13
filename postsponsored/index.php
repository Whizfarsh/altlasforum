<?php
session_start();
?>
<?php
$username = "";
$user_earnings = "";
if(isset($_SESSION['username']));
$username = $_SESSION['username'];
if(isset($_GET['id'])){
    $postid = $_GET['id'];
    // echo $postname;
}

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
        <a href="../my-account.php" class="hmkey"><strong>MY ACCOUNT</strong></a>
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
        <a href="../dashboard/my-account.php" class="hmkey"><strong>MY ACCOUNT</strong></a>
        <a href="../dashboard/coupon.php" target="_blank" class="hmkey"><strong>GENERATE COUPON</strong></a>
        <a href="#" class="hmkey"><strong>HOW TO EARN</strong></a>
        <a href="../admin/sponsored_post.php" class="hmkey"><strong>SPONSORED POSTS</strong></a>
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
    <div class="text-center adsbig"><img src="../assets/img/970.jpg"></div>
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

                    if(isset($_GET['id'])) {


                        $postid = $_GET['id'];


                        $query = "SELECT * FROM posts WHERE id = $postid";
                        $seposts = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_assoc($seposts)) {


                            $post_id = $row['id'];
                        $post_title = $row['post_title'];
                        $post_image = $row['post_image'];
                        $postimg = "../uploads/$post_image";
                            $post_content = nl2br($row['post_content']);
//                                        $pcontent = preg_replace("/[^a-zA-Z\-]/", "", $post_content);
//                                        $pcontent = preg_replace("/[^a-zA-Z\-]/", "", $post_content);
//                                        $pcontent = ($post_content);
                        }

                        // $user_query = "SELECT * FROM users WHERE uname = '$username'";
                        // $user_data = mysqli_query($connection, $user_query);

                        // while ($row = mysqli_fetch_assoc($user_data)){
                        //     $at_earning = $row['at_earnings'];
                        //     $user_name = $row['fname'];
                        //     $user_email = $row['email'];

                        //     $at_earnings = $at_earning+3;
                        // }


                        // $query = "UPDATE users SET at_earnings='$at_earnings' WHERE uname='$username'";
                        // $user_earnings_query = mysqli_query($connection, $query);



                    }
                    ?>
                        <div class="author vcard inline-items">
                            <div><h3><b><?php echo $post_title ?></b></h3></div><hr> <br>
                            <div class="text-left author-date"><?php echo "<img src='$postimg'>"?><br><strong><span style="text-decoration: none;"><?php echo $post_content ?></span></strong></a><br>
                                <!--                                    <span style="color: black; font-size: 10px;">posted by <b style="font-size: 13px;">ADMIN</b></span>-->

                            </div>

                        </div><hr>
                    <?php

                    $com_query = "SELECT * FROM comments where comment_post_ID = '$postid'";
                    $com_result = mysqli_query($connection, $com_query);

                    while($row = mysqli_fetch_assoc($com_result)){
                        $comment_user = $row['comment_author'];
                        $user_comment = $row['comment_content'];
                    ?>
                        <div style="text-decoration: none; background-color: #e6e6fa; color: #eb5d23; padding: 15px; border-radius: 20px;">
                                    <small><?php echo $comment_user ?> Commented</small>: <br><span style="color: #000000; font-weight: bold;"><?php echo $user_comment ?></span></a><br>
                    <!--                                    <span style="color: black; font-size: 10px;">posted by <b style="font-size: 13px;">ADMIN</b></span>-->
                </div><br>
        <?php } ?>
                    <?php
                    if (isset($username)){

                        $user_query = "SELECT * FROM users WHERE uname = '$username'";
                        $user_data = mysqli_query($connection, $user_query);

                        while ($row = mysqli_fetch_assoc($user_data)){
                            $at_earning = $row['at_earnings'];
                            $user_name = $row['fname'];
                            $user_email = $row['email'];
                        }
                        echo "<div id=\"respond\" class=\"comment-respond\">";
                        echo '<h3 id="reply-title" class="comment-reply-title">Leave a comment</h3><form method="post" id="commentform" class="comment-form">';
                        echo '<p class="comment-notes">Required fields are marked <span style="color: #ff0000;">*</span></p>';
                        echo '<p class="comment-form-comment"><label for="comment">Comment <span style="color: #ff0000;">*</span></label> <textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required"></textarea></p>';
                        echo '<p class="form-submit"><input name="submit" type="submit" id="submit" class="submit" value="Post Comment">';
                        echo '<input type="hidden" name="comment_parent" id="comment_parent" value="0">';
                        echo '</p>';
                        echo '</form>';
                        echo '</div>';
                    }else{
                        echo 'Comment box is available for logged in users only';
                    }

                    if(isset($_POST['submit'])){
                        $comment_content = $_POST['comment'];

                        if(!empty($comment_content)){
                        $comment_content = mysqli_real_escape_string($connection, $comment_content);

                            $comment_query = "SELECT * FROM comments WHERE comment_post_ID='$postid'";
                            $queried_comment = mysqli_query($connection, $comment_query);

                            while($row = mysqli_fetch_assoc($queried_comment)){
                                $comment_count = $row['comment_count'];
                                $comment_post_ID = $row['comment_post_ID'];
                                $comment_author_email = $row['comment_author_email'];
                            }

                            if($comment_count > 0 && $comment_post_ID == $post_id){
                                $dquery = "SELECT at_earnings FROM users WHERE email='$comment_author_email'";
                                $queried_d = mysqli_query($connection, $dquery);

                                while($row = mysqli_fetch_assoc($queried_d)){
                                    $u_at_earnings = $row['at_earnings'];

                                    $us_at_earnings = $u_at_earnings-50;
                                }

                                $duquery = "UPDATE users SET at_earnings='$us_at_earnings' WHERE email='$comment_author_email'";
                                $user_d_earnings_query = mysqli_query($connection, $duquery);

                                if(!$user_d_earnings_query){
                                    die("QUERY FAILED" . mysqli_error($connection));
                                }

                            }else{

                                $insert_comment = "insert into comments (comment_post_ID, comment_author, comment_count, comment_author_email, comment_content) VALUES ('$postid', '$user_name', 1, '$user_email', '$comment_content')";
                                $comment_result = mysqli_query($connection, $insert_comment);

                                if($comment_result){
                                    $atearning = $at_earning-1;
                                    $query = "UPDATE users SET at_earnings='$atearning' WHERE uname='$username'";
                                    $user_earnings_query = mysqli_query($connection, $query);
                                }else{
                                    die("QUERY FAILED" . mysqli_error($connection));
                                }
                        }
                        }


                    }

                    ?>
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
        <p class="copyright">BAO CYBER TECHNOLOGIES © 2020</p>
    </footer>
</div>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
