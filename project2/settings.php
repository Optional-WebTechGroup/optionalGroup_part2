<?php
$host = "localhost";
$user = "root";
$pwd = "";
$sql_db = "optional_group_db";

$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    header('Location: error.html');
    exit();
}
?>