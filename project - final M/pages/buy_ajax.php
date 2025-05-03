<?php
//raghad bahawi:after clicks buy update quantity and empty the cart ------------
session_start();
include "../db.php";

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo json_encode(['success' => false, 'message' => 'Cart is empty']);
    exit;
}

foreach ($_SESSION['cart'] as $item) {
    $id = intval($item['id']);
    $qty = intval($item['quantity']);

    // Reduce the stock in DB if enough is available
    $query = "UPDATE product SET stock = stock - $qty WHERE idProduct = $id AND stock >= $qty";
    mysqli_query($conn, $query);
}

// Empty the cart session
$_SESSION['cart'] = [];

echo json_encode(['success' => true]);
