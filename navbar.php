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
 <nav class="navbar navbar-light bg-primary sticky-top  p-0 m-0  ">
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
                  <input id="searchInput" type="text" class="col-lg-10 col-md-8 col-12 m-auto rounded border-1   p-2 d-inline " placeholder="Rechercher un produit" required>
                  <button type="submit"   class="btn btn-dark m-auto fw-bold btn-lg mt-lg-0 mt-md-0 mt-2 fs-6  col-lg-1 col-md-3 col-12 d text-secondary  d-inline ">Rechercher</button>
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