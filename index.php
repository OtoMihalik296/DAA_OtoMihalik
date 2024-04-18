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
<h2>Product List</h2>

<div class="products">

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "databazove_mihalik";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT id, nazov, popis, cena FROM produkty";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='product-card'>";
            echo "<img src='' alt=''>";
            echo "<h3>".$row['nazov']."</h3>";
            echo "<p>".$row['popis']."</p>";
            echo "<p>Price: ".$row['cena']."</p>";
            echo "</div>";
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>
    </div>
    </main>
    
    </body>
    </html>