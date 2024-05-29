<?php
require_once('database.php');
require_once('user.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data using $_REQUEST
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $confirm_password = $_REQUEST['confirm_password'];
    // Global array to store error messages. 
    // got the idea from https://www.w3schools.com/php/php_arrays.asp
    $validation_error = [];

    // Check if passwords match
    if ($password !== $confirm_password) {
        $validation_error[] = "Passwords do not match.";
    }

   

    // Create a new User instance
    $user = new User();
    // Check if the username already exists
    if ($user->get_username($username)) {
        $validation_error[]  = "Username already exists.";
    }

   

} 
    
 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign-Up Page</title>
</head>
<body>
    <h1>Sign-Up Form</h1>
    
    <form action="/Signup.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br>
        <label for="confirm_password">Confirm Password:</label><br>
        <input type="password" id="confirm_password" name="confirm_password"><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>