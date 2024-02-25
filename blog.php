<?php session_start(); ?>
<?php require_once('connection.php'); ?>
<?php 
    if(isset($_GET['categorie'])){
      $categorieArticle = $_GET['categorie']; 
      $sqlQuery = "SELECT * FROM articles WHERE categorieArticle = :categorie ORDER BY `articles`.`idArticle` DESC ;";
      $articlesStatement = $db->prepare($sqlQuery);
      $articlesStatement->bindParam(':categorie', $categorieArticle, PDO::PARAM_STR);
      $articlesStatement->execute();
      $articles = $articlesStatement->fetchAll(PDO::FETCH_ASSOC);

    }else{
      $sqlQuery = 'SELECT * FROM articles ORDER BY `articles`.`idArticle` DESC';
      $articlesStatement = $db->prepare($sqlQuery);
      $articlesStatement->execute();
      $articles = $articlesStatement->fetchAll();
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KenzAtlas-Blog</title>
    <link rel="icon" href="assets/img/logo/LOGO_2.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body >

   <!--navbar debut-->
    
    <?php include('navbar.php'); ?>

    <!--navbar end-->

    <!--blog articles start-->
    <div class="container-fluid p-3 blog  ">
        <div  class="row blog__container">
          <div id="postsContainer" class="col-lg-8 col-md-12 col-12 blog__container__posts">
            <?php 
                foreach ($articles as $article) { 
            ?>
            <div class="row align-items-center m-2 mt-5 blog__container__posts__post">
              <div class="col-lg-5 col-md-6 col-12 blog__container__posts__post__imgContainer">
                <img src="assets/<?php echo($article['imgArticle']); ?>" class=" blog__container__posts__post__imgContainer__img" alt="">
              </div>
              <div class="col-lg-7 col-md-6 col-12 blog__container__posts__post__text">
                <span class="d-none blog__container__posts__post__text__idArticle"><?php echo($article['idArticle']); ?></span>
                <span class="d-none blog__container__posts__post__text__categorie"><?php echo($article['categorieArticle']); ?></span>
                <h2 class="fs-3 blog__container__posts__post__text__title m-2"><?php echo($article['titreArticle']); ?></h2>
                <p class="text-body fs-5 fw-light blog__container__posts__post__text__body m-2"><?php echo($article['contenuArticle']); ?></p>
                <p class="fw-lighter  fs-6 blog__container__posts__post__text__date m-2"><?php echo($article['dateArticle']); ?></p>
                <button class="btn btn-dark    text-secondary fw-bold m-2">En savoir plus</button>
              </div>
            </div>
            <?php }?>
            

          </div>
          <?php include('aside.php'); ?>
        </div>
    </div>
    <div class="container d-flex justify-content-center p-5">
      <nav aria-label="Page navigation example">
          <ul id="blogPagination" class="pagination pagination-lg  ">
          </ul>
      </nav>
  </div>
        


    <!-- footer start-->

   <!--footer start -->

   <?php include('footer.php'); ?>


<!-- footer end -->

    <script src="js/postsPagination.js"></script>
    <script src="js/explore.js"></script>
    <script src="js/scrollReveal.js"></script>
    <script src="js/cart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/searchBar.js"></script></body>
  </html>