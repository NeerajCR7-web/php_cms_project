<?php
if(!isset($page_title)) { 
    $page_title = 'Admin Panel'; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title); ?> - ACE</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Main CSS -->
    <link href="styles.css" rel="stylesheet">
    
    <!-- CKEditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>
    
    <!-- Favicon -->
    <link rel="icon" href="images/favicon.png" type="image/png">
    
    <style>
        /* Avatar Styles */
        .admin-user img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #6C63FF;
        }

        .avatar-fallback {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f0f0f0;
            border-radius: 50%;
            color: #6C63FF;
            font-size: 24px;
        }

        .admin-user {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        /* Ensure the profile image path is correct */
        .admin-user img {
            display: block;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <div class="admin-sidebar">
            <div class="admin-brand">
                <i class="fas fa-cog"></i>
                <h1>TEAM ACE</h1>
            </div>
            
            <ul class="admin-menu">
                <li>
                    <a href="dashboard.php" <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'class="active"' : ''; ?>>
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="projects.php" <?php echo basename($_SERVER['PHP_SELF']) == 'projects.php' ? 'class="active"' : ''; ?>>
                        <i class="fas fa-project-diagram"></i>
                        <span>Projects</span>
                    </a>
                </li>
                <li>
                    <a href="certificates.php" <?php echo basename($_SERVER['PHP_SELF']) == 'certificates.php' ? 'class="active"' : ''; ?>>
                        <i class="fas fa-certificate"></i>
                        <span>Certificates</span>
                    </a>
                </li>
                <li>
                    <a href="skills.php" <?php echo basename($_SERVER['PHP_SELF']) == 'skills.php' ? 'class="active"' : ''; ?>>
                        <i class="fas fa-code"></i>
                        <span>Skills</span>
                    </a>
                </li>
                <li>
                    <a href="users.php" <?php echo basename($_SERVER['PHP_SELF']) == 'users.php' ? 'class="active"' : ''; ?>>
                        <i class="fas fa-users"></i>
                        <span>Users</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="admin-main">
            <!-- Admin Header -->
            <header class="admin-header">
            <!-- Replace the admin-user div with this -->
<div class="admin-user">
    <?php
    if(isset($_SESSION['id'])) {
        $query = 'SELECT photo FROM users WHERE id = '.$_SESSION['id'];
        $result = mysqli_query($connect, $query);
        $user = mysqli_fetch_assoc($result);
        
        if(!empty($user['photo'])) {
            echo '<img src="data:image/jpeg;base64,'.base64_encode($user['photo']).'" alt="User Avatar">';
        } else {
            echo '<div class="avatar-fallback"><i class="fas fa-user-circle"></i></div>';
        }
    }
    ?>
    <div class="admin-user-info">
        <h4><?php echo htmlspecialchars($_SESSION['email']); ?></h4>
        <small>Administrator</small>
    </div>
</div>
                <a href="logout.php" class="admin-logout">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </header>

            <!-- Page Content will be inserted here -->
            <main class="content-wrapper">