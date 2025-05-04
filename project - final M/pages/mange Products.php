<!-- Added by Zahra alsuwiki -->
<?php
$show_logout = true; // Show logout link in the header
// Since this file is in the "pages" folder, we go one level up for assets
$prefix = "../";
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
  $_SESSION['login_error'] = "You must log in first.";
  header("Location: ../pages/login.php");
  exit;
}
// Include the shared header with dynamic menu highlighting
include $prefix . "header.php";

//zinab alrashed welcome massage
if (isset($_SESSION['admin_name'])) {
  $adminName = $_SESSION['admin_name'];
  echo "<div class='container' style='font-size: 2em; text-align: center;'><h2>Welcome, Admin <strong>$adminName</strong>!</h2></div>";
}

// Database connection
include $prefix . "db.php";

// Handle delete action : dana 
if (isset($_GET['delete_id'])) {
  $product_id = $_GET['delete_id'];

  $stmt = $conn->prepare("DELETE FROM product WHERE idProduct = ?");
  $stmt->bind_param("i", $product_id);

  if ($stmt->execute()) {
      // redirect with success flag
      header("Location: mange Products.php?deleted=1");
  } else {
      // redirect with error flag
      header("Location: mange Products.php?deleted=0");
  }

  $stmt->close();
  exit;
}


// Display success/error messages
if (isset($_SESSION['message'])) {
    echo '<div class="alert alert-success">'.$_SESSION['message'].'</div>';
    unset($_SESSION['message']);
}
if (isset($_SESSION['error'])) {
    echo '<div class="alert alert-danger">'.$_SESSION['error'].'</div>';
    unset($_SESSION['error']);
}
?>


<!-- massege success after click the add product :Budur Alqattan-->
<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <div  id="successMsg" style="background-color: #d4edda; color: #155724; padding: 15px; margin: 20px auto; border: 1px solid #c3e6cb; border-radius: 5px; width: 80%; text-align: center;">
         Product added successfully!
    </div>
    <!--disapeare after 5 second-->
    <script>
  setTimeout(function () {
    const msg = document.getElementById('successMsg');
    if (msg) {
      msg.style.display = 'none';
    }
  }, 5000); // 5000 milliseconds = 5 seconds
</script>
<?php endif; ?>



<!-- message success after update product :Dana-->
<?php if (isset($_GET['updated']) && $_GET['updated'] == 1): ?>
    <div id="successMsg" style="background-color: #d1ecf1; color: #155724; padding: 15px; margin: 20px auto; border: 1px solid #bee5eb; border-radius: 5px; width: 80%; text-align: center;">
         Product updated successfully!
    </div>
    <!--disapeare after 5 second-->
    <script>
      setTimeout(function () {
        const msg = document.getElementById('successMsg');
        if (msg) {
          msg.style.display = 'none';
        }
      }, 5000); // 5000 milliseconds = 5 seconds
    </script>
<?php endif; ?>

<!-- message success after delete product :Dana-->
<?php if (isset($_GET['deleted']) && $_GET['deleted'] == 1): ?>
  <div id="deleteMsg" style="background-color: #d1ecf1; color: #155724; padding: 15px; margin: 20px auto; border: 1px solid #bee5eb; border-radius: 5px; width: 80%; text-align: center;">
    Product deleted successfully!
  </div>
  <script>
    setTimeout(function () {
      const msg = document.getElementById('deleteMsg');
      if (msg) {
        msg.style.display = 'none';
      }
    }, 5000);
  </script>
<?php endif; ?>




<!-- ZAINAB ALBADI -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Products | Glamour</title>
  <link rel="stylesheet" href="<?= $prefix ?>css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= $prefix ?>css/style.css">
  <script>


    // Confirm before deleting
    function confirmDelete(productId) {
      if (confirm('Are you sure you want to delete this product?')) {
        // Use current page URL to handle spaces in filename
        window.location.href = window.location.pathname + '?delete_id=' + productId;
      }
    }
  </script>
  <!-- for search bar -->
  <script src="<?= $prefix ?>js/search.js" defer></script>

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


            <?php
            // Query all products from database (retrive) : Budur Alqattan-----------------
            $sql = "SELECT * FROM product";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo '
                <div class="col-6 col-md-4 col-lg-4">
                  <div class="product text-center">
                    <figure class="product-media">
                      <a href="product.php?id='.$row["idProduct"].'">
                        <img src="'.$prefix.'images/'.$row["picture"].'" alt="'.$row["name"].'" class="product-image">
                      </a>
                    </figure>
                    <div class="product-body">
                      <div class="product-cat">'.$row["categories"].'</div>
                      <h3 class="product-title"><a href="product.php?id='.$row["idProduct"].'">'.$row["name"].'</a></h3>
                      <div class="product-price"><span class="new-price">SAR '.$row["price"].'</span></div>
                      <a style="margin: 10px;" href="update operation.php?id='.$row["idProduct"].'" class="btn btn-primary btn-round">Modify</a>
                      <button onclick="confirmDelete('.$row["idProduct"].')" class="btn btn-danger btn-round">Delete</button>
                    </div>
                  </div>
                </div>';
              }
            } else {
              echo "<p class='text-center w-100'>No products found.</p>";
            }
            
            $conn->close();
            ?>

          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<?php include $prefix . "footer.php"; ?>

</div>
</body>
</html>
      
