<?php
include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();
include('includes/header.php');
?>

<div class="dashboard-container">
    <!-- Hero Section -->
    <div class="dashboard-hero">
        <div class="hero-content">
            <div class="team-badge pulse">
                <i class="fas fa-star"></i>
                <span>TEAM ACE</span>
            </div>
            <h1>Team ACE Welcomes You</h1>
            <p class="tagline">Where Excellence Meets Innovation</p>
            <div class="team-motto">
                <p>"Achieving, Creating, Excelling - Together We Build Digital Masterpieces"</p>
            </div>
        </div>
        <div class="hero-image">
            <img src="images/team/team-banner.jpg" alt="Team ACE Collaboration">
        </div>
    </div>

    <!-- Stats Cards - Replaced Section -->
    <div class="stats-container">
        <div class="stat-card">
            <i class="fas fa-code-branch"></i>
            <h3>20+</h3>
            <p>Projects Completed</p>
        </div>
        <div class="stat-card">
            <i class="fas fa-users"></i>
            <h3>3</h3>
            <p>Team Members</p>
        </div>
        <div class="stat-card">
            <i class="fas fa-trophy"></i>
            <h3>12</h3>
            <p>Awards Won</p>
        </div>
        <div class="stat-card">
            <i class="fas fa-smile"></i>
            <h3>100%</h3> 
            <p>Client Satisfaction</p>
        </div>
    </div>

    <!-- Team Preview -->
    <div class="team-preview">
        <h2>Meet Team ACE</h2>
        <div class="team-grid">
            <?php
            $query = 'SELECT * FROM team_members ORDER BY RAND() LIMIT 3';
            $result = mysqli_query($connect, $query);
            
            while($member = mysqli_fetch_assoc($result)):
            ?>
            <div class="team-member-card">
                <img src="images/team/<?php echo htmlentities($member['image']); ?>" alt="<?php echo htmlentities($member['name']); ?>">
                <h3><?php echo htmlentities($member['name']); ?></h3>
                <p class="role"><?php echo htmlentities($member['role']); ?></p>
                <div class="skills">
                    <?php 
                    $skills = explode(',', $member['skills']);
                    foreach(array_slice($skills, 0, 3) as $skill): 
                    ?>
                    <span><?php echo trim($skill); ?></span>
                    <?php endforeach; ?>
                    <?php if(count($skills) > 3): ?>
                    <span>+<?php echo (count($skills) - 3); ?> more</span>
                    <?php endif; ?>
                </div>
                <a href="team_members.php?id=<?php echo $member['id']; ?>" class="view-profile">View Profile</a>
            </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!-- Quick Management -->
    <div class="quick-links">
        <h2>Quick Management</h2>
        <div class="management-grid">
            <a href="projects.php" class="management-card">
                <i class="fas fa-project-diagram"></i>
                <h3>Projects</h3>
                <p>Manage portfolio projects</p>
            </a>
            <a href="certificates.php" class="management-card">
                <i class="fas fa-certificate"></i>
                <h3>Certificates</h3>
                <p>Manage certifications</p>
            </a>
            <a href="skills.php" class="management-card">
                <i class="fas fa-code"></i>
                <h3>Skills</h3>
                <p>Manage technical skills</p>
            </a>
            <a href="users.php" class="management-card">
                <i class="fas fa-user-cog"></i>
                <h3>Users</h3>
                <p>Manage admin users</p>
            </a>
            <a href="team_members.php" class="management-card">
                <i class="fas fa-users"></i>
                <h3>Team</h3>
                <p>Manage team members</p>
            </a>
            <a href="settings.php" class="management-card">
                <i class="fas fa-cog"></i>
                <h3>Settings</h3>
                <p>System configuration</p>
            </a>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="recent-activity">
        <h2>Recent Activity</h2>
        <div class="activity-list">
            <?php
            $activities = [
                ['icon' => 'fas fa-project-diagram', 'text' => 'Added new project "IPL Award Management System"', 'time' => '2 hours ago'],
                ['icon' => 'fas fa-user-plus', 'text' => 'New team member Harsh joined', 'time' => '1 day ago'],
                ['icon' => 'fas fa-certificate', 'text' => 'Updated AWS Certification', 'time' => '2 days ago'],
                ['icon' => 'fas fa-code', 'text' => 'Added React skill to portfolio', 'time' => '3 days ago']
            ];
            
            foreach($activities as $activity):
            ?>
            <div class="activity-item">
                <i class="<?php echo $activity['icon']; ?>"></i>
                <div class="activity-content">
                    <p><?php echo $activity['text']; ?></p>
                    <small><?php echo $activity['time']; ?></small>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<style>
    /* Dashboard Styles */
    .dashboard-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 20px;
    }
    
    .dashboard-hero {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: linear-gradient(135deg, var(--primary), var(--accent));
        color: white;
        padding: 40px;
        border-radius: 16px;
        margin-bottom: 40px;
        box-shadow: var(--shadow-lg);
    }
    
    .hero-content {
        flex: 1;
        padding-right: 40px;
    }
    
    .hero-image {
        flex: 1;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: var(--shadow-xl);
        max-height: 350px;
    }
    
    .hero-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .team-badge {
        display: inline-flex;
        align-items: center;
        background: rgba(255,255,255,0.2);
        padding: 8px 16px;
        border-radius: 50px;
        margin-bottom: 20px;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.9rem;
        letter-spacing: 1px;
    }
    
    .team-badge i {
        margin-right: 10px;
        color: var(--warning);
    }
    
    .dashboard-hero h1 {
        font-size: 2.5rem;
        margin-bottom: 10px;
        font-weight: 800;
    }
    
    .tagline {
        font-size: 1.2rem;
        opacity: 0.9;
        margin-bottom: 20px;
    }
    
    .team-motto {
        font-style: italic;
        background: rgba(255,255,255,0.1);
        padding: 15px;
        border-radius: 8px;
        border-left: 4px solid var(--warning);
    }
    
    /* Stats Cards - Updated Section */
    .stats-container {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 40px;
    }
    
    .stat-card {
        background: white;
        padding: 25px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    .stat-card i {
        font-size: 2.5rem;
        color: var(--primary);
        margin-bottom: 15px;
    }
    
    .stat-card h3 {
        font-size: 2.2rem;
        color: var(--dark);
        margin-bottom: 5px;
    }
    
    .stat-card p {
        color: var(--gray);
        font-size: 1rem;
    }
    
    /* Rest of your existing styles remain unchanged */
    .team-preview {
        margin-bottom: 40px;
    }
    
    .team-preview h2 {
        margin-bottom: 20px;
        color: var(--dark);
        font-size: 1.8rem;
    }
    
    .team-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
    }
    
    .team-member-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: var(--shadow-md);
        transition: var(--transition);
        text-align: center;
    }
    
    .team-member-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-lg);
    }
    
    .team-member-card img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        border-bottom: 3px solid var(--primary);
    }
    
    .team-member-card h3 {
        font-size: 1.5rem;
        margin: 20px 0 5px;
        color: var(--dark);
    }
    
    .team-member-card .role {
        color: var(--secondary);
        font-weight: 600;
        margin-bottom: 15px;
    }
    
    .team-member-card .skills {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        justify-content: center;
        padding: 0 20px 20px;
    }
    
    .team-member-card .skills span {
        background: var(--light-gray);
        padding: 5px 12px;
        border-radius: 50px;
        font-size: 0.8rem;
        color: var(--dark);
    }
    
    .team-member-card .view-profile {
        display: inline-block;
        margin-bottom: 20px;
        padding: 8px 20px;
        background: var(--primary);
        color: white;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition);
    }
    
    .team-member-card .view-profile:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
    }
    
    .quick-links {
        margin-bottom: 40px;
    }
    
    .quick-links h2 {
        margin-bottom: 20px;
        color: var(--dark);
        font-size: 1.8rem;
    }
    
    .management-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }
    
    .management-card {
        background: white;
        padding: 30px;
        border-radius: 12px;
        text-align: center;
        box-shadow: var(--shadow-md);
        transition: var(--transition);
        color: var(--dark);
        text-decoration: none;
    }
    
    .management-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
        background: var(--primary);
        color: white;
    }
    
    .management-card:hover i {
        color: white;
    }
    
    .management-card i {
        font-size: 2.5rem;
        color: var(--primary);
        margin-bottom: 20px;
        transition: var(--transition);
    }
    
    .management-card h3 {
        font-size: 1.3rem;
        margin-bottom: 10px;
    }
    
    .management-card p {
        font-size: 0.9rem;
        opacity: 0.8;
    }
    
    .recent-activity {
        margin-bottom: 40px;
    }
    
    .recent-activity h2 {
        margin-bottom: 20px;
        color: var(--dark);
        font-size: 1.8rem;
    }
    
    .activity-list {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: var(--shadow-md);
    }
    
    .activity-item {
        display: flex;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px solid var(--light-gray);
    }
    
    .activity-item:last-child {
        border-bottom: none;
    }
    
    .activity-item i {
        width: 40px;
        height: 40px;
        background: var(--light-gray);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        color: var(--primary);
    }
    
    .activity-content p {
        margin-bottom: 5px;
        font-weight: 500;
    }
    
    .activity-content small {
        color: var(--gray);
        font-size: 0.8rem;
    }
    
    @media (max-width: 992px) {
        .dashboard-hero {
            flex-direction: column;
        }
        
        .hero-content {
            padding-right: 0;
            margin-bottom: 30px;
        }
        
        .hero-image {
            width: 100%;
        }
        
        .stats-container {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 768px) {
        .team-grid {
            grid-template-columns: 1fr;
        }
    }
    
    @media (max-width: 576px) {
        .stats-container {
            grid-template-columns: 1fr;
        }
        
        .dashboard-hero {
            padding: 25px;
        }
        
        .dashboard-hero h1 {
            font-size: 2rem;
        }
    }
</style>

<?php
include('includes/footer.php');
?>