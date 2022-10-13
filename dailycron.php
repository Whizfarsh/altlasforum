<?php include_once "includes/db.php" ?>
<?php


    $query = "SELECT * FROM dailycounter";
    $select_dailycount = mysqli_query($connection, $query);

    if(!$select_dailycount){
        die("QUERY FAILED" . mysqli_error($connection));
    }

    while ($row = mysqli_fetch_array($select_dailycount)){

        $daily_count = $row['daily_count'];

        $daily_count = $daily_count+1;

        $query = "UPDATE dailycounter SET daily_count='$daily_count'";
        $user_earnings_query = mysqli_query($connection, $query);

//        if(!$user_earnings_query){
//            die("QUERY FAILED" . mysqli_error($connection));
//        }else{
//            echo "Updated successfully";
//        }
    }



?>
