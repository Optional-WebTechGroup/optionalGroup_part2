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
    <?php include('header.inc') ?>
    <main id="about_main">
        <h1>About <span class="text_gradient">The Optional Group</span></h1>

        <hr>

        <!-- ChatGPT GenAI Prompt: what other things should the about page of our website have instead of the mission and vision, provide the content for each section -->
        <section class="green_section">
            <h2>📖 Our Story</h2>
            <p>The Optional Group began with a simple belief: that access to technology and the internet shouldn't be a
                privilege—it should be a right. Founded by a group of tech innovators and sustainability advocates, we
                saw how remote and off-grid communities were being left behind in the digital age.
                So we set out to change that.
                Today, we're building future-ready, eco-conscious networks that empower people, uplift communities, and
                protect the environment. Because we believe innovation should improve lives—not just in cities, but
                everywhere.</p>
        </section>

        <!--section and div-->
        <section>
            <div class="row">
                <div class="column blue_section">
                    <h2>🌍 Mission Statement</h2>
                    <p>To empower remote and off-grid communities by delivering sustainable, high-speed connectivity
                        through cutting-edge technology and eco-friendly infrastructure—enabling people to thrive
                        without compromising the planet.</p>
                </div>
                <div class="column blue_section">
                    <h2>🌱 Vission Statement</h2>
                    <p>To be a global leader in bridging the digital divide by creating self-sufficient, environmentally
                        responsible ecosystems where every community, no matter how remote, can access the opportunities
                        of the digital world.</p>
                </div>
            </div>
        </section>

        <!-- Section and div-->
        <section>
            <div class="row">
                <div class="column green_section">
                    <h2>Real Results, Real Change</h2>
                    <ul>
                        <li>+25 remote communities connected across the region</li>
                        <li>100% solar-powered infrastructure across all project sites</li>
                        <li>98% uptime even in challenging environments</li>
                        <li>Thousands of lives improved through access to education, health, and opportunity</li>
                    </ul>
                </div>
                <div class="column green_section">
                    <h2>Testimonial</h2>
                    <blockquote>
                        <q>
                            Thanks to The Optional Group, our school now has internet access for the first time. Our
                            students can now learn beyond the textbooks.
                        </q>
                        <p>- Teacher, rural Philippines</p>
                    </blockquote>
                </div>
            </div>
        </section>

        <hr>

        <h2 id="team">Meet Our Team</h2>
        <!-- Section and div with linked class for Class Details-->
        <section class="Class_Details">
            <div class="Class_Name">
                <h2> Class Details </h2>
                <ul>
                    <li>The Optional Group
                        <ul>
                            <li>2.30pm - 4.30pm Wednesday</li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="Tutor">
                <p> <strong> Class Tutor: </strong> </p>
                <p> <strong> Rahul Raghavan </strong> </p>
            </div>
        </section>

        <!-- Div and subsection with linked class for Member Details-->
        <div class="Member_Details">
            <section class="GroupIDs">
                <h2> Group Members </h2>
                <ul>
                    <li> Aldrin Filbert Maano: 105667785 </li>
                    <li> Giuliano Zuccara: 105910780 </li>
                    <li> Nikolas Popovic: 105920284 </li>
                    <li> Oliver Scott: 105912692 </li>
                </ul>
            </section>
            <section class="MemberCont">
                <h2>Member contributions</h2>
                <dl> <!-- Defintion List elements for text of Member Contributions-->
                    <dt> Aldrin Filbert Maano </dt>
                    <dd> contributions: Team Leader, apply.html Page Manager, CSS contributor, EOI table and validation</dd>

                    <dt> Giuliano Zuccara </dt>
                    <dd> contributions: jobs.html Page Manager, CSS contributor, job description table</dd>

                    <dt> Nikolas Popovic </dt>
                    <dd> contributions: index.html Page Manager, CSS contributor, manage.php</dd>

                    <dt> Oliver Scott </dt>
                    <dd> contributions: About.html Page Manager, CSS contributor, settings.php, modularisation</dd>
                </dl>
            </section>
        </div>

        <!-- Section and subsection with linked class for Member Styles-->
        <div class="Member_Styles row">
            <div class="Member_Interests">
                <table> <!-- Table elements for Member Interests-->
                    <caption><strong>Members Interests </strong></caption> <!-- bold accessability tag-->

                    <thead>
                        <tr>
                            <th> Group Member </th>
                            <th> Computer Science Interests </th>
                            <th> Recreational Interests </th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td class="MemberNames"> Aldrin Filbert Maano </td>
                            <td> AI, Robotics</td>
                            <td> Anime, Manga </td>
                        </tr>
                        <tr>
                            <td class="MemberNames"> Giuliano Zuccara </td>
                            <td> How computers work, Programming </td>
                            <td> Moding consoles, Playing Video Games</td>
                        </tr>
                        <tr>
                            <td class="MemberNames"> Nikolas Popovic </td>
                            <td> Cyber Security, Programming</td>
                            <td> Music, Playing Video Games</td>
                        </tr>
                        <tr>
                            <td class="MemberNames"> Oliver Scott </td>
                            <td> Automative systems, Programming</td>
                            <td> Reading Comics, Playing Video Games</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Section sub for GroupPhoto figure tag with alternative text-->
            <div class="GroupPhoto_Section">
                <figure>
                    <img id="GroupPhoto" src="images/OptionalGroupPh.jpg"
                        alt="A group photo of the members of The Optional Group" title="The Optional group"
                        loading="lazy">
                    <figcaption>A group photo of the members of The Optional Group</figcaption>
                </figure>
            </div>
        </div>


    </main>
    <?php include('footer.inc') ?>
</body>

</html>