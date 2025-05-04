<?php
$prefix = "../";
session_start();
include $prefix . "db.php";
include $prefix . "header.php";

// Validate and fetch product ID safely
$product_id = isset($_GET['id']) ? $_GET['id'] : null;

if (!filter_var($product_id, FILTER_VALIDATE_INT)) {
    echo "<div class='container'><h2 class='text-center my-5'>Invalid product ID.</h2></div>";
    include $prefix . "footer.php";
    exit;
}

// Use prepared statement to avoid SQL injection
$stmt = $conn->prepare("SELECT * FROM product WHERE idProduct = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();

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


<!-- RAGHAD BAHAWI: desgin-->

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

         
<!-- raghadbahawi : limit the quantity to max in database-->
<div class="product-quantity">
  <label for="product-quantity"><strong>Qty:</strong></label>
  <div class="input_group">
    <button type="button" class="btn btn_decrement btn-spinner" onclick="changeQty(-1)">-</button>
    <input 
      type="text" 
      id="product_quantity" 
      name="quantity" 
      class="form-control" 
      value="1" 
      min="1" 
      max="<?= $row['stock'] ?>" 
      required>

<!-- raghad : buttons diapper when it not availabele -->

<?php if ($row['stock'] == 0): ?>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelector(".btn-add-to-cart").disabled = true;
            document.querySelector(".btn-checkout").disabled = true;
        });
    </script>
<?php endif; ?>

    <button type="button" class="btn btn_increment btn-spinner" onclick="changeQty(1)">+</button>


  </div>
    <!-- raghadbahawi : show the stock quantity for each product -->
  <?php if ($row['stock'] == 0): ?>
    <p style="margin-top: 8px; color: red; font-size: 16px; font-weight: bold;">
        Sold Out
    </p>
<?php else: ?>
    <p style="margin-top: 8px; color: #777; font-size: 14px;">
        Available: <?= $row['stock'] ?> in stock
    </p>
<?php endif; ?>

</div>


                    <div class="product-buttons">
                        <?php if ($row['stock'] == 0): ?>
                            <button class="btn btn-primary btn-add-to-cart" disabled>Sold Out</button>
                        <?php else: ?>
                            <button class="btn btn-primary btn-add-to-cart">Add to Cart</button>
                        <?php endif; ?>
                        <a href="#" id="btn-checkout" class="btn btn-secondary btn-checkout">Checkout</a>
                        <input type="hidden" id="product_id" value="<?= $row['idProduct'] ?>">

                        <button class="help-button" onclick="openHelpPopup()">?</button>
                    </div>
                </div>
            </div>


            <!-- Product Tabs -->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#description">Description</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#shipping-returns">Shipping & Returns</a>
                </li>
            </ul>

            <div class="tab-content">
                <div id="description" class="tab-pane fade show active">
                    <pre><?= htmlspecialchars($row['description2']) ?></pre>
                </div>
                <div id="shipping-returns" class="tab-pane fade">
                    <pre><strong>📦 Shipping Policy:</strong> 
                    Free standard shipping on orders over SAR 300 within Saudi Arabia.
                    Orders are processed within 1-2 business days, delivered within 3-5 in major cities.
                    Express delivery available within 1-2 days (extra charge). COD available for SAR 10.

<strong>🔄 Return Policy:</strong>
                    Return unused/unopened items within 14 days for full refund or exchange.
                    Used items are not returnable. Damaged/incorrect orders replaced for free within 48h notice.
                    </pre>
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




    <!--important for the popup to show after click-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>



    <!-- jory : add to cart quantity -->

    <script>
document.addEventListener("DOMContentLoaded", function () {
    const quantityInput = document.getElementById("product_quantity");
    const addToCartBtn = document.querySelector(".btn-add-to-cart");
    const checkoutBtn = document.getElementById("btn-checkout");

    function sendToCart(redirect = false) {
        const quantity = parseInt(quantityInput.value);

        //  Frontend validation before sending
        const max = parseInt(quantityInput.max);

if (max === 0) {
    alert("This product is currently out of stock.");
    return;
}

if (isNaN(quantity) || quantity < 1) {
    alert("Please select a valid quantity.");
    return;
}


        const xhr = new XMLHttpRequest();
        xhr.open("POST", "../pages/add_to_cart.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onload = function () {
            try {
                const res = JSON.parse(xhr.responseText);
                if (res.success) {
                    if (redirect) {
                        window.location.href = "cart.php";
                    } else {
                        const modal = new bootstrap.Modal(document.getElementById("addedToCartModal"));
                        modal.show();
                    }
                } else {
                    alert(res.message);
                }
            } catch (error) {
                alert("Something went wrong while processing your request.");
            }
        };

        xhr.send("product_id=<?= $row['idProduct'] ?>&quantity=" + quantity);
    }

    addToCartBtn.addEventListener("click", function () {
        sendToCart(false);
    });

    checkoutBtn.addEventListener("click", function (e) {
        e.preventDefault();
        sendToCart(true);
    });
});
</script>


<!-- jory : limit  quantity-->

<script>
function changeQty(change) {
    const input = document.getElementById('product_quantity');
    const max = parseInt(input.max);
    const min = parseInt(input.min);
    let value = parseInt(input.value) || min;

    value += change;

    if (value < min) value = min;
    if (value > max) value = max;

    input.value = value;
}

    function openHelpPopup() {
        document.getElementById("helpPopup").style.display = "flex";
    }

    function closeHelpPopup() {
        document.getElementById("helpPopup").style.display = "none";
    }



  

</script>

</body>
</html>