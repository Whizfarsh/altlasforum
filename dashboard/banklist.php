<?php 

// Ssckey 
// curl --request GET \
//   --url 'https://api.ravepay.co/v2/gpx/transfers/beneficiaries?seckey=seckey' \
//   --header 'content-type: application/json'

$url = 'https://api.ravepay.co/v2/gpx/transfers/beneficiaries?seckey=FLWSECK_TEST-8fb35e66be0a88cbf9a3c7c0ada9536c-X';

    $curl = curl_init($url);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);

    $response = curl_exec($curl);
    curl_close($curl);

    $dt = $response . PHP_EOL;
//    $data = ($dt);

    $dat = json_decode($dt, true);

    print_r($dat);
    
    $benstatus = $dat['status'];
    $message = $dat['message'];
    $recipient_id = $dat['data']['payout_beneficiaries']['0']['id'];
    
    // echo $recipient_id;

    // print_r($recipient_id);

    if($benstatus){

        $turl = 'https://api.ravepay.co/v2/gpx/transfers/create';

        $curl = curl_init($turl);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode([
        "account_bank"=> "$bank_name",
        "account_number"=> "$act_num",
        "amount"=> "$tot_earnings",
        "seckey"=> "FLWSECK_TEST-8fb35e66be0a88cbf9a3c7c0ada9536c-X",
        "narration"=> "ATLAS FORUM",
        "currency"=> "NGN",
        "reference"=> "mk-$refk-jk",
        "beneficiary_name"=> "$act_num"
    ]));
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);

    $response = curl_exec($curl);
    curl_close($curl);

    $tf = $response . PHP_EOL;
//    $data = ($dt);

    $tfr = json_decode($dt, true);

    print_r($tfr);

        
          
          // This is only available for the following currencies NGN, KES, UGX, TZS, ZAR, GHS & XOF
    }


?>