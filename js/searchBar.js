

function filterProducts(event) {
    event.preventDefault();
    
    var searchInput = document.getElementById('searchInput');
    var searchTerm = searchInput.value.trim().toLowerCase();

    // Redirect to the target page with the search query as a parameter
    window.location.href = "shop?search=" + encodeURIComponent(searchTerm);
}






document.addEventListener('DOMContentLoaded', function () {

    const registerLoginBtns = document.querySelectorAll('registerLoginBtns');

    registerLoginBtns.forEach((btn)=>{
        btn.addEventListener(('click'),($event)=>{
            $event.preventDefault();
        });
    });
    // Retrieve the search query parameter from the URL
    var searchParams = new URLSearchParams(window.location.search);
    var searchTerm = searchParams.get('search');

    if (searchTerm) {
        var products = document.querySelectorAll('.shop__container__products__list__product');
        products.forEach(function (product) {
            const productName = product.querySelector('p.title').textContent;
            
            if (productName.toLowerCase().includes(searchTerm)) {
                product.classList.remove('hide');
            } else {
                product.classList.add('hide');
            }
        });
    }
});

// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
    'use strict'
  
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')
  
    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
      .forEach(function (form) {
        form.addEventListener('submit', function (event) {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }
  
          form.classList.add('was-validated')
        }, false)
      })
  })()


