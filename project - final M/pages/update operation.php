<?php
$prefix = "../";
include $prefix . "header.php";
?>
<!--jory alqahtani-->
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
    .button-container button:hover {
      background-color: gray;
    }
  </style>
</head>
<body>
<div class="page-wrapper">

  <div class="container">
    <!-- Modify Product Form -->
    <header><h1>Modify Product</h1></header>

    <form id="productForm" action="manage_Products.php" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="updateChoice">What would you like to update?</label>
        <select id="updateChoice" name="updateChoice" required onchange="toggleInputType()">
          <option value="" disabled selected>Select an option</option>
          <option value="name">Product Name</option>
          <option value="price">Price</option>
          <option value="quantity">Quantity</option>
          <option value="image">Image</option>
          <option value="category">Category</option>
          <option value="description1">Product Description 1</option>
          <option value="description2">Product Description 2</option>
        </select>
      </div>

      <div class="form-group" id="categoryDiv" style="display: none;">
        <label for="category">Select Category:</label>
        <select id="category" name="category" required>
          <option value="" disabled selected>Select a category</option>
          <option value="lips">Lips</option>
          <option value="eyes">Eyes</option>
          <option value="face">Face</option>
        </select>
      </div>

      <div class="form-group" id="newValueDiv" style="display: none;">
        <label for="newValue">New Value:</label>
        <input type="text" id="newValue" name="newValue" required>
      </div>

      <div class="form-group" id="description1Div" style="display: none;">
        <label for="description1">Product Description 1:</label>
        <textarea id="description1" name="description1" required rows="4" cols="50"></textarea>
      </div>

      <div class="form-group" id="description2Div" style="display: none;">
        <label for="description2">Product Description 2:</label>
        <textarea id="description2" name="description2" required rows="4" cols="50"></textarea>
      </div>

      <div id="imageUploadDiv" class="form-group" style="display: none;">
        <label for="productImage">Upload New Image:</label>
        <input type="file" id="productImage" name="productImage" required accept="image/*">
      </div>

      <div class="button-container">
        <button type="submit">Modify product</button>
        <button type="button" id="cancelButton">Cancel</button>
      </div>
    </form>
  </div>

  <!-- JavaScript to toggle input fields based on selection -->
  <script>
    function toggleInputType() {
      const updateChoice = document.getElementById('updateChoice').value;
      const newValueDiv = document.getElementById('newValueDiv');
      const newValueInput = document.getElementById('newValue');
      const imageUploadDiv = document.getElementById('imageUploadDiv');
      const categoryDiv = document.getElementById('categoryDiv');
      const description1Div = document.getElementById('description1Div');
      const description2Div = document.getElementById('description2Div');

      newValueInput.value = '';
      newValueDiv.style.display = 'none';
      imageUploadDiv.style.display = 'none';
      categoryDiv.style.display = 'none';
      description1Div.style.display = 'none';
      description2Div.style.display = 'none';

      if (updateChoice === 'price') {
        newValueDiv.style.display = 'block';
        newValueInput.type = 'text';
        newValueInput.oninput = function () {
          this.value = this.value.replace(/[^0-9.]/g, '');
        };
      } else if (updateChoice === 'quantity') {
        newValueDiv.style.display = 'block';
        newValueInput.type = 'text';
        newValueInput.oninput = function () {
          this.value = this.value.replace(/[^0-9]/g, '');
        };
      } else if (updateChoice === 'name') {
        newValueDiv.style.display = 'block';
        newValueInput.type = 'text';
        newValueInput.oninput = null;
      } else if (updateChoice === 'image') {
        imageUploadDiv.style.display = 'block';
      } else if (updateChoice === 'category') {
        categoryDiv.style.display = 'block';
      } else if (updateChoice === 'description1') {
        description1Div.style.display = 'block';
      } else if (updateChoice === 'description2') {
        description2Div.style.display = 'block';
      } else {
        newValueDiv.style.display = 'block';
      }
    }

    const form = document.getElementById('productForm');
    form.onsubmit = function (e) {
      e.preventDefault();

      const updateChoice = document.getElementById('updateChoice').value;

      if (updateChoice === 'image') {
        const productImage = document.getElementById('productImage');
        if (!productImage.files.length) {
          alert('Please upload an image.');
          return;
        }
      }

      // Simulate redirection after update
      window.location.href = "manage Products.html";
    };

    document.getElementById('cancelButton').onclick = function () {
      form.reset();
      toggleInputType();
    };
  </script>

<?php include $prefix . "footer.php"; ?>
</div>
</body>
</html>
