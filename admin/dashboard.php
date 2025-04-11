<?php
include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();
include('includes/header.php');
?>

<h2>Dashboard</h2>

<ul id="dashboard">
    <li>
        <a href="projects.php">
            <i class="fas fa-project-diagram"></i>
            Manage Projects
        </a>
    </li>
    <li>
        <a href="certificates.php">
            <i class="fas fa-certificate"></i>
            Manage Certificates
        </a>
    </li>
    <li>
        <a href="skills.php">
            <i class="fas fa-code"></i>
            Manage Skills
        </a>
    </li>
    <li>
        <a href="users.php">
            <i class="fas fa-users"></i>
            Manage Users
        </a>
    </li>
</ul>

<?php
include('includes/footer.php');
?>