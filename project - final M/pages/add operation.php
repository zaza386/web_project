<?php $prefix = "../"; ?>
<?php include $prefix . "header.php"; ?>
<!DOCTYPE html>
<html>
<head> <!--jory alqahtani -->
  <meta charset="UTF-8">
  <meta name="keywords" content="Glamour, Glamour home page, organic makeup, natural beauty, cruelty-free cosmetics, vegan makeup, eco-friendly beauty, organic foundation, clean beauty, non-toxic makeup">
  <meta name="description" content="Discover the beauty of organic makeup with Glamour. Shop high-quality, cruelty-free, and eco-friendly cosmetics made from natural ingredients. Embrace clean beauty today!">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Add product</title>
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

<main class="main">
  <section class="middle-section">
    <div class="container">
      <br> 
      <form id="productForm" action="add_product.php" method="post" enctype="multipart/form-data">
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
          <input type="file" id="productImage" name="productImage" accept="image/*" required>
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
          <button type="submit">Add product</button>
          <button type="button" id="cancelButton">Cancel</button>
        </div>
      </form>
    </div>
  </section>
</main>

<?php include $prefix . "footer.php"; ?>

<!-- Script for cancel/reset -->
<script>
  const form = document.getElementById('productForm');
  form.onsubmit = function(e) {
    e.preventDefault();
    window.location.href = "mange Products.php";
  };
  document.getElementById('cancelButton').onclick = function () {
    form.reset();
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
