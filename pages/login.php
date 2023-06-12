<?php
session_start();

// If statement to check if the user is logged in already
if (isset($_SESSION['username'])) {
    header("Location: home.php");
    exit();
}

// Check if the login form is submitted
if (isset($_POST['submit'])) {

    // Fetch the usersname and password 
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Load the user data from the JSON file
    $userData = json_decode(file_get_contents(__DIR__ . "/../json/users.json"), true);

    // Foreach checking that the username and password is correct 
    foreach ($userData as $user) {
        if ($user['username'] === $username && password_verify($password, $user['password'])) {
            //  Once Username and Password Matches we are keeping that username as that user is logged in
            $_SESSION['username'] = $username;

            // Redirect to the home page
            header("Location: home.php");
            exit();
        }
    }

    // if the username and password is incorrect then display this message
    echo "Password Incorrect! Please check your Username and Password";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <title>Dropping Donuts - Login</title>
</head>

<body>

    <h1>Login</h1>

    <form class="myform" action="" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>

        <input type="submit" name="submit" value="Login">
    </form>
</body>

</html>