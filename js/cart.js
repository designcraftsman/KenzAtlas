document.addEventListener('DOMContentLoaded', function () {
  
    // Retrieve cart count from localStorage
    const cartCount = localStorage.getItem('cartCount') || 0;
    const cartIcons = document.querySelectorAll('#cartIcon');
    // Update the cart icon with the retrieved count
    cartIcons.forEach(icon => {
        icon.textContent = cartCount;
      });
});



document.addEventListener('DOMContentLoaded', function () {

  // Retrieve cart information from localStorage
  const cartProducts = JSON.parse(localStorage.getItem('cartProducts')) || [];

  // Dynamically populate the cart container
  const cartContainer = document.querySelector('.cartProducts');
  const cartRecap = document.querySelector('.cartRecap');
  if (cartProducts.length === 0) {
    const emptyCartMessage = document.createElement('div');
    emptyCartMessage.classList.add('text-center', 'fs-4', 'fw-normal', 'text-muted', 'p-4');
    emptyCartMessage.textContent = 'Votre panier est vide';
    cartContainer.classList.add('col-lg-12');
    cartRecap.classList.add('d-none');
    cartContainer.appendChild(emptyCartMessage);
  } else {
    // If cart is not empty, populate the cart items
  cartProducts.forEach((product, index) => {
      // Create and append elements for each product in the cart
      const productElement = document.createElement('div');
      productElement.classList.add('row', 'mt-3', 'align-items-center', 'cartProducts__product');
      productElement.setAttribute('data-index', index); // Set a unique identifier
      productElement.innerHTML = `
          <span class="d-none">${product.id}</span>
          <div class="col-lg-1 col-2">
              <img src="${product.imgSrc}" class="w-100" alt="">
          </div>
          <div class="col-lg-3 col-2">${product.title}</div>
          <div class="col-4 "><span class="fs-5 fw-light">${product.totalCost} dh</span></div>
          <div class=" col-4 d-flex justify-content-between flex-wrap">
              <div class="wrapper">
                <span class="minus fs-6 p-2 fw-bolder">-</span>
                <input class="d-inline-block cartProductQuantity  fs-6 p-1 text-center fw-bolder productPage__product__quantity num" min="1" max="5"  value="${product.quantity}" type="number"></input>
                <span class="plus fs-6 p-2 fw-bolder">+</span>
              </div>
              <button class="btn btn-dark text-secondary mt-lg-0 mt-md-0 mt-3 delete-btn">Supprimer</button>
          </div>
      `;
        cartContainer.appendChild(productElement);
        });}
        const deleteButtons = document.querySelectorAll('.delete-btn');
      deleteButtons.forEach(button => {
          button.addEventListener('click', function () {
              const rowIndex = this.closest('.cartProducts__product').getAttribute('data-index');
              // Call a function to handle deletion based on the rowIndex
              handleDelete(rowIndex);
          });
       });

        updateTotalCost(cartProducts);

        function updateTotalCost(products) {
          const totalCost = products.reduce((sum, product) => sum + (product.quantity * product.price), 0);
          localStorage.setItem('cartTotalCost', totalCost.toString());
          var cartTotalCost = document.getElementById('cartTotalCost');
          cartTotalCost.textContent = totalCost.toString();
      }
        updateCartCount(cartProducts);
        function updateCartProductsCookie() {
          const orderRecapProducts = JSON.parse(localStorage.getItem('cartProducts')) || [];
          const jsonString = JSON.stringify(orderRecapProducts);
          document.cookie = "cartProducts=" + encodeURIComponent(jsonString) + "; path=/";
      }
      
      // Example: Modifying the array and updating the cookie
      updateCartProductsCookie();
        function updateCartCount(products) {
          const totalCount = products.reduce((sum, product) => sum + parseInt(product.quantity), 0);
          localStorage.setItem('cartCount', totalCount.toString());
        }


        const cartProductQuantityInputs = document.querySelectorAll('.cartProductQuantity');
        cartProductQuantityInputs.forEach( input =>{
            input.addEventListener('change',function(){
              const cartProductIndex = this.closest('.cartProducts__product').getAttribute('data-index');
              const cartProduct = cartProducts[cartProductIndex];
              // Update the cart product quantity
              cartProduct.quantity = this.value;
              // Update the cart total cost
              cartProduct.totalCost = cartProduct.quantity * cartProduct.price;
              localStorage.setItem('cartProducts', JSON.stringify(cartProducts));
              updateCartCount(cartProducts);
              // Update the display
              location.reload();
            }); 
        });
        // Loop through each plus button and attach an event listener
        // Select all elements with the class "plus" and "minus"
        const quantityInputs = document.querySelectorAll(".cartProductQuantity");
        const plusButtons = document.querySelectorAll(".plus");
        const minusButtons = document.querySelectorAll(".minus");

        plusButtons.forEach((plusButton, index) => {
          plusButton.addEventListener("click", () => {
              let currentValue = parseInt(cartProductQuantityInputs[index].value);
              if (currentValue < 5) { // Assuming the maximum quantity is 5
                  currentValue++;
                  cartProductQuantityInputs[index].value = currentValue;
                  updateProductQuantity(index, currentValue);
              }
          });
      });

        // Loop through each minus button and attach an event listener
        minusButtons.forEach((minusButton, index) => {
          minusButton.addEventListener("click", () => {
              let currentValue = parseInt(cartProductQuantityInputs[index].value);
              if (currentValue > 1) {
                  currentValue--;
                  cartProductQuantityInputs[index].value = currentValue;
                  updateProductQuantity(index, currentValue);
              }
          });
      });

        // Function to update the quantity of a product in the cartProducts array
        function updateProductQuantity(index, newValue) {
          const cartProducts = JSON.parse(localStorage.getItem('cartProducts')) || [];
          cartProducts[index].quantity = newValue;
          // Update the cart total cost based on the new quantity
          cartProducts[index].totalCost = cartProducts[index].quantity * cartProducts[index].price;
          localStorage.setItem('cartProducts', JSON.stringify(cartProducts));
          // Update the total cost displayed
          updateTotalCost(cartProducts);
          // Update the cart count based on the updated quantities
          updateCartCount(cartProducts);
          location.reload();
      }

      // Function to update the cart count based on product quantities
      function updateCartCount(products) {
        const totalCount = products.reduce((sum, product) => sum + parseInt(product.quantity), 0);
        localStorage.setItem('cartCount', totalCount.toString());
      }

        const cartConfirm = document.getElementById('cartConfirmBtn');

        cartConfirm.addEventListener('click', () => {
          window.location.href = 'checkout';
        });

        function handleDelete(rowIndex) {
          // Retrieve cart information from localStorage
          let cartProducts = JSON.parse(localStorage.getItem('cartProducts')) || [];
      
          // Remove the product at the specified index
          cartProducts.splice(rowIndex, 1);
      
          // Update the cart count
          updateCartCount(cartProducts);
      
          // Store the updated cart state back in localStorage
          localStorage.setItem('cartProducts', JSON.stringify(cartProducts));
      
          // Check if there are no more products in the cart
          if (cartProducts.length === 0) {
              // Clear cartCount and other relevant data
              localStorage.removeItem('cartCount');
              localStorage.removeItem('cartTotalCost');
          }
      
          // Refresh the page or update the display to reflect the changes
          location.reload();
      }
    });      



