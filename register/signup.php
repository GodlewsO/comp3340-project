<!DOCTYPE html>
<html>
    <head>

    </head>

    <body>
        <?php
            session_start();

            function main() {
                if (empty($_POST["email"])) {
                    echo "no email error";
                    return;
                }

                $servername = "localhost";
                $username = "admin";
                $password = "5194481a";
                $dbname = "godlewso_userauth";

                $email = $_POST["email"];
                $pw = $_POST["pw"];
                
                // Create and check connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } 

                // Pull email from DB and check if successful
                $sql = "SELECT `Email` FROM `user` WHERE `Email`='$email'";
                $result = $conn->query($sql);
                if(!$result) {
                    echo "Error performing query<br>";
                    $conn->close();
                    return;
				}

                // Check if email found in DB
                if ($result->num_rows > 0) {
                    echo "An account with that email already exists.";
                    $conn->close();
                    return;
                }

                // Add email and hash into DB
                $hash = password_hash("$pw", PASSWORD_DEFAULT);
                $sql = "INSERT INTO `user` (`Email`, `PassHash`) VALUES ('$email', '$hash')";
                $result = $conn->query($sql);
                
                // Check if insert successful
                if(!$result) {
                    echo "Error performing query";
                    return;
                }
                
                echo "Account Created.";

                $conn->close();
            }

            main();
        ?>
        
        <br><hr><br>
        <a href="add.php">Back to form</a> or <a href="index.php">Back to Menu</a>
    </body>
</html>