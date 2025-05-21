<?php
session_start();
require_once('settings.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: apply.php');
    exit();
}

// sanitize input: removes leading and traii
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


// loads the jobs reference numbers as an array from the database
$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    header('Location: database_error.html');
    exit();
}
$sql = "SELECT job_reference_number FROM jobs ORDER BY job_reference_number ASC;";
$result = mysqli_query($conn, $sql);
if (!$result) {
   header('Location: database_error.html');
    exit(); 
}
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
mysqli_close($conn);

// validataes the job reference number
$job_reference_numbers = array_column($rows, 'job_reference_number');
$job_reference_number = sanitize_input($_POST['job_reference_number'] ?? '');
if (empty($job_reference_number)) {
    $errors['job_reference_number'] = 'Please select a job reference number.';
} elseif (!in_array($job_reference_number, $job_reference_numbers)) {
    $errors['job_reference_number'] = 'Invalid job reference number selected.';
} elseif (strlen($job_reference_number) > 5) {
   $errors['job_reference_number'] = 'Jobs reference number must not exceed 5 characters.'; 
}

// validates the first name
$first_name = sanitize_input($_POST['first_name'] ?? '');
if (empty($first_name)) {
    $errors['first_name'] = "First name is required.";
} elseif (strlen($first_name) > 20) {
   $errors['first_name'] = "First name must not exceed 20 characters."; 
}

// validates the last name
$last_name = sanitize_input($_POST['last_name'] ?? '');
if (empty($last_name)) {
    $errors['last_name'] = "Last name is required.";
} elseif (strlen($last_name) > 20) {
   $errors['last_name'] = "Last name must not exceed 20 characters."; 
}

// vlaidates the birthdate
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

// validates the gender
$genders = ['male', 'female'];
$gender = sanitize_input($_POST['gender'] ?? '');
if (empty($gender)) {
    $errors['gender'] = 'Gender is required.';
} elseif (!in_array($gender, $genders)) {
    $errors['gender'] = 'Invalid gender.';
}


// validates the street address
$street_address = sanitize_input($_POST['street_address'] ?? '');
if (empty($street_address)) {
    $errors['street_address'] = "Street address is required.";
} elseif (strlen($street_address) > 40) {
   $errors['street_address'] = "Street address must not exceed 40 characters."; 
}

// validates the suburb 
$suburb = sanitize_input($_POST['suburb'] ?? '');
if (empty($suburb)) {
    $errors['suburb'] = "Suburb is required.";
} elseif (strlen($suburb) > 40) {
   $errors['suburb'] = "Suburb must not exceed 40 characters."; 
}

// array with the key as the state and the value as the regex for the postcode
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

// validates the state
$state = sanitize_input($_POST['state'] ?? '');
if (empty($state)) {
    $errors['state'] = 'Please select a state.';
    $errors['postcode'] = 'No state selected';
} elseif (!array_key_exists($state, $state_postcode_patterns)) {
    $errors['state'] = 'Invalid state selected.';
} elseif (strlen($state) > 3) {
    $errors['state'] = 'State must not exceed 3 characters'; 
}

// validates the postcode based on the state
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

// validates the email address
$email_address = sanitize_input($_POST['email_address'] ?? '');
if (empty($email_address)) {
    $errors['email_address'] = "Email address is required.";
} elseif (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
    $errors['email_address'] = "Invalid email address.";
} elseif (strlen($email_address) > 100) {
   $errors['email_address'] = 'Email address must not exceed 100 characters.'; 
}

// validates phone number
$phone_number = sanitize_input($_POST['phone_number'] ?? '');
if (empty($phone_number)) {
    $errors['phone_number'] = "Phone number is required.";
} elseif (!preg_match('/^[0-9 ]{8,12}$/', $phone_number)) {
    $errors['phone_number'] = "Invalid phone number."; 
} elseif (strlen($phone_number) > 12) {
   $errors['phone_number'] = 'Phone number must not exceed 12 characters.'; 
}

