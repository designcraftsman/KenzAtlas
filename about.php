<?php session_start(); ?>
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


    <div class="container-fluid mb-5">
        <h1 class="display-4  fw-bolder text-primary text-center mt-5 contactContainer__title">À propos de nous</h1>
        <div class="row mt-5 contactContainer__box">
            <div class="col-lg-5 col-md-5 col-12 bg-primary m-auto p-5 text-secondary rounded-5  ">
                <h2 class="fs-2 fw-bold ">Notre Histoire</h2>
                <p class=" mt-3 fs-6 fw-light ">KenzAtlas est une marque de cosmétiques 100% marocaine qui puise son inspiration dans la richesse naturelle et culturelle du Maroc. Fondée en 2023 avec la vision d'offrir des produits de beauté authentiques, naturels et empreints d'élégance, KenzAtlas s'engage à redéfinir les normes de l'industrie cosmétique en fusionnant tradition et modernité.
                  <span class="fw-bold">Mission :</span> Notre mission chez KenzAtlas est de sublimer la beauté naturelle de chacun en proposant une gamme de produits de beauté exclusivement composés d'ingrédients naturels d'exception tel que l’argile, henné, et safran. Nous aspirons à révéler la splendeur héritée du Maroc tout en célébrant l'individualité de chaque personne.
                  </p>
            </div>
            <div class="col-lg-5 col-md-5 col-12 m-lg-auto m-md-auto mt-5 ">
                <img src="assets/img/more/carte.jpg" class="img-fluid rounded-5  " alt="">
            </div>
        </div>
        <div class="row mt-5 reveal">
            <div class="col-lg-5 col-md-5 col-12 m-auto">
                <img src="assets/img/more/carte2.jpg" class="img-fluid  rounded-5" alt="">
            </div>
            <div class="col-lg-5 col-md-5 col-12 m-lg-auto m-md-auto bg-primary  p-5 text-secondary rounded-5  mt-5 ">
                <h2 class="fs-2 fw-bold ">Valeurs Fondamentales </h2>
                <p class=" mt-3 fs-6 fw-light ">
                  <span class="fw-bold ">1-Authenticité :</span> KenzAtlas incarne l'authenticité marocaine en sélectionnant méticuleusement des ingrédients naturels, préservant ainsi la pureté et l'efficacité de nos produits. <br>
                  <span class="fw-bold ">2-Tradition et Modernité :</span> Nous fusionnons les traditions ancestrales de la beauté marocaine avec des approches modernes pour créer des formules innovantes et luxueuses.<br>
                  <span class="fw-bold ">3-Responsabilité Environnementale :</span> Nous sommes déterminés à minimiser notre impact sur l'environnement en adoptant des pratiques durables, des emballages éco-responsables et des initiatives de responsabilité sociale.<br>
                  <span class="fw-bold ">4-Élégance Marocaine :</span> KenzAtlas s'inspire de l'élégance intemporelle du Maroc, offrant une expérience sensorielle unique qui évoque la beauté et le raffinement.<br>

                </p>
            </div>
        </div>
        <div class="row mt-5 reveal">
            <div class="col-11 m-auto bg-primary  p-5 text-secondary  rounded-5">
                <h2 class="fs-2 fw-bold ">Engagement envers la Qualité </h2>
                <p class="mt-3 fs-6 fw-light">Nous mettons un point d'honneur à maintenir des normes de qualité exceptionnelles à chaque étape de la production, depuis la sélection des ingrédients jusqu'à la fabrication artisanale de nos produits, garantissant ainsi une expérience luxueuse pour nos clients.

                  Chez KenzAtlas, nous ne proposons pas seulement des produits de beauté, nous offrons une invitation à découvrir et à embrasser la splendeur de la nature marocaine, capturée dans chaque pot. Notre engagement envers l'authenticité, la qualité et l'élégance guide chacune de nos actions, faisant de KenzAtlas bien plus qu'une marque de skincare, mais une célébration de la beauté naturelle.
                  </p>
            </div>
        </div>
    </div>



     <!-- footer start-->

    <!--footer start -->

    <?php include('footer.php'); ?>


    <!-- footer end -->

    <script src="js/explore.js"></script>
    <script src="js/scrollReveal.js"></script>
    <script src="js/cart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/searchBar.js"></script>
  </body>
  </html>