<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if(isset($_POST['name']))
{
  if($_POST['name'] and $_POST['url'] and $_POST['percent'])
  {
    $query = 'INSERT INTO skills (
        name,
        url,
        logo_url,
        percent
      ) VALUES (
         "'.mysqli_real_escape_string($connect, $_POST['name']).'",
         "'.mysqli_real_escape_string($connect, $_POST['url']).'",
         "'.mysqli_real_escape_string($connect, $_POST['logo_url']).'",
         "'.mysqli_real_escape_string($connect, $_POST['percent']).'"
      )';
    mysqli_query($connect, $query);
    
    set_message('Skill has been added');
  }
  
  header('Location: skills.php');
  die();
}

include('includes/header.php');

?>

<h2>Add Skill</h2>

<form method="post">
  
  <label for="name">Name:</label>
  <input type="text" name="name" id="name">
  
  <br>
  
  <label for="url">URL:</label>
  <input type="text" name="url" id="url">
  
  <br>
  
  <label for="logo_url">Logo URL:</label>
  <input type="text" name="logo_url" id="logo_url">
  
  <br>
  
  <label for="percent">Percent:</label>
  <input type="text" name="percent" id="percent">
  
  <br>
  
  <input type="submit" value="Add Skill">
  
</form>

<p><a href="skills.php"><i class="fas fa-arrow-circle-left"></i> Return to Skill List</a></p>

<?php
include('includes/footer.php');
?>