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

$name = $description = $price = $image_url = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $image_url = $_POST["image_url"];

    // Validate inputs (you can add more validation as needed)
    if (empty($name)) {
        $errors[] = "Name is required";
    }

    if (empty($description)) {
        $errors[] = "Description is required";
    }

    if (!is_numeric($price) || $price < 0) {
        $errors[] = "Price must be a positive number";
    }

    // If there are no validation errors, proceed with update
    if (empty($errors)) {
        $sql = "UPDATE produkty SET nazov=?, popis=?, cena=?, image_url=? WHERE id=?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssdsi", $name, $description, $price, $image_url, $id);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo "Product updated successfully";
                // Redirect to a different page after successful update
                header("Location: admin_panel.php");
                exit;
            } else {
                $errors[] = "Error updating product";
            }

            $stmt->close();
        } else {
            $errors[] = "Error preparing statement";
        }
    }
}

// Fetch product details
$id = $_GET["id"];
$sql = "SELECT * FROM produkty WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if (!$row) {
    echo "Product not found";
    exit;
}
$name = $row["nazov"];
$description = $row["popis"];
$price = $row["cena"];
$image_url = $row["image_url"];

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>

@import url('https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400..900&display=swap');
    body {
    font-family: 'Maven Pro', sans-serif;
    background-color: #f9f9f9;
    color: #333;
}

.container {
    width: 30%;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    margin-bottom: 20px;
    text-align:center;
}

.form-group {
    margin-bottom: 20px;
    width:90%;
    display:flex;
    justify-content:center;
    flex-direction:column;
}

label {
    font-weight: bold;
    width: 94%;
    margin: auto auto 0.75rem auto;
}

form {
    display: flex;
    justify-content: center;
    align-items:center;
    flex-direction:column;
}

input[type="text"],
input[type="number"],
textarea {
    width: 90%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin:auto;
}

textarea {
    min-height: 100px;
}

input[type="submit"] {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 5px;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

.errors {
    color: #dc3545;
    margin-bottom: 20px;
}

    </style>
</head>
<body>
    <div class="container">
        <h2>Upraviť produkt</h2>
        <?php if (!empty($errors)) : ?>
            <ul class="errors">
                <?php foreach ($errors as $error) : ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
            <div class="form-group">
                <label for="name">Názov:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Popis:</label>
                <textarea id="description" name="description" required><?php echo htmlspecialchars($description); ?></textarea>
            </div>
            <div class="form-group">
                <label for="price">Cena:</label>
                <input type="number" id="price" name="price" min="0" step="0.01" value="<?php echo htmlspecialchars($price); ?>" required>
            </div>
            <div class="form-group">
                <label for="image_url">Obrázok URL:</label>
                <input type="text" id="image_url" name="image_url" value="<?php echo htmlspecialchars($image_url); ?>" required>
            </div>
            <input type="submit" value="Update Product">
        </form>
    </div>
</body>
</html>
