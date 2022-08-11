<?php
require "./dbhelper.php";

session_start();

// Remove token from database
if (isset($_SESSION['username'])) {
    $email = $_SESSION['username'];
    if (emailInTokens($email) == 1) {
        removeToken($email);
    }
}

// Destroy cookies and unset session variables
$_SESSION = array();
if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time()-1000);
        setcookie($name, '', time()-1000, '/');
    }
}
session_destroy();

header('Location: ./index.php');
?>
