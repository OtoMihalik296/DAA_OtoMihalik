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

// Fetch products with category information from the database
$sql = "SELECT p.id, p.nazov AS name, p.popis AS description, p.cena AS price, p.image_url, k.kategoria AS category
        FROM produkty p
        INNER JOIN kategorie k ON p.id_kategorie = k.id";
$result = $conn->query($sql);

$products = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400..900&display=swap');
body {
    font-family: 'Maven Pro', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
}

.container {
    max-width: 60vw;
    margin: 0 auto;
    padding: 20px;
}

h2 {
    text-align: center;
}

.products {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

.product {
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 20px;
    margin-top:1rem;
}

.product img {
    width: 100%;
    border-radius: 5px;
    margin-bottom: 10px;
}

.product h3 {
    margin: 0 0 10px;
}

.product p {
    margin: 0;
}

.buttons {
    display: flex;
    justify-content: space-between;
    margin-top: 10px;
}

.buttons a {
    text-decoration: none;
    color: #333;
    padding: 8px 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.buttons a:hover {
    background-color: #eee;
}

#addproduct {
    text-align:Center;
    margin: 0.5rem auto;
    width: max-content;
    display:block;
    text-decoration:none;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px 20px;
    color: black;
}

</style>
</head>
<body>
    <div class="container">
        <h2>Admin Panel</h2>
        <a href="index.php" id="addproduct">Naspať na stránku</a>
        <a href="add_product.php" id="addproduct">Pridať produkt</a>
        <div class="products">
            <?php
            // Display products with category information
            foreach ($products as $product) {
                echo "<div class='product'>";
                echo "<img src='" . $product['image_url'] . "' alt='" . $product['name'] . "'>";
                echo "<div>";
                echo "<h3>".$product['name']."</h3>";
                echo "<p>".$product['price']." €</p>";
                echo "<p>".$product['category']."</p>"; // Display category
                echo "<div class='buttons'>";
                echo "<a href='edit_product.php?id=".$product['id']."'>Upraviť</a>";
                echo "<a href='delete_product.php?id=".$product['id']."'>Vymazať</a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
</body>
</html>