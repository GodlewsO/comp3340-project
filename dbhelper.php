<?php

$DB_CONNECTION['servername'] = "localhost";
$DB_CONNECTION['username'] = "admin";
$DB_CONNECTION['password'] = "5194481a";
$DB_CONNECTION['dbname'] = "godlewso_userauth";

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
function addNewUser($email, $hash, $fname, $lname) {
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
    $sql = "INSERT INTO `user` (`email`, `pass_hash`, `fname`, `lname`)
            VALUES ('$email', '$hash', '$fname', '$lname')";
    $result = $conn->query($sql);
    if(!$result) {
        echo "Error performing query";
        $conn->close();
        return -1;
    }

    $conn->close();
    return 1;
}

/**
 * Returns hash from user table.
 * Return -1 on error.
 */
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
    $conn->close();
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

/**
 * Inserts token into user_tokens table for given email.
 * Returns 1 if true and -1 on error.
 */
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

/**
 * Updates token into user_tokens table for given email.
 * Returns 1 if true and -1 on error.
 */
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

/**
 * Returns token from user_token table.
 * Return -1 on error.
 */
function getToken($email) {
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
    $sql = "SELECT `user_token` FROM `user_tokens` WHERE `email`='$email'";
    $result = $conn->query($sql);
    if(!$result) {
        $conn->close();
        return -1;
    }

    $row = $result -> fetch_assoc();
    $conn->close();
    return $row["user_token"];
}

/**
 * Removes token entry from user_token table.
 * Return -1 on error.
 */
function removeToken($email) {
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
    $sql = "DELETE FROM `user_tokens` WHERE `user_tokens`.`email` = '$email'";
    $result = $conn->query($sql);
    if(!$result) {
        $conn->close();
        return -1;
    }
}

// /**
//  * Removes entry from user_tokens.
//  * Return -1 on error.
//  */
// function removeToken($email) {
//     // Connect to database and return -1 if unsuccessful
//     global $DB_CONNECTION;
//     $conn = new mysqli($DB_CONNECTION['servername'],
//                        $DB_CONNECTION['username'],
//                        $DB_CONNECTION['password'],
//                        $DB_CONNECTION['dbname']);
//     if ($conn->connect_error) {
//         return -1;
//     }

//     // delete token from user_token table and check if successful
//     $sql = "QUERY TODO ";
//     $result = $conn->query($sql);
//     if(!$result) {
//         $conn->close();
//         return -1;
//     }

//     $row = $result -> fetch_assoc();
//     $conn->close();
//     return $row["pass_hash"];
// }






/**
 * Checks if given username is found in admin table.
 * Returns 1 if true, 0 if false, and -1 on error.
 */
function unameInAdmin($uname) {
    // Connect to database and return -1 if unsuccessful
    global $DB_CONNECTION;
    $conn = new mysqli($DB_CONNECTION['servername'],
                       $DB_CONNECTION['username'],
                       $DB_CONNECTION['password'],
                       $DB_CONNECTION['dbname']);
    if ($conn->connect_error) {
        return -1;
    }

    // Pull username from adnim table and check if query successful
    $sql = "SELECT `uname` FROM `admin` WHERE `uname`='$uname'";
    $result = $conn->query($sql);
    if(!$result) {
        $conn->close();
        return -1;
    }
    
    // Username found
    if ($result->num_rows > 0) {
        $conn->close();
        return 1;
    }

    // Username not found
    $conn->close();
    return 0;
}

/**
 * Returns hash from admin table.
 * Return -1 on error.
 */
function getAdminHash($uname) {
    // Connect to database and return -1 if unsuccessful
    global $DB_CONNECTION;
    $conn = new mysqli($DB_CONNECTION['servername'],
                       $DB_CONNECTION['username'],
                       $DB_CONNECTION['password'],
                       $DB_CONNECTION['dbname']);
    if ($conn->connect_error) {
        return -1;
    }

    // Pull hash from admin table and check if successful
    $sql = "SELECT `pass_hash` FROM `admin` WHERE `uname`='$uname'";
    $result = $conn->query($sql);
    if(!$result) {
        $conn->close();
        return -1;
    }

    $row = $result -> fetch_assoc();
    $conn->close();
    return $row["pass_hash"];
}


