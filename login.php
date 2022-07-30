<!DOCTYPE html>
<html>
    <head>

    </head>

    <body>
        <?php
            session_start();

            require './dbhelper.php';

            function main() {
                // Get form data if it exists
                if (empty($_POST["email"]) || empty($_POST["pw"])) {
                    echo "Empty form error<br>";
                    return;
                }
                $email = $_POST["email"];
                $pw = $_POST["pw"];

                // Check if email found in db
                switch (emailInUser($email)) {
                    case 0:
                        echo "An account with that name doensn't exist<br>";
                        return;
                    case 1:
                        break;
                    case -1:
                        echo "Error performing query<br>";
                        return;
                }

                // Get hash of password for given email
                $pulledHash = getHash($email);
                if ($pulledHash == -1) {
                    echo "Error performing query<br>";
                    return;
                }

                // Verify given password
                if (!password_verify($pw, $pulledHash)) {
                    echo "invalid password<br>";
                    return;
                }
                echo "Logged in<br>";

                // Check if user has token and update/insert it accordingly
                $token = bin2hex(openssl_random_pseudo_bytes(16));
                switch (emailInTokens($email)) {
                    case 0:
                        if (insertToken($email, $token) == -1) {
                            echo "Error performing query<br>";
                            return;
                        }
                        echo "Token successfuly added<br>";
                        break;
                    case 1:
                        if (updateToken($email, $token) == -1) {
                            echo "Error performing query<br>";
                            return;
                        }
                        echo "Token successfuly updated<br>";
                        break;
                    case -1:
                        echo "Error performing query<br>";
                        return;
                }

                // Create cookie for 14 days
                $cookie = $email . ':' . $token;
                $mac = hash_hmac('sha256', $cookie, "lMRxf3xggCa2Lxtb");
                $cookie .= ':' . $mac;
                setcookie('rememberme', $cookie, time() + (60 * 60 * 24 * 14), "/");
            }


            
            main();
        ?>
        
        <br><hr><br>
        <a href="../index.html">Back to Menu</a>
    </body>
</html>