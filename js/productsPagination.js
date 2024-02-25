const itemsPerPage = 6;
let currentPage = 1;
let data = [];

// Get the sorting dropdown element
const sortingDropdown = document.querySelector('.shop__container__products__results__select');

// Attach an event listener to the sorting dropdown
sortingDropdown.addEventListener('change', () => {
  // Call displayData with the current data and sorting option
  displayData(data, sortingDropdown.value);
});
function extractAllProductData() {
  const productElements = document.querySelectorAll('.shop__container__products__list__product');
  return Array.from(productElements, extractProductData);
}

function extractProductData(productElement) {
  const title = productElement.querySelector('.shop__container__products__list__product__title').textContent;
  const id = productElement.querySelector('.shop__container__products__list__product__id').textContent;
  const price = parseFloat(productElement.querySelector('.shop__container__products__list__product__price').textContent);
  const category = productElement.querySelector('.shop__container__products__list__product__details__categorie').textContent;
  const state = productElement.querySelector('.shop__container__products__list__product__details__etat').textContent;
  const moyenneNotation = parseInt(productElement.querySelector('.shop__container__products__list__product__moyenneNotation').textContent);
  const image = productElement.querySelector('.shop__container__products__list__product__img').getAttribute('src');

  return { title, price, category, state, image, id , moyenneNotation};
}


function displayData(data, sortingOption) {
  const productsContainer = document.getElementById('productsContainer');
  const paginationContainer = document.getElementById('pagination');
  const startIndexText = document.getElementById('startIndex');
  const lastIndexText = document.getElementById('lastIndex');
  const totalItemsText = document.getElementById('totalProducts');

  // Apply sorting based on the selected option
  let sortedData = [...data];
  if (sortingOption === '2') {
    sortedData.sort((a, b) => a.price - b.price);
  } else if (sortingOption === '3') {
    sortedData.sort((a, b) => b.price - a.price);
  }

  const startIndex = (currentPage - 1) * itemsPerPage;
  const endIndex = Math.min(startIndex + itemsPerPage, sortedData.length);
  const totalItemsOnCurrentPage = endIndex - startIndex;

  startIndexText.textContent = startIndex + 1;
  lastIndexText.textContent = endIndex;
  totalItemsText.textContent = sortedData.length;

  const currentPageData = sortedData.slice(startIndex, endIndex);
  const currentPageHTML = currentPageData.map(product => {
    return `
      <div class="col-lg-5 col-md-6 col-10 m-auto product mt-4 shop__container__products__list__product">
        <div class="card border-0 m-auto w-100">
          <a href="product?idProduit=${product.id}" class="text-decoration-none text-dark">
            <div class="ProductsImageContainers">
              <img src="${product.image}" class="img-fluid card-img-top ProductsImages shop__container__products__list__product__img object-fit-cover" alt="...">
              <button class="btn btn-primary   rounded-0 btn-lg fw-light text-secondary ProductsImagesBtnsShop">DECOUVRIR</button>
            </div>
            <div class="card-body">
              <div class="d-none shop__container__products__list__product__details">
                <span class="shop__container__products__list__product__details__categorie">${product.category}</span>
                <span class="shop__container__products__list__product__details__etat">${product.state}</span>
              </div>
              <p class="card-text text-center m-1 fw-bolder"><span class="shop__container__products__list__product__price">${product.price.toFixed(2)}</span>dh</p>
              <p class="card-text text-center m-1 shop__container__products__list__product__title title">${product.title}</p>
              <p class="card-text text-center m-1">
                ${Array.from({ length: product.moyenneNotation }, (_, index) => `<i class="fa-solid fa-star fa-xs text-primary m-1"></i>`).join('')}
              </p>
            </div>
          </a>
        </div>
      </div>
    `;
  }).join('');

  productsContainer.innerHTML = currentPageHTML;

  const totalPages = Math.ceil(sortedData.length / itemsPerPage);
  const paginationHTML = generatePaginationHTML(currentPage, totalPages);

  paginationContainer.innerHTML = paginationHTML;
  // Display or hide pagination based on the number of pages
  paginationContainer.style.display = totalPages > 1 ? 'flex' : 'none';
}

const paginationLinks = document.querySelectorAll('.page-link');
paginationLinks.forEach(link => {
  link.addEventListener('click', handlePaginationClick);
});

function generatePaginationHTML(currentPage, totalPages) {
  const maxPagesToShow = 5;
  const paginationArray = [];

  if (totalPages <= maxPagesToShow) {
    for (let i = 1; i <= totalPages; i++) {
      paginationArray.push(i);
    }
  } else {
    const halfMax = Math.floor(maxPagesToShow / 2);
    const startPage = Math.max(1, currentPage - halfMax);
    const endPage = Math.min(totalPages, startPage + maxPagesToShow - 1);

    if (startPage > 1) {
      paginationArray.push(1);
      if (startPage > 2) {
        paginationArray.push('...');
      }
    }

    for (let i = startPage; i <= endPage; i++) {
      paginationArray.push(i);
    }

    if (endPage < totalPages) {
      if (endPage < totalPages - 1) {
        paginationArray.push('...');
      }
      paginationArray.push(totalPages);
    }
  }

  return `
  <li class="page-item"><a class="page-link" href="#" onclick="changePage(${currentPage - 1})"> << </a></li>
  ${paginationArray.map(page => `
    <li class="page-item ${page === currentPage ? 'active' : ''}">
      <a class="page-link" href="#" onclick="handlePaginationClick(event, ${page})">${typeof page === 'number' ? page : '...'}</a>
    </li>
  `).join('')}
  <li class="page-item"><a class="page-link" href="#" onclick="changePage(${currentPage + 1})"> >> </a></li>
`;
}


function changePage(pageNumber) {
  const totalPages = Math.ceil(data.length / itemsPerPage);

  if (pageNumber < 1 || pageNumber > totalPages || pageNumber === currentPage) {
    return;
  }

  currentPage = pageNumber;
  displayData(data, sortingDropdown.value);
}

function handlePaginationClick(event, pageNumber) {
  event.preventDefault();
  changePage(pageNumber);
} 

data = extractAllProductData();
displayData(data, sortingDropdown.value);
