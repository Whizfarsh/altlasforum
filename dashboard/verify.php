<?php
    session_start();
?>
<?php
    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
    }
// echo $username;
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

        .hmkey{
            margin-right: 15px;
            font-size: 20px;
            font-weight: bold;
            color: #eb5d23;
        }
        /* .hmkey:hover{
            color: #e6e6fa;
            background-color: #eb5d23;

        } */

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
            color: #000000;
            font-size: 1.5em;
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
$trans_ref = '';
include '../includes/db.php';
    if (isset($_GET['reference'])) {
        $ref = $_GET['reference'];
        $amount = 10; //Correct Amount from Server
        $currency = "NGN"; //Correct Currency from Server


        
    $refs_query = "SELECT trans_reference FROM users WHERE trans_reference='$ref'";
    $refs = mysqli_query($connection, $refs_query);

    while($row = mysqli_fetch_assoc($refs)){
        $trans_ref = $row['trans_reference'];
    }

    if($ref == $trans_ref){
        echo "<div>";
                echo "<div class=\"container tpspace\" style=\"\">";
                echo "<div class=\"row\">";
                echo "<div class=\"col-md-3\">";
                echo "</div>";
                echo "<div class=\"col-md-6\">";
                echo "<div class=\"text-center\"><img src=\"../assets/img/atlas200c.png\"></div>";
                echo "<div class=\"text-center pspace\" style=\"background-color: #ffffff;\">";
                echo "<div class='hmkey'>Oops !!! Something Went Wrong</div>";
                echo "</div>";
                echo "</div>";
                echo "<div class=\"col-md-3\">";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
    }else{

        $query = array(
            "SECKEY" => "FLWSECK_TEST-8fb35e66be0a88cbf9a3c7c0ada9536c-X",
            "txref" => $ref 
        );

        $data_string = json_encode($query);
                
        $ch = curl_init('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify');                                                                      
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                              
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($ch);

        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_size);
        $body = substr($response, $header_size);

        curl_close($ch);

        $resp = json_decode($response, true);

        // print_r($resp);

        $paymentStatus = $resp['data']['status'];
        $chargeResponsecode = $resp['data']['chargecode'];
        $chargeAmount = $resp['data']['amount'];
        $chargeCurrency = $resp['data']['currency'];

        if (($chargeResponsecode == 00 || $chargeResponsecode == 0) && ($chargeAmount == $amount)  && ($chargeCurrency == $currency)) {
          // transaction was successful...
             // please check other things like whether you already gave value for this ref
          // if the email matches the customer who owns the product etc
          //Give Value and return to Success page

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
                    $activation = $activation+1;

                    $transf = "UPDATE users SET trans_reference='$ref', isActivated=1, at_earnings='$at_earnings' WHERE uname='$username'";
                    $transf_query = mysqli_query($connection, $transf);


                    $select_referral = "SELECT * FROM users WHERE uname='$db_refa'";
                    $selected = mysqli_query($connection, $select_referral);

                    while ($row = mysqli_fetch_array($selected)) {
                        $af_earnings = $row['af_earnings'];
                        }
                    $af_earnings = $af_earnings + 1000;

                    $query = "UPDATE users SET af_earnings='$af_earnings' WHERE uname='$db_refa'";
                    $user_earnings_query = mysqli_query($connection, $query);
             
          
            if (!$transf_query && $user_earnings_query) {
              die("QUERY FAILED" . mysqli_error($connection)) . '' . mysqli_errno($connection);
            }else{
                echo "<div>";
                echo "<div class=\"container tpspace\" style=\"\">";
                echo "<div class=\"row\">";
                echo "<div class=\"col-md-3\">";
                echo "</div>";
                echo "<div class=\"col-md-6\">";
                echo "<div class=\"text-center\"><img src=\"../assets/img/atlas200c.png\"></div>";
                echo "<div class=\"text-center pspace\" style=\"background-color: #ffffff;\">";
                echo "<div class='hmkey'>Your Account Has Been Activated Successfully</div>";
                echo "<a id='link' href=''>LOGIN HERE</a>";
                echo "</div>";
                echo "</div>";
                echo "<div class=\"col-md-3\">";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";

                // header('Location: ../login.php');
            
            }
        } else {
            //Dont Give Value and return to Failure page
        }
    }
}
        else {
      die('No reference supplied');
    }



// if(isset($_GET['reference'])){

//     $reference = $_GET['reference'];

//     $ref_query = "SELECT trans_reference FROM users WHERE trans_reference='$reference'";
//     $ref = mysqli_query($connection, $ref_query);

//     while($row = mysqli_fetch_assoc($ref)){
//         $tran_ref = $row['trans_reference'];
//     }

