<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "databazove_mihalik";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "";

    $input_username = $_POST['meno'];
    $input_password = mysqli_real_escape_string($conn, $_POST['heslo']); // Assuming $_POST['heslo'] is the password entered by the user
    $input_email = $_POST['email'];
    $hashed_password = hash('sha256', $input_password);
    
    $check_username_sql = "SELECT * FROM user WHERE meno='$input_username'";
    $result = $conn->query($check_username_sql);

    if ($result->num_rows > 0) {
        echo "<p>Používateľ už existuje.</p>";
    } else {
        // Use $hashed_password instead of $input_password
        $insert_sql = "INSERT INTO user (meno, heslo, email) VALUES ('$input_username', '$hashed_password', '$input_email')";
    
        if ($conn->query($insert_sql) === TRUE) {
            echo "<p>Úspešné vytvorenie.</p>";
        } else {
            echo "Error: " . $insert_sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
}

echo '<html>';
echo '<head>';
echo '<title>Register form</title>';
echo '<link rel="stylesheet" href="login.css">';
echo '</head>';
echo '<body>';
echo '<div class="wrapper">';
echo '<form action="register.php" method="post">';
echo '<h1>Registrácia</h1>';
echo '<input type="email" name="email" placeholder="Zadajte email" required>';
echo '<input type="text" name="meno" placeholder="Zadajte meno" required autofocus>';
echo '<input type="password" name="heslo" placeholder="Zadajte heslo" required>';
echo '<button type="submit" name="submit">Registrovať sa</button>';
echo '<a href="login.php" id="Register">Prihlásiť sa</a>';
echo '</form>';
echo '</div>';
echo '</body>';
echo '</html>';
?>