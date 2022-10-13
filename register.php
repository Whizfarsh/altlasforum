<?php
    session_start();
?>
<?php include_once "includes/db.php" ?>
<?php
use PHPMailer\PHPMailer\PHPMailer;
$db_email = "";
$message = "Please Fill In All Starred Box With Correct Details For Security Reasons";
if(isset($_GET['wnp'])){
    $referra = $_GET['wnp'];
    $_SESSION['username'] = $referra;
    $referral = $_SESSION['username'];
}
if(isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $pnumber = $_POST['pnumber'];
    $password = $_POST['password'];
    $reflink = "http://localhost/atlas/register.php?wnp=$uname";





    if (!empty($fname) && !empty($uname) && !empty($email) && !empty($pnumber) && !empty($password)) {


        $ref_count = "SELECT * FROM users WHERE uname='$referral'";
        $ref_count_data = mysqli_query($connection, $ref_count);

        while($row = mysqli_fetch_assoc($ref_count_data)){
            $refa_count = $row['referral_count'];
        }


        $fname = mysqli_real_escape_string($connection, $fname);
        $uname = mysqli_real_escape_string($connection, $uname);
        $email = mysqli_real_escape_string($connection, $email);
        $pnumber = mysqli_real_escape_string($connection, $pnumber);
        $password = mysqli_real_escape_string($connection, $password);


        $query = "SELECT * FROM users WHERE email='$email'";
        $email_result = mysqli_query($connection, $query);


        if(!$email_result){
            die("QUERY FAILED" . mysqli_error($connection));
        }

        while($row = mysqli_fetch_assoc($email_result)) {
            $user_id = $row['user_id'];
            $db_username = $row['uname'];
            $db_fullname = $row['fname'];
            $db_refa = $row['referral'];
            $db_pass = $row['password'];
            $db_email = $row['email'];
        }

        $uname_query = "SELECT * FROM users WHERE uname='$uname'";
        $uname_result = mysqli_query($connection, $uname_query);


        if(!$uname_result){
            die("QUERY FAILED" . mysqli_error($connection));
        }

        while($row = mysqli_fetch_assoc($uname_result)) {
            $user_id = $row['user_id'];
            $db_username = $row['uname'];
            $db_fullname = $row['fname'];
            $db_refa = $row['referral'];
            $db_pass = $row['password'];
            $db_email = $row['email'];
        }




        if($email == $db_email){
            $message = "Email already exist";
        }elseif($uname == $db_username){
            $message = "Username has been used";
        }else{
            $query = "SELECT randSalt FROM users";
            $select_randsalt_query = mysqli_query($connection, $query);

            if (!$select_randsalt_query) {
                die("QUERY FAILED" . mysqli_error($connection));
            }
            $row = mysqli_fetch_array($select_randsalt_query);
            $randsalt = $row['randSalt'];
            $password = crypt($password, $randsalt);
            $token = 'gncduksmccoutywnzjJDLQPROIWUDHGLAMZXVNM1236858';
            $token = str_shuffle($token);
            $token = substr($token, 0, 10);

            $query = "INSERT INTO users (fname, uname, referral, reflink, email, pnumber, password, token, user_image, isEmailConfirmed) VALUES ('{$fname}', '{$uname}', '{$referral}', '{$reflink}', '{$email}', '{$pnumber}', '{$password}', '', '0', '1')";
            $result = mysqli_query($connection, $query);

            if (!$result) {
                die("QUERY FAILED" . mysqli_error($connection)) . '' . mysqli_errno($connection);
            }
//             include_once "PHPMailer/PHPMailer.php";
//             include_once "PHPMailer/Exception.php";

//             $mail = new PHPMailer();
//             $mail->setFrom('no-reply@sugarmummyforyou.com');
//             $mail->addAddress($email, $fname);
//             $mail->Subject = "Please verify email!";
//             $mail->isHTML(true);
//             $mail->Body = "
//                     Please click on the link below:<br><br>
                    
//                     <a href='http://sugarmummyforyou.com/confirm.php?email=$email&token=$token'>CLICK HERE</a>
//                  ";
//             if ($mail->send()) {
//                 $ref_count = "SELECT * FROM users WHERE uname='$referral'";
//                 $ref_count_data = mysqli_query($connection, $ref_count);

//                 while($row = mysqli_fetch_assoc($ref_count_data)){
//                     $refa_count = $row['referral_count'];
//                     $refa_count = $refa_count+1;
//                 }
//                 $refa_count_update = "UPDATE users SET referral_count='$refa_count' WHERE uname='$referral'";
//                 $refa_count_update_query = mysqli_query($connection, $refa_count_update);

//                 if($refa_count_update_query){
//                     $message = "Registration Successful, Check Your Email To Verify";
//                 }else{
//                     echo 'mistake';
//                 }

// //                $message = "Registration Successful, Check Your Email To Verify";
//             } else {
//                 $message = "Mailer Error: . $mail->ErrorInfo";
//             }
                header("Location: activate.php?activate=$email");

        }




    }else{
        $message = "some fields are empty";
    }

}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Register || Atlas-forum</title>
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

