<?php
include '../includes/db.php';


// curl --request GET \
//   --url 'https://api.ravepay.co/v2/gpx/transfers?seckey=seckey&batch_id=batch_id' \
//   --header 'content-type: application/json'

$url = 'https://api.ravepay.co/v2/gpx/transfers?seckey=FLWSECK_TEST-8fb35e66be0a88cbf9a3c7c0ada9536c-X';

    $curl = curl_init($url);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
    // curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode([
    //     "account_number"=> "$act_num",
    //     "account_bank"=> "$bank_name",
    //     "seckey"=> "FLWSECK_TEST-8fb35e66be0a88cbf9a3c7c0ada9536c-X",
    // ]));
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);

    $response = curl_exec($curl);
    curl_close($curl);

    $dt = $response . PHP_EOL;
//    $data = ($dt);

    $dat = json_decode($dt, true);
    // print_r($dat);

    




?>