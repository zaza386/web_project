<?php
// Define the path prefix (since index.php is in the root)
$prefix = "";

// Connect to the database
include $prefix . "db.php";

// Include shared header
include $prefix . "header.php";
?>
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
  <title>Glamour</title>

  <!-- Stylesheets -->
  <link rel="stylesheet" href="<?= $prefix ?>css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= $prefix ?>css/style.css">
</head>

<body>
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
