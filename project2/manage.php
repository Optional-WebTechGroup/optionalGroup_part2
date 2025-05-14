basic html structure 

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
    <header>
         <a href="index.html"><img src="images/the_optional_group_logo.png" alt="The Optional Group Logo"
                class="logo"></a>
        <!-- ChatGPT GenAI Image Prompt: Create an image for a company logo for It company called The Optional Group. It’s a company which supplies remote it support and environmental impact. The group colours are blues, greens, and shades-->
        <nav class="nav">
            <ul class="nav_links">
                <li><a href="index.html" class="active">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="jobs.html">Jobs</a></li>
                <li><a href="apply.html">Apply</a></li>
            </ul>
        </nav>
        <a id="cta" href="mailto:info@theoptionalgroup.com.au">Email Us</a>
    </header>
	
    <main>
        <p>This is a basic HTML template with meta tags, a header, and a body section.</p>
    </main>
	
    <footer>
        <div id="footer_nav">
            <a href="index.html"><img src="images/the_optional_group_logo.png" alt="The Optional Group Logo"
                    class="logo"></a>
            <!-- ChatGPT GenAI Image Prompt: Create an image for a company logo for It company called The Optional Group. It’s a company which supplies remote it support and environmental impact. The group colours are blues, greens, and shades-->
            <ul id="footer_links">
                <li><a href="index.html">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="jobs.html">Jobs</a></li>
                <li><a href="apply.html">Apply</a></li>
            </ul>
        </div>
        <div id="footer_row">
            <a class="footer_link" href="https://nagooptional.atlassian.net/jira/software/projects/SCRUM/summary"
                target="_blank">Jira
                Project Link</a>
            <a class="footer_link" href="https://github.com/Optional-WebTechGroup/OptionalGroupProject01"
                target="_blank">Github Repo Link</a>
        </div>
        <p id="copyright">&copy; Copyright 2025 | The Optional Group | All Rights Reserved</p>
    </footer>
</body>
</html>
