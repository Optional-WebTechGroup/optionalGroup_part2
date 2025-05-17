<?php
require_once('settings.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: apply.php');
    exit();
}

function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = strip_tags($data);
    return $data;
}


?>