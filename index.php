<?php
session_start(); // Start the session

// Redirect to login page if user is not logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit; // Stop further execution
}

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "databazove_mihalik";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define default sorting order
$sortBy = isset($_GET['sort']) ? $_GET['sort'] : 'name_asc';
$orderBy = '';

// Define sorting column and order based on user selection
switch ($sortBy) {
    case 'name_asc':
        $orderBy = 'nazov ASC';
        break;
    case 'name_desc':
        $orderBy = 'nazov DESC';
        break;
    case 'price_asc':
        $orderBy = 'cena ASC';
        break;
    case 'price_desc':
        $orderBy = 'cena DESC';
        break;
    case 'id_asc':
        $orderBy = 'id ASC';
        break;
    case 'id_desc':
        $orderBy = 'id DESC';
        break;
    default:
        $orderBy = 'nazov ASC';
        break;
}

// Fetch products from database based on sorting order
$sql = "SELECT id, nazov, popis, cena, image_url FROM produkty ORDER BY $orderBy";
$result = $conn->query($sql);

// Initialize array to store products
$products = [];

// Check if products were found
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
} else {
    echo "0 results";
}

// Close database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="produkt.css">
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
                <option value="price_desc">Cena ↑</option>
                <option value="price_asc">Cena ↓</option>
                <option value="id_asc">ID ↑</option>
                <option value="id_desc">ID ↓</option>
            </select>
        </form>
        <div id="price-range-slider">
            <div style="display:flex; flex-direction: row; justify-content: space-evenly; align-items:center; width:100%;">
                <span>0€</span>
                <p>-</p>
                <span>2000€</span>
            </div>
            <div style="display:flex; flex-direction: row;">
                <input type="range" id="min-price" min="0" max="2000" value="0">
                <input type="range" id="max-price" min="0" max="2000" value="2000">
            </div>
        </div>
        <a href="admin.php">Admin</a>
    </div>

    <div class="products">
    <?php
        foreach ($products as $product) {
            echo "<div class='product-card'>"; // Ensure product-card is set to display: flex
            echo "<div class='obrazok'>";
            echo "<img src='" . $product['image_url'] . "' alt='" . $product['nazov'] . "'>";
            echo "</div>";
            echo "<h3>".$product['nazov']."</h3>";
            echo "<h4>".$product['cena']." €</h4>";
            echo "<a href='#'>Kúpiť</a>";
            echo "</div>";
        }
    ?>
</div>
</main>

<script>
// Price Range Slider Functionality
const minPriceInput = document.getElementById('min-price');
const maxPriceInput = document.getElementById('max-price');
const productCards = document.querySelectorAll('.product-card');

const minLabel = document.querySelector('#price-range-slider span:first-child');
const maxLabel = document.querySelector('#price-range-slider span:last-child');

function filterProductsByPrice() {
    const minValue = parseInt(minPriceInput.value);
    const maxValue = parseInt(maxPriceInput.value);

    productCards.forEach(function(card) {
        const price = parseInt(card.querySelector('h4').textContent); // Get the price from each product card
        if (price >= minValue && price <= maxValue) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });

    minLabel.textContent = minValue + '€';
    maxLabel.textContent = maxValue + '€';
}

function syncSliders() {
    const minValue = parseInt(minPriceInput.value);
    const maxValue = parseInt(maxPriceInput.value);

    if (minValue > maxValue) {
        minPriceInput.value = maxValue;
    }

    filterProductsByPrice();
}

minPriceInput.addEventListener('input', syncSliders);
maxPriceInput.addEventListener('input', syncSliders);

// Initially filter products by price
filterProductsByPrice();

// Sorting functionality
document.getElementById('sort-by').addEventListener('change', function() {
    var sortBy = this.value;
    var productsContainer = document.querySelector('.products');
    var productCardsArray = Array.from(productCards);

    productCardsArray.sort(function(a, b) {
        var aValue, bValue;

        switch (sortBy) {
            case 'name_asc':
            case 'name_desc':
                aValue = a.querySelector('h3') ? a.querySelector('h3').textContent.toLowerCase() : '';
                bValue = b.querySelector('h3') ? b.querySelector('h3').textContent.toLowerCase() : '';
                break;
            case 'price_asc':
            case 'price_desc':
                aValue = parseFloat(a.querySelector('h4').textContent);
                bValue = parseFloat(b.querySelector('h4').textContent);
                break;
            case 'id_asc':
            case 'id_desc':
                aValue = parseInt(a.querySelector('p:nth-of-type(2)').textContent.split(':')[1].trim());
                bValue = parseInt(b.querySelector('p:nth-of-type(2)').textContent.split(':')[1].trim());
                break;
        }

        if (sortBy.endsWith('_asc')) {
            return aValue > bValue ? 1 : -1;
        } else {
            return aValue < bValue ? 1 : -1;
        }
    });

    productsContainer.innerHTML = '';
    productCardsArray.forEach(function(card) {
        productsContainer.appendChild(card);
    });
});

const searchInput = document.getElementById('search-input');

searchInput.addEventListener('input', function() {
    const searchText = this.value.trim().toLowerCase();
    const productCards = Array.from(document.querySelectorAll('.product-card'));

    productCards.forEach(card => {
        const productNameElement = card.querySelector('h3');
        if (productNameElement) {
            const productName = productNameElement.textContent.toLowerCase();
            if (productName.includes(searchText)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        }
    });
}); 

</script>

</body>
</html>
