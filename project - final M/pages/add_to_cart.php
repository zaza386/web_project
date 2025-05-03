
<?php
//------jory---------------
session_start();
include "../db.php";

// Make sure the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and validate the product ID and quantity
    $productId = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    if ($productId <= 0 || $quantity <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid product data.']);
        exit;
    }

    // Fetch product from the database
    $stmt = $conn->prepare("SELECT idProduct, name, price, stock FROM product WHERE idProduct = ?");
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if (!$product) {
        echo json_encode(['success' => false, 'message' => 'Product not found.']);
        exit;
    }

    // Check stock limit
    if ($quantity > $product['stock']) {
        echo json_encode(['success' => false, 'message' => 'Requested quantity exceeds stock.']);
        exit;
    }

    // Initialize session cart if needed
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $productId) {
            // Update quantity if product already in cart
            $newQty = $item['quantity'] + $quantity;
            if ($newQty > $product['stock']) {
                echo json_encode(['success' => false, 'message' => 'Total quantity exceeds available stock.']);
                exit;
            }
            $item['quantity'] = $newQty;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $_SESSION['cart'][] = [
            'id' => $product['idProduct'],
            'name' => $product['name'],
            'price' => $product['price'],
            'quantity' => $quantity
        ];
    }

    echo json_encode(['success' => true, 'message' => 'Product added to cart successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
