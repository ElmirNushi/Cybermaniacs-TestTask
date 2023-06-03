<?php
include "DataBaseConnection.php";
$db = $connection;
define('tableName', 'users');
$userData = $_POST;

registerUser($db, $userData);
function registerUser($db, $userData)
{
    $username = $userData['username'];
    $password = $userData['password'];
    if (!empty($username) && !empty($password)) {
        $hashPassword = crypt($password,
            PASSWORD_DEFAULT);
        $query = "INSERT INTO " . tableName;
        $query .= " (username, password) ";
        $query .= "VALUES ('$username', '$hashPassword')";

        $execute = $db->query($query);
        echo $db->error;
        if ($execute) {
            $_SESSION['username'] = $username;
            echo 1;
        } else {
            echo 0;
        }
    } else {
        echo "All Fields are required";
    }
}