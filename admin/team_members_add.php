<?php
include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if(isset($_POST['name']))
{
    $target_dir = "../images/team/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Check if image file is actual image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check === false) {
        set_message('File is not an image');
        header('Location: team_members.php');
        die();
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        set_message('Only JPG, JPEG, PNG files are allowed');
        header('Location: team_members.php');
        die();
    }
    
    // Upload file
    $new_filename = uniqid().'.'.$imageFileType;
    if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir.$new_filename))
    {
        $query = 'INSERT INTO team_members (
            name,
            role,
            bio,
            image,
            skills,
            email,
            linkedin,
            github
        ) VALUES (
            "'.mysqli_real_escape_string($connect, $_POST['name']).'",
            "'.mysqli_real_escape_string($connect, $_POST['role']).'",
            "'.mysqli_real_escape_string($connect, $_POST['bio']).'",
            "'.$new_filename.'",
            "'.mysqli_real_escape_string($connect, $_POST['skills']).'",
            "'.mysqli_real_escape_string($connect, $_POST['email']).'",
            "'.mysqli_real_escape_string($connect, $_POST['linkedin']).'",
            "'.mysqli_real_escape_string($connect, $_POST['github']).'"
        )';
        mysqli_query($connect, $query);
        
        set_message('Team member has been added');
    }
    else
    {
        set_message('Error uploading image');
    }
    
    header('Location: team_members.php');
    die();
}

include('includes/header.php');
?>

<h2>Add Team Member</h2>

<form method="post" enctype="multipart/form-data">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required>
    
    <label for="role">Role:</label>
    <input type="text" name="role" id="role" required>
    
    <label for="bio">Bio:</label>
    <textarea name="bio" id="bio" required></textarea>
    
    <label for="image">Profile Image:</label>
    <input type="file" name="image" id="image" accept="image/jpeg,image/png" required>
    
    <label for="skills">Skills (comma separated):</label>
    <input type="text" name="skills" id="skills" required>
    
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>
    
    <label for="linkedin">LinkedIn URL:</label>
    <input type="url" name="linkedin" id="linkedin">
    
    <label for="github">GitHub URL:</label>
    <input type="url" name="github" id="github">
    
    <input type="submit" value="Add Member">
</form>

<p><a href="team_members.php"><i class="fas fa-arrow-circle-left"></i> Return to Team List</a></p>

<?php
include('includes/footer.php');
?>