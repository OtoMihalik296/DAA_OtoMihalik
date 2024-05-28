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

$sortBy = isset($_GET['sort']) ? $_GET['sort'] : 'name_asc';
$orderBy = '';

switch ($sortBy) {
    case 'name_asc':
        $orderBy = 'p.nazov ASC';
        break;
    case 'name_desc':
        $orderBy = 'p.nazov DESC';
        break;
    case 'price_asc':
        $orderBy = 'p.cena ASC';
        break;
    case 'price_desc':
        $orderBy = 'p.cena DESC';
        break;
    case 'id_asc':
        $orderBy = 'p.id ASC';
        break;
    case 'id_desc':
        $orderBy = 'p.id DESC';
        break;
    default:
        $orderBy = 'p.nazov ASC';
        break;
}

$sql = "SELECT p.id, p.nazov AS product_name, p.popis AS description, p.cena AS price, p.image_url, k.kategoria AS category_name 
        FROM produkty p
        JOIN kategorie k ON p.id_kategorie = k.id
        ORDER BY $orderBy";

$result = $conn->query($sql);

$products = [];
$ceny = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
        $ceny[] = $row['price'];
    }
} else {
    echo "0 results";
}

// Calculate statistics
sort($ceny);
$nizka = min($ceny);
$vysoka = max($ceny);
$midIndex = floor(count($ceny) / 2);
if (count($ceny) % 2 == 0) {
    $stred = ($ceny[$midIndex - 1] + $ceny[$midIndex]) / 2;
} else {
    $stred = $ceny[$midIndex];
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="produkt.css">
    <script src="script.js"></script>
    <style>
        #kategoria {
            margin: 1rem 0;
            position: absolute;
            bottom: 1rem;
            left: 40%;
        }
        .statistics {
            margin: 20px 0;
        }
    </style>
</head>
<body>
    
<main>
    <div class="left-nav">
        <h2>Notebooky</h2>
        <div class="search-container">
            <input type="text" placeholder="Hľadanie.." id="search-input">
        </div>
        <form id="filter-form">
            <label for="sort-by">Zoradiť podla:</label>
            <select id="sort-by">
                <option value="name_asc">Názov (A-Z)</option>
                <option value="name_desc">Názov (Z-A)</option>
                <option value="price_asc">Cena ↑</option>
                <option value="price_desc">Cena ↓</option>
                <option value="id_asc">ID ↑</option>
                <option value="id_desc">ID ↓</option>
            </select>
        </form>
        <div id="price-range-slider">
            <div style="display: flex; flex-direction: row; justify-content: space-evenly; align-items: center; width: 100%;">
                <span>0€</span>
                <p>-</p>
                <span>2000€</span>
            </div>
            <div style="display: flex; flex-direction: row;">
                <input type="range" id="min-price" min="0" max="2000" value="0">
                <input type="range" id="max-price" min="0" max="2000" value="2000">
            </div>
        </div>
        <select id="category-dropdown">
            <option value="all">Všetky</option>
            <option value="Pracovný">Pracovný</option>
            <option value="Herný">Herný</option>
            <option value="Bežný">Bežný</option>
        </select>
        <a href="admin.php">Admin</a>
        <div class="statistics">
            <p>Najnižšia cena: <?php echo $nizka; ?> €</p>
            <p>Najvyššia cena: <?php echo $vysoka; ?> €</p>
            <p>Stredná cena: <?php echo $stred; ?> €</p>
        </div>
    </div>

    <div class="products">
    <?php
        foreach ($products as $product) {
            echo "<div class='product-card'>";
            echo "<div class='obrazok'>";
            echo "<img src='" . $product['image_url'] . "' alt='" . $product['product_name'] . "'>";
            echo "</div>";
            echo "<h3>" . $product['product_name'] . "</h3>";
            echo "<h4>" . $product['price'] . " €</h4>";
            echo "<p id='kategoria'>" . $product['category_name'] . "</p>";
            echo "<a href=''>Kúpiť</a>";
            echo "</div>";
        }
    ?>
    </div>
</main>

</body>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const categoryDropdown = document.getElementById('category-dropdown');

    categoryDropdown.addEventListener('change', function() {
        const selectedCategory = this.value; 
        filterProducts(selectedCategory); 
    });

    function filterProducts(category) {
        const products = document.querySelectorAll('.product-card');

        products.forEach(function(product) {
            const productCategory = product.querySelector('p').textContent.trim();

            if (category === 'all' || productCategory === category) {
                product.style.display = 'block';
            } else {
                product.style.display = 'none';
            }
        });
    }
});
</script>
</html>
