<!DOCTYPE html> <!-- derfines program langauge file as html-->
<html lang="en"> <!-- defines actual language as English 'en' -->
<head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="The Optional Group">
    <meta name="author" content="">
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="shortcut icon" href="images/OptionalGroup_Tab_Icon.png">
    <!-- ChatGPT GenAI Image Prompt: Create an image for a company logo for It company called The Optional Group. It’s a company which supplies remote it support and environmental impact. The group colours are blues, greens, and shades-->
    <title>The Optional Group</title>
</head>
<body>
    
	<?php include_once 'header.inc'; ?>
    
    <main>
        
        <h1>Manager Profile</h1>

        <form method="post" action="">
            <section>
                <label for="JobReference">EOI: Job Reference Number</label>
                <br>
                <input type="text" name="EOI_reference" id="EOI_reference" required maxlength="20">
                <input id="submit_button" type="submit" value="Search">
                <input id="submit_button" type="submit" value="Delete EOI References">
            </section>
        </form>
        <input id="submit_button" type="submit" value="Search All">
        <Form method="post" action="">
            <section>
                <label for="ApplicantSurname">Find Applicant (Surname)</label>
                <br>
                <input type="text" name="Applicant" id="Applicant" required maxlength="20">
                <input id="submit_button" type="submit" value="Find Applicant">
            </section>
        </Form>

    </main>
	
    <?php include_once 'footer.inc'; ?>

</body>
</html>