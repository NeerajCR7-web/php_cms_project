<?php
include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if(isset($_POST['first'])) { // https://stackoverflow.com/questions/30038026/upload-form-not-displaying-ok-after-ifemptyname?noredirect=1&lq=1
    $photo = null;
    if(isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $photo = file_get_contents($_FILES['photo']['tmp_name']);
    }

    $query = 'INSERT INTO users (
        first,
        last,
        email,
        password,
        active,
        photo
      ) VALUES (
        "'.mysqli_real_escape_string($connect, $_POST['first']).'",
        "'.mysqli_real_escape_string($connect, $_POST['last']).'",
        "'.mysqli_real_escape_string($connect, $_POST['email']).'",
        "'.md5($_POST['password']).'",
        "'.$_POST['active'].'",
        '.($photo !== null ? '"'.mysqli_real_escape_string($connect, $photo).'"' : 'NULL').'
      )';
    mysqli_query($connect, $query);
    
    set_message('User has been added');
    header('Location: users.php');
    die();
}

include('includes/header.php');
?>

<h2>Add User</h2>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="first">First Name:</label>
        <input type="text" name="first" id="first" required>
    </div>
    
    <div class="form-group">
        <label for="last">Last Name:</label>
        <input type="text" name="last" id="last" required>
    </div>
    
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
    </div>
    
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
    </div>
    
    <div class="form-group">
        <label for="active">Active:</label>
        <select name="active" id="active" required>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="photo">Profile Photo (optional):</label>
        <input type="file" name="photo" id="photo" accept="image/*">
    </div>
    
    <div class="form-actions">
        <input type="submit" value="Add User" class="btn-save">
        <a href="users.php" class="btn-cancel">Cancel</a>
    </div>
</form>

<?php include('includes/footer.php'); ?>