<?php
//raghad bahawi:after clicks buy update quantity and empty the cart ------------
session_start();
include "../db.php";

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo json_encode(['success' => false, 'message' => 'Cart is empty']);
    exit;
}

// Update quantity in the database
foreach ($_SESSION['cart'] as $item) {
    $id = intval($item['id']);
    $qty = intval($item['quantity']);

    // Reduce the stock in DB if enough is available
    $query = "UPDATE product SET stock = stock - $qty WHERE idProduct = $id AND stock >= $qty";
    mysqli_query($conn, $query);
}





// --------dana -------------
// Save purchase info before clearing cart
$order = [
    'id' => uniqid('order_'),
    'date' => date('Y-m-d H:i:s'),
    'items' => $_SESSION['cart'],
    'total' => 0
];

// Calculate total
foreach ($_SESSION['cart'] as $item) {
    $order['total'] += $item['price'] * $item['quantity'];
}

// Get previous orders from cookie
$pastOrders = [];
if (isset($_COOKIE['past_orders'])) {
    $pastOrders = json_decode($_COOKIE['past_orders'], true);
}

// Add new order to history
$pastOrders[] = $order;

// Save back to cookie (30 days)
setcookie('past_orders', json_encode($pastOrders), time() + (30 * 24 * 60 * 60), "/");

// Empty the cart session
$_SESSION['cart'] = [];

// Return success response
echo json_encode(['success' => true]);
?>
