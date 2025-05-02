<?php
// zainab albadi: Added the header for the page
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
// Handle logout action only on manage products page
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}

// Get the current file name to determine active menu item and where to show search
$currentFile = basename($_SERVER['SCRIPT_NAME']);
?>

<header class="header">
  <div class="header-top">
    <div class="container">
      <div class="header-left"></div>
      <div class="header-right">
        <ul class="top-menu">
        <script src="js/search.js" defer></script>
          <li><br>
            <a href="#">Links</a>
            <ul>
              <li><i class="icon-phone"></i>Call: +966 5 0000 0000</li>
              <li><a href="<?= $prefix ?>pages/about.php">About Us</a></li>
              <li><a href="<?= $prefix ?>pages/contact.php">Contact Us</a></li>
              <?php if (isset($show_logout) && $show_logout && isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true): ?>
                <li><a href="?action=logout"><i class="icon-user"></i>Logout</a></li>
              <?php elseif (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true): ?>
                <li><a href="<?= $prefix ?>pages/mange products.php"><i class="icon-user"></i>Manage</a></li>
              <?php else: ?>
                <li><a href="<?= $prefix ?>pages/login.php"><i class="icon-user"></i>Login</a></li>
              <?php endif; ?>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <div class="header-middle sticky-header">
    <div class="container">
      <div class="header-left">
        <!-- Mobile menu button -->
        <button class="mobile-menu-toggler">
          <span class="sr-only">Toggle mobile menu</span>
          <i class="icon-bars"></i>
        </button>

        <!-- Website logo -->
        <a href="<?= $prefix ?>Index.php" class="logo">
          <img src="<?= $prefix ?>images/logo.png" alt="Glamour Logo" width="105" height="25">
        </a>

        <!-- Main navigation menu -->
        <nav class="main-nav">
          <ul class="menu">
            <li class="<?= ($currentFile === 'index.php' || $currentFile === 'Index.php') ? 'active' : '' ?>">
              <a href="<?= $prefix ?>Index.php">Home</a>
            </li>
            <li class="<?= ($currentFile === 'contact.php') ? 'active' : '' ?>">
              <a href="<?= $prefix ?>pages/contact.php">Contact Us</a>
            </li>
            <li class="<?= ($currentFile === 'help.php') ? 'active' : '' ?>">
              <a href="<?= $prefix ?>pages/help.php">Help</a>
            </li>
          </ul>
        </nav>
      </div>
      <script src="js/search.js" defer></script>
      <div class="header-right">
      <?php if ($currentFile === 'Index.php' || $currentFile === 'index.php' || $currentFile === 'mange products.php'): ?>
        <!-- Search bar appears only in index.php and manageProducts.php -->
        <div class="header-search">
          <a href="#" id="searchIcon" class="search-toggle" role="button" title="Search"><i class="icon-search"></i></a>
          <form action="#" method="get" id="searchForm" style="display: inline;">
            <div class="header-search-wrapper" style="display: inline;">
              <label for="q" class="sr-only">Search</label>
              <input type="search" class="form-control" name="q" id="q" placeholder="Search in..." required style="width: 200px; display: inline;">
            </div>
          </form>
        </div>
      <?php endif; ?>
      <?php if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true): ?>
  <div class="cart">
    <a href="<?= $prefix ?>pages/cart.php" role="button" title="View Cart"><i class="icon-shopping-cart"></i></a>
  </div>
<?php endif; ?>
      </div>
    </div>
  </div>
</header>
