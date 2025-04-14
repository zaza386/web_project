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
              <li><a href="pages/about.html">About Us</a></li>
              <li><a href="pages/contact.html">Contact Us</a></li>
              <li><a href="pages/login.html"><i class="icon-user"></i>Login</a></li>
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
        <a href="index.php" class="logo">
          <img src="images/logo.png" alt="Glamour Logo" width="105" height="25">
        </a>
        <nav class="main-nav">
          <ul class="menu">
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="pages/contact.html">Contact Us</a></li>
            <li><a href="pages/help.html">Help</a></li>
          </ul>
        </nav>
      </div>

      <div class="header-right">
        <div class="header-search">
          <a href="#" id="searchIcon" class="search-toggle" role="button" title="Search"><i class="icon-search"></i></a>
          <form action="#" method="get" id="searchForm" style="display: inline;">
            <div class="header-search-wrapper" style="display: inline;">
              <label for="q" class="sr-only">Search</label>
              <input type="search" class="form-control" name="q" id="q" placeholder="Search in..." required style="width: 200px; display: inline;">
            </div>
          </form>
        </div>
        <div class="cart">
          <a href="pages/cart.html" role="button" title="View Cart"><i class="icon-shopping-cart"></i></a>
        </div>
      </div>
    </div>
  </div>
</header>

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

<footer class="footer">
  <div class="footer-middle">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-lg-3">
          <div class="widget widget-about">
            <img src="images/logo.png" class="footer-logo" alt="Footer Logo" width="105" height="25">
            <p>Glamour is a premium online store dedicated to organic makeup, offering a carefully selected range of high-quality, chemical-free beauty products.</p>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="widget widget-links">
            <h4>Quick Links</h4>
            <ul>
              <li><a href="pages/about.html">About Us</a></li>
              <li><a href="pages/contact.html">Contact Us</a></li>
              <li><a href="pages/help.html">Help</a></li>
              <li><a href="pages/login.html">Login</a></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="widget widget-social">
            <h4>Follow Us</h4>
            <div class="social-icons">
              <a href="https://www.facebook.com/profile.php?id=61574225245811" class="social-icon" title="Facebook"><i class="icon-facebook-f"></i></a>
              <a href="https://x.com/GlamourOrganicC" class="social-icon" title="Twitter"><i class="icon-twitter"></i></a>
              <a href="https://www.instagram.com/glamourorganiccosmeticco/" class="social-icon" title="Instagram"><i class="icon-instagram"></i></a>
              <a href="https://www.youtube.com/" class="social-icon" title="YouTube"><i class="icon-youtube"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>

</div>

<!-- Search Script -->
<script src="js/search.js"></script>
</body>
</html>