// validates the required skills
$required_technical_skills = ['python', 'assembly', 'java', 'networking', 'switching', 'routing', 'other_skills'];
$skills = $_POST['technical_skills'] ?? [];
if (empty($skills)) {
    $errors['technical_skills'] = "Technical skills is required.";
} 
// check if the skill is invalid
foreach ($skills as $skill) {
    if (!in_array($skill, $required_technical_skills)) {
        $errors['technical_skills'] = 'Invalid technical skills.';
        break;
    }
}

// make string in the format "skill1,skill2,skill3"
if (!array_key_exists('technical_skills', $errors)) {
    $technical_skills = implode(',', $skills);
    if (strlen($technical_skills) > 255) {
        $errors['technical_skills'] = 'Invalid technical skills.';
    }
}

// validates other skills, required if other skills is checked
$other_skills = sanitize_input($_POST['other_skills'] ?? '');
$other_skills = empty($other_skills) ? null : $other_skills;
if (empty($other_skills) && in_array('other_skills', $skills)) {
    $errors['other_skills'] = 'Other skills is required.';
}

// validates experience title
$experience_title = sanitize_input($_POST['experience_title'] ?? '');
$experience_title = empty($experience_title) ? null : $experience_title;
if (!empty($experience_title) && strlen($experience_title) > 100) {
    $errors['experience_title'] = 'Title must not exceed 100 characters.';  
}

// validates experience company
$experience_company = sanitize_input($_POST['experience_company'] ?? '');
$experience_company = empty($experience_company) ? null : $experience_company;
if (!empty($experience_company) && strlen($experience_company) > 100) {
    $errors['experience_company'] = 'Company must not exceed 100 characters.';  
}

// sets the experience description to null if empty
$experience_description = sanitize_input($_POST['experience_description'] ?? '');
$experience_description = empty($experience_description) ? null : $experience_description;

// validates the experience from date
$experience_from_date = sanitize_input($_POST['experience_from_date'] ?? '');
$experience_from_date = empty($experience_from_date) ? null : $experience_from_date;
if (!empty($experience_from_date) && !validate_date($experience_from_date)) {
    $errors['experience_from_date'] = 'Invalid date.';
}

// validates the experience to date
$experience_to_date = sanitize_input($_POST['experience_to_date'] ?? '');
$experience_to_date = empty($experience_to_date) ? null : $experience_to_date;
if (!empty($experience_to_date) && !validate_date($experience_to_date)) {
    $errors['experience_to_date'] = 'Invalid date.';
}

// set the currently working to 1 if set else 0
$currently_working = isset($_POST['currently_working']) ? 1 : 0;

// validate the education institution
$education_institution = sanitize_input($_POST['education_institution'] ?? '');
$education_institution = empty($education_institution) ? null : $education_institution;
if (!empty($education_institution) && strlen($education_institution) > 100) {
    $errors['education_institution'] = 'Institution must not exceed 100 characters.';  
}

// validate the education degree
$education_degree = sanitize_input($_POST['education_degree'] ?? '');
$education_degree = empty($education_degree) ? null : $education_degree;
if (!empty($education_degree) && strlen($education_degree) > 100) {
    $errors['education_degree'] = 'Degree must not exceed 100 characters.';  
}

// validate the education major
$education_major = sanitize_input($_POST['education_major'] ?? '');
$education_major = empty($education_major) ? null : $education_major;
if (!empty($education_major) && strlen($education_major) > 100) {
    $errors['education_major'] = 'Major must not exceed 100 characters.';  
}

// sets the education description to null if empty 
$education_description = sanitize_input($_POST['education_description'] ?? '');
$education_description = empty($education_description) ? null : $education_description;

// validate the education from date
$education_from_date = sanitize_input($_POST['education_from_date'] ?? '');
$education_from_date = empty($education_from_date) ? null : $education_from_date;
if (!empty($education_from_date) && !validate_date($education_from_date)) {
    $errors['education_from_date'] = 'Invalid date.';
}

// validate the education to date
$education_to_date = sanitize_input($_POST['education_to_date'] ?? '');
$education_to_date = empty($education_to_date) ? null : $education_to_date;
if (!empty($education_to_date) && !validate_date($education_to_date)) {
    $errors['education_to_date'] = 'Invalid date.';
}

// set the currently attending to 1 if set else 0
$currently_attending = isset($_POST['currently_attending']) ? 1 : 0;

