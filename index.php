<?php
include('admin/includes/database.php');
include('admin/includes/config.php');
include('admin/includes/functions.php');
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
    <title>My Portfolio</title>
    <link href="adminstyles.css" type="text/css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>
</head>
<body>

    <header>
        <h1>Welcome to My Portfolio!</h1>
        <p>Showcasing my work and achievements</p>
    </header>

    <section class="projects-section">
        <h2>My Projects</h2>
        <?php
        $query = 'SELECT * FROM projects ORDER BY date DESC';
        $result = mysqli_query($connect, $query);
        ?>
        <p>There are <?php echo mysqli_num_rows($result); ?> projects in my portfolio!</p>
        
        <div class="projects-container">
            <?php while($record = mysqli_fetch_assoc($result)): ?>
            <div class="project-card">
                <?php if($record['photo']): ?>
                <div class="project-image">
                    <img src="admin/image.php?type=project&id=<?php echo $record['id']; ?>&width=400&height=300">
                </div>
                <?php endif; ?>
                <div class="project-details">
                    <h3><?php echo $record['title']; ?></h3>
                    <p class="project-date"><?php echo date('F Y', strtotime($record['date'])); ?></p>
                    <div class="project-content"><?php echo $record['content']; ?></div>
                    <?php if($record['url']): ?>
                        <a href="<?php echo $record['url']; ?>" target="_blank" class="view-btn">View Project</a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </section>

    <section class="certificates-section">
        <h2>My Certificates</h2>
        <?php
        $query = 'SELECT * FROM certificates ORDER BY date DESC';
        $result = mysqli_query($connect, $query);
        ?>
        <p>There are <?php echo mysqli_num_rows($result); ?> certificates in my portfolio!</p>
        
        <div class="certificates-container">
            <?php while($record = mysqli_fetch_assoc($result)): ?>
            <div class="certificate-card">
                <div class="certificate-image">
                    <img src="admin/image.php?type=certificate&id=<?php echo $record['id']; ?>&width=400&height=300">
                </div>
                <div class="certificate-details">
                    <h3><?php echo $record['title']; ?></h3>
                    <p class="organization"><?php echo $record['organization']; ?></p>
                    <p class="date"><?php echo date('F Y', strtotime($record['date'])); ?></p>
                    <?php if($record['url']): ?>
                        <a href="<?php echo $record['url']; ?>" target="_blank" class="view-btn">View Certificate</a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </section>

    <section class="skills-section">
        <h2>My Skills</h2>
        <?php
        $query = 'SELECT * FROM skills ORDER BY name ASC';
        $result = mysqli_query($connect, $query);
        ?>
        
        <div class="skills-container">
            <?php while($record = mysqli_fetch_assoc($result)): ?>
            <div class="skill-item">
                <h3><?php echo $record['name']; ?></h3>
                <div class="skill-bar">
                    <div class="skill-level" style="width: <?php echo $record['percent']; ?>%">
                        <span><?php echo $record['percent']; ?>%</span>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </section>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> My Portfolio. All rights reserved.</p>
    </footer>

</body>
</html>