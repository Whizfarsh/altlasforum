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
$activation = "";
function redirect()
{
    header('Location: login.php');
    exit();
}

//if (!isset($_GET['activate'])) {
//    redirect();
//    exit();
//}

if (isset($_GET['activate'])) {

    $email = mysqli_real_escape_string($connection, $_GET['activate']);

    $_SESSION['email'] = $email;

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($connection, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $user_id = $row['user_id'];
        $db_username = $row['uname'];
        $db_fullname = $row['fname'];
        $db_phone = $row['pnumber'];
        $db_email = $row['email'];
        $db_refa = $row['referral'];
        $db_pass = $row['password'];
        $confirmation = $row['isEmailConfirmed'];
        $activation = $row['isActivated'];
        $user_daily_login = $row['user_daily_login'];
    }
}
if($activation == 1){
    redirect();
    exit();
}
if (isset($_GET['usecoupon'])) {

    $activation = mysqli_real_escape_string($connection, $_GET['usecoupon']);

    $sql = "SELECT * FROM users WHERE email='$activation'";
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
    }
}
if (isset($_GET['activate'])) {
            $amount = "1500";

            $_SESSION['username'] = $db_username;

            echo "<div>";
            echo "<div class=\"container tpspace\" style=\"\">";
            echo "<div class=\"row\">";
            echo "<div class=\"col-md-3\">";
            echo "</div>";
            echo "<div class=\"col-md-6\">";
            echo "<div class=\"text-center\"><img src=\"assets/img/atlas200c.png\"></div>";
            echo "<div class=\"text-center pspace\" style=\"background-color: #ffffff;\">";
            echo "<h2 class=\"text-center\"><strong>Hello, $db_username</strong></h2>";
            echo "<hr>";
            echo "<p>";
            echo "The purpose for activation is to initiate the earning functionality, which can be done by using either of the method below.";
            echo " Please take note that the activation cost just NGN$amount.";
            echo "<br>";
            echo "<b>Buy coupon code from our trusted agent to avoid scamming</b>";
            echo "<br>";
            echo "<a id=\"link\" href=\"./dashboard/verify.php\"><b>Buy coupon code here</b></a>";
            echo "</p>";
//            echo "<br>";
            echo "<h3 class=\"text-center\" style=\"margin-top: 5px;\">";
            echo '<form>
            <script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
            <button class="href" type="button" onClick="payWithRave()">USE FLUTTERWAVE</button>
        </form>
        
        <script>
            const API_publicKey = "FLWPUBK_TEST-54df797be3169920ac7c3c761d65b5b6-X";
        
            function payWithRave() {
                var x = getpaidSetup({
                    PBFPubKey: API_publicKey,
                    customer_email: "'.$db_email.'",
                    amount: 10,
                    customer_phone: "'.$db_phone.'",
                    currency: "NGN",
                    txref: "rave-"+Math.floor((Math.random() * 1000000000) + 1),
                    meta: [{
                        metaname: "flightID",
                        metavalue: "AP1234"
                    }],
                    onclose: function() {},
                    callback: function(response) {
                        var txref = response.data.txRef; // collect txRef returned and pass to a server page to complete status check.
                        console.log("This is the response returned after a charge", response);
                        // if (
                        //     response.data.tx.chargeResponseCode == 00 ||
                        //     response.data.tx.chargeResponseCode == 0
                        // ) {
                        //     // redirect to a success page
                        //     window.location = \'./dashboard/verify.php?reference=\' + response.data.tx.txRef;
                        // } else {
                        //     // redirect to a failure page.
                        //     window.location = \'./dashboard/verify.php?check=\' + response.success;
                        // }
        
                        x.close(); // use this to close the modal immediately after payment.
                    }
                });
            }
        </script>';
//             echo '<form >
//   <script src="https://js.paystack.co/v1/inline.js"></script>
//   <button class="href" type="button" onclick="payWithPaystack()"> PAY WITH CARD </button> 
// </form>
 
// <script>
//   function payWithPaystack(){
//     var handler = PaystackPop.setup({
//       key: \'pk_test_b59219761cea46f7db87140ca8ab89853591691d\',
//       email: \''.$db_email.'\',
//       amount: 1000,
//       currency: "NGN",
//       ref: \'\'+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
//       metadata: {
//          custom_fields: [
//             {
//                 display_name: "Mobile Number",
//                 variable_name: "mobile_number",
//                 value: "+2348012345678"
//             }
//          ]
//         },
//         callback: function(response){
//         // post to server to verify transaction before giving value
//         window.location = \'./dashboard/verify.php?reference=\' + response.reference;
// //        alert("var verifying");
// //        verifying.done(function( data ) { /* give value saved in data */ });
//       },
// //      callback: function(response){
// //          alert(\'success. transaction ref is \' + response.reference);
// //          alert(\'success. transaction ref is \' + response.reference);
// //      },
// //      onClose: function(){
// //          alert(\'window closed\');
// //      }
//     });
//     handler.openIframe();
//   }
// </script>';
//            echo '<br>';
//            echo "<a class=\"href\" href=\"../activate.php?activate\">PAY WITH CARD</a>";
            echo "</h3>";
            echo "<b>OR</b>";
            echo "<br>";
            echo "<h3 class=\"text-center\" style=\"margin-top: 10px;\">";
            echo "<a class=\"href\" href=\"../atlas/activate.php?usecoupon=$db_email\">USE A COUPON CODE</a>";
            echo "</h3>";
            echo "</div>";
            echo "</div>";
            echo "<div class=\"col-md-3\">";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
            if (isset($_GET['usecoupon'])) {
                echo "<div>";
                echo "<div class=\"container tpspace\" style=\"\">";
                echo "<div class=\"row\">";
                echo "<div class=\"col-md-3\">";
                echo "</div>";
                echo "<div class=\"col-md-6\">";
                echo "<div class=\"text-center\"><img src=\"assets/img/atlas200c.png\"></div>";
                echo "<div class=\"text-center pspace\" style=\"background-color: #ffffff;\">";
                echo "<form method='post' action='activating.php?user=$db_username'>";
                echo "<input class='text-center' type=\"text\" name='usercoupon' placeholder='INSERT COUPON CODE HERE' required>";
                echo "<br>";
                echo "<input class=\"btn mypbtn\" type=\"submit\" name='coupon'>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
                echo "<div class=\"col-md-3\">";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
?>
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
