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
    <label for="title">Title:</label>
    <input type="text" name="title" id="title">
    
    <br>
    
    <label for="organization">Organization:</label>
    <input type="text" name="organization" id="organization">
    
    <br>
    
    <label for="date">Date:</label>
    <input type="date" name="date" id="date">
    
    <br>
    
    <label for="url">URL:</label>
    <input type="text" name="url" id="url">
    
    <br>
    
    <input type="submit" value="Add Certificate">
</form>

<p><a href="certificates.php"><i class="fas fa-arrow-circle-left"></i> Return to Certificate List</a></p>

<?php include('includes/footer.php'); ?>