<body style="background-color: #e6e6fa;">
    <nav class="navbar navbar-light navbar-expand" style="height: 80px;background-color: #eb5d23;">
        <div class="container"><a class="navbar-brand text-center"><img class="img-fluid mx-auto d-block" src="assets/img/atlas200w.png" style="width: 200px;height: 88px;margin-top: -15%;"></a></div>
    </nav>

    <div class="hdspace">
        <div class="container">
            <div class="text-center"><img src="assets/img/970.jpg"></div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-3 col-xl-1"></div>
            <div class="col-md-6 col-xl-6" style="background-color: rgba(255,255,255,0);margin-bottom: 30px;margin-right: 10px;margin-left: 10px;">
                <div class="text-center"></div>
                <div class="container hd" style="background-color: #ffffff;">
                    <form method="post" style="padding: 10px;padding-bottom: 30px;">
                        <h3 class="text-center" style="color: #000000;"><strong>Create an account.</strong></h3>
                        <h6 class="text-center"><b><?php echo $message ; ?></b></h6>
                        <div class="form-group"><label><strong>Full Name</strong><span class="text-danger"><strong>*</strong></span></label><input class="form-control" type="text" name="fname" required=""></div>
                        <div class="form-group"><label><strong>Username</strong><span class="text-danger"><strong>*</strong></span></label><input class="form-control" type="text" name="uname" required="" maxlength="10"></div>
                        <div class="form-group"><label><strong>Email</strong><span class="text-danger"></span><span class="text-danger"><strong>*</strong></span></label><input class="form-control" type="email" name="email" required=""></div>
                        <div class="form-group"><label><strong>Phone Number</strong><span class="text-danger"><strong>*</strong></span></label><input class="form-control" type="number" name="pnumber" required=""></div>
                        <div class="form-group"><label><strong>Password</strong><span class="text-danger"><strong>*</strong></span></label><input class="form-control" type="password" name="password" required=""></div>
                        <div class="form-group"><label><strong>Confirm Password&nbsp;</strong><span class="text-danger"><strong>*</strong></span></label><input class="form-control" type="password" name="password" required=""></div>
                        <div class="form-group" required="">
                            <div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-1" style="width: 13px;" required=""><label class="form-check-label" for="formCheck-1">Yes, I have read and agree to the website&nbsp;<a href="https://nnuforum.com/tos" class="term"><strong><span style="text-decoration: underline;">terms</span></strong></a><br></label></div>
                        </div>
                        <div class="form-group" style="padding-top: 10px;"><button class="btn mypbtn btn-block" type="submit" name="submit" style=""><strong>REGISTER</strong></button></div>You already have an account?<a class="already" href="login.php" style="margin-bottom: 10px;color: #000;"> Login here.</a></form>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 col-xl-4" style="">
                <div class="side sida"></div>
            </div>
        </div>
    </div>
<?php include_once "includes/footer.php" ?>