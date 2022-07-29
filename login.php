<!DOCTYPE html>
<html>
    <head>

    </head>

    <body>
        <?php
            session_start();

            function main() {
                if (empty($_POST["email"])) {
                    echo "You must enter a valid name to save<br><br>";
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
                if ($result->num_rows <= 0) {
                    echo "An account with that name doensn't exist<br>";
                    $conn->close();
                    return;
                }

                // Pull hash from DB and check if successful
                $sql = "SELECT `PassHash` FROM `user` WHERE `Email`='$email'";
                $result = $conn->query($sql);
                if(!$result) {
                    echo "Error performing query<br>";
                    $conn->close();
                    return;
				}

                // verify given password
                $row = $result -> fetch_assoc();
                $pulledHash = $row["PassHash"];
                if (!password_verify($pw, $pulledHash)) {
                    echo "invalid password<br>";
                    return;
                }
                echo "Logged in<br>";

                $conn->close();
            }
    
            main();
        ?>
        
        <br><hr><br>
        <a href="../index.html">Back to Menu</a>
    </body>
</html>