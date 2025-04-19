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
                <li><strong>Q:</strong> How do I log in? <br><strong>A:</strong> Click the login button and enter your info.</li>
                <li><strong>Q:</strong> How do I reset my password? <br><strong>A:</strong> Click "Forgot password" on the login page.</li>
                <li><strong>Q:</strong> How do I track my order? <br><strong>A:</strong> Check your email for tracking information or log in to your account.</li>
                <li><strong>Q:</strong> What payment methods do you accept? <br><strong>A:</strong> We accept all major credit cards and cash on delivery.</li>
              </ul>
            </section>
        
            <section>
              <h3>Contact Support</h3>
              <p>If you need help, email: <a href="mailto:support@glamour.com">support@glamour.com</a> or call us at +966 5 0000 0000</p>
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
