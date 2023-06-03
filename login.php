<div>
    <p style="color: #C99292; font-size: 25px; display: flex; justify-content: center">Login</p>

    <div style="margin: auto; width: 18%">
        <div id="message" style="color: red; width: 300px;"></div>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username"/>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password"/>

        <button type="submit" style="float: right; margin-top: 10px;" id="loginSubmit">Login</button>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js"
        integrity="sha512-8Z5++K1rB3U+USaLKG6oO8uWWBhdYsM3hmdirnOEWp8h2B1aOikj5zBzlXs8QOrvY9OxEnD2QDkbSKKpfqcIWw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    // Login request
    $(document).ready(function () {
        $("#loginSubmit").click(function () {
            let username = $("#username").val().trim();
            let password = $("#password").val().trim();

            if (username != "" && password != "") {
                $.ajax({
                    url: 'loginCheck.php',
                    type: 'post',
                    data: {username: username, password: password},
                    success: function (response) {
                        let msg = "";
                            if (response == 1) {
                                window.location = "home.php";
                            } else {
                                msg = "Invalid username and password!";
                            }

                        $("#message").html(msg);
                    }
                });
            }
        });
    });
</script>