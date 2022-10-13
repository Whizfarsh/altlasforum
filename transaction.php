<?php
    session_start();
?>
<?php
    include 'includes/db.php';

    if(isset($_SESSION['email']));{
    $email = $_SESSION['email'];

    if($email) {
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($connection, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
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

            $at_earnings = $at_earnings+900;

        }

        $activation_data = "UPDATE users SET isActivated=1, at_earnings='$at_earnings' WHERE email='$email'";
        $activation_confirmation = mysqli_query($connection, $activation_data);

        if($activation_confirmation){
            header("Location: ../atlas/login.php");
        }else{
            echo "error";
        }



    }



}
?>
