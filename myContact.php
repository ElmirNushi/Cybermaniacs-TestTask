<?php
include 'DataBaseConnection.php';

// get the logged in user
$userQuery = mysqli_query($connection, "SELECT * FROM `users` WHERE `username` = '" . $_SESSION['username'] . "'");

// check if user was found
if (mysqli_num_rows($userQuery) == 1) {
    $user = mysqli_fetch_array($userQuery);

    // emails and phones query
    $phonesQuery = mysqli_query($connection, "SELECT  * FROM `phones` WHERE `user_id` = '" . $user['id'] . "'");
    $emailsQuery = mysqli_query($connection, "SELECT * FROM `emails` WHERE `user_id` = '" . $user['id'] . "'");
}
?>

<div style="position: relative">
    <div style="display: flex; justify-content: center">
        <p style="color: #C99292; font-size: 25px; display: flex; justify-content: center">My Contact</p>
        <div id="message" style="color: red;"></div>

        <div style="position: absolute; right: 10px; top: 30px">
            <label for="contactPublish">Publish my contact: </label>
            <input type="checkbox" id="contactPublish" name="contactPublish"
                <?php if ($user['publish_info'] === 'true') {
                    echo "checked=\"checked\"";
                } ?>
                   style="float: right"/>
        </div>
    </div>
    <div style="display: flex; justify-content: center; gap: 50px; position: relative">
        <div class="contact">
            <p style="text-decoration: underline; text-align: center; font-size: 20px">Contact</p>
            <div>
                <label for="firstname">Firstname: </label>
                <input type="text" name="firstname" id="firstname" value="<?php if (isset($user['first_name'])) {
                    echo $user['first_name'];
                } ?>"/>
            </div>
            <div>
                <label for="lastname">Lastname: </label>
                <input type="text" name="lastname" id="lastname" value="<?php if (isset($user['last_name'])) {
                    echo $user['last_name'];
                } ?>"/>
            </div>
            <div>
                <label for="address">Address: </label>
                <input type="text" name="address" id="address" value="<?php if (isset($user['address'])) {
                    echo $user['address'];
                } ?>"/>
            </div>
            <div>
                <label for="city">ZIP/City: </label>
                <input type="text" name="city" id="city" value="<?php if (isset($user['city'])) {
                    echo $user['city'];
                } ?>"/>
            </div>
            <div>
                <label for="country">Country: </label>
                <select name="country" id="country">
                    <?php
                    $result = mysqli_query($connection, 'SELECT * from countries', MYSQLI_USE_RESULT);
                    while ($countries = mysqli_fetch_assoc($result)) {
                        $output = "<option value='" . $countries['id'] . "'";
                        if ($user['country'] == $countries['id']) {
                            $output .= "selected='selected'";
                        }
                        $output .= ">" . $countries['name'] . "</option>";
                        echo $output;
                    } ?>
                </select>
            </div>
        </div>
        <div class="phones">
            <p style="text-decoration: underline; text-align: center; font-size: 20px">Phones</p>
            <div id="phone">
                <?php
                while ($phone = mysqli_fetch_assoc($phonesQuery)) {
                    if (isset($phone)) {
                        $phoneNumber = $phone['number'];
                        $phoneChecked = '';
                        if ($phone['published'] === 'true') {
                            $phoneChecked = "checked=\"checked\"";
                        }
                        echo "<input type='number' name='phone[]' id='phone' value='" . $phoneNumber . "' />" . "<input type='checkbox' id='publishPhone' name='phonePublish'" . $phoneChecked . "/>" . "<br/>";
                    }
                }
                ?>

            </div>
            <a href="Javascript:void(0);" style="float: right; padding-top: 20px" onclick="addPhone()">Add</a>

        </div>
        <div class="emails">
            <p style="text-decoration: underline; text-align: center; font-size: 20px">Emails</p>
            <div id="email">
                <?php
                while ($emailsArray = mysqli_fetch_assoc($emailsQuery)) {
                    if (isset($emailsArray)) {
                        $email = $emailsArray['email'];
//                        echo $email;
                        $emailChecked = '';
                        if ($emailsArray['published'] === 'true') {
                            $emailChecked = "checked=\"checked\"";
                        }
                        echo "<input type='email' name='email[]' id='email' value='" . $email . "' />" . "<input type='checkbox' id='emailPublish' name='emailPublish'" . $emailChecked . "/>" . "<br/>";
                    }
                }
                ?>
            </div>

            <a href="Javascript:void(0);" style="float: right; padding-top: 20px;" id="addEmail"
               onclick="addEmail()">Add</a>
        </div>

        <div>
            <button type="submit" style="margin-top: 10px; position: absolute; bottom: -50px; right: 280px;"
                    id="savePhonebook">Submit
            </button>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js"
        integrity="sha512-8Z5++K1rB3U+USaLKG6oO8uWWBhdYsM3hmdirnOEWp8h2B1aOikj5zBzlXs8QOrvY9OxEnD2QDkbSKKpfqcIWw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    function addEmail() {
        $('#email').append('<div><input type="text" name="email[]" id="email" value=""/><input type="checkbox" id="publish" name="publish" value="publishEmail"' +
            '/></div>')
    }

    function addPhone() {
        $('#phone').append('<div><input type="number" name="phone[]" id="phoneInput" value=""/><input type="checkbox" id="publishPhone" name="publishPhone" value="publish"' +
            '/></div>')
    }
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#savePhonebook").click(function () {
            let userId = '<?php echo $user['id']?>';
            let firstName = $("#firstname").val();
            let lastName = $("#lastname").val();
            let address = $("#address").val();
            let city = $("#city").val();
            let country = $("#country").val();
            let email = [];
            $("input[name='email[]']").each(function () {
                email.push(this.value);
            });
            let phone = [];
            $("input[name='phone[]']").each(function () {
                phone.push(this.value);
            });
            let checked = $('#contactPublish').is(':checked');


            // TODO checkbox for phone/email
            // let phoneChecked = [];
            // let searchIDs = $('input[name="phonePublish"]:checked').map(function () {
            //     phoneChecked.push(this.value);
            // }).get();

            if (firstName != "") {
                $.ajax({
                    url: 'phoneBookUserUpdate.php',
                    type: 'post',
                    data: {
                        userId: userId,
                        first_name: firstName,
                        last_name: lastName,
                        address: address,
                        city: city,
                        country: country,
                        email: email,
                        phone: phone,
                        contactPublish: checked,
                    },
                    success: function (response) {
                        let msg = "";
                        if (response == 1) {
                            window.location = "home.php";
                        } else {
                            msg = "First name or last name are too short!";
                        }
                        $("#message").html(msg);
                    }
                });
            }
        });
    });
</script>