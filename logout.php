<?php
ob_start();
session_start();

if (isset($_SESSION['admin']) || empty($_SESSION['admin'])) {
    unset($_SESSION['admin']);
    $_SESSION['success_message-logout'] = "Log out successfully!";
    header("location: ./login.php");
    exit();
}