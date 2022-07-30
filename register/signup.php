<!DOCTYPE html>
<html>
    <head>

    </head>

    <body>
        <?php
            session_start();

            require '../dbhelper.php';

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
                        break;
                    case 1:
                        echo "An account with that email already exists<br>";
                        return;
                    case -1:
                        echo "Error performing query<br>";
                        return;
                }

                // Add user and hash to database
                $hash = password_hash("$pw", PASSWORD_DEFAULT);
                if (addNewUser($email, $hash) == -1) {
                    echo "Error performing query<br>";
                    return;
                }

                echo "Account Created.";
            }

            main();
        ?>
        
        <br><hr><br>
        <a href="../index.html">Back to Menu</a>
    </body>
</html>