<?php
    
    // $tot_earnings = $eafearnings+$eatearnings;

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

?>
--------

if($af_earnings == 4000 && $at_earnings <= 5000){

// $eat_earnings = floor($at_earnings * 0.50);
if(($af_earnings + $at_earnings) <= 8000){

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
echo "<input class='text-left' type=\"text\" id='eatearn' name='eatearnings' value='$at_earnings' readonly>";
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
if($af_earnings >= 5000){

// $eat_earnings = floor($at_earnings * 0.90);

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
echo "<input class='text-left' type=\"text\" id='eatearn' name='eatearnings' value='$at_earnings' readonly>";
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
echo "<input class=\"btn mypbtn\" type=\"submit\" id='withdrawn' name='actwithdraw' value='WITHDRAW EARNINGS'>";
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