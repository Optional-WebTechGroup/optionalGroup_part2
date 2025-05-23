 <?php $current_page = basename($_SERVER['PHP_SELF']); ?>
 <header>
    <a href="index.php"><img src="images/the_optional_group_logo.png" alt="The Optional Group Logo"
            class="logo"></a>
    <!-- ChatGPT GenAI Image Prompt: Create an image for a company logo for It company called The Optional Group. It’s a company which supplies remote it support and environmental impact. The group colours are blues, greens, and shades-->
    <nav class="nav">
        <ul class="nav_links">
            <li><a href="index.php" <?php if ($current_page == 'index.php') echo 'class="active"'; ?>>Home</a></li>
            <li><a href="about.php" <?php if ($current_page == 'about.php') echo 'class="active"'; ?>>About</a></li>
            <li><a href="jobs.php" <?php if ($current_page == 'jobs.php') echo 'class="active"'; ?>>Jobs</a></li>
            <li><a href="apply.php" <?php if ($current_page == 'apply.php') echo 'class="active"'; ?>>Apply</a></li>
            <li><a href="manage.php" <?php if ($current_page == 'manage.php') echo 'class="active"'; ?>>Manage</a></li>
        </ul>
    </nav>
    <a id = "logout" href="logout.php" style="text-decoration:none;">Logout</a>
</header>