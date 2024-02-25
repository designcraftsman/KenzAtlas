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

    <div class="container   contactContainer mb-5 ">
      <div class="row p-5 align-items-center ">
        <div class="col-lg-6 col-md-6 col-12">
          <h1 class="display-4    fw-bolder  mt-5  contactContainer__title">Contactez-Nous</h1>
          <div class=" m-auto ">
            <h2 class="fw-light fs-3 mt-4 contactContainer__box">Demandez-nous n'importe quoi </h2>
            <form class="mt-3 contactContainer__box" method="POST">
                <input type="text" class="p-2 mt-4 w-100 rounded form-control" name="nom" placeholder="Votre nom complet" required >
                <input type="text" class="p-2 mt-4 w-100 rounded form-control " name="email" placeholder="Votre adresse email" required>
                <textarea  class="w-100 mt-4 p-2  form-control " rows="5" name="message" placeholder="Écrivez un message" required></textarea>
                <button type="submit" class="btn btn-primary text-secondary  btn-lg    mt-4 fw-normal ">Envoyer</button>
            </form>
            <?php
                    if (isset($_POST['nom']) && isset($_POST['email']) && isset($_POST['message']) ) {
                      try {
                          // Establish a database connection (replace with your actual database configuration)
                          include('connection.php');
                          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                          $nom = $_POST['nom'];
                          $email = $_POST['email'];
                          $messageUtulisateur = $_POST['message'];
                          // Prepare the SQL query using placeholders
                          $sqlQuery = 'INSERT INTO messages (nomCompletUtulisateur ,emailUtulisateur ,messageUtulisateur ) VALUES (:nomCompletUtulisateur,:emailUtulisateur,:messageUtulisateur)';
                          $insertData = $db->prepare($sqlQuery);
                          $insertData->execute([
                              'nomCompletUtulisateur' => $nom,
                              'emailUtulisateur' => $email,
                              'messageUtulisateur' => $messageUtulisateur
                          ]);
                          header("Location: ".$_SERVER['PHP_SELF']);
                          exit();
                      } catch (PDOException $e) {
                          echo 'An error occurred: ' . $e->getMessage();
                      }
                  }
            ?>
            
        </div>
        </div>
        <div class="col-lg-4  col-md-4 col-12 offset-lg-2 offset-md-2 mt-5 offset-0 m-auto contactContainer__image  ">
          <img src="assets/img/contact/contact.jpg" class="img-fluid contactContainer__image__img " alt="">
        </div>
      </div>
      <div class="row  border reveal">
        <div class="col-lg-4 col-md-4 col-12 m-auto text-center p-3">
          <h3 class="fs-4 fw-light text-center m-2">Par Whatsapp :</h3>
          <p class="fw-lighter fs-5 mt-4"><i class="fa-brands fa-whatsapp fa-2xl m-3"></i> +212-697547863</p>
        </div>
        <div class="col-lg-4 col-md-4 col-12 m-auto text-center p-3">
          <h3 class="fs-4 fw-light text-center m-2">Notre mail :</h3>
          <p class="fw-lighter fs-5 mt-4"><i class="fa-solid fa-envelope fa-2xl m-3"></i> kenzatlas@gmail.com</p>

        </div>
        <div class="col-lg-4 col-md-4 col-12 m-auto p-3">
          <h3 class="fs-4 text-center fw-light ">Suivez nous :</h3>
          <ul class="list-unstyled text-center text-secondary  mt-4 ">
            <li class="d-inline m-3 "><a class="text-decoration-none socialLinks  text-dark  " href="https://www.facebook.com/kenz.atla?sfnsn=wa&mibextid=RUbZ1f"><i class="fa-brands fa-facebook fa-2xl"></i></a></li>
            <li class="d-inline m-3 "><a class="text-decoration-none socialLinks text-dark  " href="https://www.instagram.com/kenz.atlas?igsh=MTg2bWVoYjEzbzBhag=="><i class="fa-brands fa-instagram fa-2xl"></i></a></li>
            <li class="d-inline m-3 "><a class="text-decoration-none socialLinks text-dark  " href="https://www.tiktok.com/@kenzatlaspro?_t=8jMB8zQPPWf&_r=1"><i class="fa-brands fa-tiktok fa-2xl"></i></a></li>
          </ul>
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
    <script src="js/searchBar.js"></script></body>
  </html>