<?php
session_start();
?>
<?php
$message = '';
include '../includes/db.php';
$refk = rand();

?>
    <!DOCTYPE html>
    <html>

    <head>
        <script src="../assets/js/jquery-3.2.1.min.js"></script>
        <script>
            $(document).ready(function(){
                $("button").click(function(){
                    var af_earning=$("#afearn").val();
                    var eat_earning=$("#eatearn").val();
                    var bank_name=$("#bankselected").find(":selected").val();;
                    var account_name=$("#account_name").val();
                    var account_num=$("#account_num").val();
                    $.ajax({
                        url:'processed.php',
                        data:{afearn:af_earning, eat_earning:eatearn, account_name:account_name, account_num:account_num, bankselected:bank_name},
                        type:'POST',
                        success:function(data) {
                            $("#result").html(data);
                        }
                    });
                });

            });
        </script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Withdraw || Atlas-forum</title>
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


            .hhkey{
                margin-right: 15px;
                font-size: 20px;
                color: #eb5d23;
                margin-bottom: 10px;
            }
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
$username = "";
if(isset($_SESSION['username']));
$username = $_SESSION['username'];
//if(isset($_GET['postid'])){
//    $postid = $_GET['id'];
//}
    if($username){
        $user_query = "SELECT * FROM users WHERE uname='$username'";
        $user_queried = mysqli_query($connection, $user_query);

        while($row = mysqli_fetch_assoc($user_queried)){
            $user_role = $row['user_role'];
            $at_earnings = $row['at_earnings'];
            $af_earnings = $row['af_earnings'];
            $refa_count = $row['referral_count'];
        }

    }
    
?>
<?php
// include '../includes/db.php';
if(isset($_POST['withdraw'])) {
    $eafearnings = $_POST['eafearnings'];
    $eatearnings = $_POST['eatearnings'];
    $act_num = $_POST['act_num'];
    $account_name = $_POST['act_name'];
    $bank_name = $_POST['bank'];
    $tot_earnings = $eafearnings+$eatearnings;

    // echo '<ul id="result"><li>'.$eatearnings.'</li><li>'.$eafearnings.'</li><li>'.$actnum.'</li><li>'.$account_name.'</li>
    // <li>'.$bank_name.'</li><li>'.$tot_earnings.'</li>
    // </u>'

    $url = 'https://api.ravepay.co/v2/gpx/transfers/beneficiaries/create';

    $curl = curl_init($url);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode([
        "account_number"=> "$act_num",
        "account_bank"=> "$bank_name",
        "seckey"=> "FLWSECK_TEST-8fb35e66be0a88cbf9a3c7c0ada9536c-X",
    ]));
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);

    $response = curl_exec($curl);
    curl_close($curl);

    $dt = $response . PHP_EOL;
