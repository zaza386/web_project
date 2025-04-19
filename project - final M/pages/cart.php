<?php $prefix = "../"; ?>
<?php include $prefix . "header.php"; ?>
<!--Zahra Hussain ALshwuki-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="Glamour cart page">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Glamour</title>
    <link rel="stylesheet" href="<?= $prefix ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $prefix ?>css/style.css">
    <link rel="stylesheet" href="<?= $prefix ?>css/cart.css">
</head>
<body>
<div class="page-wrapper">

    <div class="cart-container">
        <div class="product-area">
            <h2>Shopping Cart</h2>
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
                    <tbody id="cart-items">
                        <tr>
                            <td colspan="5" class="empty-cart">Your cart is currently empty.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="cart-buttons">
                <a href="#" id="empty-cart-button" class="btn btn-primary btn-round">EMPTY CART</a>
                <a href="#" id="update-cart-button" class="btn btn-primary btn-round">UPDATE CART</a>
            </div>
        </div>

        <div class="cart-total-area">
            <h2>Cart Total</h2>
            <p id="subtotal">Subtotal: SAR 0.00</p>
            <p>Shipping:</p>
            <label><input type="radio" name="shipping" value="free" data-shipping="0" checked> Free Shipping: SAR 0.00</label><br>
            <label><input type="radio" name="shipping" value="standard" data-shipping="10"> Standard: SAR 10.00</label><br>
            <label><input type="radio" name="shipping" value="express" data-shipping="20"> Express: SAR 20.00</label><br>
            <p id="total">Total: SAR 0.00</p>
            <div class="cart-buttons-total">
                <a href="#" class="btn btn-primary btn-round" data-toggle="modal">
                    <span>BUY</span><i class="icon-long-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Empty Cart Modal -->
    <div class="modal fade" id="emptyCartModal" tabindex="-1" role="dialog" aria-labelledby="emptyCartModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-center p-4">
          <div class="modal-body">
            <h2>🛒 Your Cart is Empty</h2>  
            <p>Please add products to your cart before proceeding to checkout.</p>
            <a href="<?= $prefix ?>Index.html" class="btn btn-primary btn-round">Continue Shopping</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Thank You Modal -->
    <div class="modal fade" id="thankYouModal" tabindex="-1" role="dialog" aria-labelledby="thankYouModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-center p-4">
          <div class="modal-body">
            <h2>🎉 Thank You!</h2>  
            <p>Your order has been placed successfully.</p>
            <a href="<?= $prefix ?>Index.html" class="btn btn-primary btn-round">Back to Home</a>
          </div>
        </div>
      </div>
    </div>

    <?php include $prefix . "footer.php"; ?>
</div>

<!-- Bootstrap JS (required for modal) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= $prefix ?>js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const cartItems = document.getElementById("cart-items");

        function loadCartItems() {
            const cart = JSON.parse(localStorage.getItem("cart")) || [];
            cartItems.innerHTML = "";

            if (cart.length === 0) {
                cartItems.innerHTML = '<tr><td colspan="5" class="empty-cart">Your cart is currently empty.</td></tr>';
                document.getElementById("subtotal").textContent = "Subtotal: SAR 0.00";
                document.getElementById("total").textContent = "Total: SAR 0.00";
                return;
            }

            let subtotal = 0;
            cart.forEach((item, index) => {
                const total = item.price * item.quantity;
                subtotal += total;

                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${item.name}</td>
                    <td>SAR ${item.price.toFixed(2)}</td>
                    <td><input type="number" min="1" value="${item.quantity}" class="quantity-input" data-index="${index}"></td>
                    <td>SAR ${total.toFixed(2)}</td>
                    <td><button class="btn-remove" data-index="${index}">Remove</button></td>
                `;
                cartItems.appendChild(row);
            });

            document.getElementById("subtotal").textContent = `Subtotal: SAR ${subtotal.toFixed(2)}`;
            document.getElementById("total").textContent = `Total: SAR ${subtotal.toFixed(2)}`;
        }

        loadCartItems();

        document.getElementById("empty-cart-button").addEventListener("click", function() {
            localStorage.removeItem("cart");
            loadCartItems();
        });

        document.getElementById("update-cart-button").addEventListener("click", function() {
            updateCartQuantities();
            loadCartItems();
        });

        cartItems.addEventListener("click", function(e) {
            if (e.target.classList.contains("btn-remove")) {
                const index = e.target.dataset.index;
                let cart = JSON.parse(localStorage.getItem("cart")) || [];
                cart.splice(index, 1);
                localStorage.setItem("cart", JSON.stringify(cart));
                loadCartItems();
            }
        });

        function updateCartQuantities() {
            const quantityInputs = document.querySelectorAll('.quantity-input');
            let cart = JSON.parse(localStorage.getItem("cart")) || [];

            quantityInputs.forEach(input => {
                const index = input.dataset.index;
                const newQuantity = parseInt(input.value);

                if (newQuantity >= 1 && cart[index]) {
                    cart[index].quantity = newQuantity;
                }
            });

            localStorage.setItem("cart", JSON.stringify(cart));
        }

        document.querySelectorAll('input[name="shipping"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const shippingCost = parseFloat(this.dataset.shipping);
                const subtotalText = document.getElementById("subtotal").textContent;
                const subtotal = parseFloat(subtotalText.replace(/[^0-9.]/g, ''));
                document.getElementById("total").textContent = `Total: SAR ${(subtotal + shippingCost).toFixed(2)}`;
            });
        });

        document.querySelector('.cart-buttons-total a').addEventListener('click', function(e) {
            e.preventDefault();
            updateCartQuantities();

            const cart = JSON.parse(localStorage.getItem("cart")) || [];
            if (cart.length === 0) {
                $('#emptyCartModal').modal('show');
            } else {
                localStorage.removeItem("cart");
                $('#thankYouModal').modal('show');
            }
        });
    });
</script>
</body>
</html>
