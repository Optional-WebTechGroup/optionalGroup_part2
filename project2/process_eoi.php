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
$job_reference_number = sanitize_input($_POST['job_reference_number'] ?? '');
if (empty($job_reference_number)) {
    $errors['job_reference_number'] = 'Please select a job reference number.';
} elseif (!in_array($job_reference_number, $job_reference_numbers)) {
    $errors['job_reference_number'] = 'Invalid job reference number selected.';
}

$first_name = sanitize_input($_POST['first_name'] ?? '');
if (empty($first_name)) {
    $errors['first_name'] = "First name is required.";
} elseif (strlen($first_name) > 20) {
   $errors['first_name'] = "First name must not exceed 20 characters."; 
}

$last_name = sanitize_input($_POST['last_name'] ?? '');
if (empty($last_name)) {
    $errors['last_name'] = "Last name is required.";
} elseif (strlen($last_name) > 20) {
   $errors['last_name'] = "Last name must not exceed 20 characters."; 
}

$birthdate = sanitize_input($_POST['birthdate'] ?? '');
if (empty($birthdate)) {
    $errors['birthdate'] = "Birthdate is required."; 
} elseif (preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $birthdate)) {
    $day = (int)substr($birthdate, 0, 2);
    $month = (int)substr($birthdate, 3, 2);
    $year = (int)substr($birthdate, 6, 4);

    if (!checkdate($month, $day, $year)) {
        $errors['birthdate'] = "Invalid date.";  
    }
} else {
    $errors['birthdate'] = "Date must be in the format DD/MM/YYYY."; 
}

session_start();
$_SESSION['errors'] = $errors;
?>

<form action="apply.php" method="post">
    <input type="hidden" name="job_reference_number" value="<?php echo htmlspecialchars($job_reference_number); ?>">
    <input type="hidden" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>">
    <input type="hidden" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>">
    <input type="hidden" name="birthdate" value="<?php echo htmlspecialchars($birthdate); ?>">
    
</form>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('form').submit();
});
</script>