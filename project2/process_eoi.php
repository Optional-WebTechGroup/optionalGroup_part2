<?php
session_start();
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

function validate_date($date, $format='Y-m-d') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}

$errors = [];

$job_reference_numbers = ['5KC3U', 'PXUB6'];
$job_reference_number = sanitize_input($_POST['job_reference_number'] ?? '');
if (empty($job_reference_number)) {
    $errors['job_reference_number'] = 'Please select a job reference number.';
} elseif (!in_array($job_reference_number, $job_reference_numbers)) {
    $errors['job_reference_number'] = 'Invalid job reference number selected.';
} elseif (strlen($job_reference_number) > 5) {
   $errors['job_reference_number'] = 'Jobs reference number must not exceed 5 characters.'; 
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
    if (validate_date($birthdate, 'd/m/Y')) {
        $sql_birthdate = DateTime::createFromFormat('d/m/Y', $birthdate);
        $sql_birthdate = $sql_birthdate->format('Y-m-d');
    } else {
        $errors['birthdate'] = "Invalid date.";  
    }
} else {
    $errors['birthdate'] = "Date must be in the format DD/MM/YYYY."; 
}

$genders = ['male', 'female'];
$gender = sanitize_input($_POST['gender'] ?? '');
if (empty($gender)) {
    $errors['gender'] = 'Gender is required.';
} elseif (!in_array($gender, $genders)) {
    $errors['gender'] = 'Invalid gender.';
}

$street_address = sanitize_input($_POST['street_address'] ?? '');
if (empty($street_address)) {
    $errors['street_address'] = "Street address is required.";
} elseif (strlen($street_address) > 40) {
   $errors['street_address'] = "Street address must not exceed 40 characters."; 
}

$suburb = sanitize_input($_POST['suburb'] ?? '');
if (empty($suburb)) {
    $errors['suburb'] = "Suburb is required.";
} elseif (strlen($suburb) > 40) {
   $errors['suburb'] = "Suburb must not exceed 40 characters."; 
}

$state_postcode_patterns = [
    'ACT' => '/^(02\d{2}|26(0\d|1[0-8])|29(0\d|1\d|20))$/', // 0200–0299, 2600–2618, 2900–2920
    'NSW' => '/^(1\d{3}|2[0-5]\d{2}|2619|26[2-9]\d|2[7-8]\d{2}|292\d|29[3-9]\d)$/', // 1000–1999, 2000–2599, 2619–2899, 2921–2999
    'NT' => '/^0[8-9]\d{2}$/', // 0800–0999
    'QLD' => '/^(4\d{3}|9\d{3})$/', // 4000–4999, 9000–9999
    'SA' => '/^5\d{3}$/', // 5000–5999
    'TAS' => '/^7\d{3}$/', // 7000–7999
    'VIC' => '/^(3\d{3}|8\d{3})$/', // 3000–3999, 8000–8999
    'WA' => '/^(6[0-6]\d{2}|67[0-8]\d|679[0-7]|6[8-9]\d{2})$/', // 6000–6797, 6800–6999
];

$state = sanitize_input($_POST['state'] ?? '');
if (empty($state)) {
    $errors['state'] = 'Please select a state.';
    $errors['postcode'] = 'No state selected';
} elseif (!array_key_exists($state, $state_postcode_patterns)) {
    $errors['state'] = 'Invalid state selected.';
} elseif (strlen($state) > 3) {
    $errors['state'] = 'State must not exceed 3 characters'; 
}

$postcode = sanitize_input($_POST['postcode'] ?? '');
if (!array_key_exists('state', $errors)) {
    if (empty($postcode)) {
        $errors['postcode'] = "Postcode is required."; 
    } elseif (strlen($postcode) > 4) {
        $errors['postcode'] = 'Postcode must not exceed 4 characters';    
    } elseif (preg_match('/^(0[289]\d{2}|[1-9]\d{3})$/', $postcode)) {
        if (!preg_match($state_postcode_patterns[$state], $postcode)) {
            $errors['postcode'] = "Postcode doesn't match state.";    
        }
    } else {
        $errors['postcode'] = "Invalid postcode.";    
    }
} else {
    $errors['postcode'] = "Invalid state.";   
}

$email = sanitize_input($_POST['email_address'] ?? '');
if (empty($email)) {
    $errors['email_address'] = "Email address is required.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email_address'] = "Invalid email address.";
} elseif (strlen($email) > 100) {
   $errors['email_address'] = 'Email address must not exceed 100 characters.'; 
}

$phone_number = sanitize_input($_POST['phone_number'] ?? '');
if (empty($phone_number)) {
    $errors['phone_number'] = "Phone number is required.";
} elseif (!preg_match('/^[0-9 ]{8,12}$/', $phone_number)) {
    $errors['phone_number'] = "Invalid phone number."; 
} elseif (strlen($phone_number) > 12) {
   $errors['phone_number'] = 'Phone number must not exceed 12 characters.'; 
}


