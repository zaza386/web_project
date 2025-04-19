<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="keywords" content="Glamour, Glamour home page, organic makeup, natural beauty, cruelty-free cosmetics, vegan makeup, eco-friendly beauty, organic foundation, clean beauty, non-toxic makeup">
  <meta name="description" content="Discover the beauty of organic makeup with Glamour. Shop high-quality, cruelty-free, and eco-friendly cosmetics made from natural ingredients. Embrace clean beauty today!">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Glamour</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="page-wrapper">

<?php include 'header.php'; ?>

<main class="main">
  <div class="web_name" style="background-image: url('images/logo2.jpg');"></div>
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
            $sql = "SELECT * FROM product";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo '
                <div class="col-6 col-md-4 col-lg-4">
                  <div class="product text-center">
                    <figure class="product-media">
                      <a href="pages/product.php?id=' . $row["idProduct"] . '">
                        <img src="images/' . $row["picture"] . '" alt="' . htmlspecialchars($row["name"]) . '" class="product-image">
                      </a>
                    </figure>
                    <div class="product-body">
                      <div class="product-cat">' . htmlspecialchars($row["categories"]) . '</div>
                      <h3 class="product-title">
                        <a href="pages/product.php?id=' . $row["idProduct"] . '">' . htmlspecialchars($row["name"]) . '</a>
                      </h3>
                      <div class="product-price"><span class="new-price">SAR ' . number_format($row["price"], 2) . '</span></div>
                    </div>
                  </div>
                </div>';
              }
            } else {
              echo "<p class='text-center'>No products found.</p>";
            }
          ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>

</div>

<script src="js/search.js"></script>
</body>
</html>
