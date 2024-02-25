<?php session_start(); ?>
<?php
    include('connection.php');
    $id = $_GET['idProduit']; 
    $sqlQuery = "SELECT * FROM produit WHERE idProduit = :idProduit;";
    $produitStatement = $db->prepare($sqlQuery);
    $produitStatement->bindParam('idProduit', $id, PDO::PARAM_INT); 
    $produitStatement->execute();
    $produit = $produitStatement->fetch(PDO::FETCH_ASSOC);
    include('connection.php');
    $sqlQuery = 'SELECT * FROM `produit` ORDER BY `produit`.`moyenneNotation` DESC LIMIT 4';
    $produitsVedetteStatement = $db->prepare($sqlQuery);
    $produitsVedetteStatement->execute();
    $produitsVedette = $produitsVedetteStatement->fetchAll();
    include('connection.php');
    $sqlQuery = 'SELECT * FROM avis where idProduit = :idProduit ORDER BY `avis`.`dateAvis` DESC';
    $avisStatement = $db->prepare($sqlQuery);
    $avisStatement->bindParam(':idProduit', $id, PDO::PARAM_STR);
    $avisStatement->execute();
    $avisGroupe = $avisStatement->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo($produit['nomProduit']) ?></title>
    <link rel="icon" href="assets/img/logo/LOGO_2.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body >
   <!--navbar debut-->
    
   <?php include('navbar.php'); ?>

