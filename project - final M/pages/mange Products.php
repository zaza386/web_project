<?php
// Since this file is in the "pages" folder, we go one level up for assets
$prefix = "../";

// Include the shared header with dynamic menu highlighting
include $prefix . "header.php";
?>
<!-- ZAINAB ALBADI -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="keywords" content="Glamour, manage products, admin panel">
  <meta name="description" content="Admin panel to manage Glamour products.">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Manage Products - Glamour</title>

  <!-- Stylesheets -->
  <link rel="stylesheet" href="<?= $prefix ?>css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= $prefix ?>css/style.css">
</head>
<body>
<div class="page-wrapper">

<main class="main">
  <section class="middle-section">
    <div class="container">
      <br>
      <h2>Manage The Products</h2>

      <!-- Button to add a new product -->
      <a href="add operation.php" class="btn btn-primary btn-round" style="float: right; margin-top: -40px;">Add Product</a>

      <p>Here you can modify, add, or delete products from your store.</p>

      <div class="page-content">
        <div class="container">
          <br>
          <div class="row">

            <!-- Product 1 -->
            <div class="col-6 col-md-4 col-lg-4">
              <div class="product text-center">
                <figure class="product-media">
                  <a href="product.php"><img src="<?= $prefix ?>images/product-1.jpg" alt="Rosé Luxe Velvet Tint" class="product-image"></a>
                </figure>
                <div class="product-body">
                  <div class="product-cat">Face</div>
                  <h3 class="product-title"><a href="product.php">Rosé Luxe Velvet Tint</a></h3>
                  <div class="product-price"><span class="new-price">SAR 95</span></div>

                  <!-- Action buttons -->
                  <a style="margin: 10px;" href="update operation.php" class="btn btn-primary btn-round">Modify Product</a>
                  <a href="#" class="btn btn-primary btn-round">Delete Product</a>
                </div>
              </div>
            </div>

            <!-- Product 2 -->
            <div class="col-6 col-md-4 col-lg-4">
              <div class="product text-center">
                <figure class="product-media">
                  <a href="product.php"><img src="<?= $prefix ?>images/product-2.jpg" alt="Cheeks Highlighter" class="product-image"></a>
                </figure>
                <div class="product-body">
                  <div class="product-cat">Face</div>
                  <h3 class="product-title"><a href="product.php">Cheeks Highlighter</a></h3>
                  <div class="product-price"><span class="new-price">SAR 100</span></div>
                  <a style="margin: 10px;" href="update operation.php" class="btn btn-primary btn-round">Modify Product</a>
                  <a href="#" class="btn btn-primary btn-round">Delete Product</a>
                </div>
              </div>
            </div>

            <!-- Product 3 -->
            <div class="col-6 col-md-4 col-lg-4">
              <div class="product text-center">
                <figure class="product-media">
                  <a href="product.php"><img src="<?= $prefix ?>images/product-3.jpg" alt="Bronzer Stick" class="product-image"></a>
                </figure>
                <div class="product-body">
                  <div class="product-cat">Face</div>
                  <h3 class="product-title"><a href="product.php">Bronzer Stick</a></h3>
                  <div class="product-price"><span class="new-price">SAR 80</span></div>
                  <a style="margin: 10px;" href="update operation.php" class="btn btn-primary btn-round">Modify Product</a>
                  <a href="#" class="btn btn-primary btn-round">Delete Product</a>
                </div>
              </div>
            </div>

            <!-- More static products can be added here -->

          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<!-- Include footer -->
<?php include $prefix . "footer.php"; ?>

</div>

<!-- You can add JavaScript later to handle delete/modify functionality -->
</body>
</html>