// validate if linkedin is a valid url
$linkedin = sanitize_input($_POST['linkedin'] ?? '');
$linkedin = empty($linkedin) ? null : $linkedin;
if (!empty($linkedin) && !filter_var($linkedin, FILTER_VALIDATE_URL)) {
    $errors['linkedin'] = 'Invalid url.';
}

// validate if twitter is a valid url
$twitter = sanitize_input($_POST['twitter'] ?? '');
$twitter = empty($twitter) ? null : $twitter;
if (!empty($twitter) && !filter_var($twitter, FILTER_VALIDATE_URL)) {
    $errors['twitter'] = 'Invalid url.';
}

// validate if github is a valid url
$github = sanitize_input($_POST['github'] ?? '');
$github = empty($github) ? null : $github;
if (!empty($github) && !filter_var($github, FILTER_VALIDATE_URL)) {
    $errors['github'] = 'Invalid url.';
}

// validate if personal website is a valid url
$personal_website = sanitize_input($_POST['personal_website'] ?? '');
$personal_website = empty($personal_website) ? null : $personal_website;
if (!empty($personal_website) && !filter_var($personal_website, FILTER_VALIDATE_URL)) {
    $errors['personal_website'] = 'Invalid url.';
}

// validates resume
if (isset($_FILES['resume'])) {
    if ($_FILES['resume']['error'] === UPLOAD_ERR_OK) {
        $file_tmp_path = $_FILES['resume']['tmp_name'];
        $file_name = $_FILES['resume']['name'];
        $file_size = $_FILES['resume']['size'];
        $file_type = $_FILES['resume']['type'];
        
        // check if size if greter then 2MB
        if ($file_size > 2 * 1024 * 1024) {
            $errors['resume'] = "File too large."; 
        }
        
        // check if in allowed extensions
        $allowed_extensions = ['pdf', 'docx', 'doc'];
        $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        if (!in_array($file_extension, $allowed_extensions)) {
            $errors['resume'] = "Invalid file type.";
        }

        $upload_folder = 'resumes/';
        if (!empty($first_name) && !empty($last_name) && empty($errors)) {
            $resume_file_name = $first_name . '_' . $last_name . '_' . time() . '.' . $file_extension; // uses time() to make it unique
            $destination = $upload_folder . $resume_file_name;
            // Move file from temp location to destination
            // Might cause an error on your device if you don't have write permission for resumes folder
            if (!move_uploaded_file($file_tmp_path, $destination)) {
                $errors['resume'] = 'Upload Error';
            }
        } 
        // ask to reupload resume if there are errors in other sections
        if (!empty($errors) && empty($errors['resume'] ?? '')) {
            $errors['resume'] = "Please reupload your resume."; 
        }
    } elseif ($_FILES['resume']['error'] !== UPLOAD_ERR_NO_FILE) {
        $errors['resume'] = "File upload error."; 
    } 
}

// sets message for us to null if empty
$message_for_us = sanitize_input($_POST['message_for_us'] ?? '');
$message_for_us = empty($message_for_us) ? null : $message_for_us;
?>

<!-- sends the form data back to apply.php if there's an error so that it will retain the previously inputted data -->
<?php if (!empty($errors)): ?>
    <!-- sets the session error to errors -->
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
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email_address); ?>"> 
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
        <input type="hidden" name="education_institution" value="<?php echo htmlspecialchars($education_institution); ?>"> 
        <input type="hidden" name="education_degree" value="<?php echo htmlspecialchars($education_degree); ?>"> 
        <input type="hidden" name="education_major" value="<?php echo htmlspecialchars($education_major); ?>"> 
        <input type="hidden" name="education_description" value="<?php echo htmlspecialchars($education_description); ?>"> 
        <input type="hidden" name="education_from_date" value="<?php echo htmlspecialchars($education_from_date); ?>"> 
        <input type="hidden" name="education_to_date" value="<?php echo htmlspecialchars($education_to_date); ?>"> 
        <?php if (isset($_POST['currently_attending'])): ?>
            <input type="hidden" name="currently_attending" value="currently_attending"> 
        <?php endif; ?>
        <input type="hidden" name="linkedin" value="<?php echo htmlspecialchars($linkedin); ?>"> 
        <input type="hidden" name="twitter" value="<?php echo htmlspecialchars($twitter); ?>"> 
        <input type="hidden" name="github" value="<?php echo htmlspecialchars($github); ?>"> 
        <input type="hidden" name="personal_website" value="<?php echo htmlspecialchars($personal_website); ?>"> 
        <input type="hidden" name="message_for_us" value="<?php echo htmlspecialchars($message_for_us); ?>"> 
    </form>
    <script>
    //  auto submit forms
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('form').submit();
    });
    </script>
