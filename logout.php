<?php
// Destroy session/ Logout user
session_start();
session_destroy();
header('Location: main.php');