<?php
session_start();
if (!isset($_SESSION['admin']["is_admin"]) || $_SESSION['admin']["is_admin"] = false) {
    header('location: ../../logout.php');
} 