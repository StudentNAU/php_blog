<?php


$connection = mysqli_connect('127.0.0.1','root','','test_db');

if($connection == false){
    echo 'Error<br>';
    echo mysqli_connection_error();
    exit();
}

?>