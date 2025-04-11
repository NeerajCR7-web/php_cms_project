<?php
include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if(!isset($_GET['id'])) {
    header('Location: certificates.php');
    die();
}

if(isset($_POST['title'])) {
    if($_POST['title'] && $_POST['organization'] && $_POST['date']) {
        $query = 'UPDATE certificates SET
            title = "'.mysqli_real_escape_string($connect, $_POST['title']).'",
            organization = "'.mysqli_real_escape_string($connect, $_POST['organization']).'",
            date = "'.mysqli_real_escape_string($connect, $_POST['date']).'",
            url = "'.mysqli_real_escape_string($connect, $_POST['url']).'"
            WHERE id = '.$_GET['id'].'
            LIMIT 1';
        mysqli_query($connect, $query);
        
        set_message('Certificate has been updated');
        header('Location: certificates.php');
        die();
    }
}

if(isset($_GET['id'])) {
    $query = 'SELECT * FROM certificates WHERE id = '.$_GET['id'].' LIMIT 1';
    $result = mysqli_query($connect, $query);
    
    if(!mysqli_num_rows($result)) {
        header('Location: certificates.php');
        die();
    }
    
    $record = mysqli_fetch_assoc($result);
}

include('includes/header.php');
?>

<h2>Edit Certificate</h2>

<form method="post">
    <label for="title">Title:</label>
    <input type="text" name="title" id="title" value="<?php echo htmlentities($record['title']); ?>">
    
    <br>
    
    <label for="organization">Organization:</label>
    <input type="text" name="organization" id="organization" value="<?php echo htmlentities($record['organization']); ?>">
    
    <br>
    
    <label for="date">Date:</label>
    <input type="date" name="date" id="date" value="<?php echo htmlentities($record['date']); ?>">
    
    <br>
    
    <label for="url">URL:</label>
    <input type="text" name="url" id="url" value="<?php echo htmlentities($record['url']); ?>">
    
    <br>
    
    <input type="submit" value="Edit Certificate">
</form>

<p><a href="certificates.php"><i class="fas fa-arrow-circle-left"></i> Return to Certificate List</a></p>

<?php include('includes/footer.php'); ?>