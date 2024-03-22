<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "databazove";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "";

    $input_username = $_POST['username'];
    $input_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $input_email = $_POST['email'];

    $check_username_sql = "SELECT * FROM user WHERE meno='$input_username'";
    $result = $conn->query($check_username_sql);

    if ($result->num_rows > 0) {
        echo "<p>Username already exists. Please choose a different username.</p>";
    } else {
        $insert_sql = "INSERT INTO user (meno, heslo, email) VALUES ('$input_username', '$input_password', '$input_email')";

        if ($conn->query($insert_sql) === TRUE) {
            echo "<p>New record created successfully</p>";
        } else {
            echo "Error: " . $insert_sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}

echo '<html>';
echo '<head>';
echo '<title>Register form</title>';
echo '<link rel="stylesheet" href="style.css">';
echo '</head>';
echo '<body>';
echo '<div class="wrapper">';
echo '<form action="register.php" method="post">';
echo '<h1>Registrácia</h1>';
echo '<input type="email" name="email" placeholder="email" required>';
echo '<input type="text" name="username" placeholder="username" required autofocus>';
echo '<input type="password" name="password" placeholder="password" required>';
echo '<button type="submit" name="submit">Registrovať sa</button>';
echo '<a href="index.php" id="Register">Prihlásiť sa</a>';
echo '</form>';
echo '</div>';
echo '</body>';
echo '</html>';
?>
