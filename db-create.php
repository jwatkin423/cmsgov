<?php

$servername = "localhost"; // mysql host
$username = "root"; // Change to your username
$password = "root"; // Change to your password

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$createDB = "CREATE DATABASE cmsgov_test";

$createUser = "CREATE USER 'srv_cmsgov_test'@'localhost' IDENTIFIED BY 'cmsGovAdmin'";

$grant = "GRANT ALL PRIVILEGES ON * . * TO  'srv_cmsgov_test'@'localhost' WITH GRANT OPTION MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0";

$resultGrant = $conn->query($grant);
$flush = "FLUSH PRIVILEGES";


$resultCreateDB = $conn->query($createDB);
if ($resultCreateDB) {
    $resultCreateUser = $conn->query($createUser);
    if ($resultCreateDB) {
        $resultFlush = $conn->query($flush);
        if ($resultFlush) {
          echo "DB and user created successfully";
        } else {
          echo "DB and user created successfully but privileges were not flushed";
        }
    } else {
        echo "DB but the user was created successfully";
    }
} else {
    echo "DB was not created";
}

echo PHP_EOL;





?>
