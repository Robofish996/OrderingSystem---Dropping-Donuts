<!DOCTYPE html>
<html>
<head>
  <title>Dropping Donuts - Order System</title>
  <link rel="stylesheet" type="text/css" href="./css/index.css">
</head>
<body>
  <h1>Welcome to Dropping Donuts</h1>

  <!-- Sign-in form -->
  <h2>Sign In</h2>
  <form class="myform" action="./pages/login.php" method="post">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" value="<?php echo isset($_POST['username']) ? '' : ''; ?>" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password" value="" required><br>

    <input type="submit" value="Sign In">
  </form>

  <!-- Create account form -->
  <h2>Create an Account</h2>
  <form class="myform" action="./pages/register.php" method="post">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" value="<?php echo isset($_POST['username']) ? '' : ''; ?>" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password" value="" required><br>

    <label for="confirm_password">Confirm Password:</label>
    <input type="password" name="confirm_password" id="confirm_password" value="" required><br>

    <input type="submit" value="Create Account">
  </form>
</body>
</html>
