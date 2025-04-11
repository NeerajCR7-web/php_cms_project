<?php
include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();
include('includes/header.php');
?>

<style>
.team-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
    padding: 20px;
}

.team-card {
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.team-image {
    width: 100%;
    height: 200px; /* Fixed height for images */
    overflow: hidden;
}

.team-image img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Ensures images maintain aspect ratio */
    object-position: center; /* Centers the image */
}

.team-info {
    padding: 15px;
}

.team-info h3 {
    margin-top: 0;
}

.role {
    font-weight: bold;
    color: #555;
    margin: 5px 0;
}

.skills {
    font-size: 0.9em;
    margin: 5px 0;
}

.bio {
    font-size: 0.9em;
    margin: 10px 0;
}

.team-links {
    margin-top: 15px;
}

.team-links a {
    margin-right: 10px;
    color: #333;
    font-size: 1.2em;
}
</style>

<h2>Team ACE Members</h2>

<div class="team-grid">
    <?php
    $query = 'SELECT * FROM team_members ORDER BY name';
    $result = mysqli_query($connect, $query);
    
    while($member = mysqli_fetch_assoc($result)):
    ?>
    <div class="team-card">
        <div class="team-image">
            <img src="images/team/<?php echo htmlentities($member['image']); ?>" alt="<?php echo htmlentities($member['name']); ?>">
        </div>
        <div class="team-info">
            <h3><?php echo htmlentities($member['name']); ?></h3>
            <p class="role"><?php echo htmlentities($member['role']); ?></p>
            <p class="skills"><strong>Skills:</strong> <?php echo htmlentities($member['skills']); ?></p>
            <p class="bio"><?php echo htmlentities($member['bio']); ?></p>
            <div class="team-links">
                <a href="mailto:<?php echo htmlentities($member['email']); ?>"><i class="fas fa-envelope"></i></a>
                <?php if($member['linkedin']): ?>
                    <a href="<?php echo htmlentities($member['linkedin']); ?>" target="_blank"><i class="fab fa-linkedin"></i></a>
                <?php endif; ?>
                <?php if($member['github']): ?>
                    <a href="<?php echo htmlentities($member['github']); ?>" target="_blank"><i class="fab fa-github"></i></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
</div>

<?php
include('includes/footer.php');
?>