/**
 * Checks if given username is found in admin_tokens table.
 * Returns 1 if true, 0 if false, and -1 on error.
 */
function unameInTokens($uname) {
    // Connect to database and return -1 if unsuccessful
    global $DB_CONNECTION;
    $conn = new mysqli($DB_CONNECTION['servername'],
                       $DB_CONNECTION['username'],
                       $DB_CONNECTION['password'],
                       $DB_CONNECTION['dbname']);
    if ($conn->connect_error) {
        return -1;
    }

    // Pull username from admin_tokens table and check if query successful
    $sql = "SELECT * FROM `admin_tokens` WHERE `uname`='$uname'";
    $result = $conn->query($sql);
    if(!$result) {
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


/**
 * Inserts token into admin_tokens table for given username.
 * Returns 1 if true and -1 on error.
 */
function insertAdminToken($uname, $token) {
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
    $sql = "INSERT INTO `admin_tokens` (`uname`, `admin_token`) VALUES ('$uname', '$token')";
    $result = $conn->query($sql);
    if(!$result) {
        $conn->close();
        return -1;
    }

    $conn->close();
    return 1;
}

/**
 * Updates token into admin_tokens table for given username.
 * Returns 1 if true and -1 on error.
 */
function updateAdminToken($uname, $token) {
    // Connect to database and return -1 if unsuccessful
    global $DB_CONNECTION;
    $conn = new mysqli($DB_CONNECTION['servername'],
                        $DB_CONNECTION['username'],
                        $DB_CONNECTION['password'],
                        $DB_CONNECTION['dbname']);
    if ($conn->connect_error) {
        return -1;
    }

    // Update token for given username and return -1 if unsuccessful
    $sql = "UPDATE `admin_tokens` SET `admin_token`='$token' WHERE `uname`='$uname'";
    $result = $conn->query($sql);
    if(!$result) {
        $conn->close();
        return -1;
    }

    $conn->close();
    return 1;
}

/**
 * Returns token from admin_token table.
 * Return -1 on error.
 */
function getAdminToken($uname) {
    // Connect to database and return -1 if unsuccessful
    global $DB_CONNECTION;
    $conn = new mysqli($DB_CONNECTION['servername'],
                        $DB_CONNECTION['username'],
                        $DB_CONNECTION['password'],
                        $DB_CONNECTION['dbname']);
    if ($conn->connect_error) {
        return -1;
    }

    // Update token for given username and return -1 if unsuccessful
    $sql = "SELECT `admin_token` FROM `admin_tokens` WHERE `uname`='$uname'";
    $result = $conn->query($sql);
    if(!$result) {
        $conn->close();
        return -1;
    }

    $row = $result -> fetch_assoc();
    $conn->close();
    return $row["admin_token"];
}


/**
 * Adds email to banned emails list
 */
function banEmail($email) {
    // Connect to database and return -1 if unsuccessful
    global $DB_CONNECTION;
    $conn = new mysqli($DB_CONNECTION['servername'],
                        $DB_CONNECTION['username'],
                        $DB_CONNECTION['password'],
                        $DB_CONNECTION['dbname']);
    if ($conn->connect_error) {
        return -1;
    }

    // Insert email into banned emails table and return -1 if unsuccessful
    $sql = "INSERT INTO `banned_emails` (`email`) VALUES ('$email')";
    $result = $conn->query($sql);
    if(!$result) {
        $conn->close();
        return -1;
    }

    $conn->close();
}

function addAdmin() {
    // Connect to database and return -1 if unsuccessful
    global $DB_CONNECTION;
    $conn = new mysqli($DB_CONNECTION['servername'],
                       $DB_CONNECTION['username'],
                       $DB_CONNECTION['password'],
                       $DB_CONNECTION['dbname']);
    if ($conn->connect_error) {
        return -1;
    }

    $uname = "admin";
    $password = "password";
    $hash = password_hash("$password", PASSWORD_DEFAULT);

    // Add email and hash into user table and check if successful
    $sql = "INSERT INTO `admin` (`uname`, `pass_hash`) VALUES ('$uname', '$hash')";
    $result = $conn->query($sql);
    if(!$result) {
        echo "Error performing query";
        $conn->close();
        return -1;
    }

    $conn->close();
    return 1;
}
?>
