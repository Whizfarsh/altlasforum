<?php
if(isset($_POST['act_num']) &&!empty($_POST['act_num']) && isset($_POST['bankselected']) &&!empty($_POST['bankselected'])) {
    $accot_name = $_POST['act_num'];
    $bk_name = $_POST['bankselected'];

    // $url = 'https://api.paystack.co/bank/resolve?account_number=' . $accot_name . '&bank_code=' . $bk_name . '';

    $query = array(
            "recipientaccount"=> $accot_name,
            "destbankcode"=> $bk_name,
            "PBFPubKey"=> "FLWPUBK_TEST-54df797be3169920ac7c3c761d65b5b6-X"
          );

    $data_string = json_encode($query);

    $url = 'https://api.ravepay.co/flwv3-pug/getpaidx/api/resolve_account';

    $curl = curl_init($url);

    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);                                              
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'
        ));

    $response = curl_exec($curl);
    curl_close($curl);

    $dt = $response . PHP_EOL;
//    $data = ($dt);

    $dat = json_decode($dt, true);
    print_r($dt);
//     $status = $dat['status'];
//     $account_name = $dat['data']['account_name'];
//     if ($dat) {
//     echo "<input class='text-left' type='text' id='result' name='account_name' value='$account_name' readonly>";
// }else{
//         if($status == False)
//         echo "<input class='text-left' type='text' id='result' name='account_name' value='INCORRECT DETAILS' readonly>";
//     }
}
?>