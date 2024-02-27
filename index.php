<?php session_start(); ?>
<?php     
          try{
              include('connection.php');
              $sqlQuery = 'SELECT * FROM `produit` ORDER BY `produit`.`moyenneNotation` DESC LIMIT 4';
              $produitsVedetteStatement = $db->prepare($sqlQuery);
              $produitsVedetteStatement->execute();
              $produitsVedette = $produitsVedetteStatement->fetchAll();
              include('connection.php');
              $sqlQuery = 'SELECT * FROM `articles` ORDER BY `articles`.`dateArticle` DESC LIMIT 3';
              $articlesStatement = $db->prepare($sqlQuery);
              $articlesStatement->execute();
              $articles = $articlesStatement->fetchAll();
              include('connection.php');
              $sqlQuery = 'SELECT * FROM `produit` WHERE etatproduit = "pack promo" ORDER BY `produit`.`idProduit` DESC LIMIT 3';
              $packsStatement = $db->prepare($sqlQuery);
              $packsStatement->execute();
              $packs = $packsStatement->fetchAll();
          }catch(error){
            header("Location: error");
          }
              ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kenzAtlas</title>
    <link rel="icon" href="assets/img/logo/LOGO_2.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body >

    <!--navbar debut-->
    
    <?php
    if (isset($_POST['nomUtulisateur']) && isset($_POST['prenomUtulisateur']) && isset($_POST['emailUtulisateur']) && isset($_POST['motdepasseUtulisateur'])) {
        try {
            // Establish a database connection (replace with your actual database configuration)
            include('connection.php');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $nomUtulisateur = $_POST['nomUtulisateur'];
            $prenomUtulisateur = $_POST['prenomUtulisateur'];
            $emailUtulisateur = $_POST['emailUtulisateur'];
            $motdepasseUtulisateur = $_POST['motdepasseUtulisateur'];
            $dateNaissanceUtulisateur = $_POST['dateNaissanceUtulisateur'];
            $hashedPassword = password_hash($motdepasseUtulisateur, PASSWORD_BCRYPT);
    
            // Prepare the SQL query using placeholders
            $sqlQuery = 'INSERT INTO utulisateur (nomUtulisateur ,prenomUtulisateur ,emailUtulisateur, motdepasseUtulisateur, dateNaissanceUtulisateur  ) VALUES (:nomUtulisateur,:prenomUtulisateur,:emailUtulisateur,:motdepasseUtulisateur, :dateNaissanceUtulisateur)';
            $insertData = $db->prepare($sqlQuery);
            $insertData->execute([
                'nomUtulisateur' => $nomUtulisateur,
                'prenomUtulisateur' => $prenomUtulisateur,
                'emailUtulisateur' => $emailUtulisateur,
                'motdepasseUtulisateur' => $hashedPassword,
                'dateNaissanceUtulisateur' => $dateNaissanceUtulisateur
            ]);
        } catch (PDOException $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }

?>

<?php           
                $loginError = false;
                if (isset($_POST['emailUtulisateur']) && isset($_POST['motdepasseUtulisateur'])) {
                    try {
                        // Establish a database connection (replace with your actual database configuration)
                        include('connection.php');
                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $emailUtulisateur = $_POST['emailUtulisateur'];
                        $motdepasseUtulisateur = $_POST['motdepasseUtulisateur'];
                        // Prepare the SQL query using placeholders
                        $sqlQuery = 'SELECT * from utulisateur WHERE emailUtulisateur = :email';
                        $stmt = $db->prepare($sqlQuery);
                        $stmt->execute([
                            'email' => $emailUtulisateur,
                        ]);

                        $user = $stmt->fetch(PDO::FETCH_ASSOC);

                        // Check if a user with the given email exists
                        if ($user) {
                            // Verify the hashed password
                            if (password_verify($motdepasseUtulisateur, $user['motdepasseUtulisateur'])) {
                                $_SESSION['idUtulisateur'] = $user['idUtulisateur'];	
                                $_SESSION['nomUtulisateur'] = $user['nomUtulisateur'];
                                $_SESSION['prenomUtulisateur'] = $user['prenomUtulisateur'];
                                $_SESSION['emailUtulisateur'] = $user['emailUtulisateur'];
                                $_SESSION['telephoneUtulisateur'] = $user['telephoneUtulisateur'];
                                $_SESSION['dateNaissanceUtulisateur'] = $user['dateNaissanceUtulisateur'];
                                $_SESSION['motdepasseUtulisateur'] = $user['motdepasseUtulisateur'];
                            } else {
                              $loginError =true;
                            }
                        } else {
                          $loginError =true;
                        }
                    } catch (PDOException $e) {
                        echo 'An error occurred: ' . $e->getMessage();
                    }
                    
                }
            ?> 
 
 <!--navbar debut-->
 <nav class="navbar navbar-light bg-primary fixed-top  p-0 m-0  ">
        <div class="container-fluid navbar__container m-0 p-0">
          <a class=" m-0 p-0 ps-3 " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
             <i  class="fa-solid fa-bars-staggered fa-xl navbar__container__icon navbar__icon "></i>
          </a>
            <a class="navbar-brand " href="index">
                <!--Logo image-->
                <img src="assets/img/logo/svg_white.svg" alt=""  width="160" class="d-inline-block align-text-top">
            </a>
            <div class="navbar__container__options order-lg-2 pe-4 ">
                <a class="m-1" data-bs-toggle="collapse" href="#collapseExample" type="button" aria-expanded="false" aria-controls="collapseExample">
                  <i class="fa-solid fa-magnifying-glass fa-lg navbar__container__options__icons d-none d-lg-inline-block navbar__icon" ></i>
                </a>
                <?php if(!isset($_SESSION['nomUtulisateur'])){ ?>
                <a  type="button" data-bs-toggle="modal" data-bs-target="#login">
                  <i class="fa-solid fa-user fa-lg navbar__container__options__icons d-none d-lg-inline-block navbar__icon" ></i>
                </a>
                <?php }else{ ?>
                <a  class="text-decoration-none m-1 d-none d-lg-inline-block" data-bs-toggle="collapse" href="#userCollapse" role="button" aria-expanded="false" aria-controls="collapseExample" >
                  <i class="fa-solid fa-user fa-lg navbar__container__options__icons  navbar__icon m-auto" ></i>
                   <span class="fs-6 fw-light text-secon text-secondary"><?php echo($_SESSION['prenomUtulisateur'].' '.$_SESSION['nomUtulisateur']); ?></span>
                   <div class="collapse position-absolute ms-4 " id="userCollapse">
                    <div class="card card-body   fs-6 fw-normal p-0 ">
                      <p class="fs-6 p-2  m-0 mb-3 mt-3"><?php echo($_SESSION['emailUtulisateur']); ?></p>
                      <hr class="m-0 p-0 border-primary mb-2">
                      <a href="mes-commandes" class="d-block text-dark mb-2  text-decoration-none p-1"><i class="fa-solid fa-boxes-stacked m-2"></i>  Mes commandes</a>
                      <hr class="m-0 p-0 border-primary mb-2 ">
                      <a href="user" class="d-block text-dark mb-2  text-decoration-none p-1"><i class="fa-solid fa-user-gear m-2"></i>  Mon compte</a>
                      <hr class="m-0 p-0 border-primary  mb-2">
                      <a  href="signout" class="d-block text-dark mb-2 text-decoration-none p-1"><i class="fa-solid fa-right-from-bracket m-2"></i>  Deconnexion</a>
                      <hr class="m-0 p-0 border-primary ">
                    </div>
                </div>
                </a>
                <?php }?>
                <a href="cart.php" class="d-inline-block  m-lg-1 m-0   position-relative navbar__container__options__cart  ">
                  <span id="cartIconContainer" class="d-inline-block bg-dark rounded-5"></span>
                  <span id="cartIcon" class=" text-center   text-secondary  fs-6 fw-bolder "></span>   
                  <i class="fa-solid fa-cart-shopping fa-lg pointer-event  navbar__container__options__icons navbar__icon " ></i>
                </a>
            </div>
          </div>
            <div class="collapse w-100" id="collapseExample">
              <div class="card card-body bg-primary border-0  ">
                <form class="row " id="searchForm" onsubmit="filterProducts(event)">
                  <input id="searchInput" type="text" class="col-lg-9 col-md-8 col-12 m-auto rounded border-1   p-2 d-inline " placeholder="Rechercher un produit" required>
                  <button type="submit"   class="btn btn-dark m-auto fw-bold btn-lg mt-lg-0 mt-md-0 mt-2 fs-6  col-lg-2 col-md-3 col-12 d text-secondary  d-inline ">Rechercher</button>
                </form>
            </div>
            </div>
       <div class="offcanvas offcanvas-start offcanvasNavbar" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
        <div class="offcanvas-header ">
            <!--Logo image-->
            <div class="m-auto ">
              <img src="assets/img/logo/svg_yellow (1).svg" alt=""  width="180" class="d-inline-block align-text-top">
            </div>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body offcanvasNavbar__nav m-0 p-0 text-center  mt-5">
          <hr class="m-0 p-0">
            <a href="index" class="d-block  text-decoration-none pt-3 pb-3 fs-6 offcanvasNavbar__nav__link ">Accueil</a>
            <hr class="m-0 p-0">
            <a href="shop" class="d-block  text-decoration-none  pt-3 pb-3 fs-6 offcanvasNavbar__nav__link">Boutique</a>
            <hr class="m-0 p-0">
            <?php if(isset($_SESSION['nomUtulisateur'])){ ?>
              <a href="mes-commandes" class="d-lg-none d-block   text-decoration-none  pt-3 pb-3 fs-6 offcanvasNavbar__nav__link">Mes commandes</a>
              <hr class="m-0 p-0">
            <?php } ?>
            <a href="blog" class="d-block   text-decoration-none  pt-3 pb-3 fs-6 offcanvasNavbar__nav__link">Notre Blog</a>
            <hr class="m-0 p-0">
            <a href="contact" class="d-block   text-decoration-none  pt-3 pb-3 fs-6 offcanvasNavbar__nav__link">Contactez-Nous</a>
            <hr class="m-0 p-0">
            <a href="about" class="d-block   text-decoration-none  pt-3 pb-3 fs-6 offcanvasNavbar__nav__link">À propos de KenzAtlas</a>
            <hr class="m-0 p-0">
            <?php if(isset($_SESSION['nomUtulisateur'])){ ?>
              <a href="signout" class="d-lg-none d-block   text-decoration-none  pt-3 pb-3 fs-6 offcanvasNavbar__nav__link">Se déconnecter</a>
              <hr class="m-0 p-0">
            <?php } ?>
          <div class="offcanvas-footer mt-5">
            <ul class="list-unstyled text-center ">
              <li class="d-inline m-2 "><a class="text-decoration-none offcanvasNavbar__nav__socialLink text-dark" href="https://www.facebook.com/kenz.atla?sfnsn=wa&mibextid=RUbZ1f"><i class="fa-brands fa-facebook fa-lg"></i></a></li>
              <li class="d-inline m-2 "><a class="text-decoration-none offcanvasNavbar__nav__socialLink text-dark" href="https://www.instagram.com/kenz.atlas?igsh=MTg2bWVoYjEzbzBhag=="><i class="fa-brands fa-instagram fa-lg"></i></a></li>
              <li class="d-inline m-2"><a class="text-decoration-none offcanvasNavbar__nav__socialLink text-dark" href="https://www.tiktok.com/@kenzatlaspro?_t=8jMB8zQPPWf&_r=1"><i class="fa-brands fa-tiktok fa-lg"></i></a></li>
              <li class="d-inline m-2"><a class="text-decoration-none offcanvasNavbar__nav__socialLink text-dark" href="https://wa.me/+212684822768"><i class="fa-brands fa-whatsapp fa-lg"></i></a></li>
            </ul>
          </div>
          <p class="text-center fw-lighter mt-5  ">© 2023 DesignCraftsMan Tous droits réservés.</p>
        </div>
      </div>
    </nav>
    <nav class="navbar fixed-bottom  navbar-light bg-primary  d-lg-none ">
      <div class="container-fluid  w-100 ">
        <div class="w-100  p-1 d-flex  justify-content-between align-items-center  ">
          <div class="p-1 text-center">
            <?php if(!isset($_SESSION['nomUtulisateur'])){  ?>
            <a type="button" data-bs-toggle="modal" data-bs-target="#login"  class="text-decoration-none ">
              <i class="fa-solid fa-user fa-xl navbar__container__options__icons text-secondary " ></i>
              <span class="d-block text-secondary ">Se connecter</span>
            </a>
            <?php }else{ ?>
              <a type="button" href="user" class="text-decoration-none ">
              <i class="fa-solid fa-user fa-xl navbar__container__options__icons text-secondary " ></i>
              <span class="d-block text-secondary ">Mon compte</span>
            </a>
            <?php } ?>
          </div>
          
          <div class="p-1 text-center ">
            <a href="shop" class="text-decoration-none ">
              <i class="fa-solid fa-shop fa-xl text-secondary"></i>
              <span class="d-block text-secondary">boutique</span>
            </a>
          </div>
          <div class="p-1 text-center ">
            <a  data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
              <i class="fa-solid fa-magnifying-glass fa-xl navbar__container__options__icons text-secondary" ></i>
              <span  class="d-block text-secondary">Rechercher</span>
            </a>
          </div>
          
        </div>
      </div>
    </nav>
    <!--navbar end-->


    <!-- login and registration forms start -->
    <div class="modal fade" id="login" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header bg-primary ">
            <div class="logo-container m-auto ">
              <img src="assets/img/logo/svg_white.svg" alt=""  width="160" class="d-inline-block align-text-top">
            </div>
          </div>
          <div class="modal-body">
            <form method="POST" class="needs-validation" novalidate>
                <input type="email" class="p-2 w-100 m-auto mt-3 fs-5 border-3 rounded form-control  " name="emailUtulisateur" placeholder="Email" required>
                <input type="password" class="p-2 w-100 m-auto mt-3 fs-5 border-3  rounded  form-control "name="motdepasseUtulisateur" placeholder="Mot de passe" required>
                <?php 
                    if ($loginError) {
                      echo '<div class="alert alert-danger mt-3" role="alert">Identifiant incorrect. Veuillez réessayer.</div>';
                  }
                ?>
                <button type="submit" class=" btn btn-primary w-100 m-auto registerLoginBtns mt-3 text-secondary fs-5 border-0 rounded fw-bolder ">Se connecter</button>
            </form>
            <p class="text-center fs-6 mt-4">Vous n'avez pas un compte? <a type="button" class="text-primary " data-bs-target="#Register" data-bs-toggle="modal" data-bs-dismiss="modal">Créer un compte.</a></p>
         </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="Register" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header bg-primary ">
            <div class="logo-container m-auto ">
              <img src="assets/img/logo/svg_white.svg" alt=""  width="160" class="d-inline-block align-text-top">
            </div>
          </div>
          <div class="modal-body">
            <form method="POST" class="needs-validation" novalidate>
              <input type="text" class="p-2 w-100 m-auto mt-3 fs-5 border-3 rounded form-control  " name="nomUtulisateur" placeholder="Nom" required>
              <input type="text" class="p-2 w-100 m-auto mt-3 fs-5 border-3  rounded  form-control "name="prenomUtulisateur" placeholder="Prenom" required>
              <input type="email" class="p-2 w-100 m-auto mt-3 fs-5 border-3 rounded form-control  "name="emailUtulisateur" placeholder="Email" required>
              <input type="password" class="p-2 w-100 m-auto mt-3 fs-5 border-3  rounded  form-control "name="motdepasseUtulisateur" placeholder="Mot de passe" required>
              <input type="date" class="p-2 w-100 m-auto mt-3 fs-5 border-3 rounded form-control " name="dateNaissanceUtulisateur" required>
              <div class="form-check mt-3 fs-6 ms-1">
                <input class="form-check-input " type="checkbox" value="" id="flexCheckChecked" required>
                <label class="form-check-label " for="flexCheckChecked">
                  J'ai lu et j'accepte <a href="terms-conditions"> les termes et les conditions d'utulisations</a>.
                </label>
              </div>
              <button type="submit" class=" btn btn-primary w-100 m-auto registerLoginBtns  mt-3 text-secondary fs-5 border-0 rounded fw-bolder ">Créer compte</button>
          </form>
          <p class="text-center fs-6 mt-4">Vous avez déjà un compte? <a class="text-primary " type="button" data-bs-target="#login" data-bs-toggle="modal" data-bs-dismiss="modal">Se connecter</a></p>
          </div>
        </div>
      </div>
    </div>


    <!-- login and registration forms end -->

    <!--navbar end-->



    <!--hero section debut-->
    <section class="heroSection">
        <div id="carouselExampleDark" class="carousel carousel-dark slide heroSection__container  " data-bs-ride="carousel">
            <?php if(isset($packs[1]) && isset($packs[2])) { ?>
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active bg-secondary  rounded-circle " aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleDark" class="bg-secondary  rounded-circle" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleDark" class="bg-secondary  rounded-circle" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <?php }?>
            <div class="carousel-inner active heroSection__container__carousel">
              <div class="carousel-item h-100  active heroSection__container__carousel__item" data-bs-interval="10000">
                <img  src="assets/<?php echo($packs[0]['imageProduit1']); ?>"  class="  d-block w-100 heroSection__container__carousel__item__img " alt="...">
                <div class=" heroSection__container__carousel__item__info    ">
                  <div class="heroSection__container__carousel__item__info__text ">
                    <h3 class="fs-4 fw-light heroSection__container__carousel__item__info__h3 ">PACK</h3>
                    <h2 class="display-4  fw-bold mt-4 heroSection__container__carousel__item__info__h2"><?php echo($packs[0]['nomProduit']); ?></h2>
                    <p class="fs-6 mt-4 heroSection__container__carousel__item__info__p "><?php echo($packs[0]['sousTitreProduit']); ?></p>
                  </div> 
                  <a type="button" href="product?idProduit=<?php echo($packs[0]['idProduit']); ?>" class="btn btn-primary btn-lg text-secondary fs-5 heroSection__container__carousel__item__info__btn  fw-bolder">Acheter Maintenant</a>
                </div>
              </div>
              <?php if(isset($packs[1]) && isset($packs[2])) { ?>
              <div class="carousel-item h-100   heroSection__container__carousel__item" data-bs-interval="10000">
                <img  src="<?php echo($packs[1]['imageProduit1']); ?>"  class=" d-block w-100 heroSection__container__carousel__item__img " alt="...">
                <div class=" heroSection__container__carousel__item__info    ">
                  <div class="heroSection__container__carousel__item__info__text ">
                    <h3 class="fs-4 fw-light heroSection__container__carousel__item__info__h3 ">PACK</h3>
                    <h2 class="display-4  fw-bold mt-4 heroSection__container__carousel__item__info__h2"><?php echo($packs[1]['nomProduit']); ?></h2>
                    <p class="fs-6 mt-4 heroSection__container__carousel__item__info__p "><?php echo($packs[1]['sousTitreProduit']); ?></p>
                  </div> 
                  <a type="button" href="product?idProduit=<?php echo($packs[1]['idProduit']); ?>" class="btn btn-primary btn-lg text-secondary heroSection__container__carousel__item__info__btn fs-5  fw-bolder">Acheter Maintenant</a>
                </div>
              </div>
              <div class="carousel-item h-100   heroSection__container__carousel__item" data-bs-interval="10000">
                <img  src="<?php echo($packs[2]['imageProduit1']); ?>"  class="object-fit-cover d-block w-100 heroSection__container__carousel__item__img " alt="...">
                <div class=" heroSection__container__carousel__item__info    ">
                  <div class="heroSection__container__carousel__item__info__text ">
                    <h3 class="fs-4 fw-light heroSection__container__carousel__item__info__h3 ">PACK</h3>
                    <h2 class="display-4  fw-bold mt-4 heroSection__container__carousel__item__info__h2"><?php echo($packs[2]['nomProduit']); ?></h2>
                    <p class="fs-6 mt-4 heroSection__container__carousel__item__info__p "><?php echo($packs[2]['sousTitreProduit']); ?></p>
                  </div> 
                  <a type="button" href="product?idProduit=<?php echo($packs[2]['idProduit']); ?>" class="btn btn-primary btn-lg text-secondary fs-5 heroSection__container__carousel__item__info__btn  fw-bolder">Acheter Maintenant</a>
                </div>
              </div>
              <?php }  ?>
            </div>
          </div>
    </section>

    <!--hero section end-->


    <!--featured products section start -->
    <section class="container featuredProducts mt-5 ">
      <h2 class="featuredProducts__title fs-1 text-center reveal">Nos produits vedettes</h2>
      <h4 class="featuredProducts__subTitle fs-4 fw-lighter text-center reveal ">Obtenez la peau que vous désirez</h4>
      <div class="row d-flex featuredProducts__products justify-content-center align-content-center  mt-5  reveal">
        <?php foreach($produitsVedette as $produit){ ?>
        <div class="col-lg-3 col-md-6 col-10 mt-2 ">
          <div class="card border-0 m-auto w-100 ProductsCards" >
            <a href="product?idProduit=<?php echo($produit['idProduit']); ?>" class="text-decoration-none text-dark">
            <div class="ProductsImageContainers">
              <img src="assets/<?php
                    if($produit['etatProduit']=="pack promo"){
                     echo($produit['imageProduit2']);}else{
                      echo($produit['imageProduit1']);
                     } 
                     ?>"  class="img-fluid card-img-top ProductsImages" alt="...">
              <button class="btn btn-primary   rounded-0 btn-lg fw-light text-secondary ProductsImagesBtns">DECOUVRIR</button>
            </div>
            <div class="card-body">
              <div class=" d-none">
                <span class="shop__container__products__list__product__details__categorie"><?php echo($produit['categorieProduit']); ?></span>
                <span class="shop__container__products__list__product__details__etat"><?php echo($produit['etatProduit']); ?></span>
              </div>
              <p class="card-text text-center m-1 fw-bolder"><span class="shop__container__products__list__product__price"><?php echo($produit['prixProduit']); ?></span>dh</p>
              <p class="card-text text-center m-1"><?php echo($produit['nomProduit']); ?></p>
              <p class="card-text text-center m-1">
                <?php for($i=0 ; $i < $produit['moyenneNotation']; $i++){ ?>
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

    <!--featured products section end -->


    <!--categories section start-->

    <section class="container-fluid text-center mt-5 categoriesSection">
      <div class="row categoriesSection__container">
        <div class="col-lg-6 col-12   p-0 categoriesSection__container__item mt-2 mb-4">
          <img  src="assets/img/homePage/categoriesSection/haircare.jpg " class="w-100 h-100 reveal" alt="">
          <div class="categoriesSection__container__item__info text-secondary reveal">
            <h3 class="categoriesSection__container__item__info__h3 fs-2 fw-lighter   ">Meilleur de</h3>
            <h2 class="categoriesSection__container__item__info__h2 fs-1 fw-bolder ">SOIN DES <br> CHEVEUX</h2>
            <button type="button" id="exploreHair" class="btn btn-primary btn-lg  text-secondary fw-bold  ">Explorer</button>
          </div>
        </div>
        <div class="col-lg-6 col-12  p-0  categoriesSection__container__item mt-5 ">
          <img  src="assets/img/homePage/categoriesSection/skincare2.jpg " class="w-100 h-100 reveal" alt="">
          <div class="categoriesSection__container__item__info text-secondary reveal ">
            <h3 class="categoriesSection__container__item__info__h3 fs-2 fw-lighter ">Meilleur de</h3>
            <h2 class="categoriesSection__container__item__info__h2 fs-1 fw-bolder ">SOIN DE <br> LA PEAU</h2>
            <button type="button" id="exploreSkin" class="btn btn-primary btn-lg text-secondary fw-bold  ">Explorer</button>
          </div>
        </div>
      </div>
    </section>

    <!--categories section end-->


    
    <!--info section start-->
    <section class="container  infoSection p-5 " >
      <div class="row text-center infoSection__container  p-5  d-flex flex-wrap justify-content-center ">
        <div class="col-lg-4 col-md-6 col-12 infoSection__container__item  mt-5 ">
          <div class="infoSection__container__item__icon m-3 reveal"><i class="fa-solid fa-truck display-1 text-primary "></i></div>
          <h2 class="infoSection__container__item__title  m-4 fs-3 fw-bold 3  reveal ">Livraison gratuite</h2>
          <h3 class="infoSection__container__item__subTitle fw-normal fs-5  reveal">Livraison gratuite pour toutes les commandes</h3>
        </div>
        <div class="col-lg-4 col-md-6 col-12 infoSection__container__item  mt-5 ">
          <div class="infoSection__container__item__icon m-3 reveal"><i class="fa-solid fa-arrow-right-arrow-left display-1  text-primary "></i></div>
          <h2 class="infoSection__container__item__title fw-bold  m-4 fs-3  reveal">Échange</h2>
          <h3 class="infoSection__container__item__subTitle fw-normal fs-5 reveal">Sous 30 jours pour un échange</h3>
        </div>
        <div class="col-lg-4 col-md-6 col-12  infoSection__container__item   mt-5 ">
          <div class="infoSection__container__item__icon m-3 reveal"><i class="fa-solid fa-phone display-1   text-primary "></i></div>
          <h2 class="infoSection__container__item__title fw-bold  m-4 fs-3 reveal">Support en ligne</h2>
          <h3 class="infoSection__container__item__subTitle fw-normal  fs-5 reveal">24 heures sur 24, 7 jours sur 7</h3>
        </div>
      </div>
    </section>

    <!--infoSection end-->



    <!--client Review section start-->

    <section class="clientReviewSection container-fluid bg-primary p-3 reveal">
      <div class="container  p-2 clientReviewSection">
        <div class="row clientReviewSection__container align-items-center ">
          <div class="col-lg-3  col-12 clientReviewSection__container__text  text-lg-start text-center    ">
            <div class="clientReviewSection__container__text__icon m-4 reveal"><img loading="lazy" src="assets/img/homePage/clientReviewsSection/clientReview.svg" class="w-25 text-secondary " alt=""></div>
            <h2 class="clientReviewSection__container__text__title m-4 fs-2 fw-bold reveal">Avis client</h2> 
            <h3 class="clientReviewSection__container__text__subTitle m-4 fs-3 fw-light reveal">Ce que nos clients disent de nos produits</h3> 
          </div>
          <div class="col-lg-8 col-12 clientReviewSection__container__screenshots p-5 m-auto ">
            <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner ">
                <div class="carousel-item active" data-bs-interval="10000">
                  <div class="row">
                    <div class="col-lg-5 col-md-8 col-9 m-auto ">
                      <div class="card text-center h-100">
                        <div class="card-header">
                          <img src="assets/img/homePage/clientReviewsSection/review1.jpg" class="w-25 rounded-circle " alt="">
                          <p class="card-text text-center m-1"><i class="fa-solid fa-star fa-xs text-primary m-1"></i><i class="fa-solid fa-star fa-xs text-primary m-1"></i><i class="fa-solid fa-star fa-xs text-primary m-1"></i><i class="fa-solid m-1 fa-star fa-xs text-primary "></i><i class="fa-solid fa-star fa-xs text-primary m-1"></i></p>
                        </div>
                        <div class="card-body">
                          <p class="card-text fs-6">J'utilise ce savon depuis quelques semaines maintenant et je ne peux m'empêcher de partager à quel point mon expérience a été extraordinaire. Dès le premier contact, j'ai été séduit par son parfum délicat qui évoque la fraîcheur et la propreté.</p>
                        </div>
                        <div class="card-footer text-muted">
                          Sara lotfi
                        </div>
                      </div>
                    </div>
                   
                  </div>
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                  <div class="row">
                    <div class="col-lg-5 col-md-8 col-9 m-auto ">
                      <div class="card text-center  h-100">
                        <div class="card-header">
                          <img src="assets/img/homePage/clientReviewsSection/review2.jpg" loading="lazy" class="w-25 object-fit-cover  rounded-circle " alt="">
                          <p class="card-text text-center m-1"><i class="fa-solid fa-star fa-xs text-primary m-1"></i><i class="fa-solid fa-star fa-xs text-primary m-1"></i><i class="fa-solid fa-star fa-xs text-primary m-1"></i><i class="fa-solid m-1 fa-star fa-xs text-primary "></i><i class="fa-solid fa-star fa-xs text-primary m-1"></i></p>
                        </div>
                        <div class="card-body">
                          
                          <p class="card-text fs-6">Je suis ravi de partager mon expérience avec ce shampoing qui a totalement conquis mon cœur capillaire. Dès la première utilisation, j'ai été impressionné par son parfum délicat qui transforme ma douche en une expérience agréable et relaxante.</p>
                        </div>
                        <div class="card-footer text-muted">
                          Aicha sadik
                        </div>
                      </div>
                    </div>
                   
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="row  ">
                    <div class="col-lg-5 col-md-8 col-9  m-auto">
                      <div class="card text-center  ">
                        <div class="card-header">
                          <img src="assets/img/homePage/clientReviewsSection/review3.jpg" loading="lazy" class="w-25 rounded-circle " alt="">
                          <p class="card-text text-center m-1 "><i class="fa-solid fa-star fa-xs text-primary m-1"></i><i class="fa-solid fa-star fa-xs text-primary m-1"></i><i class="fa-solid fa-star fa-xs text-primary m-1"></i><i class="fa-solid m-1 fa-star fa-xs text-primary "></i><i class="fa-solid fa-star fa-xs text-primary m-1"></i></p>
                        </div>
                        <div class="card-body">
                          
                          <p class="card-text fs-6">La qualité des ingrédients utilisés est indéniable. Cette huile est composée d'extraits naturels qui nourrissent la peau en profondeur, et j'apprécie particulièrement l'absence de produits chimiques agressifs. De plus, le flacon en verre somptueux ajoute une touche d'élégance à ma routine de soins.</p>
                        </div>
                        <div class="card-footer text-muted">
                          Fatima imrane
                        </div>
                      </div>
                    </div>
                   
                  </div>
                </div>
              </div>
              <button class="carousel-control-prev " type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                <span class="carousel-control-prev-icon " aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next " type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                <span class="carousel-control-next-icon " aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>
        </div>
      </div> 
    </section>


    <!--clientReview section end-->



    <!-- blog section start-->

    <section class="container-fluid p-5 blogSection">
      <div class="text-center blogSection__textContainer">
        <h2 class="blogSection__textContainer__title fs-2 fw-bold reveal">De notre blog</h2>
        <h3 class="blogSection__textContainer__subTitle fs-3 fw-lighter reveal">Découvrez nos dernières informations</h3>
      </div>
      <div class="row  mt-5 reveal ">
        <?php foreach($articles as $article){ ?>
        <div class="col-lg-3 col-md-6 col-12 mt-2 blogSection__container m-auto ">
          <div class="card border-0 m-auto blogSection__container__item w-100" >
            <img loading="lazy" src="<?php echo($article['imgArticle']); ?>" class="card-img-top object-fit-cover" alt="...">
            <div class="card-body ">
              <h5 class="card-title blog__container__posts__post__text__title"><?php echo($article['titreArticle']); ?></h5>
              <p class="card-text blog__container__posts__post__text__body"><?php echo($article['contenuArticle']); ?></p>
              <a href="article?idArticle=<?php echo($article['idArticle']); ?>" class="btn  btn-dark border-1 border-dark PostsButtons">En savoir plus</a>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </section>

    <!--blog section end-->

    <!--footer start -->

    <?php include('footer.php'); ?>


    <!-- footer end -->

    <script src="js/explore.js"></script>
    <script src="js/scrollReveal.js"></script>
    <script src="js/cart.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="js/searchBar.js"></script>
</body>
</html>