<?php $prefix = "../"; ?>
<?php include $prefix . "header.php"; ?>

<!-- show duplicate error message :budur algahtani-->
<?php if (isset($_GET['error']) && $_GET['error'] == 'duplicate'): ?>
  <div style="background-color: #f8d7da; color: #721c24; padding: 15px; margin-bottom: 15px; border: 1px solid #f5c6cb; border-radius: 5px; text-align: center;">
    Product with this ID or Name already exists!
  </div>
<?php endif; ?>

<!DOCTYPE html>
<html>
<head> <!--jory alqahtani -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Add product | Glamour</title>
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

<main class="main">
  <section class="middle-section">
    <div class="container">
      <br> 
      <form id="productForm" action="insert_product.php" method="post" enctype="multipart/form-data">
  

        <div class="form-group">
          <label for="productId">Product ID:</label>
          <input type="text" id="productId" name="productId" required autocomplete="on" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
        </div>

        <div class="form-group">
          <label for="productName">Product Name:</label>
          <input type="text" id="productName" name="productName" required autocomplete="on">
        </div>

        <div class="form-group">
          <label for="productPrice">Price:</label>
          <input type="number" id="productPrice" name="productPrice" required min="0" step="0.01" autocomplete="on">
        </div>

        <div class="form-group">
          <label for="productQuantity">Quantity:</label>
          <input type="number" id="productQuantity" name="productQuantity" min="0" step="1" required>
        </div>

        <div class="form-group">
          <label for="productImage">Product Image:</label>
          <input type="file" id="productImage" name="productImage" accept="image/*" class="btn btn-primary btn-round" required>
        </div>

        <div class="form-group">
          <label for="productCategory">Product Category:</label>
          <select id="productCategory" name="productCategory" required>
            <option value="" disabled selected>Select a category</option>
            <option value="face">Face</option>
            <option value="eyes">Eyes</option>
            <option value="lips">Lips</option>
          </select>
        </div>

        <div class="form-group">
          <label for="productDescription">Product description:</label>
          <textarea id="productDescription" name="productDescription" required autocomplete="on" rows="5"></textarea>
        </div>

        <div class="form-group">
          <label for="productDescription2">Product productDescription2:</label>
          <textarea id="productDescription2" name="productDescription2" autocomplete="on" rows="5"></textarea>
        </div>

        <div class="button-container">
        <button type="submit" name="submit" class="btn btn-primary btn-round">Add product</button>

          <button type="button" id="cancelButton" class="btn btn-danger btn-round">Cancel</button>
        </div>
      </form>
    </div>
  </section>
</main>

<?php include $prefix . "footer.php"; ?>

<!-- Script for cancel/reset -->
<script>
  document.getElementById('cancelButton').onclick = function () {
    document.getElementById('productForm').reset();
  };
</script>

<!-- Search Script -->
<script>
  const searchInput = document.getElementById('q');
  const products = document.querySelectorAll('.product');
  const searchIcon = document.getElementById('searchIcon');
  const noResults = document.createElement('p');

  noResults.textContent = 'No products found.';
  noResults.style.textAlign = 'center';
  noResults.style.marginTop = '20px';
  noResults.style.display = 'none';

  const row = document.querySelector('.row');
  if (row && !document.querySelector('.row .no-results')) {
    noResults.classList.add('no-results');
    row.appendChild(noResults);
  }

  searchIcon.addEventListener('click', function (event) {
    event.preventDefault();
    const searchTerm = searchInput.value.toLowerCase().trim();
    let found = false;

    products.forEach(product => {
      const title = product.querySelector('.product-title').textContent.toLowerCase();
      const category = product.querySelector('.product-cat').textContent.toLowerCase();

      if (title.includes(searchTerm) || category.includes(searchTerm)) {
        product.style.display = '';
        found = true;
      } else {
        product.style.display = 'none';
      }
    });

    noResults.style.display = found ? 'none' : 'block';
  });
</script>

</body>
</html>
