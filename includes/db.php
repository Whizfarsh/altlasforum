<?php

$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "";
$db['db_name'] = "ccm";

foreach($db as $key => $value){
    define(strtoupper($key), $value);
};

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
mysqli_set_charset($connection, 'utf8');

//if($connection){
//    echo "we are connected";
//} else {
//    echo "Null";
//}
?>