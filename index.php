<?php
session_start();

if (isset($_POST['submit']) && !empty($_POST['username']) && !empty($_POST['password'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "databazove";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM user WHERE meno = '" . $_POST['username'] . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($_POST['password'], $row["heslo"])) {
            $_SESSION['valid'] = true;
            $_SESSION['timeout'] = time();
            $_SESSION['username'] = $_POST['username'];

            header("Location: welcome.php");
            exit();
        } else {
            echo "<p>Wrong password</p>";
        }
    } else {
        echo "<p>User not found</p>";
    }

    $conn->close();
}
?>

<html>
<head>
    <title>Login form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="wrapper">
    <form action="index.php" method="post">
        <h1>Prihláste sa</h1>
        <input type="text" name="username" placeholder="username" required autofocus>
        <input type="password" name="password" placeholder="password" required>
        <button type="submit" name="submit">Prihlásiť sa</button>
        <a href="register.php" id="Register">Registrovať sa</a>
    </form>
</div>
</body>
</html>