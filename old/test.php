<?php
include ('includes/db.php');
    //$_GET
    //$_POST

$login = $_GET['login'];
$password = $_GET['password'];

$count = mysqli_query($connection, "select *  from users where login = '$login' and password = '$password'");
if(mysqli_num_rows($count)==0){
    echo 'You not registration!';
}else{
    echo 'Hi ' . $login . '!';
}

    

     
?>