<!--navbar end-->
    <!-- product section start-->

    <div class="container productPage ">
        <div class="row p-3 productPage__container align-items-center ">
            <div class="col-lg-5 col-12 m-auto productPage__container__imgContainer position-relative ">
              <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active productPage__container__imgContainer__img h-100">
                    <img src="assets/<?php
                    if($produit['etatProduit']=="pack promo"){
                     echo($produit['imageProduit2']);}else{
                      echo($produit['imageProduit1']);
                     } 
                     ?>" class="object-fit-contain productPage__product__img d-block w-100 productPage__container__imgContainer__img__select " alt="...">
                  </div>
                  <?php if(!isset($produit['imageProduit2']) || !isset($produit['imageProduit3'])) { ?>
                  <div class="carousel-item productPage__container__imgContainer__img h-100">
                    <img src="<?php echo($produit['imageProduit2']) ?>" class="object-fit-contain d-block w-100 productPage__container__imgContainer__img__select " alt="...">
                  </div>
                  <div class="carousel-item productPage__container__imgContainer__img h-100">
                    <img src="<?php echo($produit['imageProduit3']) ?>" class="object-fit-contain d-block w-100 productPage__container__imgContainer__img__select " alt="...">
                  </div>
                  <?php } ?>
                </div>
                <?php if(!isset($produit['imageProduit2']) || !isset($produit['imageProduit3'])){ ?>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                  <span  aria-hidden="true"><i class="fa-solid fa-chevron-left fa-2xl productPage__container__imgContainer__chevrons " ></i></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next " type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                  <span  aria-hidden="true"><i class="fa-solid fa-chevron-right fa-2xl productPage__container__imgContainer__chevrons" ></i></span>
                  <span class="visually-hidden">Next</span>
                </button>
                <?php } ?>
              </div>   
            </div>
            <div class="col-lg-5 col-12  productPage__product mt-5">
                <h1 class="fw-normal fs-2 productPage__product__title"><?php echo($produit['nomProduit']) ?></h1>
                <p class="fw-lighter  fs-3 "><span class="productPage__product__price"><?php echo($produit['prixProduit']) ?></span>dh</p>
                <span class="d-none productPage__product__id"><?php echo($produit['idProduit']); ?></span>
                <p><span class="m-2 ms-0">
                  <?php for( $i=0 ; $i < $produit['moyenneNotation']; $i++){ ?>
                  <i class="fa-solid fa-star fa-xs text-primary m-1"></i>
                  <?php } ?>
                </span> | <span class="m-2"><?php echo(count($avisGroupe)); ?> avis </span></p>
                <p class="fw-lighter fs-5"><?php echo($produit['sousTitreProduit']); ?></p>
                <div class="d-flex justify-content-between align-items-center p-2 ">
                  <div>
                    <p class=" fs-6 d-inline ">Quantité : 
                      <div class="d-inline-block">
                        <div class="wrapper">
                          <span class="minus fs-6 p-2 fw-bolder">-</span>
                          <input class="d-inline-block   fs-6 p-1 text-center fw-bolder productPage__product__quantity num" min="1" max="5" value="1" type="number"></input>
                          <span class="plus fs-6 p-2 fw-bolder">+</span>
                        </div>
                      </div>
                    </p>
                  </div>
                  <a href="https://wa.me/+212684822768">
                    <i class="fa-brands fa-square-whatsapp  fa-2xl fs-1  " style="color: #43ce1c;"></i>
                  </a>
                </div>
                <button id="addProductToCart"type="button"class="btn btn-primary text-secondary w-100 btn-lg fw-bolder ">Ajouter au panier</button>
            </div>
        </div>
        <section class="mt-5" >
            <h2 class="fs-2 fw-bolder text-center p-2 reveal">Détails du Produit</h2>
            <p class=" fs-6 fw-light m-3 p-2 reveal"><?php echo($produit['descriptionProduit']); ?></p>
        </section>
        <section class="mt-5">
            <h2 class="fs-2 fw-bolder text-center m-3 reveal">Ingrédients</h2>
            <p class="fs-6 fw-light m-3 p-2 reveal"><?php echo($produit['ingredientsProduit']); ?></p>
        </section>


        <section class="mt-5">
            <h2 class="text-center fw-bolder m-3 reveal">Vous pourriez aussi aimer</h2>
            <div class="row d-flex justify-content-center align-content-center reveal  mt-5 ">
              <?php foreach($produitsVedette as $produitVedette){ ?>
              <div class="col-lg-3 col-md-6 col-10 mt-2 ">
                <div class="card border-0 m-auto w-100 ProductsCards" >
                  <a href="product?idProduit=<?php echo($produitVedette['idProduit']); ?>" class="text-decoration-none text-dark">
                  <div class="ProductsImageContainers">
                    <img src="assets/<?php
                    if($produitVedette['etatProduit']=="pack promo"){
                     echo($produitVedette['imageProduit2']);}else{
                      echo($produitVedette['imageProduit1']);
                     } 
                     ?>" class="img-fluid card-img-top ProductsImages" alt="...">
                    <button class="btn btn-primary   rounded-0 btn-lg fw-light text-secondary ProductsImagesBtns">DECOUVRIR</button>
                  </div>
                  <div class="card-body">
                    <div class=" d-none">
                      <span class="shop__container__products__list__product__details__categorie"><?php echo($produitVedette['categorieProduit']); ?></span>
                      <span class="shop__container__products__list__product__details__etat"><?php echo($produitVedette['etatProduit']); ?></span>
                    </div>
                    <p class="card-text text-center m-1 fw-bolder"><span class="shop__container__products__list__product__price"><?php echo($produitVedette['prixProduit']); ?></span>dh</p>
                    <p class="card-text text-center m-1"><?php echo($produitVedette['nomProduit']); ?></p>
                    <p class="card-text text-center m-1">
                        <?php for($i=0 ; $i < $produitVedette['moyenneNotation']; $i++){ ?>
                            <i class="fa-solid fa-star fa-xs text-primary m-1"></i>
                        <?php } ?>
                    </p>
                  </div>
                  </a>
                </div>
              </div>
              <?php } ?>
              </div>
        </section>


        <section class="mt-5 p-3 ">
            <h2 class="text-center fw-bolder m-3 reveal">Avis Clients</h2>
            <div class="comments">
            <h2 class="fs-5 fw-semibold reveal">Rédiger un avis :</h2>
            <form method="POST" class="reveal">
              <div class="star-widget mb-3 d-flex  align-items-center flex-wrap">
                  <span class="fs-6 fw-light">Noter le produit :</span>
                  <div class="stars-rating d-flex justify-content-end ">
                    <input type="radio" name="rate-5" id="rate-5" value="5">
                    <label for="rate-5" class="fas fa-star"></label>
                    <input type="radio" name="rate-4" id="rate-4" value="4">
                    <label for="rate-4" class="fas fa-star"></label>
                    <input type="radio" name="rate-3" id="rate-3" value="3">
                    <label for="rate-3" class="fas fa-star"></label>
                    <input type="radio" name="rate-2" id="rate-2" value="2">
                    <label for="rate-2" class="fas fa-star"></label>
                    <input type="radio" name="rate-1" id="rate-1" value="1">
                    <label for="rate-1" class="fas fa-star"></label>
                  </div>
              </div>
                  <div class="textarea mb-3">
                    <textarea cols="30" rows="4" name="avisUtulisateur" class="form-control p-2 fs-6" placeholder="Votre avis"></textarea>
                  </div>
                  <?php if (isset($_SESSION['idUtulisateur'])){ ?>
                  <button type="submit" class="btn btn-primary  text-secondary" >Publier un avis</button>
                  <?php }else{ ?>
                  <button type="button" data-bs-toggle="modal" data-bs-target="#login"  class="btn btn-primary  text-secondary" >Publier un avis</button>
                  <?php } ?>
            </form>
            <hr class="border-primary border-3">
            <?php
                if ((isset($_POST['rate-5']) || isset($_POST['rate-4']) || isset($_POST['rate-3']) || isset($_POST['rate-2']) || isset($_POST['rate-1'])) && isset($_POST['avisUtulisateur'])) {
                  try {
                      // Establish a database connection (replace with your actual database configuration)
                      include('connection.php');
                      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                      $avisUtulisateur = $_POST['avisUtulisateur'];
                      // Assuming you also want to handle user ratings
                      $rating = isset($_POST['rate-5']) ? 5 :
                                (isset($_POST['rate-4']) ? 4 :
                                (isset($_POST['rate-3']) ? 3 :
                                (isset($_POST['rate-2']) ? 2 :
                                (isset($_POST['rate-1']) ? 1 : 0))));
                      // Prepare the SQL query using placeholders
                      $sqlQuery = "INSERT INTO avis ( nomUtulisateur, prenomUtulisateur, idProduit, commentaireAvis, notation)Values ( :nomUtulisateur, :prenomUtulisateur ,:idProduit, :commentaireAvis, :notation)";
                      $insertData = $db->prepare($sqlQuery);
                      $insertData->execute([
                        'nomUtulisateur' => $_SESSION['nomUtulisateur'],
                        'prenomUtulisateur' => $_SESSION['prenomUtulisateur'],
                        'idProduit' => $id,
                        'commentaireAvis' => $avisUtulisateur,
                        'notation' => $rating,
                    ]);
                    } catch (PDOException $e) {
                      echo 'An error occurred: ' . $e->getMessage();
                  }
              }
              if(count($avisGroupe) <= 0){
                  ?> <p class="fs-5 mt-5 fw-lighter  text-center">Aucun avis</p>  <?php
              }else{
              foreach ($avisGroupe as $avis) {
            ?>
            <div class="comment mt-5 ">
                <h2 class="fs-5 fw-bold"><?php echo($avis['prenomUtulisateur']) ?><span class="m-2">
                  <?php for($i=0 ; $i < $avis['notation'] ; $i++  ){ ?>
                  <i class="fa-solid fa-star fa-xs text-primary m-1"></i>
                  <?php } ?>
                </span></h1>
                <p class="fs-6 fw-light"><?php echo($avis['commentaireAvis']); ?></p>
                <p class="fs-6 fw-lighter"><?php echo($avis['dateAvis']); ?></p>
                <hr class="border-primary border-3">
            </div>
            <?php }} ?>
            </div>
        </section>
    </div>



    <!-- product section end-->


 <!--footer start -->

 <?php include('footer.php'); ?>
  
  <!--footer end-->


  <script src="js/cart.js"></script>
  <script src="js/scrollReveal.js"></script>
  <script src="js/searchBar.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="js/addToCart.js"></script>
  </body>
  </html>
