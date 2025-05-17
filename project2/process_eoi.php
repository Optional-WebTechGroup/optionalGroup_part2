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
    $data = htmlspecialchars_decode($data);
    return $data;
}

$errors = [];

$job_reference_numbers = ['5KC3U', 'PXUB6'];
echo $_POST['job_reference_number'];
$job_reference_number = sanitize_input($_POST['job_reference_number'] ?? '');
if (empty($job_reference_number)) {
    $errors['job_reference_number'] = 'Please select a job reference number.';
} elseif (!in_array($job_reference_number, $job_reference_numbers)) {
    $erros['job_reference_number'] = 'Invalid job reference number selected.';
}

?>