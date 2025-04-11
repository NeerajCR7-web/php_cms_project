<?php
include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if(!isset($_GET['id']))
{
    header('Location: team_members.php');
    die();
}

if(isset($_POST['name']))
{
    $updates = [
        'name' => mysqli_real_escape_string($connect, $_POST['name']),
        'role' => mysqli_real_escape_string($connect, $_POST['role']),
        'bio' => mysqli_real_escape_string($connect, $_POST['bio']),
        'skills' => mysqli_real_escape_string($connect, $_POST['skills']),
        'email' => mysqli_real_escape_string($connect, $_POST['email']),
        'linkedin' => mysqli_real_escape_string($connect, $_POST['linkedin']),
        'github' => mysqli_real_escape_string($connect, $_POST['github'])
    ];
    
    if(!empty($_FILES["image"]["name"])) {
        $target_dir = "../images/team/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check === false) {
            set_message('File is not an image');
            header('Location: team_members.php');
            die();
        }
        
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            set_message('Only JPG, JPEG, PNG files are allowed');
            header('Location: team_members.php');
            die();
        }
        
        $new_filename = uniqid().'.'.$imageFileType;
        if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir.$new_filename)) {
            // Delete old image
            $old_image = mysqli_fetch_assoc(mysqli_query($connect, "SELECT image FROM team_members WHERE id = ".$_GET['id']))['image'];
            if(file_exists($target_dir.$old_image)) {
                unlink($target_dir.$old_image);
            }
            
            $updates['image'] = $new_filename;
        }
    }
    
    $query = 'UPDATE team_members SET ';
    foreach($updates as $field => $value) {
        $query .= $field.' = "'.$value.'", ';
    }
    $query = rtrim($query, ', ');
    $query .= ' WHERE id = '.$_GET['id'].' LIMIT 1';
    
    mysqli_query($connect, $query);
    set_message('Team member has been updated');
    header('Location: team_members.php');
    die();
}

$query = 'SELECT * FROM team_members WHERE id = '.$_GET['id'].' LIMIT 1';
$result = mysqli_query($connect, $query);

if(!mysqli_num_rows($result))
{
    header('Location: team_members.php');
    die();
}

$record = mysqli_fetch_assoc($result);

include('includes/header.php');
?>

<h2>Edit Team Member</h2>

<form method="post" enctype="multipart/form-data">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" value="<?php echo htmlentities($record['name']); ?>" required>
    
    <label for="role">Role:</label>
    <input type="text" name="role" id="role" value="<?php echo htmlentities($record['role']); ?>" required>
    
    <label for="bio">Bio:</label>
    <textarea name="bio" id="bio" required><?php echo htmlentities($record['bio']); ?></textarea>
    
    <label for="image">Profile Image (leave blank to keep current):</label>
    <input type="file" name="image" id="image" accept="image/jpeg,image/png">
    <div class="current-image">
        <p>Current Image:</p>
        <img src="../images/team/<?php echo htmlentities($record['image']); ?>" width="100">
    </div>
    
    <label for="skills">Skills (comma separated):</label>
    <input type="text" name="skills" id="skills" value="<?php echo htmlentities($record['skills']); ?>" required>
    
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="<?php echo htmlentities($record['email']); ?>" required>
    
    <label for="linkedin">LinkedIn URL:</label>
    <input type="url" name="linkedin" id="linkedin" value="<?php echo htmlentities($record['linkedin']); ?>">
    
    <label for="github">GitHub URL:</label>
    <input type="url" name="github" id="github" value="<?php echo htmlentities($record['github']); ?>">
    
    <input type="submit" value="Save Changes">
</form>

<p><a href="team_members.php"><i class="fas fa-arrow-circle-left"></i> Return to Team List</a></p>

<?php
include('includes/footer.php');
?>