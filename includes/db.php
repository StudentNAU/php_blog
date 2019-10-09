<?php



$connection = mysqli_connect(
    $config['db']['server'],
    $config['db']['username'],
    $config['db']['password'],
    $config['db']['name']
);

if($connection == false){
    echo 'Error connection<br>';
    echo mysqli_connection_error();
    exit();
}
