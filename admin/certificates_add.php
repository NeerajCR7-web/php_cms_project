<?php
include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if(isset($_POST['title'])) {
    if($_POST['title'] && $_POST['organization'] && $_POST['date']) {
        $query = 'INSERT INTO certificates (
            title,
            organization,
            date,
            url
        ) VALUES (
            "'.mysqli_real_escape_string($connect, $_POST['title']).'",
            "'.mysqli_real_escape_string($connect, $_POST['organization']).'",
            "'.mysqli_real_escape_string($connect, $_POST['date']).'",
            "'.mysqli_real_escape_string($connect, $_POST['url']).'"
        )';
        mysqli_query($connect, $query);
        
        set_message('Certificate has been added');
        header('Location: certificates.php');
        die();
    }
}

include('includes/header.php');
?>

<h2>Add Certificate</h2>

<form method="post">
    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required>
    </div>
    
    <div class="form-group">
        <label for="organization">Organization:</label>
        <input type="text" name="organization" id="organization" required>
    </div>
    
    <div class="form-group">
        <label for="date">Date:</label>
        <input type="date" name="date" id="date" required>
    </div>
    
    <div class="form-group">
        <label for="url">Certificate URL (optional):</label>
        <input type="url" name="url" id="url">
    </div>
    
    <div class="form-actions">
        <input type="submit" value="Add Certificate" class="btn-save">
        <a href="certificates.php" class="btn-cancel">Cancel</a>
    </div>
</form>

<?php include('includes/footer.php'); ?>