//     if($reference == $tran_ref){
//         echo "<div>";
//                 echo "<div class=\"container tpspace\" style=\"\">";
//                 echo "<div class=\"row\">";
//                 echo "<div class=\"col-md-3\">";
//                 echo "</div>";
//                 echo "<div class=\"col-md-6\">";
//                 echo "<div class=\"text-center\"><img src=\"../assets/img/atlas200c.png\"></div>";
//                 echo "<div class=\"text-center pspace\" style=\"background-color: #ffffff;\">";
//                 echo "<div class='hmkey'>Oops !!! Something Went Wrong</div>";
//                 echo "</div>";
//                 echo "</div>";
//                 echo "<div class=\"col-md-3\">";
//                 echo "</div>";
//                 echo "</div>";
//                 echo "</div>";
//                 echo "</div>";
//     }else{

//     $result = array();
//     //The parameter after verify/ is the transaction reference to be verified
//     $url = 'https://api.paystack.co/transaction/verify/'.$reference.'';
    
//     $ch = curl_init();
//     curl_setopt($ch, CURLOPT_URL, $url);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//     curl_setopt(
//       $ch, CURLOPT_HTTPHEADER, [
//         'Authorization: Bearer sk_test_ecd4548f0249638de1fcd2063e167255d7d2f651']
//     );
//     $request = curl_exec($ch);
//     curl_close($ch);
    
//     if ($request) {
//         $result = json_decode($request, true);
//         // print_r($result);
//         if($result){
//           if($result['data']){
//             //something came in
//             if($result['data']['status'] == 'success'){
//               // the transaction was successful, you can deliver value
//               /* 
//               @ also remember that if this was a card transaction, you can store the 
//               @ card authorization to enable you charge the customer subsequently. 
//               @ The card authorization is in: 
//               @ $result['data']['authorization']['authorization_code'];
//               @ PS: Store the authorization with this email address used for this transaction. 
//               @ The authorization will only work with this particular email.
//               @ If the user changes his email on your system, it will be unusable
//               */

//               $trans = "UPDATE users SET trans_reference='$reference', isActivated=1 WHERE uname='$username'";
//               $trans_query = mysqli_query($connection, $trans);

//               if (!$trans_query) {
//                 die("QUERY FAILED" . mysqli_error($connection)) . '' . mysqli_errno($connection);
//             }else{
//                 // echo "<div>";
//                 // echo "<div class=\"container tpspace\" style=\"\">";
//                 // echo "<div class=\"row\">";
//                 // echo "<div class=\"col-md-3\">";
//                 // echo "</div>";
//                 // echo "<div class=\"col-md-6\">";
//                 // echo "<div class=\"text-center\"><img src=\"../assets/img/atlas200c.png\"></div>";
//                 // echo "<div class=\"text-center pspace\" style=\"background-color: #ffffff;\">";
//                 // echo "<div class='hmkey'>Your Account Has Been Activated Successfully</div>";
//                 // echo "<a id='link' href=''>LOGIN HERE</a>";
//                 // echo "</div>";
//                 // echo "</div>";
//                 // echo "<div class=\"col-md-3\">";
//                 // echo "</div>";
//                 // echo "</div>";
//                 // echo "</div>";
//                 // echo "</div>";

//                 header('Location: ../login.php');
              
//             }

              
//             }else{
//               // the transaction was not successful, do not deliver value'
//               // print_r($result);  //uncomment this line to inspect the result, to check why it failed.
//               echo "Transaction was not successful: Last gateway response was: ".$result['data']['gateway_response'];
//             }
//           }else{
//             echo $result['message'];
//           }
    
//         }else{
//           //print_r($result);
//           die("Something went wrong while trying to convert the request variable to json. Uncomment the print_r command to see what is in the result variable.");
//         }
//       }else{
//         //var_dump($request);
//         die("Something went wrong while executing curl. Uncomment the var_dump line above this line to see what the issue is. Please check your CURL command to make sure everything is ok");
//       }
//     }


// }

// // Confirm that reference has not already gotten value
// // This would have happened most times if you handle the charge.success event.
// // If it has already gotten value by your records, you may call
// // perform_success()

// // Get this from https://github.com/yabacon/paystack-class
// require 'Paystack.php';
// // if using https://github.com/yabacon/paystack-php
// // require 'paystack/autoload.php';

// $paystack = new Paystack('sk_test_xxx');
// // the code below throws an exception if there was a problem completing the request,
// // else returns an object created from the json response
// $trx = $paystack->transaction->verify(
//     [
//         'reference'=>$_GET['reference']
//     ]
// );
// // status should be true if there was a successful call
// if(!$trx->status){
//     exit($trx->message);
// }
// // full sample verify response is here: https://developers.paystack.co/docs/verifying-transactions
// if('success' == $trx->data->status){
//     // use trx info including metadata and session info to confirm that cartid
//     // matches the one for which we accepted payment
//     give_value($reference, $trx);
//   perform_success();
// }

// // functions
// function give_value($reference, $trx){
//     // Be sure to log the reference as having gotten value
//     // write code to give value
// }

// function perform_success(){
//     // inline
//     echo json_encode(['verified'=>true]);
//     // standard
//     header('Location: /success.php');
//     exit();
// }
?>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>