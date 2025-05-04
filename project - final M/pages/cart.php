<?php
$prefix = "../";
session_start();
include $prefix . "db.php";
include $prefix . "header.php";

 //-----------------jory -------------

// Fetch current stock for each product
$stockData = [];
$result = mysqli_query($conn, "SELECT idProduct, stock FROM product");
while ($row = mysqli_fetch_assoc($result)) {
    $stockData[$row['idProduct']] = $row['stock'];
}

// Initialize cart session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$alertMessage = "";

// Remove a single item
if (isset($_POST['remove_item'])) {
    $removeIndex = intval($_POST['remove_item']);
    if (isset($_SESSION['cart'][$removeIndex])) {
        array_splice($_SESSION['cart'], $removeIndex, 1);
    }
}

// Update cart quantities
if (isset($_POST['update_cart'])) {
    foreach ($_POST['quantities'] as $index => $qty) {
        $qty = intval($qty);
        $product_id = $_SESSION['cart'][$index]['id'];
        $max = $stockData[$product_id];

        if ($qty <= $max) {
            $_SESSION['cart'][$index]['quantity'] = $qty;
        } else {
            $alertMessage = "You cannot exceed the available stock for one or more items.";
        }
    }
}

// Empty cart
if (isset($_POST['empty_cart'])) {
    $_SESSION['cart'] = [];
}
?>



<!--Zahra Hussain ALshwuki-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart | Glamour</title>
    <link rel="stylesheet" href="<?= $prefix ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $prefix ?>css/style.css">
    <link rel="stylesheet" href="<?= $prefix ?>css/cart.css">
</head>
<body>
<div class="page-wrapper">
    <div class="cart-container">
        <div class="product-area">
            <!-- jory alert quantity limit when type more than the limit -->
            <?php if (!empty($alertMessage)): ?>
                <div id="stock-alert" class="alert alert-danger" role="alert" style="margin-bottom: 15px;">
                    <?= $alertMessage ?>
                </div>
                <script>
                    setTimeout(() => {
                        const alertBox = document.getElementById("stock-alert");
                        if (alertBox) alertBox.remove();
                    }, 4000);
                </script>
            <?php endif; ?>

            <h2>Shopping Cart</h2>
            <form method="post">
                <div class="cart-table">
                    <table>
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>


                            <!-- update the total -->
                        <?php
                        $subtotal = 0;
                        if (empty($_SESSION['cart'])) {
                            echo '<tr><td colspan="5" class="empty-cart">Your cart is currently empty.</td></tr>';
                        } else {
                            foreach ($_SESSION['cart'] as $index => $item) {
                                $total = $item['price'] * $item['quantity'];
                                $subtotal += $total;
                                $max = $stockData[$item['id']];
                                //jory : quantity in cart not exceed the limit in the stock
                                echo "<tr>
                                <td>{$item['name']}</td>
                                <td>SAR " . number_format($item['price'], 2) . "</td>
                                <td>
                                
                                    <input type=\"number\" 
                                           name=\"quantities[$index]\" 
                                           min=\"1\" 
                                           max=\"$max\" 
                                           value=\"{$item['quantity']}\" 
                                           class=\"form-control quantity-input\" 
                                           oninput=\"this.setCustomValidity('')\" 
                                           oninvalid=\"this.setCustomValidity('')\" 
                                           data-max=\"$max\">
                                </td>
                                <td>SAR " . number_format($total, 2) . "</td>
                                <td>
                                    <button type='submit' name='remove_item' value='$index' class='btn-remove'>Remove</button>
                                </td>
                            </tr>";
                            
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <div class="cart-buttons">
                    <button type="submit" name="empty_cart" class="btn btn-primary btn-round">EMPTY CART</button>
                    <button type="submit" name="update_cart" class="btn btn-primary btn-round">UPDATE CART</button>
                </div>
            </form>
        </div>

<!-- change the total when select shipping -->
        <div class="cart-total-area">
            <h2>Cart Total</h2>
            <p>Subtotal: SAR <span id="subtotal" data-value="<?php echo $subtotal; ?>"><?php echo number_format($subtotal, 2); ?></span></p>
            <p>Shipping:</p>
            <label><input type="radio" name="shipping" value="0" checked> Free Shipping: SAR 0.00</label><br>
            <label><input type="radio" name="shipping" value="10"> Standard: SAR 10.00</label><br>
            <label><input type="radio" name="shipping" value="20"> Express: SAR 20.00</label><br>

            <?php
            $shipping = 0;
            if (isset($_POST['shipping'])) {
                $shipping = intval($_POST['shipping']);
            }
            if ($subtotal >= 300) {
                $shipping = 0;
            }
            $total = $subtotal + $shipping;
            ?>

<p>Total: SAR <span id="total"><?php echo number_format($subtotal, 2); ?></span></p>




<!-- raghadbahawi: but button-->
            <div class="cart-buttons-total">
            <button id="buyNowBtn" class="btn btn-primary btn-round" type="button">
        <span>BUY</span><i class="icon-long-arrow-right"></i>
    </button>
            </div>
        </div>
    </div>



<!-- Thank You Modal -->
<div class="modal fade" id="thankYouModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center p-4">
      <div class="modal-body">
        <h2>🎉 Thank You!</h2>
        <p>Your order has been placed successfully.</p>
        <a href="../Index.php" class="btn btn-primary btn-round">Back to Home</a>
      </div>
    </div>
  </div>
</div>

    <?php include $prefix . "footer.php"; ?>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= $prefix ?>js/bootstrap.bundle.min.js"></script>

        <!--shopping total -->
<script>
document.querySelectorAll('input[name="shipping"]').forEach(radio => {
    radio.addEventListener('change', updateTotal);
});

function updateTotal() {
    const subtotal = parseFloat(document.querySelector('#subtotal').dataset.value);
    const shipping = parseFloat(document.querySelector('input[name="shipping"]:checked').value);
    let total = subtotal;

    if (subtotal < 300) {
        total += shipping;
    }

    document.getElementById('total').innerText = `SAR ${total.toFixed(2)}`;
}
</script>
<script>
document.querySelector("form").addEventListener("submit", function (e) {
    document.querySelectorAll("input[type=number]").forEach(input => {
        input.setCustomValidity(""); // Clear any browser default message
    });
});
</script>


<!--jory : for alert exceed when user type it shows automuticlyy -->
<script>
document.querySelectorAll('.quantity-input').forEach(input => {
    input.addEventListener('input', function () {
        const max = parseInt(this.dataset.max);
        const value = parseInt(this.value);

        const existingAlert = document.getElementById('stock-alert');
        if (value > max) {
            if (!existingAlert) {
                const alert = document.createElement('div');
                alert.id = 'stock-alert';
                alert.className = 'alert alert-danger';
                alert.innerText = 'You cannot exceed the available stock for one or more items.';
                this.closest('table').before(alert);
                setTimeout(() => alert.remove(), 4000);
            }
        } else {
            if (existingAlert) existingAlert.remove();
        }
    });
});
</script>


<!-- raghad bahawi : thanks popup after click buy button -->
<script>
document.getElementById('buyNowBtn').addEventListener('click', function () {
    fetch('buy_ajax.php', {
        method: 'POST'
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            const modal = new bootstrap.Modal(document.getElementById("thankYouModal"));
            modal.show();
        } else {
            alert(data.message || 'Something went wrong');
        }
    });
});
</script>


</body>
</html>