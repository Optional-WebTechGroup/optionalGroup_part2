<?php $current_page = basename($_SERVER['PHP_SELF']); ?>
 <header>
    <a href="index.php"><img src="images/the_optional_group_logo.png" alt="The Optional Group Logo"
            class="logo"></a>
    <!-- ChatGPT GenAI Image Prompt: Create an image for a company logo for It company called The Optional Group. It’s a company which supplies remote it support and environmental impact. The group colours are blues, greens, and shades-->
    <nav class="nav">
        <ul class="nav_links">
            <li><a href="login.php" <?php if ($current_page == 'login.php') echo 'class="active"'; ?>>Login</a></li>
            <li><a href="signup.php" <?php if ($current_page == 'signup.php') echo 'class="active"'; ?>>Sign Up</a></li>
        </ul>
    </nav>
    <a id="cta" href="mailto:info@theoptionalgroup.com.au">Email Us</a>
</header>