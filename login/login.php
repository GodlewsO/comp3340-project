<?php

session_start();

require './dbhelper.php';

function main() {
    // Get form data if it exists
    if (empty($_POST["email"]) || empty($_POST["pw"])) { // empty form error
        return;
    }
    $email = $_POST["email"];
    $pw = $_POST["pw"];

    // Check if email found in db
    switch (emailInUser($email)) {
        case 0: // account doesn't exist with that email
            return;
        case 1:
            break;
        case -1: // error performing query
            return;
    }

    // Get hash of password for given email
    $pulledHash = getHash($email);
    if ($pulledHash == -1) { // error performing query
        return;
    }

    // Verify given password
    if (!password_verify($pw, $pulledHash)) { // invalid password
        return;
    }

    // Check if user has token and update/insert it accordingly
    $token = bin2hex(openssl_random_pseudo_bytes(16));
    switch (emailInTokens($email)) {
        case 0:
            if (insertToken($email, $token) == -1) {// error performing query
                return;
            }
            break;
        case 1:
            if (updateToken($email, $token) == -1) { // error performing query
                return;
            }
            break;
        case -1: // error performing query
            return;
    }

    // Create cookie for 14 days
    $cookie = $email . ':' . $token;
    $mac = hash_hmac('sha256', $cookie, "lMRxf3xggCa2Lxtb");
    $cookie .= ':' . $mac;
    setcookie('rememberme', $cookie, time() + (60 * 60 * 24 * 14), "/");
}

main();
header('Location: ../');
?>
