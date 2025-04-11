<?php
include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if(!isset($_GET['id'])) {
    header('Location: users.php');
    die();
}

if(isset($_POST['first'])) {
    // Handle photo upload
    $photo = null;
    if(isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $photo = file_get_contents($_FILES['photo']['tmp_name']);
    } elseif(isset($_POST['remove_photo'])) {
        $photo = null;
    } else {
        // Keep existing photo if exists
        $existing = mysqli_fetch_assoc(mysqli_query($connect, "SELECT photo FROM users WHERE id = ".$_GET['id']));
        $photo = $existing['photo'];
    }

    $query = 'UPDATE users SET
        first = "'.mysqli_real_escape_string($connect, $_POST['first']).'",
        last = "'.mysqli_real_escape_string($connect, $_POST['last']).'",
        email = "'.mysqli_real_escape_string($connect, $_POST['email']).'",
        active = "'.$_POST['active'].'",
        photo = '.($photo !== null ? '"'.mysqli_real_escape_string($connect, $photo).'"' : 'NULL').'
        WHERE id = '.$_GET['id'].'
        LIMIT 1';
    mysqli_query($connect, $query);
    
    if($_POST['password']) {
        $query = 'UPDATE users SET
            password = "'.md5($_POST['password']).'"
            WHERE id = '.$_GET['id'].'
            LIMIT 1';
        mysqli_query($connect, $query);
    }
    
    set_message('User has been updated');
    header('Location: users.php');
    die();
}

$query = 'SELECT * FROM users WHERE id = '.$_GET['id'].' LIMIT 1';
$result = mysqli_query($connect, $query);

if(!mysqli_num_rows($result)) {
    header('Location: users.php');
    die();
}

$record = mysqli_fetch_assoc($result);

include('includes/header.php');
?>

<h2>Edit User</h2>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="first">First Name:</label>
        <input type="text" name="first" id="first" value="<?php echo htmlentities($record['first']); ?>" required>
    </div>
    
    <div class="form-group">
        <label for="last">Last Name:</label>
        <input type="text" name="last" id="last" value="<?php echo htmlentities($record['last']); ?>" required>
    </div>
    
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo htmlentities($record['email']); ?>" required>
    </div>
    
    <div class="form-group">
        <label for="password">Password (leave blank to keep current):</label>
        <input type="password" name="password" id="password">
    </div>
    
    <div class="form-group">
        <label for="active">Active:</label>
        <select name="active" id="active" required>
            <option value="Yes" <?php echo $record['active'] == 'Yes' ? 'selected' : ''; ?>>Yes</option>
            <option value="No" <?php echo $record['active'] == 'No' ? 'selected' : ''; ?>>No</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="photo">Profile Photo:</label>
        <input type="file" name="photo" id="photo" accept="image/*">
        
        <?php if(!empty($record['photo'])): ?>
            <div class="current-photo">
                <img src="data:image/jpeg;base64,<?php echo base64_encode($record['photo']); ?>" width="100" height="100">
                <div>
                    <input type="checkbox" name="remove_photo" id="remove_photo" value="1">
                    <label for="remove_photo">Remove current photo</label>
                </div>
            </div>
        <?php endif; ?>
    </div>
    
    <div class="form-actions">
        <input type="submit" value="Save Changes" class="btn-save">
        <a href="users.php" class="btn-cancel">Cancel</a>
    </div>
</form>

<style>
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    
    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group input[type="password"],
    .form-group select {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    
    .current-photo {
        margin: 10px 0;
    }
    
    .current-photo img {
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #ddd;
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