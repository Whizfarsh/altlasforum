<?php
if(isset($_POST['act_num']) &&!empty($_POST['act_num']) && isset($_POST['bankselected']) &&!empty($_POST['bankselected']))
{
    $accot_name = $_POST['act_num'];
    $bk_name = $_POST['bankselected'];

    echo "<input class='text-left' type='text' id='result' name='bank_name' value='$bk_name' readonly>";
//    echo "Account Holder: $accot_name <br/>";
//    echo $bk_name;
} else {
    echo "<h2>Please enter all the values</h2>";
}
?>