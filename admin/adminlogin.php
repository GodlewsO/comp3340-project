<?php

session_start();

require '../dbhelper.php';

function main() {
    // Get form data if it exists
    if (empty($_POST["uname"]) || empty($_POST["pw"])) {    // empty form error
        return;
    }
    $uname = $_POST["uname"];
    $pw = $_POST["pw"];

    // Check if username found in db
    switch (unameInAdmin($uname)) {
        case 0:     // admin account doesn't exist with that username
            echo "username doesn't exist<br>";
            return;
        case 1:
            break;
        case -1:    // error performing query
            echo "error performing check uname query<br>";
            return;
            
    }

    // Get hash of password for given username
    $pulledHash = getAdminHash($uname);
    if ($pulledHash == -1) {    // error performing query
        echo "error performing getHash query<br>";
        return;
    }

    // Verify given password
    if (!password_verify($pw, $pulledHash)) {   // invalid password
        echo "invalid password<br>";
        return;
    }

    // Create new authentication token for admin
    $token = bin2hex(openssl_random_pseudo_bytes(16));
    if (updateAdminToken($uname, $token) == -1) {
        echo "error performing updateAdminToken query<br>";
        return;
    }


    // Set session variables
    $_SESSION['adminname'] = $uname;
    $_SESSION['admintoken'] = $token;
    header('Location: ./admin.php');

}

main();
?>

<a href="./">back</a>
