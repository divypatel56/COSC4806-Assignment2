<?php
session_start();
require_once('database.php');
require_once('user.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Retrieve form data using $_REQUEST
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];

    // Store the username in the session
    $_SESSION['username'] = $username;

    // Create a new User instance
    $user = new User();
    // Get user data by username
    $user_data = $user->get_username($username);

    // Verify the password
    if ($user_data && password_verify($password, $user_data['password'])) {
        // If the password is correct, set authenticated session variable and redirect to index
        $_SESSION['authenticated'] = 1;
        header("Location: ./index.php");
        exit();
    } else {
        // If authentication fails, manage failed attempts and redirect to login
        if (!isset($_SESSION["failed_attempts"])) {
            $_SESSION["failed_attempts"] = 1;
        } else {
            $_SESSION["failed_attempts"] = $_SESSION["failed_attempts"] + 1;
        }
        header("Location: /login.php");
        exit();
    }
}
    //if it is a failed attempt, then show the error message with the number of failed attempts.
    if(isset($_SESSION["failed_attempts"])){

      echo "<p style='color:red'>This is unsuccessful attempt 
      number: " .$_SESSION["failed_attempts"];
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>
    <h1>Login Form</h1>
    <form action="/login.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Submit">
    </form>
    <footer><a href= "/Signup.php">Click here to Create account</a></footer>
</body>
</html>