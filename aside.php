<div class="col-lg-4 col-md-12 col-12   mt-5 blog__container__aside ">
            <div class=" col-12">
            <h2 class="fs-5 bg-primary p-2 rounded-4 text-secondary fw-light  blog__container__aside__title">Categories</h2>
              <a href="blog?categorie=corps" class="d-block text-decoration-none fs-6 p-2 blog__container__aside__link rounded ">Corps</a>
              <hr class="m-0 p-0 border-primary ms-2">
              <a href="blog?categorie=beauté" class="d-block text-decoration-none fs-6 p-2 blog__container__aside__link rounded">Beauté</a>
              <hr class="m-0 p-0 border-primary ms-2">
              <a href="blog?categorie=cheveux" class="d-block text-decoration-none fs-6 p-2 blog__container__aside__link rounded">Cheveux</a>
              <hr class="m-0 p-0 border-primary ms-2">
              <a href="blog?categorie=conseils" class="d-block text-decoration-none fs-6 p-2  blog__container__aside__link rounded">Conseils</a>
              <hr class="m-0 p-0 border-primary ms-2">
          </div>
          <div class="col-12">
            <h2 class="fs-5 bg-primary p-2 rounded-4 text-secondary mt-3  fw-light blog__container__aside__title">Articles Populaires</h2>
            <?php
              include('connection.php');
              $sqlQuery = 'SELECT * FROM `articles` ORDER BY `articles`.`vueArticle` DESC LIMIT 5';
              $articlesStatement = $db->prepare($sqlQuery);
              $articlesStatement->execute();
              $articles = $articlesStatement->fetchAll();
              foreach($articles as $article){
                ?>
                <a href="article?idArticle=<?php echo($article['idArticle']); ?>" class="text-decoration-none text-dark">
                <div class="row p-2 blog__container__aside__recentPosts align-content-center ">
                  <div class="col-4 blog__container__aside__recentPosts__img">
                    <img src="assets/<?php echo($article['imgArticle']) ?>" class="w-100 object-fit-cover " alt="">
                  </div>
                  <div class="col-8 blog__container__aside__recentPosts__text ">
                    <p class="fs-6 fw-lighter m-0"><?php echo($article['dateArticle']) ?></p>
                    <h2 class="fs-6 m-0 blog__container__aside__recentPosts__text__title"><?php echo($article['titreArticle']) ?></h2>
                  </div>
                </div>
                </a>
              <?php } ?>
            
          </div>
</div>