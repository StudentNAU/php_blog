<?php


$connection = mysqli_connect('127.0.0.1','root','','test_db');

if($connection == false){
    echo 'Error<br>';
    echo mysqli_connection_error();
    exit();
}else{
    echo 'True connect! <hr>';
}

/*
$today =  date('Y-m-d H:i:s');// date
echo '<hr>';
$start_date = '2106-12-10';
$start_date_timestamp = strtotime($start_date);
$diff = time()-$start_date_timestamp;
 
echo $start_date . ' and ' . $today. ' =' . floor((($diff/60)/60)/24) . ' days!';
*/

 //$result = mysqli_query($connection, "select * from `arti_categories`");

/*while(($record = mysqli_fetch_assoc($result))){
    print_r($record);
    echo '<hr>';
}
*/

//echo 'Rows: ' .  mysqli_num_rows($result) . '<hr>';


?>

<form method="GET" action="/test.php">
 <input type="text" placeholder="Login" name="login">
 <input type="text" placeholder="Password" name="password">
 <hr>
 <input type="submit" value="OK">
</form>

<!--
<ul>

    <?php
    /*
        while(($cat = mysqli_fetch_assoc($result))){
            $arti_count = mysqli_query($connection, "select count(`id`) as `total_count` from `articles`where `categorie_id` =" . $cat['id']);
            $arti_count_result = mysqli_fetch_assoc($arti_count);
            //print_r($arti_count_result);
            //exit();
            echo '<li>' . $cat['title'] . ' (' . $arti_count_result['total_count'] . ')</li>';
        }
        */
    ?>
</ul>
-->


<?php

    mysqli_close($connection);

?>