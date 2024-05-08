<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "databazove_mihalik";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['confirm']) && $_POST['confirm'] === 'yes') {
        // Remove product from database
        $productId = $_POST['product_id'];
        $sql = "DELETE FROM produkty WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $productId);
        $stmt->execute();

        header("Location: admin_panel.php");
        exit;
    } else {
        // Redirect back to admin panel
        header("Location: admin_panel.php");
        exit;
    }
}

if (isset($_GET['id'])) {
    $productId = $_GET['id'];
} else {
    header("Location: admin_panel.php");
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Product</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400..900&display=swap');
        body {
            font-family: 'Maven Pro', sans-serif;
            background-color: #f9f9f9;
            text-align: center;
            padding-top: 50px;
        }

        h2 {
            color: #333;
            margin-bottom: 30px;
        }

        form {
            display: inline-block;
        }

        button {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            margin-right: 10px;
        }

        button:hover {
            background-color: #c82333;
        }

        button[name="confirm"] {
            background-color: #007bff;
        }

        button[name="confirm"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Chcete tento produkt naozaj vymazať?</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
        <button type="submit" name="confirm" value="yes">Áno</button>
        <button type="submit" name="confirm" value="no">Nie</button>
    </form>
</body>
</html>

