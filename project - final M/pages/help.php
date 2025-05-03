<?php $prefix = "../"; ?>
<?php include $prefix . "header.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Meta tags for SEO and responsiveness -->
  <meta charset="UTF-8">
  <meta name="keywords" content="Glamour, Glamour home page, organic makeup, natural beauty, cruelty-free cosmetics, vegan makeup, eco-friendly beauty, organic foundation, clean beauty, non-toxic makeup">
  <meta name="description" content="Discover the beauty of organic makeup with Glamour. Shop high-quality, cruelty-free, and eco-friendly cosmetics made from natural ingredients. Embrace clean beauty today!">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Help | Glamour</title>

  <!-- CSS files -->
  <link rel="stylesheet" href="<?= $prefix ?>css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= $prefix ?>css/style.css">
  <link rel="stylesheet" href="<?= $prefix ?>css/help.css">
</head>
<body>
<div class="page-wrapper">

  <main class="main">
    <div class="web_name" style="background-image: url('<?= $prefix ?>images/logo2.jpg');"></div>
    <div class="page-content pb-3">
      <div class="container"> <!-- Start of the container -->
        <div class="row">
          <div class="col-lg-12">
            <h1 class="title">Help Center</h1>
            
            <section>
              <h3>How to Use the System</h3>
              <p>This system helps users shop and manage their tasks. You can select, add, and delete items easily.</p>
            </section>
        
            <section>
              <h3>Frequently Asked Questions (FAQ)</h3>
              <ul>
                <li><strong>Q:</strong> What are our products made of? <br><strong>A:</strong> Our products are made from natural and organic materials.</li>
                <li><strong>Q:</strong> Are our products trusted and safe? <br><strong>A:</strong> Yes, our products are trusted and safe for human use. Anyone can use them!</li>
                <li><strong>Q:</strong> What are our best products? <br><strong>A:</strong> Our customers love our blush and lipstick.</li>
                <li><strong>Q:</strong> When do I get free shipping? <br><strong>A:</strong> You get free shipping when your order total exceeds SAR 300.</li>
              </ul>
            </section>
        
            <section>
              <h3>Contact Support</h3>
              <p>If you need help, email: <a href="mailto:support@glamour.com">support@glamour.com</a> or call us at ‪+966 5 0000 0000‬</p>
            </section>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!--  Footer  -->
  <?php include $prefix . "footer.php"; ?>
</div>

<!-- JavaScript Files -->
<script src="<?= $prefix ?>js/jquery.min.js"></script>
<script src="<?= $prefix ?>js/bootstrap.bundle.min.js"></script>
<script src="<?= $prefix ?>js/main.js"></script>
</body>
</html>