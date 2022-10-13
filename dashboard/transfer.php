<?php
if(isset($_POST['withdraw'])) {
    $eafearnings = $_POST['eafearnings'];
    $eatearnings = $_POST['eatearnings'];
    $act_num = $_POST['act_num'];
    $account_name = $_POST['account_name'];
    $bank_name = $_POST['bank'];

    echo $eafearnings;
    echo '<br>';
    echo $eatearnings;
    echo '<br>';
    echo $act_num;
    echo '<br>';
    echo $account_name;
    echo '<br>';
    echo $bank_name;

    // curl -X POST -H "Authorization: Bearer SECRET_KEY" -H "Content-Type: application/json" -d '{ 
    //     "type": "nuban",
    //     "name": "Zombie",
    //     "description": "Zombier",
    //     "account_number": "01000000010",
    //     "bank_code": "044",
    //     "currency": "NGN",
    //     "metadata": {
    //        "job": "Flesh Eater"
    //      }
    //   }' "https://api.paystack.co/transferrecipient"

    $url = 'https://api.paystack.co/transferrecipient';

    $curl = curl_init($url);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode([
        "type"=> "nuban",
        "name"=> "$account_name",
        "description"=> "ATLAS",
        "account_number"=> "$act_num",
        "bank_code"=> "$bank_name",
        "currency"=> "NGN",
        "metadata"=> [
            "job"=> "ATFRM"]
    ]));
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'X-PaystackAPI-Host: https://api.paystack.co/transferrecipient',
        'Authorization: Bearer sk_test_ecd4548f0249638de1fcd2063e167255d7d2f651',
        'Content-Type: application/json'
    ]);

    $response = curl_exec($curl);
    curl_close($curl);

    $dt = $response . PHP_EOL;
//    $data = ($dt);

    $dat = json_decode($dt, true);
    $status = $dat['status'];
    $recipient = $dat['data']['recipient_code'];
    if ($status == true) {
    echo $recipient;
}else{
        if($status == False)
        echo "<input class='text-left' type='text' id='result' name='account_name' value='INCORRECT DETAILS' readonly>";
    }
}
?>