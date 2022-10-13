<?php

if(isset($_POST['withdraw'])) {
    $eafearnings = $_POST['eafearnings'];
    $eatearnings = $_POST['eatearnings'];
    $act_num = $_POST['act_num'];
    $account_name = $_POST['act_name'];
    $bank_name = $_POST['bank'];
    $tot_earnings = $eafearnings+$eatearnings;

    echo $eafearnings;
    echo '<br>';
    echo $eatearnings;
    echo '<br>';
    echo $act_num;
    echo '<br>';
    echo $account_name;
    echo '<br>';
    echo $bank_name;
    echo '<br>';
    echo $tot_earnings;
    echo '<br>';

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
    $message = $dat['message'];
    $account_number = $dat['data']['account_number'];
    $bank_code = $dat['data']['bank_code'];
    $fullname = $dat['data']['fullname'];
    $bank_name = $dat['data']['bank_name'];
    // $recipient = $dat['data']['recipient_code'];
    // echo '<br>';
    // echo $status;
    // echo '<br>';
    // echo $message;
    // echo '<br>';
    // echo $account_number;
    // echo '<br>';
    // echo $bank_code;
    // echo '<br>';
    // echo $fullname;
    // echo '<br>';
    // echo $bank_name;
    // echo '<br>';

    if($cstatus == 'success'){

    }else{
        echo 'An Error Occured';
    }



}


?>