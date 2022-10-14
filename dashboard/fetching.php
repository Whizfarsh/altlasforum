<?php 
include '../includes/db.php';
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
$gurl = 'https://api.ravepay.co/v2/gpx/transfers';

$gcurl = curl_init($gurl);

curl_setopt($gcurl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($gcurl, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($gcurl, CURLOPT_POSTFIELDS, json_encode([
"seckey"=> "****************************"
]));
curl_setopt($gcurl, CURLOPT_HTTPHEADER, [
'Content-Type: application/json'
]);

$resps = curl_exec($gcurl);
curl_close($gcurl);

$gt = $resps . PHP_EOL;
//    $data = ($dt);

$gett = json_decode($gt, true);

$trans = $gett['data']['transfers']['0'];
$trans_status = $gett['data']['transfers']['0']['status'];
$trans_fullname = $gett['data']['transfers']['0']['fullname'];
$trans_amount = $gett['data']['transfers']['0']['amount'];
print_r($trans);
echo '<br>';
if($trans_status == 'SUCCESSFUL'){
    $user_query = "SELECT * FROM cashout WHERE account_name = '$trans_fullname'";
    $user_queried = mysqli_query($connection, $user_query);
    if(!$user_queried){
        echo 'wrong';
    }else{
        while($row = mysqli_fetch_assoc($user_queried)){
            $accountname = $row['account_name'];
            $username = $row['username'];
            $amount = $row['amount'];
            $message = $row['message'];
        }

        echo $username;
    }

    echo $username;
    
    // if($trans_fullname == $account_name){
    //     echo 'yes';
    // }
    
}
?>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
