<?php
$db_server = "localhost";
$db_user   = "root";
$db_pass   = "";
$db_name   = "bankly_v2";
$port      = 3307;

$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name, $port);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>