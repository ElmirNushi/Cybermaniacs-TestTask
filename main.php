<?php
include "DataBaseConnection.php";

// Check if user is logged in
if (isset($_SESSION['username'])) {
    header("Location:home.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Cybermaniacs</title>
</head>

<body>
<p style="color: #C99292; font-size: 30px; display: flex; justify-content: center">Phonebook</p>
<div style="margin: auto; width: 50%">
    <div class="buttons" style="display: flex; max-width: 500px; gap: 10px; padding-left: 20px; padding-bottom: 15px;">

        <a href="Javascript:void(0);" id="login"
           style="border-radius: 50px; padding: 10px 20px; border: 1px solid black;color: black; text-decoration: none">Login </a>
        <a href="Javascript:void(0);" id="register"
           style="border-radius: 50px; padding: 10px 20px; border: 1px solid black;color: black; text-decoration: none">Register </a>
        <a href="Javascript:void(0);" id="phoneBook"
           style="border-radius: 50px; padding: 10px 20px; border: 1px solid black;color: black; text-decoration: none">Public
            Phonebook </a>
    </div>
    <div class="block" id="block" style="border: 2px solid grey; width: 1000px; height: 500px;">

    </div>
</div>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    // Load register.php when register button is clicked
    $('#register').click(function (e) {
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "register.php",
            data: {},
            success: function (data) {
                $('#block').html(data);
            }
        });
    })
    // Load login.php when login button is clicked
    $('#login').click(function (e) {
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "login.php",
            data: {},
            success: function (data) {
                $('#block').html(data);
            }
        });
    })
    // Load publicPhonebook.php when phoneBook button is clicked
    $('#phoneBook').click(function (e) {
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "publicPhonebook.php",
            data: {},
            success: function (data) {
                $('#block').html(data);
            }
        });
    })

</script>
</html>