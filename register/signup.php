<!DOCTYPE html>
<html>
    <head>

    </head>

    <body>
        <?php 
            if (!empty($_POST["email"])) {
                $email = $_POST["email"];
                $pw = $_POST["pw"];
                
                $servername = "localhost";
                $username = "godlewso_admin";
                $password = "5194481a";
                $dbname = "godlewso_userauth";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } 

              	$hash = password_hash("$pw", PASSWORD_DEFAULT);

                echo "email: $email <br>";
                echo "pw: $pw <br>";
              	echo "pw hash: $hash <br>";

                // CHANGE DB FROM VACHAR(20) TO CHAR(60)  !!!TODO!!!
                $sql = "INSERT INTO `user` (`email`, `password`) VALUES ('$email', '$hash')";
                $result = $conn->query($sql);
                
                if($result) {
					echo "Success";
                } else {
                    echo "Error";
				}

                $conn->close();
                
            } else {
                echo "You must enter a valid name to save<br><br>";
            }

        ?>
        
        <br><hr><br>
        <a href="add.php">Back to form</a> or <a href="index.php">Back to Menu</a>
    </body>
</html>