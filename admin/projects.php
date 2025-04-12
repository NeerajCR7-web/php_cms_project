<?php
include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if(isset($_GET['delete'])) {
    $query = 'DELETE FROM projects WHERE id = '.$_GET['delete'].' LIMIT 1';
    mysqli_query($connect, $query);
    
    // resets the count to 0
    $query = 'SET @count = 0';
    mysqli_query($connect, $query);
    $query = 'UPDATE projects SET projects.id = @count:= @count + 1';
    mysqli_query($connect, $query);
    $query = 'ALTER TABLE projects AUTO_INCREMENT = 1';
    mysqli_query($connect, $query);
    
    set_message('Project has been deleted');
    header('Location: projects.php');
    die();
}

include('includes/header.php');

$query = 'SELECT * FROM projects ORDER BY date DESC';
$result = mysqli_query($connect, $query);
?>

<h2>Manage Projects</h2>

<table class="project-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Preview</th>
            <th>Project Details</th>
            <th>Type</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $counter = 1;
        while($record = mysqli_fetch_assoc($result)): 
        ?>
        <tr>
            <td class="center"><?php echo $counter; ?></td>
            <td class="center">
                <?php if(!empty($record['photo'])): ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($record['photo']); ?>" width="80" height="80" class="project-thumbnail">
                <?php else: ?>
                    <img src="includes/image/profile.png" width="80" height="80" class="project-thumbnail">
                <?php endif; ?>
            </td>
            <td>
                <div class="project-title"><?php echo htmlentities($record['title']); ?></div>
                <div class="project-content"><?php echo substr(htmlentities($record['content']), 0, 100); ?>...</div>
                <?php if(!empty($record['url'])): ?>
                <div class="project-url">
                    <a href="<?php echo htmlentities($record['url']); ?>" target="_blank">
                        <i class="fas fa-external-link-alt"></i> View Project
                    </a>
                </div>
                <?php endif; ?>
            </td>
            <td class="center"><?php echo $record['type']; ?></td>
            <td class="center"><?php echo date('M Y', strtotime($record['date'])); ?></td>
            <td class="actions">
                <a href="projects_photo.php?id=<?php echo $record['id']; ?>" class="btn-photo">
                    <i class="fas fa-camera"></i>
                </a>
                <a href="projects_edit.php?id=<?php echo $record['id']; ?>" class="btn-edit">
                    <i class="fas fa-edit"></i>
                </a>
                <a href="projects.php?delete=<?php echo $record['id']; ?>" 
                   class="btn-delete"
                   onclick="return confirm('Are you sure you want to delete this project?');">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </td>
        </tr>
        <?php 
        $counter++;
        endwhile; 
        ?>
    </tbody>
</table>

<div class="add-project">
    <a href="projects_add.php" class="btn-add">
        <i class="fas fa-plus-square"></i> Add New Project
    </a>
</div>

<style>
    .project-table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 0.9em;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }
    
    .project-table thead tr {
        background-color: #6C63FF;
        color: #ffffff;
        text-align: left;
    }
    
    .project-table th,
    .project-table td {
        padding: 12px 15px;
        vertical-align: middle;
    }
    
    .project-table tbody tr {
        border-bottom: 1px solid #dddddd;
    }
    
    .project-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }
    
    .project-table tbody tr:last-of-type {
        border-bottom: 2px solid #6C63FF;
    }
    
    .project-table tbody tr:hover {
        background-color: #f1f1f1;
    }
    
    .center {
        text-align: center;
    }
    
    .project-thumbnail {
        border-radius: 4px;
        object-fit: cover;
        border: 1px solid #ddd;
    }
    
    .project-title {
        font-weight: bold;
        margin-bottom: 5px;
    }
    
    .project-content {
        color: #666;
        font-size: 0.85em;
        margin-bottom: 5px;
    }
    
    .project-url a {
        color: #6C63FF;
        text-decoration: none;
        font-size: 0.8em;
    }
    
    .project-url a:hover {
        text-decoration: underline;
    }
    
    .actions {
        display: flex;
        gap: 10px;
        justify-content: center;
    }
    
    .btn-photo, .btn-edit, .btn-delete, .btn-add {
        padding: 8px 12px;
        border-radius: 4px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }
    
    .btn-photo {
        background-color: #4CAF50;
        color: white;
    }
    
    .btn-edit {
        background-color: #2196F3;
        color: white;
    }
    
    .btn-delete {
        background-color: #f44336;
        color: white;
    }
    
    .btn-add {
        background-color: #6C63FF;
        color: white;
        padding: 10px 15px;
        margin-top: 20px;
    }
    
    .add-project {
        margin-top: 20px;
    }
</style>

<?php include('includes/footer.php'); ?>