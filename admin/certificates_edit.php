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

$query = 'SELECT * FROM certificates WHERE id = '.$_GET['id'].' LIMIT 1';
$result = mysqli_query($connect, $query);

if(!mysqli_num_rows($result)) {
    header('Location: certificates.php');
    die();
}

$record = mysqli_fetch_assoc($result);

include('includes/header.php');
?>

<h2>Edit Certificate</h2>

<form method="post">
    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" value="<?php echo htmlentities($record['title']); ?>">
    </div>
    
    <div class="form-group">
        <label for="organization">Organization:</label>
        <input type="text" name="organization" id="organization" value="<?php echo htmlentities($record['organization']); ?>">
    </div>
    
    <div class="form-group">
        <label for="date">Date:</label>
        <input type="date" name="date" id="date" value="<?php echo htmlentities($record['date']); ?>">
    </div>
    
    <div class="form-group">
        <label for="url">Certificate URL:</label>
        <input type="url" name="url" id="url" value="<?php echo htmlentities($record['url']); ?>">
    </div>
    
    <div class="form-actions">
        <input type="submit" value="Save Changes" class="btn-save">
        <a href="certificates.php" class="btn-cancel">Cancel</a>
    </div>
</form>

<style>
    .form-group {
        margin-bottom: 15px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    
    .form-group input[type="text"],
    .form-group input[type="date"],
    .form-group input[type="url"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    
    .form-actions {
        margin-top: 20px;
        display: flex;
        gap: 10px;
    }
    
    .btn-save {
        background-color: #6C63FF;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 4px;
        cursor: pointer;
    }
    
    .btn-cancel {
        background-color: #f44336;
        color: white;
        padding: 10px 15px;
        border-radius: 4px;
        text-decoration: none;
    }
</style>

<?php include('includes/footer.php'); ?>