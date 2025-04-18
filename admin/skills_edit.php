<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if(!isset($_GET['id']))
{
  header('Location: skills.php');
  die();
}

if(isset($_POST['name']))
{
  if($_POST['name'] and $_POST['url'] and $_POST['percent'])
  {
    $query = 'UPDATE skills SET
      name = "'.mysqli_real_escape_string($connect, $_POST['name']).'",
      url = "'.mysqli_real_escape_string($connect, $_POST['url']).'",
      logo_url = "'.mysqli_real_escape_string($connect, $_POST['logo_url']).'",
      percent = "'.mysqli_real_escape_string($connect, $_POST['percent']).'"
      WHERE id = '.$_GET['id'].'
      LIMIT 1';
    mysqli_query($connect, $query);
    
    set_message('Skill has been updated');
  }

  header('Location: skills.php');
  die();
}

if(isset($_GET['id']))
{
  $query = 'SELECT *
    FROM skills
    WHERE id = '.$_GET['id'].'
    LIMIT 1';
  $result = mysqli_query($connect, $query);
  
  if(!mysqli_num_rows($result))
  {
    header('Location: skills.php');
    die();
  }
  
  $record = mysqli_fetch_assoc($result);
}

include('includes/header.php');

?>

<h2>Edit Skill</h2>

<form method="post">
  
  <label for="name">Name:</label>
  <input type="text" name="name" id="name" value="<?php echo htmlentities($record['name']); ?>">
  
  <br>
  
  <label for="url">URL:</label>
  <input type="text" name="url" id="url" value="<?php echo htmlentities($record['url']); ?>">
  
  <br>
  
  <label for="logo_url">Logo URL:</label>
  <input type="text" name="logo_url" id="logo_url" value="<?php echo htmlentities($record['logo_url']); ?>">
  
  <br>
  
  <label for="percent">Percent:</label>
  <input type="text" name="percent" id="percent" value="<?php echo htmlentities($record['percent']); ?>">
  
  <br>
  
  <input type="submit" value="Edit Skill">
  
</form>

<p><a href="skills.php"><i class="fas fa-arrow-circle-left"></i> Return to Skill List</a></p>

<?php
include('includes/footer.php');
?>