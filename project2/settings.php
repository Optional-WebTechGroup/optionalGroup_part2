<?php
$host = "localhost";
$user = "root";
$pwd = "";
$sql_db = "optional_group_db";

$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>