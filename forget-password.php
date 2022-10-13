
<?php include_once "includes/db.php" ?>
<?php
$message = "";
$db_username = "";
$db_pass = "";



if(isset($_POST['forget'])){

    $femail = $_POST['femail'];

    if (!empty($femail)){

        $femail = mysqli_real_escape_string($connection, $femail);

        $query = "SELECT * FROM users WHERE email = '$femail'";
        $select_password = mysqli_query($connection, $query);

        if(!$select_password){
            die("QUERY FAILED" . mysqli_error($connection));
        }
        while ($row = mysqli_fetch_array($select_password)){

            $user_id = $row['user_id'];
            $db_username = $row['uname'];
            $db_fullname = $row['fname'];
            $db_email = $row['email'];
            $db_refa = $row['referral'];
            $db_pass = $row['password'];
            $confirmation = $row['isEmailConfirmed'];
            $activation = $row['isActivated'];
            $user_daily_login = $row['user_daily_login'];
            $at_earnings = $row['at_earnings'];

        }

        $cpassword = crypt($db_pass);


        if($femail == $db_email){
            echo $cpassword;
        }else{
            echo 'Email Does Not Exist';
        }




        // if($username !== $db_username && $cpassword !== $db_pass){
        //     $message = "Wrong username or password";
        // }else if($username == $db_username && $cpassword == $db_pass && $confirmation != $activation){
        //     $message = "You have not activated your account, please check your email for activation link";
        // }else if ($username == $db_username && $cpassword == $db_pass && $confirmation == $activation){

        //     if($daily_count != $user_daily_login) {
        //         $at_earnings = $at_earnings + 100;

        //         $query = "UPDATE users SET at_earnings='$at_earnings', user_daily_login='$daily_count' WHERE uname='$username'";
        //         $user_earnings_query = mysqli_query($connection, $query);

        //         if(!$user_earnings_query){
        //             die("QUERY FAILED" . mysqli_error($connection));
        //         }else{
        //             header("Location: ../atlas/dashboard/");
        //         }





        //     }else{
        //         if($daily_count == $user_daily_login){
        //             header("Location: ../atlas/dashboard/");
        //         }
        //     }
        // }else{
        //     $message = "Wrong Username or Password";
        // }

//        if($daily_count != $user_daily_login){
//            $user_earnings = $user_earnings+100;
//
//            $query = "INSERT INTO users (user_earnings) VALUES('$user_earnings')";
//            $user_earnings_query = mysqli_query($connection, $query);
//
//
//        }


    }

}

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
    <meta property="og:image" content="assets/img/atlasbig.jpg">
    <meta name="twitter:image" content="assets/img/atlasbig.jpg">
    <link rel="icon" type="image/jpeg" sizes="16x16" href="assets/img/atlasfav.jpg">
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

        .term{
            color: #eb5d23;
            font-weight: bold;
            text-decoration: none;
        }
        .term:hover{
            color: #000;
        }

        .mypbtn{
            background-color: #eb5d23;
            width: 300PX;
            margin-bottom: 10px;
        }


    </style>
</head>

<body style="background-color: #e6e6fa;">
    <div>
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="side sida"></div>
            </div>
            <div class="col-md-6 col-xl-6" style="background-color: rgba(255,255,255,0);">
                <div class="container">
                    <div class="text-center"><img src="assets/img/atlas200c.png"></div>
                    <form method="post" style="background-color: #ffffff;padding: 15px;">
                        <h6 class="text-center"><b><?php echo $message; ?></b></h6>
                        <div class="form-group"><label><strong>Email Address</strong><span class="text-danger"><strong>*</strong></span></label><input type="email" required="" name="femail"></div>
                        <div class="form-group" style="padding-top: 10px;"><button class="btn mypbtn btn-block" type="submit" name="forget" style="width: 300PX;margin-bottom: 10px;"><strong>REQUEST PASSWORD</strong></button></div>
                        <p>Don't have an account yet?&nbsp;<a class="term" href="register.php">create account here now</a></p>
                    </form>
                    </div>
                </div>
            <div class="col-md-6 col-lg-3">
                <div class="side sida"></div>
            </div>
        </div>
    </div>
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>



?>