<?php
// Retrieve form data from index
$username = $_POST['username'];
$password = $_POST['password'];



// Hash the password for security
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Load the existing user data from the JSON file
$userData = json_decode(file_get_contents(__DIR__ . "/../json/users.json"), true);

// Check if the username already exists
foreach ($userData as $user) {
  if ($user['username'] === $username) {
    echo "Username already exists. Please choose a different username.";
    exit();
  }
}

// Add the new user details to the user data array
$newUser = [
  'username' => $username,
  'password' => $hashedPassword
];
$userData[] = $newUser;

// Save the updated user data to the JSON file
file_put_contents(__DIR__ . "/../json/users.json", json_encode($userData));

// if New user redrict to login page so that user can login
echo "Registration successful. Redirecting to login page...";
header("refresh:3; url=login.php");
exit();
?>
