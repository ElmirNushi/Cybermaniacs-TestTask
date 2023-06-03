<?php
include_once("DataBaseConnection.php");
$db = $connection;
$userData = $_POST;

updateUser($db, $userData);
if (isset($userData['phone'])) {
    savePhoneNumber($db, $userData);
}

if (isset($userData['email'])) {
    saveEmail($db, $userData);
}
function updateUser($db, $userData)
{
    $userId = $userData['userId'];
    $firstName = $userData['first_name'];
    $lastName = $userData['last_name'];
    $address = $userData['address'];
    $city = $userData['city'];
    $country = $userData['country'];
    $publishInfo = $userData['contactPublish'];
    if (strlen($firstName) >= 4) {
        $query = ("UPDATE users SET first_name='$firstName',last_name='$lastName',address='$address',city='$city',country='$country',publish_info='$publishInfo' WHERE id='$userId'");

        $execute = $db->query($query);
        echo $db->error;
        if ($execute) {
            echo 1;
        } else {
            echo 0;
        }
    } else {
        echo "First name or last name are too short!";
    }
}

function savePhoneNumber($db, $userData)
{
    $userId = $userData['userId'];

    $phonesQuery = mysqli_query($db, "SELECT  * FROM `phones` WHERE `user_id` = '" . $userId . "'");
    $dbPhones = [];
    while ($phone = mysqli_fetch_assoc($phonesQuery)) {
        array_push($dbPhones, $phone['number']);
    }
    foreach ($userData['phone'] as $number) {
        if (in_array($number, $dbPhones) === false) {
            $query = "INSERT INTO " . "phones";
            $query .= " ( user_id, number) ";
            $query .= "VALUES ('$userId', '$number')";

            $execute = $db->query($query);

            echo $db->error;
        }
    }
}

function saveEmail($db, $userData)
{
    $userId = $userData['userId'];

    $emailsQuery = mysqli_query($db, "SELECT  * FROM `emails` WHERE `user_id` = '" . $userId . "'");
    $dbEmails = [];
    while ($email = mysqli_fetch_assoc($emailsQuery)) {
        array_push($dbEmails, $email['email']);
    }
    foreach ($userData['email'] as $emailAddress) {
        if (in_array($emailAddress, $dbEmails) === false) {
            $query = "INSERT INTO " . "emails";
            $query .= " ( user_id, email) ";
            $query .= "VALUES ('$userId', '$emailAddress')";

            $execute = $db->query($query);

            echo $db->error;
        }
    }
}

// TODO phone/email update, checkboxes