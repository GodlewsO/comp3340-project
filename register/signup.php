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
                if (empty($_POST["email"]) || empty($_POST["pw"]) || 
                    empty($_POST["fname"]) || empty($_POST["lname"])) {
                    return;
                }
                $email = $_POST["email"];
                $pw = $_POST["pw"];
                $fname = $_POST["fname"];
                $lname = $_POST["lname"];

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

                // Add user to database with created password hash
                $hash = password_hash("$pw", PASSWORD_DEFAULT);
                if (addNewUser($email, $hash, $fname, $lname) == -1) {
                    echo "Error performing query<br>";
                    return;
                }

                echo "Account Created.";
            }

            main();
        ?>
        
        <br><hr><br>
        <a href="../index.php">Back to Menu</a>
    </body>
</html>
