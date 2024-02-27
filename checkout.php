<?php session_start();
  if(!isset($_SESSION['nomUtulisateur'])){
    header('Location: cart');
    exit();
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
    
    <?php include('navbar.php'); ?>

    <!--navbar end-->


    <div class="container ">
        <div class="row p-5">
            <div class="col-lg-8 col-md-10 m-auto  col-12 p-3 mt-lg-0   ">
                <h2 class="fw-bold fs-3">Informations de livraison</h2>
                <form class="row mt-4 needs-validation" novalidate method="POST" action="confirmation-ordre.php">
                  <div class="mb-3 col-lg-6 col-md-6 col-12 m-auto ">
                    <input type="text" class="form-control fs-5 p-3" name="nomClient" placeholder="Nom"required>
                  </div>
                  <div class="mb-3 col-lg-6 col-md-6 col-12 m-auto ">
                    <input type="text" class="form-control fs-5 p-3" name="prenomClient" placeholder="Prénom"required>
                  </div>
                  <div class="mb-3 col-12 m-auto ">
                    <input type="text" class="form-control fs-5 p-3" name="adresseClient" placeholder="Adresse"required>
                  </div>
                  <div class="mb-3 col-12 m-auto ">
                    <input type="text" class="form-control fs-5 p-3" name="villeClient" placeholder="Ville"required>
                  </div>
                  <div class="mb-3 col-12 m-auto ">
                    <input type="text" class="form-control fs-5 p-3" name="codePostalClient" placeholder="Code Postal"required>
                  </div>
                  <div class="mb-3 col-12 m-auto ">
                    <input type="text" class="form-control fs-5 p-3" name="telephoneClient" placeholder="Telephone"required>
                  </div>
                  <div class="mb-3">
                    <textarea class="form-control fs-5 p-3" name="noteCommandeClient" placeholder="Notes de commande (facultatif)"  rows="3"></textarea>
                  </div>
                  <hr class="border-primary border-3 ">
                  <div class="d-flex justify-content-between align-items-center  mt-2 ">
                    <p>Vos données personnelles seront utilisées pour traiter votre commande, soutenir votre expérience sur ce site et à d'autres fins décrites dans notre <a href="Politique-de-Confidentialite">politique de confidentialité.</a></p>
                  </div>  
                  <button type="submit" class="btn btn-lg btn-primary text-secondary rounded w-100 fs-5  mt-4">Confirmer ma commande</button>
                </form>
            </div>
            <div class="col-lg-3 col-md-8 col-12 m-auto  p-3">
                <h2 class="fw-bold fs-5">Récapitulatif de la commande</h2>
                <div class="orderRecapProducts">
                    
                    <!-- Checkout.js script-->


                </div>
                <hr class="border-primary border-3 ">
                <div class="d-flex justify-content-between mt-2 align-items-center ">
                    <h4 class="fs-5 fw-normal  m-0">Livraison : </h4>
                    <span  class="fs-5 fw-semibold  ">0.00dh</span>
                </div>
                <hr class="border-primary border-3 ">
                <div class="d-flex justify-content-between align-items-center  mt-2 ">
                  <h4 class="fs-5 fw-normal m-0">Paiement : </h4>
                  <span  class="fs-5 fw-semibold   ">à la livraison</span>
              </div>
                <hr class="border-primary border-3 ">
                <div class="d-flex justify-content-between align-items-center  mt-2 ">
                  <h4 class="fs-5 fw-normal  m-0">Total : </h4>
                  <span  class="fs-5 fw-semibold "><span id="totalCost"></span> dh</span>
              </div>
            </div>
        </div>
    </div>



    
    <!-- footer start-->

  <!--footer start -->

  <?php include('footer.php'); ?>


<!-- footer end -->

  <script src="js/scrollReveal.js"></script>
  <script src="js/checkout.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="js/searchBar.js"></script>
</body>
  </html>