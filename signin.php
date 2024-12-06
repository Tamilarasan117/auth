<?php
  session_start();
  //  check if user is logged in
  if (isset($_SESSION['user'])) { 
    // route to index page
    header('location: index.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <?php
      if(isset($_POST['signin'])) {
        // assign data to variables
        $email = $_POST['email'];
        $password = $_POST['password'];
        // database connection
        require_once('./database.php');
        // email validation
        $selectEmail = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $selectEmail);
        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if($user) {
          // password validation
          if($password === $user['password']) {
            // session start
            session_start();
            $_SESSION['user'] = 'yes';
            // render index page
            header("Location: index.php");
          } else {
            echo "<h1 class='message alert'>Invalid password!</h1>";
          }
        } else {
          echo "<h1 class='message alert'>Email does not exist!</h1>";
        }
      }
    ?>
    <!-- signin form-->
    <form action="signin.php" method="post" class="form-container">
      <h1 class="form-heading">Sign In</h1>
      <div class="input-box">
        <input type="email" name="email" id="email" placeholder="Email address" required>
        <input type="password" name="password" id="password" placeholder="Password" required>
      </div>
      <div class="but-card">
        <button type="submit" name="signin" class="button">Sign In</button>
        <span>Don't have an account <a href="./signup.php">Sign Up</a> </span>
      </div>
    </form>
  </body>
</html>