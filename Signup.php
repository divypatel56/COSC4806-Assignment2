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
    
    // Check if username is empty
    if (empty($username)) {
        $validation_error[] = "Username cannot be empty.";
    }
    // Check if passwords match
    if ($password !== $confirm_password) {
        $validation_error[] = "Passwords do not match.";
    }

    // password strength checks
    // reference 
    // https://www.w3schools.com/php/func_regex_preg_match.asp
    if (strlen($password) < 8 || 
        !preg_match('/[A-Z]/', $password) || 
        !preg_match('/[a-z]/', $password) || 
        !preg_match('/[0-9]/', $password) || 
        !preg_match('/[\W_]/', $password)) {
        $validation_error[] = "Password must be at least 8 characters long, contain both uppercase and lowercase letters, at least one number, and at least one special character.";
    }
    // Create a new User instance
    $user = new User();
    // Check if the username already exists
    if ($user->get_username($username)) {
        $validation_error[]  = "Username already exists.";
    }

    // If there are no errors, proceed with user creation
    if (empty($validation_error)) {
        // Hash the password using php password_hash function()
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        // Create the user in the database
        $user->register_user($username, $hashed_password);

        // Start a new session and set session variables
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['authenticated'] = 1;
        unset($_SESSION['failed_attempts']);

        // Redirect to the login page
        header("Location: ./login.php");
        exit();
    }	 
} 
    if (!empty($validation_error)) {
        echo '<ul style="color: red;">';
        foreach ($validation_error as $error) {
            echo '<li >' . $error . '</li>';
        }
        echo '</ul>';
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