$required_technical_skills = ['python', 'assembly', 'java', 'networking', 'switching', 'routing', 'other_skills'];
$skills = $_POST['technical_skills'] ?? [];
if (empty($skills)) {
    $errors['technical_skills'] = "Technical skills is required.";
} 

foreach ($skills as $skill) {
    if (!in_array($skill, $required_technical_skills)) {
        $errors['technical_skills'] = 'Invalid technical skills.';
        break;
    }
}

if (!array_key_exists('technical_skills', $errors)) {
    $technical_skills = implode(',', $skills);
    if (strlen($technical_skills) > 255) {
        $errors['technical_skills'] = 'Invalid technical skills.';
    }
}

$other_skills = sanitize_input($_POST['other_skills'] ?? '');
$other_skills = empty($other_skills) ? null : $other_skills;
if (empty($other_skills) && in_array('other_skills', $skills)) {
    $errors['other_skills'] = 'Other skills is required.';
}

$experience_title = sanitize_input($_POST['experience_title'] ?? '');
$experience_title = empty($experience_title) ? null : $experience_title;
if (!empty($experience_title) && strlen($experience_title) > 100) {
    $errors['experience_title'] = 'Title must not exceed 100 characters.';  
}

$experience_company = sanitize_input($_POST['experience_company'] ?? '');
$experience_company = empty($experience_company) ? null : $experience_company;
if (!empty($experience_company) && strlen($experience_company) > 100) {
    $errors['experience_company'] = 'Company must not exceed 100 characters.';  
}

$experience_description = sanitize_input($_POST['experience_description'] ?? '');
$experience_description = empty($experience_description) ? null : $experience_description;

$experience_from_date = sanitize_input($_POST['experience_from_date'] ?? '');
$experience_from_date = empty($experience_from_date) ? null : $experience_from_date;
if (!empty($experience_from_date) && !validate_date($experience_from_date)) {
    $errors['experience_from_date'] = 'Invalid date.';
}

$experience_to_date = sanitize_input($_POST['experience_to_date'] ?? '');
$experience_to_date = empty($experience_to_date) ? null : $experience_to_date;
if (!empty($experience_to_date) && !validate_date($experience_to_date)) {
    $errors['experience_to_date'] = 'Invalid date.';
}

$currently_working = isset($_POST['currently_working']) ? 1 : 0;
?>



<?php if (!empty($errors)): ?>
    <?php $_SESSION['errors'] = $errors; ?>
    <form action="apply.php" method="post">
        <input type="hidden" name="job_reference_number" value="<?php echo htmlspecialchars($job_reference_number); ?>">
        <input type="hidden" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>">
        <input type="hidden" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>">
        <input type="hidden" name="birthdate" value="<?php echo htmlspecialchars($birthdate); ?>">
        <input type="hidden" name="gender" value="<?php echo htmlspecialchars($gender); ?>"> 
        <input type="hidden" name="street_address" value="<?php echo htmlspecialchars($street_address); ?>"> 
        <input type="hidden" name="suburb" value="<?php echo htmlspecialchars($suburb); ?>"> 
        <input type="hidden" name="state" value="<?php echo htmlspecialchars($state); ?>"> 
        <input type="hidden" name="postcode" value="<?php echo htmlspecialchars($postcode); ?>"> 
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>"> 
        <input type="hidden" name="phone_number" value="<?php echo htmlspecialchars($phone_number); ?>"> 
        <?php foreach ($skills as $skill): ?>
            <input type="hidden" name="technical_skills[]" value="<?php echo htmlspecialchars($skill); ?>"> 
        <?php endforeach; ?>
        <input type="hidden" name="other_skills" value="<?php echo htmlspecialchars($other_skills); ?>"> 
        <input type="hidden" name="experience_title" value="<?php echo htmlspecialchars($experience_title); ?>"> 
        <input type="hidden" name="experience_company" value="<?php echo htmlspecialchars($experience_company); ?>"> 
        <input type="hidden" name="experience_description" value="<?php echo htmlspecialchars($experience_description); ?>"> 
        <input type="hidden" name="experience_from_date" value="<?php echo htmlspecialchars($experience_from_date); ?>"> 
        <input type="hidden" name="experience_to_date" value="<?php echo htmlspecialchars($experience_to_date); ?>"> 
        <?php if (isset($_POST['currently_working'])): ?>
            <input type="hidden" name="currently_working" value="currently_working"> 
        <?php endif; ?>
    </form>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('form').submit();
    });
    </script>
<?php endif; ?>

<?php
if (empty($errors)) {
    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
}
?>