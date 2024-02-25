const itemsPerPage = 4;
let currentPage = 1;
let data = [];

function extractPostData(productElement) {
  const title = productElement.querySelector('.blog__container__posts__post__text__title').textContent;
  const body = productElement.querySelector('.blog__container__posts__post__text__body').textContent;
  const date = productElement.querySelector('.blog__container__posts__post__text__date').textContent;
  const image = productElement.querySelector('.blog__container__posts__post__imgContainer__img').getAttribute('src');
  const categorie = productElement.querySelector('.blog__container__posts__post__text__categorie').textContent;
  const id = productElement.querySelector('.blog__container__posts__post__text__idArticle').textContent;

  return { title, body, date, image, categorie, id };
}

function extractAllPostsData() {
  const postElements = document.querySelectorAll('.blog__container__posts__post');
  return Array.from(postElements, extractPostData);
}

function displayData() {
  const productsContainer = document.getElementById('postsContainer');
  const paginationContainer = document.getElementById('blogPagination');


  if (data.length === 0) {
    // Display a message when there are no posts
    productsContainer.innerHTML = '<p>No posts available.</p>';
    paginationContainer.style.display = 'none';
    return;
  }

  const startIndex = (currentPage - 1) * itemsPerPage;
  const endIndex = startIndex + itemsPerPage;

  const currentPageData = data.slice(startIndex, endIndex);
  const currentPageHTML = currentPageData.map(post => {
    return `
    <a href="article?idArticle=${post.id}" class="text-decoration-none text-dark">
    <div class="row align-items-center m-2 mt-5 blog__container__posts__post">
        <div class="col-lg-5 col-md-6 col-12 blog__container__posts__post__imgContainer">
        <img src="${post.image}" class="w-100 object-fit-cover blog__container__posts__post__imgContainer__img" alt="">
        </div>
        <div class="col-lg-7 col-md-6 col-12 blog__container__posts__post__text">
        <h2 class="fs-3 blog__container__posts__post__text__title m-2">${post.title}</h2>
        <p class="text-body fs-5 fw-light blog__container__posts__post__text__body m-2">${post.body}</p>
        <p class="fw-lighter  fs-6 blog__container__posts__post__text__date m-2">${post.date}</p>
        <button class="btn  btn-primary text-secondary fw-light rounded-0 m-2">En savoir plus</button>
        </div>
    </div>
    </a>
    `;
  }).join('');

  productsContainer.innerHTML = currentPageHTML;

  const totalPages = Math.ceil(data.length / itemsPerPage);
  const paginationHTML = generatePaginationHTML(currentPage, totalPages);

  paginationContainer.innerHTML = paginationHTML;
  // Display or hide pagination based on the number of pages
  paginationContainer.style.display = totalPages > 1 ? 'flex' : 'none';
}

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
    <li class="page-item ${currentPage === page ? 'active' : ''}">
      <a class="page-link" href="#" onclick="changePage(${typeof page === 'number' ? page : currentPage})">${page}</a>
    </li>
  `).join('')}
  <li class="page-item"><a class="page-link" href="#" onclick="changePage(${currentPage + 1})"> >> </a></li>
`;
}


function changePage(pageNumber) {
  if (pageNumber < 1 || pageNumber > Math.ceil(data.length / itemsPerPage) || pageNumber === currentPage) {
    return;
  }
  currentPage = pageNumber;
  displayData();
}

data = extractAllPostsData();
displayData();