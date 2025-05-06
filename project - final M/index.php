<?php
// Define the path prefix (since index.php is in the root)
$prefix = "";

// Connect to the database
include $prefix . "db.php";

// Include shared header
include $prefix . "header.php";


?>
<!--dana :past purchase using cookies -->

<script>
setTimeout(() => {
  const alert = document.getElementById('past-order-msg');
  if (alert) alert.remove();
}, 10000); // 10 seconds
</script>


<!-- ZAINAB ALBADI -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <!-- SEO metadata -->
  <meta name="keywords" content="Glamour, Glamour home page, organic makeup, natural beauty, cruelty-free cosmetics, vegan makeup, eco-friendly beauty, organic foundation, clean beauty, non-toxic makeup">
  <meta name="description" content="Discover the beauty of organic makeup with Glamour. Shop high-quality, cruelty-free, and eco-friendly cosmetics made from natural ingredients. Embrace clean beauty today!">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Home | Glamour</title>

  <!-- Stylesheets -->
  <link rel="stylesheet" href="<?= $prefix ?>css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= $prefix ?>css/style.css">
</head>

<body>




  <!---------------------------dana :past purchase in table ------------------------->



<?php if (isset($_COOKIE['past_orders'])): 
    $orders = json_decode($_COOKIE['past_orders'], true);
?>
<div id="pastPurchasesBox" style="background-color:rgb(230, 171, 154); color:rgb(255, 255, 255); padding: 5px; margin: 20px auto; border: 1px solid:rgb(221, 149, 149); border-radius: 5px; width: 45%;">
    <h5 style="text-align: center; color:#ffff; ">🧾 Your Recent Orders</h5>
    <?php foreach ($orders as $order): ?>
        <div style="border: 1px solid #ffff; margin: 2px 0; border-radius: 5px; padding: 10px;">
            <strong>Order ID:</strong> <?= htmlspecialchars($order['id']) ?><br>
            <strong>Date:</strong> <?= htmlspecialchars($order['date']) ?><br>
            <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                <thead>
                    <tr style="background-color:rgb(195, 110, 110);">
                        <th style="padding: -3px; border: 1px solid #ffff; color:#ffff;">Product</th>
                        <th style="padding:-3px; border: 1px solid #ffff; color:#ffff;" >Quantity</th>
                        <th style="padding: -3px; border: 1px solid #ffff;color:#ffff;">Price (SAR)</th>
                        <th style="padding: -3px; border: 1px solid #ffff;color:#ffff;">Subtotal (SAR)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($order['items'] as $item): ?>
                        <tr>
                            <td style="padding: -3px; border: 1px solid #ffff;color:#ffff;"><?= htmlspecialchars($item['name']) ?></td>
                            <td style="padding:-3px; border: 1px solid #ffff;color:#ffff;"><?= intval($item['quantity']) ?></td>
                            <td style="padding: -3px; border: 1px solid #ffff;color:#ffff;"><?= number_format($item['price'], 2) ?></td>
                            <td style="padding:-3px; border: 1px solid #ffff;color:#ffff;"><?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div style="text-align: right; margin-top: 10px;">
                <strong>Total:</strong> SAR <?= number_format($order['total'], 2) ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Auto-hide pastprchase table after 10 seconds -->
<script>
    setTimeout(() => {
        const box = document.getElementById('pastPurchasesBox');
        if (box) box.style.display = 'none';
    }, 10000);
</script>
<?php endif; ?>










<div class="page-wrapper">

<main class="main">
  <!-- Banner or logo background -->
  <div class="web_name" style="background-image: url('<?= $prefix ?>images/logo2.jpg'); height: 200px;"></div>

  <!-- Product display section -->
  <section class="middle-section">
    <div class="container">
      <br>
      <h2>Our Products</h2>
      <p>Explore our premium organic makeup and skincare solutions.</p>

      <div class="page-content">
        <div class="container">
          <br>
          <div class="row">

          <?php
          // Query all products from the database
          $sql = "SELECT * FROM product";
          $result = $conn->query($sql);

          // Display products if found
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo '
              <div class="col-6 col-md-4 col-lg-4">
                <div class="product text-center">
                  <figure class="product-media">
                    <a href="' . $prefix . 'pages/product.php?id=' . $row["idProduct"] . '">
                      <img src="' . $prefix . 'images/' . $row["picture"] . '" alt="' . htmlspecialchars($row["name"]) . '" class="product-image">
                    </a>
                  </figure>
                  <div class="product-body">
                    <div class="product-cat">' . htmlspecialchars($row["categories"]) . '</div>
                    <h3 class="product-title">
                      <a href="' . $prefix . 'pages/product.php?id=' . $row["idProduct"] . '">' . htmlspecialchars($row["name"]) . '</a>
                    </h3>
                    <div class="product-price"><span class="new-price">SAR ' . number_format($row["price"], 2) . '</span></div>
                  </div>
                </div>
              </div>';
            }
          } else {
            echo "<p class='text-center w-100'>No products found.</p>";
          }
          ?>

          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<!-- Include footer -->
<?php include $prefix . "footer.php"; ?>

</div>

<!-- Optional JavaScript -->
<script src="<?= $prefix ?>js/search.js"></script>
</body>
</html>