<?php endif; ?>

<?php
if (empty($errors)) {
    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        header('Location: database_error.html');
        exit(); 
    }
    // creates table if it doesn't exits
    $query = "CREATE TABLE IF NOT EXISTS eoi (
  eoi_number INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  job_reference_number VARCHAR(5) NOT NULL,
  first_name VARCHAR(20) NOT NULL,
  last_name VARCHAR(20) NOT NULL,
  birthdate DATE NOT NULL,
  gender ENUM('male','female') NOT NULL,
  street_address VARCHAR(40) NOT NULL,
  suburb VARCHAR(40) NOT NULL,
  state CHAR(3) NOT NULL,
  postcode CHAR(4) NOT NULL,
  email_address VARCHAR(100) NOT NULL,
  phone_number VARCHAR(12) NOT NULL,
  technical_skills VARCHAR(255) NOT NULL,
  other_skills TEXT,
  experience_title VARCHAR(100),
  experience_company VARCHAR(100),
  experience_description TEXT,
  experience_from_date DATE,
  experience_to_date DATE,
  currently_working TINYINT(1) NOT NULL DEFAULT 0,
  education_institution VARCHAR(100),
  education_degree VARCHAR(100),
  education_major VARCHAR(100),
  education_description TEXT,
  education_from_date DATE,
  education_to_date DATE,
  currently_attending TINYINT(1) NOT NULL DEFAULT 0,
  linkedin VARCHAR(255),
  twitter VARCHAR(255),
  github VARCHAR(255),
  personal_website VARCHAR(255),
  resume VARCHAR(255),
  message_for_us TEXT,
  status ENUM('New','Current','Final') NOT NULL DEFAULT 'New',
  FOREIGN KEY (job_reference_number) REFERENCES jobs(job_reference_number)
);";

    if (!mysqli_query($conn, $query)) {
        header('Location: database_error.html');
        exit();
    }

    // preparing the insert sql query
   $stmt = $conn->prepare("INSERT INTO eoi (
  job_reference_number, first_name, last_name, birthdate, gender, street_address, suburb, state, postcode,
  email_address, phone_number, technical_skills, other_skills, experience_title, experience_company,
  experience_description, experience_from_date, experience_to_date, currently_working,
  education_institution, education_degree, education_major, education_description, education_from_date,
  education_to_date, currently_attending, linkedin, twitter, github, personal_website, resume,
  message_for_us
  ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
  // bind the parameter to prepared query
    $stmt->bind_param("ssssssssssssssssssissssssissssss",
    $job_reference_number, $first_name, $last_name, $sql_birthdate, $gender, $street_address, $suburb, $state, $postcode,
    $email_address, $phone_number, $technical_skills, $other_skills, $experience_title, $experience_company,
    $experience_description, $experience_from_date, $experience_to_date, $currently_working,
    $education_institution, $education_degree, $education_major, $education_description, $education_from_date,
    $education_to_date, $currently_attending, $linkedin, $twitter, $github, $personal_website, $resume_file_name,
    $message_for_us); 
    // executes and check if there's an error
    if (!$stmt->execute()) {
        header('Location: database_error.html');
        exit(); 
    } 
    // gets the id of the last insert
    $eoi_number = $conn->insert_id;
    mysqli_close($conn);
}
?>

<!-- successful application page -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/styles.css"> 
    <title>Successful Application</title>
</head>
<body>
    <div class='center_content'>
        <h1>Successful Application</h1> 
        <p>Your Expression of Interest (EOI) number is <?php echo $eoi_number; ?></p>
        <a href="index.php">Go back to website.</a>
    </div>
</body>
</html>