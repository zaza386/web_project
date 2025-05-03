<!--dana-->
<?php
$prefix = "../";
include $prefix . "db.php"; // moved up to use $conn early
include $prefix . "header.php";

$productData = null;
$selectedField = ""; // To store previously selected field

// Fetch product data for preloading
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM product WHERE idProduct = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $productData = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
}

//dana - update logic
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = intval($_POST["productId"]);
    $field = $_POST["updateChoice"];
    $selectedField = $field; // Save for re-selecting after submission failure

    switch ($field) {
        case "name":
        case "price":
        case "stock": // changed from "quantity" to "stock" based on DB column
            $value = mysqli_real_escape_string($conn, $_POST["newValue"]);
            $query = "UPDATE product SET $field = ? WHERE idProduct = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "si", $value, $id);
            break;

        case "category":
            $value = mysqli_real_escape_string($conn, $_POST["category"]);
            $query = "UPDATE product SET categories = ? WHERE idProduct = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "si", $value, $id);
            break;

        case "description1":
            $value = mysqli_real_escape_string($conn, $_POST["description1"]);
            $query = "UPDATE product SET description1 = ? WHERE idProduct = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "si", $value, $id);
            break;

        case "description2":
            $value = mysqli_real_escape_string($conn, $_POST["description2"]);
            $query = "UPDATE product SET description2 = ? WHERE idProduct = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "si", $value, $id);
            break;

        case "image":
            if (isset($_FILES["productImage"]) && $_FILES["productImage"]["error"] == 0) {
                $imageName = basename($_FILES["productImage"]["name"]);
                $targetPath = $prefix . "images/" . $imageName;
                move_uploaded_file($_FILES["productImage"]["tmp_name"], $targetPath);

                $query = "UPDATE product SET picture = ? WHERE idProduct = ?";
                $stmt = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($stmt, "si", $imageName, $id);
            }
            break;

        default:
            header("Location: mange Products.php?error=invalid");
            exit;
    }

    if (isset($stmt) && mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        $conn->close();
        header("Location: mange Products.php?updated=1"); // redirection with success flag
        exit;
    } else {
        echo "<script>alert('Update failed: " . mysqli_error($conn) . "');</script>";
    }
}
?>
<!--jory alqahtani - html -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="keywords" content="Glamour, Glamour home page, organic makeup, natural beauty, cruelty-free cosmetics, vegan makeup, eco-friendly beauty, organic foundation, clean beauty, non-toxic makeup">
  <meta name="description" content="Discover the beauty of organic makeup with Glamour. Shop high-quality, cruelty-free, and eco-friendly cosmetics made from natural ingredients. Embrace clean beauty today!">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Modify Product</title>
  <link rel="stylesheet" href="<?= $prefix ?>css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= $prefix ?>css/style.css">
  <link rel="stylesheet" href="<?= $prefix ?>css/Manage.css">
  <style>
    #productForm {
      max-width: 600px;
      margin: 0 auto;
    }

    #productForm .form-group {
      margin-bottom: 20px;
    }

    #productForm label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }

    #productForm input,
    #productForm select,
    #productForm textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
    }

    #productForm .button-container {
      display: flex;
      gap: 10px;
    }

    #productForm .button-container button {
      flex: 1;
      padding: 10px;
      font-size: 16px;
      border-radius: 5px;
    }
  </style>