//    $data = ($dt);

    $dat = json_decode($dt, true);
    $cstatus = $dat['status'];
    $cmessage = $dat['message'];
    $account_number = $dat['data']['account_number'];
    $bank_code = $dat['data']['bank_code'];
    $fullname = $dat['data']['fullname'];
    $bank_name = $dat['data']['bank_name'];

    if($cstatus == 'success'){

        $gurl = 'https://api.ravepay.co/v2/gpx/balance';

        $gcurl = curl_init($gurl);

    curl_setopt($gcurl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($gcurl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($gcurl, CURLOPT_POSTFIELDS, json_encode([
        "currency"=> "NGN",
        "seckey"=> "FLWSECK_TEST-8fb35e66be0a88cbf9a3c7c0ada9536c-X"
    ]));
    curl_setopt($gcurl, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);

    $resps = curl_exec($gcurl);
    curl_close($gcurl);

    $gt = $resps . PHP_EOL;
//    $data = ($dt);

    $gett = json_decode($gt, true);

    // print_r($gett);

    $available_balance = $gett['data']['AvailableBalance'];
//     echo '<br>';
//    echo $available_balance;

        if($available_balance > $tot_earnings){


          $uurl = 'https://api.ravepay.co/v2/gpx/transfers/create';

        $ccurl = curl_init($uurl);

    curl_setopt($ccurl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ccurl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ccurl, CURLOPT_POSTFIELDS, json_encode([
        "account_bank"=> "$bank_code",
        "account_number"=> "$account_number",
        "amount"=> "$tot_earnings",
        "seckey"=> "FLWSECK_TEST-8fb35e66be0a88cbf9a3c7c0ada9536c-X",
        "narration"=> "ATLAS FORUM",
        "currency"=> "NGN",
        "reference"=> "mk-$refk-jk",
        "beneficiary_name"=> "$fullname"
    ]));
    curl_setopt($ccurl, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);

    $resp = curl_exec($ccurl);
    curl_close($ccurl);

    $tf = $resp . PHP_EOL;
//    $data = ($dt);

    $tfr = json_decode($tf, true);

    // print_r($tfr);

    $tfstatus = $tfr['status'];
    $tfmessage = $tfr['message'];
    $tf_fullname = $tfr['data']['fullname'];
    $tf_account_number = $tfr['data']['account_number'];
    $tf_bank_name = $tfr['data']['bank_name'];
    $tf_reference = $tfr['data']['reference'];
    $tf_amount = $tfr['data']['amount'];


//     echo '<br>';
//     echo $tfstatus;
//     echo '<br>';
//     echo $tfmessage;
//     echo '<br>';
//     echo $tf_account_number;
//     echo '<br>';
//     echo $tf_bank_code;
//     echo '<br>';
//     echo $tf_fullname;
//     echo '<br>';
//     echo $tf_bank_name;
//     echo '<br>';
//     echo $tf_amount;



    $insert_query = "INSERT INTO cashout (username, account_name, account_number, bank_name, tf_reference, affiliate, activity, amount, bstatus) VALUE('$username', '$tf_fullname', '$tf_account_number', '$tf_bank_name', '$tf_reference', '$eafearnings', '$eatearnings', '$tf_amount', '1')";
    $insert_queried = mysqli_query($connection, $insert_query);


    if($insert_queried){

        $baf_earnings = $af_earnings - $eafearnings;
        $bat_earnings = $at_earnings - $eatearnings;

        $db_query = "UPDATE users SET af_earnings='$baf_earnings', at_earnings='$bat_earnings' WHERE uname='$username'";
        $db_queried = mysqli_query($connection, $db_query);

        if($db_queried){
        $message = '<b>Your Withdraw is Been Processed</>';
    }
    }else{
        echo 'Please Check Bank Details';
    }
    }
}
}

    ?>
<?php

$day = date("l");
$time = date("H:i");
$timefrom = date("00:09");
$timeto = date("24:59");
//$start = mktime(20, 33, 00, date("m"), date("d"), date("y"));


// echo $day;
//echo $day;
echo '<br>';
if($day == 'Tuesday' && ($time == $timefrom || $time <= $timeto)){

    if($af_earnings == 1000){

    $eat_earnings = floor($at_earnings * 0.40);

    echo "<div>";
    echo "<div class=\"container\" style=\"\">";
    echo "<div class=\"row\">";
    echo "<div class=\"col-md-3\">";
    echo "</div>";
    echo "<div class=\"col-md-6\">";
    echo "<div class=\"text-center\"><img src=\"../assets/img/atlas200c.png\"></div>";
    echo "<div class=\"text-left pspace\" style=\"background-color: #ffffff;\">";
    echo "<form method='post' action=''>";
    echo "<div class='text-center hhkey' styele='font-weight: bold;'>$message</div>";
    echo "<h4><b>AVAILABLE EARNINGS </b></h4>";
    echo "<labe><b>Affiliate Earnings: <b></b></labe>";
    echo "<input class='text-left' type=\"text\" name='afearnings' value='$af_earnings' required>";
    echo "<br>";
    echo "<labe>Acivity Earnings: </labe>";
    echo "<input class='text-left' type=\"text\" name='atearnings' value='$at_earnings' required>";
    echo "<br>";
    echo "<h4><b>ELIGIBLE EARNINGS</b></h4>";
    echo "<labe><b>Affiliate Earnings: <b></b></labe>";
    echo "<input class='text-left' type=\"text\" id='afearn' name='eafearnings' value='$af_earnings' readonly>";
    echo "<br>";
    echo "<labe>Acivity Earnings: </labe>";
    echo "<input class='text-left' type=\"text\" id='eatearn' name='eatearnings' value='$eat_earnings' readonly>";
    echo "<br>";
    echo "<h4><b>BANK DETAILS</b></h4>";
    echo "<labe><b>Account Number: <b></b></labe>";
    echo "<input class='text-left' type=\"text\" id='account_num' name='act_num' required>";
    echo "<br>";
    echo "<labe><b>Account Name: <b></b></labe>";
    echo "<input class='text-left' type=\"text\" id='account_name' name='act_name' required>";
    echo "<br>";
    echo "<labe>Select Bank: </labe>";
    echo "<select class='bg-grey-light' style='color: white; font-weight: bold; font-size: 18px;' name='bank' id='bankselected'>
<option value='044'>Access Bank</option>
<option value='023'>Citibank Nigeria</option>
<option value='063'>Diamond Bank</option>
<option value='050'>Ecobank Nigeria</option>
<option value='084'>Enterprise Bank</option>
<option value='070'>Fidelity Bank</option>
<option value='011'>First Bank of Nigeria</option>
<option value='309'>FBN Mobile</option>
<option value='214'>First City Monument Bank</option>
<option value='308'>FortisMobile</option>
<option value='058'>GTBank Plc</option>
<option value='030'>Heritage Bank</option>
<option value='082'>Keystone Bank</option>
<option value='560'>Page MFBank</option>
<option value='221'>Stanbic IBTC Bank</option>
<option value='304'>Stanbic Mobile Money</option>
<option value='076'>Sky Bank Bank</option>
<option value='068'>Standard Chartered Bank</option>
<option value='232'>Sterling Bank</option>
<option value='328'>TagPay</option>
<option value='033'>United Bank For Africa</option>
<option value='032'>Union Bank</option>
<option value='215'>Unity Bank</option>
<option value='035'>Wema Bank</option>
<option value='057'>Zenith Bank</option>

</select>";
    echo "<br>";
//    echo "<input class='text-left' type='text' id='result' name='bank_name' placeholder='' required>";

        // echo "<div id='result'></div>";
    echo "<br>";
    echo "<input style='width: 100%;' class=\"btn mypbtn\" type=\"submit\" id='withdrawn' name='withdraw' value='WITHDRAW EARNINGS'>";
    echo "</form>";
    echo "</div>";
    echo "</div>";
    echo "<div class=\"col-md-3\">";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    }
    if($af_earnings == 2000){

        $eat_earnings = floor($at_earnings * 0.50);

        echo "<div>";
    echo "<div class=\"container\" style=\"\">";
    echo "<div class=\"row\">";
    echo "<div class=\"col-md-3\">";
    echo "</div>";
    echo "<div class=\"col-md-6\">";
    echo "<div class=\"text-center\"><img src=\"../assets/img/atlas200c.png\"></div>";
    echo "<div class=\"text-left pspace\" style=\"background-color: #ffffff;\">";
    echo "<form method='post' action=''>";
    echo "<div class='text-center hhkey' styele='font-weight: bold;'>$message</div>";
    echo "<h4><b>AVAILABLE EARNINGS </b></h4>";
    echo "<labe><b>Affiliate Earnings: <b></b></labe>";
    echo "<input class='text-left' type=\"text\" name='afearnings' value='$af_earnings' required>";
    echo "<br>";
    echo "<labe>Acivity Earnings: </labe>";
    echo "<input class='text-left' type=\"text\" name='atearnings' value='$at_earnings' required>";
    echo "<br>";
    echo "<h4><b>ELIGIBLE EARNINGS</b></h4>";
    echo "<labe><b>Affiliate Earnings: <b></b></labe>";
    echo "<input class='text-left' type=\"text\" id='afearn' name='eafearnings' value='$af_earnings' readonly>";
    echo "<br>";
    echo "<labe>Acivity Earnings: </labe>";
    echo "<input class='text-left' type=\"text\" id='eatearn' name='eatearnings' value='$eat_earnings' readonly>";
    echo "<br>";
    echo "<h4><b>BANK DETAILS</b></h4>";
    echo "<labe><b>Account Number: <b></b></labe>";
    echo "<input class='text-left' type=\"text\" id='account_num' name='act_num' required>";
    echo "<br>";
    echo "<labe><b>Account Name: <b></b></labe>";
    echo "<input class='text-left' type=\"text\" id='account_name' name='act_name' required>";
    echo "<br>";
    echo "<labe>Select Bank: </labe>";
    echo "<select class='bg-grey-light' style='color: white; font-weight: bold; font-size: 18px;' name='bank' id='bankselected'>
<option value='044'>Access Bank</option>
<option value='023'>Citibank Nigeria</option>
<option value='063'>Diamond Bank</option>
<option value='050'>Ecobank Nigeria</option>
<option value='084'>Enterprise Bank</option>
<option value='070'>Fidelity Bank</option>
<option value='011'>First Bank of Nigeria</option>
<option value='309'>FBN Mobile</option>
<option value='214'>First City Monument Bank</option>
<option value='308'>FortisMobile</option>
<option value='058'>GTBank Plc</option>
<option value='030'>Heritage Bank</option>
<option value='082'>Keystone Bank</option>
<option value='560'>Page MFBank</option>
<option value='221'>Stanbic IBTC Bank</option>
<option value='304'>Stanbic Mobile Money</option>
<option value='076'>Sky Bank Bank</option>
<option value='068'>Standard Chartered Bank</option>
<option value='232'>Sterling Bank</option>
<option value='328'>TagPay</option>
<option value='033'>United Bank For Africa</option>
<option value='032'>Union Bank</option>
<option value='215'>Unity Bank</option>
<option value='035'>Wema Bank</option>
<option value='057'>Zenith Bank</option>

</select>";
    echo "<br>";
//    echo "<input class='text-left' type='text' id='result' name='bank_name' placeholder='' required>";

        // echo "<div id='result'></div>";
    echo "<br>";
    echo "<input class=\"btn mypbtn\" type=\"submit\" id='withdrawn' name='withdraw' value='WITHDRAW EARNINGS'>";
    echo "</form>";
    echo "</div>";
    echo "</div>";
    echo "<div class=\"col-md-3\">";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    }
    if($af_earnings == 3000){

        $eat_earnings = floor($at_earnings * 0.60);

        echo "<div>";
    echo "<div class=\"container\" style=\"\">";
    echo "<div class=\"row\">";
    echo "<div class=\"col-md-3\">";
    echo "</div>";
    echo "<div class=\"col-md-6\">";
    echo "<div class=\"text-center\"><img src=\"../assets/img/atlas200c.png\"></div>";
    echo "<div class=\"text-left pspace\" style=\"background-color: #ffffff;\">";
    echo "<form method='post' action=''>";
    echo "<div class='text-center hhkey' styele='font-weight: bold;'>$message</div>";
    echo "<h4><b>AVAILABLE EARNINGS </b></h4>";
    echo "<labe><b>Affiliate Earnings: <b></b></labe>";
    echo "<input class='text-left' type=\"text\" name='afearnings' value='$af_earnings' required>";
    echo "<br>";
    echo "<labe>Acivity Earnings: </labe>";
    echo "<input class='text-left' type=\"text\" name='atearnings' value='$at_earnings' required>";
    echo "<br>";
    echo "<h4><b>ELIGIBLE EARNINGS</b></h4>";
    echo "<labe><b>Affiliate Earnings: <b></b></labe>";
    echo "<input class='text-left' type=\"text\" id='afearn' name='eafearnings' value='$af_earnings' readonly>";
    echo "<br>";
    echo "<labe>Acivity Earnings: </labe>";
    echo "<input class='text-left' type=\"text\" id='eatearn' name='eatearnings' value='$eat_earnings' readonly>";
    echo "<br>";
    echo "<h4><b>BANK DETAILS</b></h4>";
    echo "<labe><b>Account Number: <b></b></labe>";
    echo "<input class='text-left' type=\"text\" id='account_num' name='act_num' required>";
    echo "<br>";
    echo "<labe><b>Account Name: <b></b></labe>";
    echo "<input class='text-left' type=\"text\" id='account_name' name='act_name' required>";
    echo "<br>";
    echo "<labe>Select Bank: </labe>";
    echo "<select class='bg-grey-light' style='color: white; font-weight: bold; font-size: 18px;' name='bank' id='bankselected'>
<option value='044'>Access Bank</option>
<option value='023'>Citibank Nigeria</option>
<option value='063'>Diamond Bank</option>
<option value='050'>Ecobank Nigeria</option>
<option value='084'>Enterprise Bank</option>
<option value='070'>Fidelity Bank</option>
<option value='011'>First Bank of Nigeria</option>
<option value='309'>FBN Mobile</option>
<option value='214'>First City Monument Bank</option>
<option value='308'>FortisMobile</option>
<option value='058'>GTBank Plc</option>
<option value='030'>Heritage Bank</option>
<option value='082'>Keystone Bank</option>
<option value='560'>Page MFBank</option>
<option value='221'>Stanbic IBTC Bank</option>
<option value='304'>Stanbic Mobile Money</option>
<option value='076'>Sky Bank Bank</option>
<option value='068'>Standard Chartered Bank</option>
<option value='232'>Sterling Bank</option>
<option value='328'>TagPay</option>
<option value='033'>United Bank For Africa</option>
<option value='032'>Union Bank</option>
<option value='215'>Unity Bank</option>
<option value='035'>Wema Bank</option>
<option value='057'>Zenith Bank</option>

</select>";
    echo "<br>";
//    echo "<input class='text-left' type='text' id='result' name='bank_name' placeholder='' required>";

        // echo "<div id='result'></div>";
    echo "<br>";
    echo "<input class=\"btn mypbtn\" type=\"submit\" id='withdrawn' name='withdraw' value='WITHDRAW EARNINGS'>";
    echo "</form>";
    echo "</div>";
    echo "</div>";
    echo "<div class=\"col-md-3\">";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    }
    if($af_earnings == 4000){

        $eat_earnings = floor($at_earnings * 0.75);

        echo "<div>";
    echo "<div class=\"container\" style=\"\">";
    echo "<div class=\"row\">";
    echo "<div class=\"col-md-3\">";
    echo "</div>";
    echo "<div class=\"col-md-6\">";
    echo "<div class=\"text-center\"><img src=\"../assets/img/atlas200c.png\"></div>";
    echo "<div class=\"text-left pspace\" style=\"background-color: #ffffff;\">";
    echo "<form method='post' action=''>";
    echo "<div class='text-center hhkey' styele='font-weight: bold;'>$message</div>";
    echo "<h4><b>AVAILABLE EARNINGS </b></h4>";
    echo "<labe><b>Affiliate Earnings: <b></b></labe>";
    echo "<input class='text-left' type=\"text\" name='afearnings' value='$af_earnings' required>";
    echo "<br>";
    echo "<labe>Acivity Earnings: </labe>";
    echo "<input class='text-left' type=\"text\" name='atearnings' value='$at_earnings' required>";
    echo "<br>";
    echo "<h4><b>ELIGIBLE EARNINGS</b></h4>";
    echo "<labe><b>Affiliate Earnings: <b></b></labe>";
    echo "<input class='text-left' type=\"text\" id='afearn' name='eafearnings' value='$af_earnings' readonly>";
    echo "<br>";
    echo "<labe>Acivity Earnings: </labe>";
    echo "<input class='text-left' type=\"text\" id='eatearn' name='eatearnings' value='$eat_earnings' readonly>";
    echo "<br>";
    echo "<h4><b>BANK DETAILS</b></h4>";
    echo "<labe><b>Account Number: <b></b></labe>";
    echo "<input class='text-left' type=\"text\" id='account_num' name='act_num' required>";
    echo "<br>";
    echo "<labe><b>Account Name: <b></b></labe>";
    echo "<input class='text-left' type=\"text\" id='account_name' name='act_name' required>";
    echo "<br>";
    echo "<labe>Select Bank: </labe>";
    echo "<select class='bg-grey-light' style='color: white; font-weight: bold; font-size: 18px;' name='bank' id='bankselected'>
<option value='044'>Access Bank</option>
<option value='023'>Citibank Nigeria</option>
<option value='063'>Diamond Bank</option>
<option value='050'>Ecobank Nigeria</option>
<option value='084'>Enterprise Bank</option>
<option value='070'>Fidelity Bank</option>
<option value='011'>First Bank of Nigeria</option>
<option value='309'>FBN Mobile</option>
<option value='214'>First City Monument Bank</option>
<option value='308'>FortisMobile</option>
<option value='058'>GTBank Plc</option>
<option value='030'>Heritage Bank</option>
<option value='082'>Keystone Bank</option>
<option value='560'>Page MFBank</option>
<option value='221'>Stanbic IBTC Bank</option>
<option value='304'>Stanbic Mobile Money</option>
<option value='076'>Sky Bank Bank</option>
<option value='068'>Standard Chartered Bank</option>
<option value='232'>Sterling Bank</option>
<option value='328'>TagPay</option>
<option value='033'>United Bank For Africa</option>
<option value='032'>Union Bank</option>
<option value='215'>Unity Bank</option>
<option value='035'>Wema Bank</option>
<option value='057'>Zenith Bank</option>

</select>";
    echo "<br>";
//    echo "<input class='text-left' type='text' id='result' name='bank_name' placeholder='' required>";

        // echo "<div id='result'></div>";
    echo "<br>";
    echo "<input class=\"btn mypbtn\" type=\"submit\" id='withdrawn' name='withdraw' value='WITHDRAW EARNINGS'>";
    echo "</form>";
    echo "</div>";
    echo "</div>";
    echo "<div class=\"col-md-3\">";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    }
    if($af_earnings >= 5000){

        $eat_earnings = floor($at_earnings * 0.90);

        echo "<div>";
    echo "<div class=\"container\" style=\"\">";
    echo "<div class=\"row\">";
    echo "<div class=\"col-md-3\">";
    echo "</div>";
    echo "<div class=\"col-md-6\">";
    echo "<div class=\"text-center\"><img src=\"../assets/img/atlas200c.png\"></div>";
    echo "<div class=\"text-left pspace\" style=\"background-color: #ffffff;\">";
    echo "<form method='post' action=''>";
    echo "<div class='text-center hhkey' styele='font-weight: bold;'>$message</div>";
    echo "<h4><b>AVAILABLE EARNINGS </b></h4>";
    echo "<labe><b>Affiliate Earnings: <b></b></labe>";
    echo "<input class='text-left' type=\"text\" name='afearnings' value='$af_earnings' required>";
    echo "<br>";
    echo "<labe>Acivity Earnings: </labe>";
    echo "<input class='text-left' type=\"text\" name='atearnings' value='$at_earnings' required>";
    echo "<br>";
    echo "<h4><b>ELIGIBLE EARNINGS</b></h4>";
    echo "<labe><b>Affiliate Earnings: <b></b></labe>";
    echo "<input class='text-left' type=\"text\" id='afearn' name='eafearnings' value='$af_earnings' readonly>";
    echo "<br>";
    echo "<labe>Acivity Earnings: </labe>";
    echo "<input class='text-left' type=\"text\" id='eatearn' name='eatearnings' value='$eat_earnings' readonly>";
    echo "<br>";
    echo "<h4><b>BANK DETAILS</b></h4>";
    echo "<labe><b>Account Number: <b></b></labe>";
    echo "<input class='text-left' type=\"text\" id='account_num' name='act_num' required>";
    echo "<br>";
    echo "<labe><b>Account Name: <b></b></labe>";
    echo "<input class='text-left' type=\"text\" id='account_name' name='act_name' required>";
    echo "<br>";
    echo "<labe>Select Bank: </labe>";
    echo "<select class='bg-grey-light' style='color: white; font-weight: bold; font-size: 18px;' name='bank' id='bankselected'>
<option value='044'>Access Bank</option>
<option value='023'>Citibank Nigeria</option>
<option value='063'>Diamond Bank</option>
<option value='050'>Ecobank Nigeria</option>
<option value='084'>Enterprise Bank</option>
<option value='070'>Fidelity Bank</option>
<option value='011'>First Bank of Nigeria</option>
<option value='309'>FBN Mobile</option>
<option value='214'>First City Monument Bank</option>
<option value='308'>FortisMobile</option>
<option value='058'>GTBank Plc</option>
<option value='030'>Heritage Bank</option>
<option value='082'>Keystone Bank</option>
<option value='560'>Page MFBank</option>
<option value='221'>Stanbic IBTC Bank</option>
<option value='304'>Stanbic Mobile Money</option>
<option value='076'>Sky Bank Bank</option>
<option value='068'>Standard Chartered Bank</option>
<option value='232'>Sterling Bank</option>
<option value='328'>TagPay</option>
<option value='033'>United Bank For Africa</option>
<option value='032'>Union Bank</option>
<option value='215'>Unity Bank</option>
<option value='035'>Wema Bank</option>
<option value='057'>Zenith Bank</option>

</select>";
    echo "<br>";
//    echo "<input class='text-left' type='text' id='result' name='bank_name' placeholder='' required>";

        // echo "<div id='result'></div>";
    echo "<br>";
    echo "<input class=\"btn mypbtn\" type=\"submit\" id='withdrawn' name='withdraw' value='WITHDRAW EARNINGS'>";
    echo "</form>";
    echo "</div>";
    echo "</div>";
    echo "<div class=\"col-md-3\">";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    }
}
    

?>

    <?php include_once "../includes/footer.php" ?>
