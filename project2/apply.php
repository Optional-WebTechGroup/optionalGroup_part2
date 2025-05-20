<?php
session_start();
$errors = $_SESSION['errors'] ?? [];

unset($_SESSION['errors']);
?>

<!DOCTYPE html>
<html lang="en">

<head> <!-- Adds web browser support meta tags for format and search algorithm-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Job application form at The Optional Group.">
    <meta name="keywords" content="The Optional Group, Job Application Form, Reference Number, Personal Information, Resume">
    <meta name="author" content="Aldrin Filbert Maano">
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="shortcut icon" href="images/OptionalGroup_Tab_Icon.png">
    <!-- ChatGPT GenAI Image Prompt: Create an image for a company logo for It company called The Optional Group. It’s a company which supplies remote it support and environmental impact. The group colours are blues, greens, and shades-->
    <title>The Optional Group: Apply Page</title>
</head>

<body>
    <?php include("header.inc"); ?>

    <main id="apply_main">
        <!-- title section with the reference dropdown below -->
        <h1>Apply to your <span class="text_gradient">Dream Job</span></h1>
        <form action="process_eoi.php" method="post" novalidate>
            <p class="center" id="reference_number"><label for="job_reference_number">Job Reference Number: </label>
                <select name="job_reference_number" id="job_reference_number" required>
                    <option value="">Please Select</option>
                    <?php 
                        $selected_job_reference_number = $_POST['job_reference_number'] ?? '';
                        $job_reference_numbers = ['5KC3U', 'PXUB6'];
                        foreach ($job_reference_numbers as $job_reference_number) {
                            echo "<option value='$job_reference_number'" . ($selected_job_reference_number === $job_reference_number ? "selected" : "") . ">$job_reference_number</option>";
                        }
                    ?>
                </select>
            </p>
            <?php if((!empty($errors['job_reference_number']))): ?>
                <span class="center error"><?php echo htmlspecialchars($errors['job_reference_number']); ?></span>
            <?php endif; ?>
            <hr>
            <!-- Section to add personal informations -->
            <section>
                <h2>Personal Information</h2>
                <p>Fields marked with * are required.</p>

                <div class="row">
                    <div class="question">
                        <label for="first_name">First name*</label>
                        <input type="text" name="first_name" id="first_name" required maxlength="20" value="<?php echo htmlspecialchars($_POST['first_name'] ?? ''); ?>">
                        <?php if((!empty($errors['first_name']))): ?>
                            <span class="error"><?php echo htmlspecialchars($errors['first_name']); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="question">
                        <label for="last_name">Last name*</label>
                        <input type="text" name="last_name" id="last_name" required maxlength="20" value="<?php echo htmlspecialchars($_POST['last_name'] ?? ''); ?>">
                        <?php if((!empty($errors['last_name']))): ?>
                            <span class="error"><?php echo htmlspecialchars($errors['last_name']); ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="row">
                    <div class="question">
                        <!-- input for birthdate, follows the patter of DD/MM/YYYY -->
                        <label for="birthdate">Birthdate*</label>
                        <input type="text" name="birthdate" id="birthdate" required placeholder="DD/MM/YYYY"
                            pattern="\d{2}/\d{2}/\d{4}" value="<?php echo htmlspecialchars($_POST['birthdate'] ?? ''); ?>">
                        <?php if((!empty($errors['birthdate']))): ?>
                            <span class="error"><?php echo htmlspecialchars($errors['birthdate']); ?></span>
                        <?php endif; ?>
                    </div>

                    <fieldset class="question">
                        <legend>Gender*</legend>
                        <p> <input type="radio" id="male" name="gender" value="male" <?php echo ($_POST['gender'] === 'male' ? 'checked' : '');?>>
                            <label for="male">Male</label>
                            <input type="radio" id="female" name="gender" value="female" <?php echo ($_POST['gender'] === 'female' ? 'checked' : '');?>>
                            <label for="female">Female</label>
                        </p>
                        <?php if((!empty($errors['gender']))): ?>
                            <span class="error"><?php echo htmlspecialchars($errors['gender']); ?></span>
                        <?php endif; ?>
                    </fieldset>
                </div>

                <div class="row">
                    <div class="question">
                        <label for="street_address">Street Address*</label>
                        <input type="text" name="street_address" id="street_address" required maxlength="40" value="<?php echo htmlspecialchars($_POST['street_address'] ?? ''); ?>">
                        <?php if((!empty($errors['street_address']))): ?>
                            <span class="error"><?php echo htmlspecialchars($errors['street_address']); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="question">
                        <label for="suburb">Suburb/Town*</label>
                        <input type="text" name="suburb" id="suburb" required maxlength="40" value="<?php echo htmlspecialchars($_POST['suburb'] ?? ''); ?>">
                        <?php if((!empty($errors['suburb']))): ?>
                            <span class="error"><?php echo htmlspecialchars($errors['suburb']); ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="row">
                    <!-- dropdown for state and input for postcode that has the pattern for postcodes for australia -->
                    <!-- can't make it only accept postcode based on the specific state as it requires javascript because it's a type of dynamic action -->
                    <p class="question"><label for="state">State*: </label>
                        <select name="state" id="state" required>
                            <option value="">Please Select</option>
                            <option value="ACT" <?php echo ($_POST['state'] === 'ACT') ? 'selected' : ''; ?>>Australian Capital Territory</option>
                            <option value="NSW" <?php echo ($_POST['state'] === 'NSW') ? 'selected' : ''; ?>>New South Wales</option>
                            <option value="NT" <?php echo ($_POST['state'] === 'NT') ? 'selected' : ''; ?>>Northern Territory</option>
                            <option value="QLD" <?php echo ($_POST['state'] === 'QLD') ? 'selected' : ''; ?>>Queensland</option>
                            <option value="SA" <?php echo ($_POST['state'] === 'SA') ? 'selected' : ''; ?>>South Australia</option>
                            <option value="TAS" <?php echo ($_POST['state'] === 'TAS') ? 'selected' : ''; ?>>Tasmania</option>
                            <option value="VIC" <?php echo ($_POST['state'] === 'VIC') ? 'selected' : ''; ?>>Victoria</option>
                            <option value="WA" <?php echo ($_POST['state'] === 'WA') ? 'selected' : ''; ?>>Western Australia</option>
                        </select>
                        <?php if((!empty($errors['state']))): ?>
                            <span class="error"><?php echo htmlspecialchars($errors['state']); ?></span>
                        <?php endif; ?>
                    </p>
                    <div class="question">
                        <label for="postcode">Postcode*</label>
                        <input type="text" name="postcode" id="postcode" required minlength="4" maxlength="4"
                            pattern="0[289]\d{2}|[1-9]\d{3}" value="<?php echo htmlspecialchars($_POST['postcode'] ?? ''); ?>">
                        <?php if((!empty($errors['postcode']))): ?>
                            <span class="error"><?php echo htmlspecialchars($errors['postcode']); ?></span>
                        <?php endif; ?>
                    </div>

                </div>

                <div class="row">
                    <div class="question">
                        <!-- input for email address following the correct email address pattern -->
                        <label for="email_address">Email Address*</label>
                        <input type="text" name="email_address" id="email_address" required
                            pattern="[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                        <?php if((!empty($errors['email']))): ?>
                            <span class="error"><?php echo htmlspecialchars($errors['email']); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="question">
                        <label for="phone_number">Phone Number*</label>
                        <input type="text" name="phone_number" id="phone_number" required minlength="8" maxlength="12"
                            pattern="[0-9 ]{8,12}" value="<?php echo htmlspecialchars($_POST['phone_number'] ?? ''); ?>">
                        <?php if((!empty($errors['phone_number']))): ?>
                            <span class="error"><?php echo htmlspecialchars($errors['phone_number']); ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="row">
                    <div class="question">
                        <fieldset>
                            <legend>Required Technical Skills*</legend>
                            <?php $technical_skills = $_POST['technical_skills'] ?? []; ?>
                            <p>
                                <input type="checkbox" name="technical_skills[]" id="python" value="python" <?php echo (in_array('python', $technical_skills) ? 'checked' : '')?>>
                                <label for="python">Python</label>
                                <input type="checkbox" name="technical_skills[]" id="java" value="java" <?php echo (in_array('java', $technical_skills) ? 'checked' : '')?>>
                                <label for="java">Java</label>
                                <input type="checkbox" name="technical_skills[]" id="assembly" value="assembly" <?php echo (in_array('assembly', $technical_skills) ? 'checked' : '')?>>
                                <label for="assembly">Assembly</label>
                            </p>
                            <p>
                                <input type="checkbox" name="technical_skills[]" id="networking" value="networking" <?php echo (in_array('networking', $technical_skills) ? 'checked' : '')?>>
                                <label for="networking">Networking</label>
                                <input type="checkbox" name="technical_skills[]" id="switching" value="switching" <?php echo (in_array('switching', $technical_skills) ? 'checked' : '')?>>
                                <label for="switching">Switching</label>
                                <input type="checkbox" name="technical_skills[]" id="routing" value="routing" <?php echo (in_array('routing', $technical_skills) ? 'checked' : '')?>>
                                <label for="routing">Routing</label>
                            </p>
                            <p>
                                <input type="checkbox" id="" name="technical_skills[]" value="other_skills" <?php echo (in_array('other_skills', $technical_skills) ? 'checked' : '')?>>
                                <label for="other_skills_checked">Other Skills</label> 
                            </p>
                        </fieldset>
                        <?php if((!empty($errors['technical_skills']))): ?>
                            <span class="error"><?php echo htmlspecialchars($errors['technical_skills']); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="question">
                        <label for="other_skills">Other Skills:</label>
                        <textarea name="other_skills" id="other_skills" rows="5"><?php echo htmlspecialchars($_POST['other_skills'] ?? ''); ?></textarea>
                        <?php if((!empty($errors['other_skills']))): ?>
                            <span class="error"><?php echo htmlspecialchars($errors['other_skills']); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
            <hr>
            <!-- experience section containing the forms for your previous experiences -->
            <section>
                <h2>Experience</h2>
                <div class="row">
                    <div class="question">
                        <label for="experience_title">Title</label>
                        <input type="text" name="experience_title" id="experience_title" value="<?php echo htmlspecialchars($_POST['experience_title'] ?? ''); ?>">
                         <?php if((!empty($errors['experience_title']))): ?>
                            <span class="error"><?php echo htmlspecialchars($errors['experience_title']); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="question">
                        <label for="experience_company">Company</label>
                        <input type="text" name="experience_company" id="experience_company" value="<?php echo htmlspecialchars($_POST['experience_company'] ?? ''); ?>">
                        <?php if((!empty($errors['experience_company']))): ?>
                            <span class="error"><?php echo htmlspecialchars($errors['experience_company']); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="question">
                        <label for="experience_description">Description</label>
                        <textarea name="experience_description" id="experience_description" rows="5"><?php echo htmlspecialchars($_POST['experience_description'] ?? ''); ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="question">
                        <label for="experience_from_date">From</label>
                        <input type="date" name="experience_from_date" id="experience_from_date" value="<?php echo htmlspecialchars($_POST['experience_from_date'] ?? ''); ?>">
                        <?php if((!empty($errors['experience_from_date']))): ?>
                            <span class="error"><?php echo htmlspecialchars($errors['experience_from_date']); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="question">
                        <label for="experience_to_date">To</label>
                        <input type="date" name="experience_to_date" id="experience_to_date" value="<?php echo htmlspecialchars($_POST['experience_to_date'] ?? ''); ?>">
                        <?php echo htmlspecialchars($_POST['experience_to_date'] ?? ''); ?>
                        <?php if((!empty($errors['experience_to_date']))): ?>
                            <span class="error"><?php echo htmlspecialchars($errors['experience_to_date']); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="question">
                        <p><input type="checkbox" name="currently_working" id="currently_working"
                                value="currently_working" <?php echo (isset($_POST['currently_working'])) ? 'checked' : ''?>>
                            <label for="currently_working">I currently work here</label>
                        </p>
                    </div>
                </div>
            </section>
            <hr>
            <!-- Education section containing your education details -->
            <section>
                <h2>Education</h2>
                <div class="row">
                    <div class="question">
                        <label for="education_institution">Institution</label>
                        <input type="text" name="education_institution" id="education_institution" value="<?php echo htmlspecialchars($_POST['education_institution'] ?? ''); ?>">
                         <?php if((!empty($errors['education_insitution']))): ?>
                            <span class="error"><?php echo htmlspecialchars($errors['education_institution']); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="question">
                        <label for="education_degree">Degree</label>
                        <input type="text" name="education_degree" id="education_degree" value="<?php echo htmlspecialchars($_POST['education_degree'] ?? ''); ?>">
                        <?php if((!empty($errors['education_degree']))): ?>
                            <span class="error"><?php echo htmlspecialchars($errors['education_degree']); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="question">
                        <label for="education_major">Major</label>
                        <input type="text" name="education_major" id="education_major" value="<?php echo htmlspecialchars($_POST['education_major'] ?? ''); ?>">
                        <?php if((!empty($errors['education_major']))): ?>
                            <span class="error"><?php echo htmlspecialchars($errors['education_major']); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="question">
                        <label for="education_description">Description</label>
                        <textarea name="education_description" id="education_description" rows="5"><?php echo htmlspecialchars($_POST['education_description'] ?? ''); ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="question">
                        <label for="education_from_date">From</label>
                        <input type="date" name="education_from_date" id="education_from_date" value="<?php echo htmlspecialchars($_POST['education_from_date'] ?? ''); ?>">
                        <?php if((!empty($errors['education_from_date']))): ?>
                            <span class="error"><?php echo htmlspecialchars($errors['education_from_date']); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="question">
                        <label for="education_to_date">To</label>
                        <input type="date" name="education_to_date" id="education_to_date" value="<?php echo htmlspecialchars($_POST['education_to_date'] ?? ''); ?>">
                        <?php if((!empty($errors['education_to_date']))): ?>
                            <span class="error"><?php echo htmlspecialchars($errors['education_to_date']); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="question">
                        <p><input type="checkbox" name="currently_attending" id="currently_attending"
                                value="currently_attending" <?php echo (isset($_POST['currently_attending'])) ? 'checked' : ''?>>
                            <label for="currently_attending">I currently attend</label>
                        </p>
                    </div>
                </div>
            </section>
            <hr>
            <!-- section to add online profiles like linkedin and github -->
            <section>
                <h2>Your Profiles</h2>
                <div class="row">
                    <div class="question">
                        <label for="linkedin">LinkedIn</label>
                        <input type="url" name="linkedin" id="linkedin" value="<?php echo htmlspecialchars($_POST['linkedin'] ?? ''); ?>">
                        <?php if((!empty($errors['linkedin']))): ?>
                            <span class="error"><?php echo htmlspecialchars($errors['linkedin']); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="question">
                        <label for="twitter">X (Twitter)</label>
                        <input type="url" name="twitter" id="twitter" value="<?php echo htmlspecialchars($_POST['twitter'] ?? ''); ?>">
                        <?php if((!empty($errors['twitter']))): ?>
                            <span class="error"><?php echo htmlspecialchars($errors['twitter']); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="question">
                        <label for="github">Github</label>
                        <input type="url" name="github" id="github" value="<?php echo htmlspecialchars($_POST['github'] ?? ''); ?>">
                        <?php if((!empty($errors['github']))): ?>
                            <span class="error"><?php echo htmlspecialchars($errors['github']); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="question">
                        <label for="personal_website">Personal Website</label>
                        <input type="url" name="personal_website" id="personal_website" value="<?php echo htmlspecialchars($_POST['personal_website'] ?? ''); ?>">
                        <?php if((!empty($errors['personal_website']))): ?>
                            <span class="error"><?php echo htmlspecialchars($errors['personal_website']); ?></span>
                        <?php endif; ?> 
                    </div>
                </div>
            </section>
            <hr>
            <!-- Section to upload the resume -->
            <section>
                <h2>Resume</h2>
                <div class="row">
                    <div class="question">
                        <label for="resume" id="file_input">
                            Upload your resume here <span>only accepts .pdf .docx .doc</span>
                            <input type="file" accept=".pdf,.docx,.doc" name="resume" id="resume">
                        </label>
                    </div>
                </div>
            </section>
            <hr>
            <!-- section to add message for the hiring team -->
            <section>
                <h2>Message to the Hiring Team</h2>
                <div class="row">
                    <div class="question">
                        <label for="message_for_us">Let us know about your interest in working here</label>
                        <textarea name="message_for_us" id="message_for_us" rows="10"></textarea>
                    </div>
                </div>
            </section>
            <input id="submit_button" type="submit" value="Apply">
        </form>
    </main>
    <?php include("footer.inc"); ?> 
</body>

</html>