<?php
include "DataBaseConnection.php";

$username = mysqli_real_escape_string($connection, $_POST['username']);
$password = mysqli_real_escape_string($connection, $_POST['password']);


if ($username != "" && $password != "") {
    $sql_query = "select count(*) as cntUser from users where username='" . $username . "' and password='" . crypt($password,
            PASSWORD_DEFAULT) . "'";
    $result = mysqli_query($connection, $sql_query);
    $row = mysqli_fetch_array($result);

    $count = $row['cntUser'];

    if ($count > 0) {
        $_SESSION['username'] = $username;
        echo 1;
    } else {
        echo 0;
    }
}