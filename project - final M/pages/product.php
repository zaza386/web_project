<?php
$prefix = "../";
session_start();
include $prefix . "db.php";
include $prefix . "header.php";

// Handle product addition (if POST)
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $target = $prefix . "images/" . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $sql = "INSERT INTO product (name, price, picture) VALUES ('$name', '$price', '$image')";
        mysqli_query($conn, $sql);
        echo "<script>alert('Product added successfully!');</script>";
    } else {
        echo "<script>alert('Failed to upload image.');</script>";
    }
}

// Get product from DB
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$query = "SELECT * FROM product WHERE idProduct = $product_id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "<div class='container'><h2 class='text-center my-5'>Product not found.</h2></div>";
    include $prefix . "footer.php";
    exit;
}
?>


<!-- Raghad Bahawi: Product Page -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>

    <!-- CSS Files -->
    <link rel="stylesheet" href="<?= $prefix ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $prefix ?>css/product.css">
    <link rel="stylesheet" href="<?= $prefix ?>css/style.css">
    <link rel="stylesheet" href="<?= $prefix ?>css/plugins/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="<?= $prefix ?>css/plugins/magnific-popup/magnific-popup.css">
    <link rel="stylesheet" href="<?= $prefix ?>css/plugins/nouislider/nouislider.css">

    <!-- Help Popup CSS -->
    <style>
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;
        }
        .popup-content {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            width: 300px;
            text-align: left;
            position: relative;
        }
        .close-button {
            position: absolute;
            right: 10px;
            top: 10px;
            cursor: pointer;
            font-size: 20px;
        }
        .help-button {
            background-color: #a94442;
            color: white;
            border: none;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            font-size: 20px;
            line-height: 1;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="page-wrapper">

        <!-- Product Section -->
        <div class="container product-page">
            <div class="row">
                <!-- Product Image -->
                <div class="col-md-6">
                    <div class="product-gallery">
                        <img id="product-zoom" src="<?= $prefix ?>images/<?= $row['picture'] ?>" alt="<?= htmlspecialchars($row['name']) ?>" class="img-fluid">
                    </div>
                </div>

                <!-- Product Info -->
                <div class="col-md-6">
                    <h1 class="product_title"><?= htmlspecialchars($row['name']) ?></h1>
                    <p class="product_price">SAR <?= number_format($row['price'], 2) ?></p>
                    <p class="product_description"><?= htmlspecialchars($row['description1']) ?></p>

                    <div class="product-quantity">
                        <label for="product-quantity">Qty:</label>
                        <div class="input_group">
                            <button class="btn btn_decrement btn-spinner" type="button">-</button>
                            <input type="text" id="product_quantity" class="form-control" value="1" readonly>
                            <button class="btn btn_increment btn-spinner" type="button">+</button>
                        </div>
                    </div>

                    <div class="product-buttons">
                        <button class="btn btn-primary btn-add-to-cart">Add to Cart</button>
                        <a href="cart.php" class="btn btn-secondary btn-checkout">Checkout</a>
                        <button class="help-button" onclick="openHelpPopup()">?</button>
                    </div>
                </div>
            </div>

            <!-- Product Tabs -->
            <div class="product-tabs">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#description">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#shipping-returns">Shipping & Returns</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div id="description" class="tab-pane fade show active">
<pre><?= htmlspecialchars($row['description2']) ?></pre>
                    </div>
                    <div id="shipping-returns" class="tab-pane fade">
<pre><strong>📦 Shipping Policy:</strong>

Free standard shipping on orders over SAR 200 within Saudi Arabia.
Orders are processed within 1-2 business days, delivered within 3-5 in major cities.
Express delivery available within 1-2 days (extra charge). COD available for SAR 10.

<strong>🔄 Return Policy:</strong>

Return unused/unopened items within 14 days for full refund or exchange.
Used items are not returnable. Damaged/incorrect orders replaced for free within 48h notice.
</pre>
                    </div>
                </div>
            </div>
        </div>

        <!-- Added to Cart Modal -->
        <!-- ZAINAB ALBADI -->
        <div class="modal fade" id="addedToCartModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content text-center p-4">
                    <div class="modal-body">
                        <h2>🎉 Added to Cart!</h2>
                        <p>Your item has been successfully added to your shopping cart.</p>
                        <a href="cart.php" class="btn btn-primary btn-round">View Cart</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Help Popup -->
        <!-- ZAINAB ALBADI -->
        <div id="helpPopup" class="popup-overlay">
            <div class="popup-content">
                <span class="close-button" onclick="closeHelpPopup()">&times;</span>
                <h4>Need Help?</h4>
                <ul style="padding-left: 20px;">
                    <li>Choose quantity using + / -</li>
                    <li>Click "Add to Cart" to save item</li>
                    <li>Click "Checkout" to place your order</li>
                    <li>Email: support@Glamour_Organic.com</li>
                </ul>
                <button onclick="closeHelpPopup()" class="btn btn-sm btn-outline-primary">Got it!</button>
            </div>
        </div>

        <?php include $prefix . "footer.php"; ?>
    </div>

    <!-- JavaScript Files -->
    <!-- Zahra Alsuwiki -->
    <script src="<?= $prefix ?>js/jquery.min.js"></script>
    <script src="<?= $prefix ?>js/bootstrap.bundle.min.js"></script>
    <script src="<?= $prefix ?>js/main.js"></script>

    <script>
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
                if (currentValue > 1) quantityInput.value = currentValue - 1;
            });

            const addToCartButton = document.querySelector('.btn-add-to-cart');
            addToCartButton.addEventListener('click', function () {
                <?php if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true): ?>
                    alert('Admins cannot add products to the cart.');
                <?php else: ?>
                    const quantity = parseInt(quantityInput.value);
                    const product = {
                        name: "<?= addslashes($row['name']) ?>",
                        price: <?= $row['price'] ?>,
                        quantity: quantity
                    };
                    let cart = JSON.parse(localStorage.getItem("cart")) || [];
                    cart.push(product);
                    localStorage.setItem("cart", JSON.stringify(cart));
                    $('#addedToCartModal').modal('show');
                <?php endif; ?>
            });
        });

        //ZAINAB ALBADI 
        function openHelpPopup() {
            document.getElementById("helpPopup").style.display = "flex";
        }

        function closeHelpPopup() {
            document.getElementById("helpPopup").style.display = "none";
        }
    </script>
</body>
</html>
