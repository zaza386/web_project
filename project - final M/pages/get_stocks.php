

<?php

//jory for cart quantity 

include "../db.php"; // one level up from pages
header('Content-Type: application/json');

$result = mysqli_query($conn, "SELECT idProduct, stock FROM product");
$stocks = [];

while ($row = mysqli_fetch_assoc($result)) {
    $stocks[$row['idProduct']] = $row['stock'];
}

echo json_encode($stocks);
?>
