<?php
// Get the current file name to determine active menu item and where to show search
$currentFile = basename($_SERVER['SCRIPT_NAME']);
?>

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
              <li><a href="<?= $prefix ?>pages/about.php">About Us</a></li>
              <li><a href="<?= $prefix ?>pages/contact.php">Contact Us</a></li>
              <?php if ($currentFile === 'login.php'): ?>
                <li><a href="<?= $prefix ?>Index.php"><i class="icon-user"></i>Logout</a></li>
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

      <div class="header-right">
        <?php if ($currentFile === 'index.php' || $currentFile === 'manageProducts.php'): ?>
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
      </div>
    </div>
  </div>
</header>
