<?php

$DB_CONNECTION['servername'] = "localhost";
$DB_CONNECTION['username'] = "admin";
$DB_CONNECTION['password'] = "5194481a";
$DB_CONNECTION['dbname'] = "godlewso_userauth";
$SECRET_KEY = "lMRxf3xggCa2Lxtb";

/**
 * Checks if given email is found in user table.
 * Returns 1 if true, 0 if false, and -1 on error.
 */
function emailInUser($email) {
    // Connect to database and return -1 if unsuccessful
    global $DB_CONNECTION;
    $conn = new mysqli($DB_CONNECTION['servername'],
                       $DB_CONNECTION['username'],
                       $DB_CONNECTION['password'],
                       $DB_CONNECTION['dbname']);
    if ($conn->connect_error) {
        return -1;
    }

    // Pull email from user table and check if query successful
    $sql = "SELECT `email` FROM `user` WHERE `email`='$email'";
    $result = $conn->query($sql);
    if(!$result) {
        $conn->close();
        return -1;
    }
    
    // Email found
    if ($result->num_rows > 0) {
        $conn->close();
        return 1;
    }

    // Email not found
    $conn->close();
    return 0;
}

/**
 * Creates a new user in user table with given data.
 * Returns 1 on success, and -1 on error.
 */
function addNewUser($email, $hash) {
    // Connect to database and return -1 if unsuccessful
    global $DB_CONNECTION;
    $conn = new mysqli($DB_CONNECTION['servername'],
                       $DB_CONNECTION['username'],
                       $DB_CONNECTION['password'],
                       $DB_CONNECTION['dbname']);
    if ($conn->connect_error) {
        return -1;
    }

    // Add email and hash into user table and check if successful
    $sql = "INSERT INTO `user` (`email`, `pass_hash`) VALUES ('$email', '$hash')";
    $result = $conn->query($sql);
    if(!$result) {
        echo "Error performing query";
        $conn->close();
        return -1;
    }

    $conn->close();
    return 1;
}

function getHash($email) {
    // Connect to database and return -1 if unsuccessful
    global $DB_CONNECTION;
    $conn = new mysqli($DB_CONNECTION['servername'],
                       $DB_CONNECTION['username'],
                       $DB_CONNECTION['password'],
                       $DB_CONNECTION['dbname']);
    if ($conn->connect_error) {
        return -1;
    }

    // Pull hash from user table and check if successful
    $sql = "SELECT `pass_hash` FROM `user` WHERE `email`='$email'";
    $result = $conn->query($sql);
    if(!$result) {
        $conn->close();
        return -1;
    }

    $row = $result -> fetch_assoc();
    return $row["pass_hash"];
}

/**
 * Checks if given email is found in user_tokens table.
 * Returns 1 if true, 0 if false, and -1 on error.
 */
function emailInTokens($email) {
    // Connect to database and return -1 if unsuccessful
    global $DB_CONNECTION;
    $conn = new mysqli($DB_CONNECTION['servername'],
                        $DB_CONNECTION['username'],
                        $DB_CONNECTION['password'],
                        $DB_CONNECTION['dbname']);
    if ($conn->connect_error) {
        return -1;
    }

    // Pull email from user_tokens table and check if query successful
    $sql = "SELECT `email` FROM `user_tokens` WHERE `email`='$email'";
    $result = $conn->query($sql);
    if(!$result) {
        echo "Error performing query<br>";
        $conn->close();
        return -1;
    }

    // Token entry found
    if ($result->num_rows > 0) {
        $conn->close();
        return 1;
    }
    
    // Token entry not found
    $conn->close();
    return 0;
}

function insertToken($email, $token) {
    // Connect to database and return -1 if unsuccessful
    global $DB_CONNECTION;
    $conn = new mysqli($DB_CONNECTION['servername'],
                        $DB_CONNECTION['username'],
                        $DB_CONNECTION['password'],
                        $DB_CONNECTION['dbname']);
    if ($conn->connect_error) {
        return -1;
    }

    // Update token for given email and return -1 if unsuccessful
    $sql = "INSERT INTO `user_tokens` (`email`, `user_token`) VALUES ('$email', '$token')";
    $result = $conn->query($sql);
    if(!$result) {
        $conn->close();
        return -1;
    }

    $conn->close();
    return 1;
}

function updateToken($email, $token) {
    // Connect to database and return -1 if unsuccessful
    global $DB_CONNECTION;
    $conn = new mysqli($DB_CONNECTION['servername'],
                        $DB_CONNECTION['username'],
                        $DB_CONNECTION['password'],
                        $DB_CONNECTION['dbname']);
    if ($conn->connect_error) {
        return -1;
    }

    // Update token for given email and return -1 if unsuccessful
    $sql = "UPDATE `user_tokens` SET `user_token`='$token' WHERE `email`='$email'";
    $result = $conn->query($sql);
    if(!$result) {
        $conn->close();
        return -1;
    }

    $conn->close();
    return 1;
}

?>
