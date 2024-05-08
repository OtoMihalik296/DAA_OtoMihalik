<?php
session_start();

if (isset($_POST['submit']) && !empty($_POST['meno']) && !empty($_POST['heslo'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "databazove_mihalik";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM user WHERE meno = '" . $_POST['meno'] . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Hash the provided plain text password using SHA-256
        $provided_password = mysqli_real_escape_string($conn, $_POST['heslo']);
        $hashed_provided_password = hash('sha256', $provided_password);
        
        if ($hashed_provided_password === $row["heslo"]) {
            // Password is correct
            $_SESSION['logged_in'] = true;
            $_SESSION['timeout'] = time();
            $_SESSION['meno'] = $_POST['meno'];
            
            // Redirect to welcome page
            header("Location: index.php");
            exit();
        } else {
            // Password is incorrect
            echo "<p>Zlé heslo</p>";
        }
    } else {
        // Username not found
        echo "<p>Používateľ sa nenašiel</p>";
    }

    $conn->close();
}
?>

<html>
<head>
    <title>Login form</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
<div class="wrapper">
    <form action="login.php" method="post">
        <h1>Prihláste sa</h1>
        <input type="text" name="meno" placeholder="Zadajte meno" required autofocus>
        <input type="password" name="heslo" placeholder="Zadajte heslo" required>
        <button type="submit" name="submit">Prihlásiť sa</button>
        <a href="register.php" id="Register">Registrovať sa</a>
    </form>
</div>
</body>
</html>