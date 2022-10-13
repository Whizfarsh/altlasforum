<?php
$msg = "";
$msg1 = "";
$btn1 = "";
$btn2 = "";

function redirect() {
    header('Location: register.php');
    exit();
}

if (!isset($_GET['email']) || !isset($_GET['token'])) {
    redirect();
    exit();
} else {
    include_once 'includes/db.php';

    $email = mysqli_real_escape_string($connection, $_GET['email']);
    $token = mysqli_real_escape_string($connection, $_GET['token']);

    $sql = "SELECT * FROM users WHERE email='$email' AND token='$token' AND isEmailConfirmed=0";
    $result = mysqli_query($connection, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $fname = $row['fname'];
    }

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        $verify = "UPDATE users SET isEmailConfirmed=1, token='' WHERE email='$email'";
        $user_verify = mysqli_query($connection, $verify);


        if ($user_verify) {


            include_once "PHPMailer/PHPMailer.php";
            include_once "PHPMailer/Exception.php";

            $mail = new PHPMailer();
            $mail->setFrom('no-reply@sugarmummyforyou.com');
            $mail->addAddress($email, $fname);
            $mail->Subject = "EARNING ACTIVATION";
            $mail->isHTML(true);
            $mail->Body = "
                            Please use the link below to activate your account to start earning:<br><br>
                            
                            <a href='../activate.php?activate=$email'>ACTIVATE EARNING</a>
                         ";

            if ($mail->send()) {

                $msg = 'your email has been verified';
                $msg1 = 'Check email for earnings activation link';
            }


//        $msg = 'your email has been verified';
//        $msg1 = 'Check email for earnings activation link';
//        $btn1 = 'ACTIVATE ONLINE';
//        $btn2 = 'USE A COUPON CODE';

        } else
            $msg = 'please check';
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


    </style>
</head>

<body>
    <div>
        <div class="container tpspace" style="margin-top: 5px;">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="text-center pspace" style="background-color: #ffffff;">
                        <h2 class="text-center"><strong>Hello,</strong></h2>
                        <hr><span class="text-center"><?php echo $msg; ?></span>
                        <p><?php echo $msg1; ?></p>
<!--                        <form>-->
<!--                            <div class="form-group"><button class="btn mypbtn" type="button">--><?php //echo $btn1; ?><!--</button></div>-->
<!--                        </form>-->
<!--                        <form>-->
<!--                            <div class="form-group"><button class="btn mypbtn" type="button">--><?php //echo $btn2; ?><!--</button></div>-->
<!--                            <p>To buy a coupon code,&nbsp;<a href="#">use this link</a></p>-->
<!--                        </form>-->
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </div>
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>