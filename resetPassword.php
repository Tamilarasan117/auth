<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>

    <!-- signin form-->
    <form action="resetPassword.php" method="post" class="form-container">
      <h1 class="form-heading">Forgot Password</h1>
      <p class="description">No worries, we'll send you instructions for reset</p>
      <div class="input-box">
        <input type="email" name="email" id="email" placeholder="Email address" required>
      </div>
      <div class="but-card">
        <button type="submit" name="signin" class="button">Reset Password</button>
        <span> <a href="./signup.php">Back</a> </span>
      </div>
    </form>
  </body>
</html>