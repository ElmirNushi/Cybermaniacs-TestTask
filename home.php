<?php
include "DataBaseConnection.php";

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location:main.php");
}
?>

<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cybermaniacs - Registered</title>
</head>

<body>
<p style="color: #C99292; font-size: 30px; display: flex; justify-content: center">Phonebook</p>
<div style="margin: auto; width: 50%">
    <div class="buttons" style="display: flex; max-width: 500px; gap: 10px; padding-left: 20px; padding-bottom: 15px;">

        <a href="logout.php" id=""
           style="border-radius: 50px; padding: 10px 20px; border: 1px solid black;color: black; text-decoration: none">Logout </a>
        <a href="Javascript:void(0);" id="phoneBook"
           style="border-radius: 50px; padding: 10px 30px; border: 1px solid black;color: black; text-decoration: none">Public
            Phonebook </a>
        <a href="Javascript:void(0);" id="myContact"
           style="border-radius: 50px; padding: 10px 20px; border: 1px solid black;color: black; text-decoration: none">My
            Contact </a>
    </div>
    <div class="block" id="block" style="border: 2px solid grey; width: 1000px; height: 500px;">

    </div>
</div>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
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

    $('#myContact').click(function (e) {
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "myContact.php",
            data: {},
            success: function (data) {
                $('#block').html(data);
            }
        });
    })
</script>

</html>


