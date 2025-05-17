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
    <?php include("header.inc") ?>
    <main id="apply_main">
        <!-- title section with the reference dropdown below -->
        <h1>Apply to your <span class="text_gradient">Dream Job</span></h1>
        <form action="process_eoi.php" method="post">
            <p class="center"><label for="reference_number">Job Reference Number: </label>
                <select name="reference_number" id="reference_number" required>
                    <option value="">Please Select</option>
                    <option value="5KC3U">5KC3U</option>
                    <option value="PXUB6">PXUB6</option>
                </select>
            </p>
            <hr>
            <!-- Section to add personal informations -->
            <section>
                <h2>Personal Information</h2>
                <p>Fields marked with * are required.</p>

                <div class="row">
                    <div class="question">
                        <label for="first_name">First name*</label>
                        <input type="text" name="first_name" id="first_name" required maxlength="20">
                    </div>
                    <div class="question">
                        <label for="last_name">Last name*</label>
                        <input type="text" name="last_name" id="last_name" required maxlength="20">
                    </div>
                </div>

                <div class="row">
                    <div class="question">
                        <!-- input for birthdate, follows the patter of DD/MM/YYYY -->
                        <label for="birthdate">Birthdate*</label>
                        <input type="text" name="birthdate" id="birthdate" required placeholder="DD/MM/YYYY"
                            pattern="(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[12])\/(\d){4}">
                    </div>

                    <fieldset class="question">
                        <legend>Gender*</legend>
                        <p> <input type="radio" id="male" name="gender" value="male" required>
                            <label for="male">Male</label>
                            <input type="radio" id="female" name="gender" value="female">
                            <label for="female">Female</label>
                        </p>
                    </fieldset>
                </div>

                <div class="row">
                    <div class="question">
                        <label for="street_address">Street Address*</label>
                        <input type="text" name="street_address" id="street_address" required maxlength="40">
                    </div>
                    <div class="question">
                        <label for="suburb">Suburb/Town*</label>
                        <input type="text" name="suburb" id="suburb" required maxlength="40">
                    </div>
                </div>

                <div class="row">
                    <!-- dropdown for state and input for postcode that has the pattern for postcodes for australia -->
                    <!-- can't make it only accept postcode based on the specific state as it requires javascript because it's a type of dynamic action -->
                    <p class="question"><label for="state">State*: </label>
                        <select name="state" id="state" required>
                            <option value="">Please Select</option>
                            <option value="ACT">Australian Capital Territory</option>
                            <option value="NSW">New South Wales</option>
                            <option value="NT">Northern Territory</option>
                            <option value="QLD">Queensland</option>
                            <option value="WA">South Australia</option>
                            <option value="TAS">Tasmania</option>
                            <option value="VIC">Victoria</option>
                            <option value="SA">Western Australia</option>
                        </select>
                    </p>
                    <div class="question">
                        <label for="postcode">Postcode*</label>
                        <input type="text" name="postcode" id="postcode" required minlength="4" maxlength="4"
                            pattern="(0[289][0-9]{2})|([1-9][0-9]{3})">
                    </div>

                </div>

                <div class="row">
                    <div class="question">
                        <!-- input for email address following the correct email address pattern -->
                        <label for="email_address">Email Address*</label>
                        <input type="text" name="email_address" id="email_address" required
                            pattern="[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}">
                    </div>
                    <div class="question">
                        <label for="phone_number">Phone Number*</label>
                        <input type="text" name="phone_number" id="phone_number" required minlength="8" maxlength="12"
                            pattern="[0-9 ]{8,12}">
                    </div>
                </div>

                <div class="row">
                    <div class="question">
                        <fieldset>
                            <legend>Required Technical Skills*</legend>
                            <p>
                                <input type="checkbox" name="technical_skills[]" id="python" value="python" required
                                    checked>
                                <label for="python">Python</label>
                                <input type="checkbox" name="technical_skills[]" id="java" value="java">
                                <label for="java">Java</label>
                                <input type="checkbox" name="technical_skills[]" id="assembly" value="assembly">
                                <label for="assembly">Assembly</label>
                            </p>
                            <p>
                                <input type="checkbox" name="technical_skills[]" id="networking" value="networking">
                                <label for="networking">Networking</label>
                                <input type="checkbox" name="technical_skills[]" id="switching" value="switching">
                                <label for="switching">Switching</label>
                                <input type="checkbox" name="technical_skills[]" id="routing" value="routing">
                                <label for="routing">Routing</label>
                            </p>
                        </fieldset>
                    </div>
                    <div class="question">
                        <label for="other_skills">Other Skills:</label>
                        <textarea name="other_skills" id="other_skills" rows="5"></textarea>
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
                        <input type="text" name="experience_title" id="experience_title">
                    </div>
                    <div class="question">
                        <label for="experience_company">Company</label>
                        <input type="text" name="experience_company" id="experience_company">
                    </div>
                </div>
                <div class="row">
                    <div class="question">
                        <label for="experience_description">Description</label>
                        <textarea name="experience_description" id="experience_description" rows="5"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="question">
                        <label for="experience_from_date">From</label>
                        <input type="date" name="experience_from_date" id="experience_from_date">
                    </div>
                    <div class="question">
                        <label for="experience_to_date">To</label>
                        <input type="date" name="experience_to_date" id="experience_to_date">
                    </div>
                </div>
                <div class="row">
                    <div class="question">
                        <p><input type="checkbox" name="currently_working" id="currently_working"
                                value="currently_working">
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
                        <input type="text" name="education_institution" id="education_institution">
                    </div>
                </div>
                <div class="row">
                    <div class="question">
                        <label for="education_degree">Degree</label>
                        <input type="text" name="education_degree" id="education_degree">
                    </div>
                    <div class="question">
                        <label for="education_major">Major</label>
                        <input type="text" name="education_major" id="education_major">
                    </div>
                </div>
                <div class="row">
                    <div class="question">
                        <label for="education_description">Description</label>
                        <textarea name="education_description" id="education_description" rows="5"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="question">
                        <label for="education_from_date">From</label>
                        <input type="date" name="education_from_date" id="education_from_date">
                    </div>
                    <div class="question">
                        <label for="education_to_date">To</label>
                        <input type="date" name="education_to_date" id="education_to_date">
                    </div>
                </div>
                <div class="row">
                    <div class="question">
                        <p><input type="checkbox" name="currently_attending" id="currently_attending"
                                value="currently_attending">
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
                        <input type="text" name="linkedin" id="linkedin">
                    </div>
                    <div class="question">
                        <label for="twitter">X (Twitter)</label>
                        <input type="text" name="twitter" id="twitter">
                    </div>
                </div>
                <div class="row">
                    <div class="question">
                        <label for="github">Github</label>
                        <input type="text" name="github" id="github">
                    </div>
                    <div class="question">
                        <label for="personal_website">Personal Website</label>
                        <input type="text" name="personal_website" id="personal_website">
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