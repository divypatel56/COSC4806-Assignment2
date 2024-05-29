<?php
require_once('database.php');

class User {
    //function to get all user
    public function get_all_users() {
        $db = db_connect();
        $statement = $db->prepare("SELECT * FROM users");
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }
    // function to check if user exists or not
    public function isUser_exists($username) {
        $db = db_connect();
        $statement = $db->prepare("SELECT * FROM users WHERE username = :username");
        $statement->bindParam(':username', $username);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    // function to create new user
    public function register_user($username, $password) {
        $db = db_connect();
        $statement = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $statement->bindParam(':username', $username);
        $statement->bindParam(':password', $password);
        $statement->execute();
    }
}
?>