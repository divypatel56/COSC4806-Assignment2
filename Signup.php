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