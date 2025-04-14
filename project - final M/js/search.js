document.addEventListener('DOMContentLoaded', function () {
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
      const productLink = product.querySelector('.product-title a').getAttribute('href');
      const productIdMatch = productLink.match(/id=(\d+)/);
      const productId = productIdMatch ? productIdMatch[1] : '';

      if (
        title.includes(searchTerm) ||
        category.includes(searchTerm) ||
        productId.includes(searchTerm)
      ) {
        product.style.display = '';
        found = true;
      } else {
        product.style.display = 'none';
      }
    });

    noResults.style.display = found ? 'none' : 'block';
  });
});
