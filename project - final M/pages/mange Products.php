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

// Database connection
include $prefix . "db.php";

// Handle delete action
if (isset($_GET['delete_id'])) {
    $product_id = $_GET['delete_id'];
    
    // Prepare delete statement
    $stmt = $conn->prepare("DELETE FROM product WHERE idProduct = ?");
    $stmt->bind_param("i", $product_id);
    
    // Execute deletion
    if ($stmt->execute()) {
        $_SESSION['message'] = "Product deleted successfully";
    } else {
        $_SESSION['error'] = "Error deleting product: " . $conn->error;
    }
    
    $stmt->close();
    
    // Redirect using the current script name (solves space issue)
    header("Location: " . basename($_SERVER['PHP_SELF']));
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



<!-- ZAINAB ALBADI -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Products - Glamour</title>
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
            // Query all products from database
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






<!-- Budur Alqattan -->


<div class="container mt-5">
  <h4>Product Information (Admin View)</h4>
  <table class="table table-bordered table-striped">
    <thead class="thead-dark">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Categories</th>
        <th>Price (SAR)</th>
        <th>Quantity</th>
        <th>Description</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Re-open DB connection if closed above
      include_once $prefix . "db.php";

      $info_sql = "SELECT * FROM product";
      $info_result = $conn->query($info_sql);

      if ($info_result->num_rows > 0) {
        while ($prod = $info_result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>{$prod['idProduct']}</td>";
          echo "<td>{$prod['name']}</td>";
          echo "<td>{$prod['categories']}</td>";
          echo "<td>{$prod['price']}</td>";
          echo "<td>{$prod['quantity']}</td>";
          echo "<td>{$prod['description']}</td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='6' class='text-center'>No product data available.</td></tr>";
      }
      ?>
    </tbody>
  </table>
</div>


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
      
