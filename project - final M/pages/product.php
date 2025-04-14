<?php
session_start();
include '../db.php';

// إضافة المنتج للسلة
$popupSuccess = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $id = intval($_POST['id']);
    $name = $_POST['name'];
    $price = floatval($_POST['price']);
    $picture = $_POST['picture'];
    $quantity = intval($_POST['quantity']);

    $newItem = [
        'id' => $id,
        'name' => $name,
        'price' => $price,
        'picture' => $picture,
        'quantity' => $quantity
    ];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] === $id) {
            $item['quantity'] += $quantity;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $_SESSION['cart'][] = $newItem;
    }

    $popupSuccess = true;
}

// جلب بيانات المنتج من قاعدة البيانات
if (!isset($_GET['id'])) {
    echo "Product ID not provided.";
    exit;
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM product WHERE idProduct = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Product not found.";
    exit;
}

$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($product['name']); ?> - Glamour</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS Files -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/product.css">
    <link rel="stylesheet" href="../css/plugins/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="../css/plugins/magnific-popup/magnific-popup.css">
    <link rel="stylesheet" href="../css/plugins/nouislider/nouislider.css">

    <style>
        .popup-overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.5); z-index: 9999; display: none;
            align-items: center; justify-content: center;
        }

        .popup-content {
            background: #fff; padding: 20px; border-radius: 8px;
            width: 300px; text-align: center; position: relative;
        }

        .popup-content h4 {
            margin-bottom: 15px;
        }

        .popup-content button {
            margin-top: 10px;
        }

        .close-button {
            position: absolute; right: 10px; top: 10px;
            font-size: 20px; cursor: pointer;
        }
    </style>
</head>
<body>
<div class="page-wrapper">

<!-- HEADER -->
<header class="header">
  <div class="header-top">
    <div class="container">
      <div class="header-left"></div>
      <div class="header-right">
        <ul class="top-menu">
          <li><br>
            <a href="#">Links</a>
            <ul>
              <li><i class="icon-phone"></i>Call: +966 5 0000 0000</li>
              <li><a href="about.html">About Us</a></li>
              <li><a href="contact.html">Contact Us</a></li>
              <li><a href="login.html"><i class="icon-user"></i>Login</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="header-middle sticky-header">
    <div class="container">
      <div class="header-left">
        <button class="mobile-menu-toggler">
          <span class="sr-only">Toggle mobile menu</span>
          <i class="icon-bars"></i>
        </button>
        <a href="../index.php" class="logo">
          <img src="../images/logo.png" alt="Glamour Logo" width="105" height="25">
        </a>
        <nav class="main-nav">
          <ul class="menu">
            <li><a href="../index.php">Home</a></li>
            <li><a href="contact.html">Contact Us</a></li>
            <li><a href="help.html">Help</a></li>
          </ul>
        </nav>
      </div>
      <div class="header-right">
        <div class="cart">
          <a href="cart.php" title="View Cart"><i class="icon-shopping-cart"></i></a>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- MAIN CONTENT -->
<main class="main">
  <div class="container product-page mt-5">
    <div class="row">
      <div class="col-md-6">
        <div class="product-gallery">
          <img src="../images/<?php echo $product['picture']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="img-fluid">
        </div>
      </div>

      <div class="col-md-6">
        <h1 class="product_title"><?php echo htmlspecialchars($product['name']); ?></h1>
        <p class="product_price">SAR <?php echo number_format($product['price'], 2); ?></p>
        <p class="product_description"><?php echo htmlspecialchars($product['description1']); ?></p>

        <form method="POST" action="">
          <input type="hidden" name="id" value="<?php echo $product['idProduct']; ?>">
          <input type="hidden" name="name" value="<?php echo htmlspecialchars($product['name']); ?>">
          <input type="hidden" name="price" value="<?php echo $product['price']; ?>">
          <input type="hidden" name="picture" value="<?php echo $product['picture']; ?>">
          <input type="hidden" name="add_to_cart" value="1">

          <div class="product-quantity">
            <label for="product_quantity">Qty:</label>
            <div class="input_group">
              <button class="btn btn_decrement btn-spinner" type="button">-</button>
              <input type="text" id="product_quantity" name="quantity" class="form-control" value="1" readonly>
              <button class="btn btn_increment btn-spinner" type="button">+</button>
            </div>
          </div>

          <div class="product-buttons mt-3">
            <button type="submit" class="btn btn-primary btn-round">Add to Cart</button>
            <a href="cart.php" class="btn btn-primary btn-round">Checkout</a>
          </div>
        </form>
      </div>
    </div>

    <div class="product-tabs mt-5">
      <ul class="nav nav-tabs">
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#description">Description</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#shipping-returns">Shipping & Returns</a></li>
      </ul>
      <div class="tab-content">
        <div id="description" class="tab-pane fade show active mt-3">
        <pre><?php echo nl2br(htmlspecialchars($product['description2'])); ?></pre>
        </div>
        <div id="shipping-returns" class="tab-pane fade mt-3">
