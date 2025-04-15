<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

if( isset( $_POST['email'] ) )
{
  
  $query = 'SELECT *
    FROM users
    WHERE email = "'.$_POST['email'].'"
    AND password = "'.md5( $_POST['password'] ).'"
    AND active = "Yes"
    LIMIT 1';
  $result = mysqli_query( $connect, $query );
  
  if( mysqli_num_rows( $result ) )
  {
    
    $record = mysqli_fetch_assoc( $result );
    
    $_SESSION['id'] = $record['id'];
    $_SESSION['email'] = $record['email'];
    
    header( 'Location: dashboard.php' );
    die();
    
  }
  else
  {
    
    set_message( 'Incorrect email and/or password' );
    
    header( 'Location: index.php' );
    die();
    
  } 
  
}

include( 'includes/header.php' );

?>

<style>
  .login-container {
    max-width: 400px;
    margin: 50px auto;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    background: #ffffff;
  }
  
  .login-title {
    text-align: center;
    color: #2c3e50;
    margin-bottom: 30px;
    font-size: 24px;
    font-weight: 600;
  }
  
  .form-group {
    margin-bottom: 20px;
  }
  
  label {
    display: block;
    margin-bottom: 8px;
    color: #555;
    font-weight: 500;
  }
  
  input[type="text"],
  input[type="password"] {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
    transition: border 0.3s;
  }
  
  input[type="text"]:focus,
  input[type="password"]:focus {
    border-color: #3498db;
    outline: none;
    box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
  }
  
  .submit-btn {
    width: 100%;
    padding: 12px;
    background-color: #3498db;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
  }
  
  .submit-btn:hover {
    background-color: #2980b9;
  }
  
  body {
    background-color: #f5f7fa;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }
</style>

<div class="login-container">
  <div class="login-title">Welcome Back</div>
  
  <form method="post">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="text" name="email" id="email" placeholder="Enter your email">
    </div>

    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" placeholder="Enter your password">
    </div>

    <button type="submit" class="submit-btn">Login</button>
  </form>
  
</div>

<?php

include( 'includes/footer.php' );

?>