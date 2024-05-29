<?php
session_start();

// Check if the user is authenticated
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== 1) {
    // If not authenticated, redirect to the login page
    header("Location: /login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>index</title>
  </head>

  <body>
    <h1>Assignment-2</h1>
    <!--if user able to logged in, display their username   
     with the current date-->
    <p>Welcome, <?= $_SESSION [ "username" ].". Today is: ". 
    date("Y-m-d")."."?> </p>
  </body>

  <footer> <a href="/logout.php">Click here to Logout</a> </footer>
</html>