<pre><strong>📦 Shipping Policy:</strong>
We offer free standard shipping on all orders over SAR 200 within Saudi Arabia.
Orders are processed within 1-2 business days and delivered within 3-5 business days in major cities.
Express shipping is available for an additional charge, with delivery in 1-2 business days.
We currently ship across Saudi Arabia; for GCC or international shipping, please contact our support team.
Cash on Delivery (COD) is available for an additional fee of SAR 10. 

<strong>🔄 Return Policy:</strong>
If you are not satisfied with your purchase, you may return unused and unopened products within 14 days of delivery for a full refund or exchange.
Due to hygiene reasons, we cannot accept returns on used or opened products.
If your order arrives damaged, defective, or incorrect, please contact us within 48 hours of delivery for a free replacement or refund.
Customers are responsible for return shipping fees unless the item is damaged or incorrect.</pre>
        </div>
      </div>
    </div>
  </div>
</main>

<!-- FOOTER -->
<footer class="footer mt-5">
  <div class="footer-middle">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-lg-3">
          <div class="widget widget-about">
            <img src="../images/logo.png" class="footer-logo" alt="Footer Logo" width="105" height="25">
            <p>Glamour is a premium online store dedicated to organic makeup, offering high-quality, chemical-free beauty products.</p>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="widget widget-links">
            <h4>Quick Links</h4>
            <ul>
              <li><a href="about.html">About Us</a></li>
              <li><a href="contact.html">Contact Us</a></li>
              <li><a href="help.html">Help</a></li>
              <li><a href="login.html">Login</a></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="widget widget-social">
            <h4>Follow Us</h4>
            <div class="social-icons">
              <a href="https://www.facebook.com/profile.php?id=61574225245811" class="social-icon"><i class="icon-facebook-f"></i></a>
              <a href="https://x.com/GlamourOrganicC" class="social-icon"><i class="icon-twitter"></i></a>
              <a href="https://www.instagram.com/glamourorganiccosmeticco/" class="social-icon"><i class="icon-instagram"></i></a>
              <a href="https://www.youtube.com/" class="social-icon"><i class="icon-youtube"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>

<!-- Success Popup -->
<div id="successPopup" class="popup-overlay">
  <div class="popup-content">
    <span class="close-button" onclick="closePopup()">&times;</span>
    <h4>Product Added!</h4>
    <p>The item has been added to your cart.</p>
    <a href="cart.php" class="btn btn-sm btn-primary">View Cart</a>
    <button onclick="closePopup()" class="btn btn-sm btn-secondary">Continue Shopping</button>
  </div>
</div>

</div>

<!-- Scripts -->
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
<script>
function closePopup() {
  document.getElementById('successPopup').style.display = 'none';
}

<?php if ($popupSuccess): ?>
document.addEventListener('DOMContentLoaded', function () {
  document.getElementById('successPopup').style.display = 'flex';
});
<?php endif; ?>

document.addEventListener("DOMContentLoaded", function () {
  const quantityInput = document.getElementById("product_quantity");
  const incrementButton = document.querySelector(".btn_increment");
  const decrementButton = document.querySelector(".btn_decrement");

  incrementButton.addEventListener("click", function () {
    let currentValue = parseInt(quantityInput.value);
    quantityInput.value = currentValue + 1;
  });

  decrementButton.addEventListener("click", function () {
    let currentValue = parseInt(quantityInput.value);
    if (currentValue > 1) {
      quantityInput.value = currentValue - 1;
    }
  });
});
</script>
</body>
</html>
