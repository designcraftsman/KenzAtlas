

document.addEventListener('DOMContentLoaded', function () { 
        // Retrieve cart count from localStorage
        const cartCount = localStorage.getItem('cartCount') || 0;
        const cartIcons = document.querySelectorAll('#cartIcon');
        // Update the cart icon with the retrieved count
        cartIcons.forEach(icon => {
            icon.textContent = cartCount;
          });
        const orderRecapProducts = JSON.parse(localStorage.getItem('cartProducts')) || [];
        const orderRecap = document.querySelector('.orderRecapProducts');
        orderRecapProducts.forEach((product, index) => {
        // Create and append elements for each product in the cart
        const productElement = document.createElement('div');
        productElement.classList.add('row', 'mt-3', 'align-items-center', 'cartProducts__product');
        productElement.setAttribute('data-index', index); // Set a unique identifier
  
        productElement.innerHTML = `
        <div class="row mt-3">
        <div class="col-4">
            <img src="${product.imgSrc}"class="img-fluid " alt="">
        </div>
        <div class="col-8">
            <h3 class="fw-normal fs-6 m-2">${product.title}</h3>
            <p class="fs-6 fw-light m-2">X ${product.quantity}</p>
            <p class="fs-6 m-2 fw-bolder "><span >${product.totalCost}</span> dh</p>
        </div>
    </div>
        `;
        orderRecap.appendChild(productElement);
       });
      updateTotalCost(orderRecapProducts);
      function updateTotalCost(products){
        const totalCost = products.reduce((sum, product) => sum + parseInt(product.totalCost), 0);
        localStorage.setItem('cartTotalCost', totalCost.toString());
        var cartTotalCost = document.getElementById('totalCost');
        cartTotalCost.textContent=totalCost.toString();
      }
      function updateCartProductsCookie() {
        const orderRecapProducts = JSON.parse(localStorage.getItem('cartProducts')) || [];
        const jsonString = JSON.stringify(orderRecapProducts);
        document.cookie = "cartProducts=" + encodeURIComponent(jsonString) + "; path=/";
    }
    
    // Example: Modifying the array and updating the cookie
    updateCartProductsCookie();

});


const orderRecapProducts = JSON.parse(localStorage.getItem('cartProducts')) || [];

// Convert the array to a JSON string
const jsonString = JSON.stringify(orderRecapProducts);

// Set a cookie with the JSON string
document.cookie = "cartProducts=" + encodeURIComponent(jsonString) + "; path=/";


