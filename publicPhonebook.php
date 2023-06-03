<?php
include 'DataBaseConnection.php';
// Users query
$userQuery = mysqli_query($connection, "SELECT * FROM `users` WHERE `publish_info` = '" . 'true' . "'");
?>

<div>
    <p style="color: #C99292; font-size: 25px; display: flex; justify-content: center; margin-top: 20px; margin-bottom: 0">
        Public Phonebook</p>

    <div style="padding-left: 80px; ">
        <?php
        while ($users = mysqli_fetch_assoc($userQuery)) {
            // Phones query
            $phonesQuery = mysqli_query($connection, "SELECT * FROM `phones` WHERE `user_id` = '" . $users['id'] . "'");
            // Emails query
            $emailsQuery = mysqli_query($connection, "SELECT * FROM `emails` WHERE `user_id` = '" . $users['id'] . "'");
            // Countries query
            $countriesQuery = mysqli_query($connection, 'SELECT * from countries', MYSQLI_USE_RESULT);

            $userId = $users['id'];
            $firstName = $users['first_name'];
            $lastName = $users['last_name'];
            $address = $users['address'];
            $city = $users['city'];
            $countryId = $users['country'];
            $countryName = '';
            while ($countries = mysqli_fetch_assoc($countriesQuery)) {
                if ($countryId == $countries['id']) {
                    $countryName = $countries['name'];
                }
            }
            echo '<div style="margin-bottom: -20px; position: relative">';
            echo '<p style="font-size: 25px ">' . $userId . '. ' . $firstName . '</p>';
            echo '<a href="Javascript:void(0);" style="position: absolute; top: 5px; left: 190px" id="showDetails" class="showDetails">View Details</a>';
            echo '<div id="details" class="details" style="display: none; margin-top: -40px;">';
            echo '<div style="display: flex; justify-content: space-evenly;">';
            echo '<div class="address">';
            echo '<p style="text-decoration: underline; font-size: 20px;"> Address </p>';
            echo '<p style="font-size: 16px;">' . $address . '</p>';
            echo '<p style="font-size: 16px;">' . $city . '</p>';
            echo '<p style="font-size: 16px;">' . $countryName . '</p>';
            echo '</div>';
            echo '<div class="phone">';
            echo '<p style="text-decoration: underline; font-size: 20px;">Phone Numbers</p>';
            if ($phonesQuery) {
                while ($phones = mysqli_fetch_assoc($phonesQuery)) {
                    echo '<p style="font-size: 16px;">' . $phones['number'] . '</p>';
                }
            }
            echo '</div>';
            echo '<div class="email">';
            echo '<p style="text-decoration: underline; font-size: 20px;">Emails</p>';
            if ($emailsQuery) {
                while ($emails = mysqli_fetch_assoc($emailsQuery)) {
                    echo '<p style="font-size: 16px;">' . $emails['email'] . '</p>';
                }
            }
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    // Show/hide button for details
    $(".showDetails").click(function () {
        $(this).next().toggle();
    });
</script>