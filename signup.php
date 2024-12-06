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
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <!-- user data store into the databse -->
    <?php
      if(isset($_POST['signup'])) {
        // assign  the values from the form to the variables
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $conformPassword = $_POST['conformPassword'];

        // filed  validation
        $error = array();
        if(empty($username) || empty($email) || empty($password) ||  empty($conformPassword)) {
          array_push($error, "All input field are required!");
        }
        // email  validation
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          array_push($error, "Invalid email address!");
        }
        // password  validation
        if(strlen($password)  < 8) {
          array_push($error, "Password must be at least 8 characters long!");
        }
        // conform password validation
        if($password !== $conformPassword) {
          array_push($error, "Password and conform password do not match!");
        }
        //  connect to the database
        require_once("./database.php");
        // email already exist validation
        $selectEmail = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $selectEmail);
        $count = mysqli_num_rows($result);
        if($count > 0) {
          array_push($error, "Email already exist!");
        }
        // display all error message
        if(count($error) > 0) {
          foreach($error as $err) {
            echo "<h1 class='message alert'>$err</h1>";
          } 
        } else {
          // insert data into the database
          $insertQuery = "INSERT INTO users (username, email, password) VALUES(?, ?, ?)";
          $stmt = mysqli_stmt_init($conn);
          $stmtPrepare = mysqli_stmt_prepare($stmt, $insertQuery);
          if($stmtPrepare) {
            mysqli_stmt_bind_param($stmt, "sss", $username, $email, $password);
            mysqli_stmt_execute($stmt);
            echo "<h1 class='message success'>You are registred successfully!</h1>";
          } else {
            die("Somthing went wrong");
          }
        }
      }
    ?>
    <!-- registration form -->
    <form action="signup.php" method="post" class="form-container">
      <h1 class="form-heading">Sign Up</h1>
      <div class="input-box">
        <input type="text" name="username" id="username" placeholder="Username" />
        <input type="email" name="email" id="email" placeholder="Email address" />
        <input type="password" name="password" id="password" placeholder="Password" />
        <input type="password" name="conformPassword" id="conformPassword" placeholder="Conform password" />
      </div>
      <div class="but-card">
        <button type="submit" name="signup" class="button">Sign Up</button>
        <span>Already have an account <a href="./signin.php">Sign In</a> </span>
      </div>
    </form>
  </body>
</html>