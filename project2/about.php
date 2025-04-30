<!-- 
============================================================
  File Name: index.html
  Description: [Brief description of the file's purpose and functionality]
  Author: The Optional Group
  Page Maanger: Nikolas Popovic
  Created On: 3/28/2025
  Last Updated: 3/28/2025
  Version: 0.0.1
  ============================================================
  Project: Project Part 1
  Dependencies: styles.css
  Changelog:
    - Latest Chnage: [Date]: [Change description]
    - What needs to be done: [Date]: [Change description]
============================================================
-->


<!DOCTYPE html>
<html lang="en">

<head> <!-- Adds web browser support meta tags for format and search algorithm-->
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
        <!-- title is sectioned to easily apply css -->
        <section id="hero">
            <div id="hero_text">
                <h1>The Optional Group</h1>
                <p id="hero_tagline">Helping you is always an Option</p>
            </div>
        </section>

        <!-- content is sectioned to easily apply css -->
        <div id="index_main">
            <section id="about_us">
                <h2>About Us</h2>
                <!-- row to keep image and text inline -->
                <div class="row" id="responsive">
                    <div class="column">
                        <p>The Optional Group is a forward-thinking technology company dedicated to bridging the digital
                            divide by setting up advanced, sustainable networks for remote communities and off-grid
                            locations. By combining cutting-edge technology with green, eco-friendly practices, we
                            empowerunderserved areas with reliable, high-speed internet access and smart solutions that
                            promote environmental sustainability. Our mission is to create interconnected,
                            self-sufficient
                            ecosystems that enable remote communities to thrive through innovation, while minimising
                            environmental impact. At The Optional Group, we believe technology should enhance the
                            quality of life without compromising the planet.</p>
                        <a id="link_about_us" href="about.html" class="button">Find Out More!</a>
                    </div>
                    <div class="column">
                        <img id="setup" src="images/setup.jpg" alt="cool setup over here">
                    </div>
                </div>
            </section>
            <hr>
            <section>
                <h2>Services We Offer</h2>
                <!-- ChatGPT GenAI Prompt: Give a list of services that the optional group offers  -->
                <div class="row">
                    <div class="column">
                        <h3>🌐 Network Infrastructure & Connectivity</h3>
                        <ul>
                            <li>High-Speed Internet Deployment for remote and off-grid areas</li>
                            <li>Wireless Mesh Networks for flexible, scalable coverage</li>
                            <li>Satellite & Microwave Link Integration for long-distance connectivity</li>
                            <li>Rural & Remote 5G Solutions</li>
                        </ul>
                    </div>
                    <div class="column">
                        <h3>⚡ Sustainable Energy-Powered Systems</h3>
                        <ul>
                            <li>Solar-Powered Network Installations</li>
                            <li>Hybrid Energy Solutions (solar, wind, and battery storage)</li>
                            <li>Green Power Infrastructure Consulting</li>
                        </ul>
                    </div>
                    <div class="column">
                        <h3>📡 Remote Monitoring & Smart Infrastructure</h3>
                        <ul>
                            <li>Real-Time Network Performance Monitoring</li>
                            <li>Smart Grid Integration & Management</li>
                            <li>Remote Equipment Diagnostics & Predictive Maintenance</li>
                            <li>Data Analytics for Infrastructure Optimisation</li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <h3>♻️ Eco-Friendly Infrastructure Planning</h3>
                        <ul>
                            <li>Low-impact Site Design & Deployment</li>
                            <li>Environmentally Sustainable Equipment Procurement</li>
                            <li>Carbon Footprint Assessment & Mitigation</li>
                        </ul>
                    </div>
                    <div class="column">
                        <h3>🛠️ Custom Tech Solutions & Consulting</h3>
                        <ul>
                            <li>Tailored Connectivity Planning for unique geographic or demographic needs</li>
                            <li>Resilience & Disaster Recovery Networks</li>
                            <li>Monitoring & Maintenance Services with remote diagnostics</li>
                        </ul>
                    </div>
                    <div class="column">
                        <h3>🏘️ Community Tech Enablement</h3>
                        <ul>
                            <li>Digital Hubs & Community Wi-Fi Zones</li>
                            <li>Local Tech Training & Support Programs</li>
                            <li>IoT-Enabled Smart Village Solutions (e.g., smart agriculture, water monitoring)</li>
                        </ul>
                    </div>
                </div>
            </section>
            <hr>
            <section id="hiring">
                <h2>We are currently hiring!</h2>
                <div class="row">
                    <div class="column blue_section">
                        <h3>Want to find out about our positions?</h3>
                        <p>Click the button to find out more</p>
                        <a href="jobs.html" id="job_button" class="button">Job Positions</a>
                    </div>
                </div>
                <div class="row">
                    <div class="column green_section">
                        <h3>How to Apply?</h3>
                        <p>You can apply by going to the Apply page</p>
                        <a href="apply.html" id="apply_button" class="button">Apply Now!</a>
                    </div>
                </div>
            </section>
            <hr>
            <section>
                <h2>Contact Us</h2>
                <form action="https://mercury.swin.edu.au/it000000/formtest.php" method="post">
                    <div class="row">
                        <div class="question">
                            <label for="name">Name:</label>
                            <input type="text" name="name" id="name">
                        </div>
                        <div class="question">
                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" pattern="[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}">
                        </div>
                        <div class="question">
                            <label for="phone_number">Phone:</label>
                            <input type="text" name="phone_number" id="phone_number" minlength="8" maxlength="12"
                                pattern="[0-9 ]{8,12}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="question">
                            <label for="message">Message:</label>
                            <textarea name="message" id="message" rows="10"></textarea>
                        </div>
                    </div>
                    <input id="submit_button" type="submit" value="Send Message">
                </form>
            </section>
        </div>
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