</head>
<body>
<div class="page-wrapper">
  <div class="container">
    <!-- Modify Product Form -->
    <header><h1>Modify Product</h1></header>

    <form id="productForm" action="update operation.php<?= isset($_GET['id']) ? '?id=' . $_GET['id'] : '' ?>" method="POST" enctype="multipart/form-data">
    <!--dana-->
    <?php if (isset($_GET['id'])): ?>
      <input type="hidden" name="productId" value="<?= htmlspecialchars($_GET['id']) ?>">
    <?php endif; ?>

      <div class="form-group">
        <label for="updateChoice">What would you like to update?</label>
        <select id="updateChoice" name="updateChoice" required onchange="toggleInputType()">
          <option value="" disabled <?= $selectedField === '' ? 'selected' : '' ?>>Select an option</option>
          <option value="name" <?= $selectedField === 'name' ? 'selected' : '' ?>>Product Name</option>
          <option value="price" <?= $selectedField === 'price' ? 'selected' : '' ?>>Price</option>
          <option value="stock" <?= $selectedField === 'stock' ? 'selected' : '' ?>>Stock</option>
          <option value="image" <?= $selectedField === 'image' ? 'selected' : '' ?>>Image</option>
          <option value="category" <?= $selectedField === 'category' ? 'selected' : '' ?>>Category</option>
          <option value="description1" <?= $selectedField === 'description1' ? 'selected' : '' ?>>Product Description 1</option>
          <option value="description2" <?= $selectedField === 'description2' ? 'selected' : '' ?>>Product Description 2</option>
        </select>
      </div>

      <div class="form-group" id="categoryDiv" style="display: none;">
        <label for="category">Select Category:</label>
        <select id="category" name="category" required>
          <option value="" disabled>Select a category</option>
          <option value="lips">Lips</option>
          <option value="eyes">Eyes</option>
          <option value="face">Face</option>
        </select>
      </div>

      <div class="form-group" id="newValueDiv" style="display: none;">
        <label for="newValue">New Value:</label>
        <input type="text" id="newValue" name="newValue">
      </div>

      <div class="form-group" id="description1Div" style="display: none;">
        <label for="description1">Product Description 1:</label>
        <textarea id="description1" name="description1" rows="4" cols="50"></textarea>
      </div>

      <div class="form-group" id="description2Div" style="display: none;">
        <label for="description2">Product Description 2:</label>
        <textarea id="description2" name="description2" rows="4" cols="50"></textarea>
      </div>

      <div id="imageUploadDiv" class="form-group" style="display: none;">
        <label for="productImage">Upload New Image:</label>
        <input type="file" id="productImage" name="productImage" accept="image/*" class="btn btn-primary btn-round">
      </div>

      <div class="button-container">
        <button type="submit" class="btn btn-primary btn-round">Modify product</button>
        <button type="button" id="cancelButton" class="btn btn-danger btn-round">Cancel</button>
      </div>
    </form>
  </div>

  <!-- JavaScript to toggle input fields based on selection  -->
   <!-- dana -->
  <script>
    function toggleInputType() {
      const updateChoice = document.getElementById('updateChoice').value;
      const newValueDiv = document.getElementById('newValueDiv');
      const newValueInput = document.getElementById('newValue');
      const imageUploadDiv = document.getElementById('imageUploadDiv');
      const categoryDiv = document.getElementById('categoryDiv');
      const description1Div = document.getElementById('description1Div');
      const description2Div = document.getElementById('description2Div');

      newValueDiv.style.display = 'none';
      imageUploadDiv.style.display = 'none';
      categoryDiv.style.display = 'none';
      description1Div.style.display = 'none';
      description2Div.style.display = 'none';

      <?php if ($productData): ?>
        const product = <?= json_encode($productData); ?>;
        if (updateChoice === 'price' || updateChoice === 'stock' || updateChoice === 'name') {
          newValueDiv.style.display = 'block';
          newValueInput.value = product[updateChoice];
          if (updateChoice !== 'name') {
            newValueInput.oninput = function () {
              this.value = this.value.replace(/[^0-9.]/g, '');
            };
          } else {
            newValueInput.oninput = null;
          }
        } else if (updateChoice === 'image') {
          imageUploadDiv.style.display = 'block';
        } else if (updateChoice === 'category') {
          categoryDiv.style.display = 'block';
          document.getElementById('category').value = product['categories'];
        } else if (updateChoice === 'description1') {
          description1Div.style.display = 'block';
          document.getElementById('description1').value = product['description1'];
        } else if (updateChoice === 'description2') {
          description2Div.style.display = 'block';
          document.getElementById('description2').value = product['description2'];
        }
      <?php endif; ?>
    }

    document.getElementById('cancelButton').onclick = function () {
      document.getElementById('productForm').reset();
      toggleInputType();
    };

    document.addEventListener("DOMContentLoaded", toggleInputType);
  </script>

<?php include $prefix . "footer.php"; ?>
</div>
</body>
</html>
