<?php

session_start();

require '../dbhelper.php';

function main() {
    // Get form data if it exists
    if (empty($_POST["email"])) {    // empty form error
        return;
    }
    $email= $_POST["email"];

    banEmail($email);
    echo "email sucessfuly banned<br>";
    echo "<a href='./admin.php'>go back</a>";
}

main();
echo "email unsuccessfuly banned<br>";
header('Location: ./admin.php');
?>
