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

// Fetch categories from the database
$sql_categories = "SELECT id, kategoria FROM kategorie";
$result_categories = $conn->query($sql_categories);
$categories = [];
if ($result_categories->num_rows > 0) {
    while ($row = $result_categories->fetch_assoc()) {
        $categories[] = $row;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $image_url = $_POST["image_url"];
    $category_id = $_POST["category"];

    if (empty($name)) {
        $errors[] = "Name is required";
    }

    if (empty($description)) {
        $errors[] = "Description is required";
    }

    if (!is_numeric($price) || $price < 0) {
        $errors[] = "Price must be a positive number";
    }

    if (empty($errors)) {
        $sql = "INSERT INTO produkty (nazov, popis, cena, image_url, id_kategorie) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssdsi", $name, $description, $price, $image_url, $category_id);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo "Product inserted successfully";
                // Redirect to a different page after successful insertion
                header("Location: admin_panel.php");
                exit;
            } else {
                $errors[] = "Error inserting product";
            }

            $stmt->close();
        } else {
            $errors[] = "Error preparing statement";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400..900&display=swap');

        body {
            font-family: 'Maven Pro', sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            width: 400px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form label {
            display: block;
            margin-bottom: 10px;
        }

        form input[type="text"],
        form input[type="number"],
        form textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        form input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        form input[type="submit"]:hover {
            background-color: #0056b3;
        }

        ul {
            color: red;
            margin-bottom: 15px;
        }

        li {
            list-style-type: none;
        }
        </style>
</head>
<body>
    <h2>Pridajte produkt</h2>
    <?php if (!empty($errors)) : ?>
        <ul>
            <?php foreach ($errors as $error) : ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="name">Názov:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required><br><br>
        <label for="description">Popis:</label>
        <textarea id="description" name="description" required><?php echo htmlspecialchars($description); ?></textarea><br><br>
        <label for="price">Cena:</label>
        <input type="number" id="price" name="price" min="0" step="0.01" value="<?php echo htmlspecialchars($price); ?>" required><br><br>
        <label for="image_url">Obrázok URL:</label>
        <input type="text" id="image_url" name="image_url" value="<?php echo htmlspecialchars($image_url); ?>" required><br><br>
        <label for="category">Kategória:</label>
        <select id="category" name="category">
            <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category['id']; ?>"><?php echo $category['kategoria']; ?></option>
            <?php endforeach; ?>
        </select><br><br>
        <input type="submit" value="Pridaj produkt">
    </form>
</body>
</html>