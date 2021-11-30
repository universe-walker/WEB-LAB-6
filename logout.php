<?php

session_start();

if ($_SESSION['user_id']) {
    unset($_SESSION['user_id']);
}

$next = $_GET['next'];
header("Location: " . $next);
