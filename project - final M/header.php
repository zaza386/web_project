<!-- header.php -->
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
