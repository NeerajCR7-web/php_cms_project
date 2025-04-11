<?php
include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();
include('includes/header.php');
?>

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