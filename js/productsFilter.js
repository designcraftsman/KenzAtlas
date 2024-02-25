// Store product categories outside the event handler
const productCategories = document.querySelectorAll('.shop__container__products__list__product__details__categorie');
const productStates = document.querySelectorAll('.shop__container__products__list__product__details__etat');

function getCheckedOptions() {
  var checkboxes = document.querySelectorAll('.form-check-input');
  var checkedOptions = [];

  checkboxes.forEach(checkbox => {
    if (checkbox.checked) {
      checkedOptions.push(checkbox.value.trim().toLowerCase());
    }
  });

  // Iterate over products once
  var products = document.querySelectorAll('.shop__container__products__list__product');

  products.forEach((product, index) => {
    const productState = productStates[index].textContent.trim().toLowerCase();
    const productCategory = productCategories[index].textContent.trim().toLowerCase();

    // Check if either state or category is included in checked options or if no checkboxes are selected
    if (
      (checkedOptions.includes(productState) || checkedOptions.includes(productCategory) || checkedOptions.length === 0)
    ) {
      product.classList.remove('d-none');
    } else {
      product.classList.add('d-none');
    }
  });

  console.log('Checked options:', checkedOptions);
}


// Attach the event listener to checkboxes
document.querySelectorAll('.form-check-input').forEach(checkbox => {
  checkbox.addEventListener('change', getCheckedOptions);
});








