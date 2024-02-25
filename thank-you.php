<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre commande est en cours de traitement</title>
    <link rel="icon" href="assets/img/logo/LOGO_2.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<?php include('navbar.php'); ?>
<div class="container  vh-100">
        <div class="m-auto text-center  p-5 ">
                <i id="thank-you-icon" class="fa-solid fa-check fa-bounce display-1  text-primary"></i>
                <h1 class="display-4 fw-normal">Merci pour votre commande!</h1>
                <h2 class="fs-2 mt-4 fw-lighter">Notre équipe vous contactera bientôt</h2>
        </div>
        <div class="row  border mt-5">
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
            <li class="d-inline m-3 "><a class="text-decoration-none socialLinks  text-dark  " href="#"><i class="fa-brands fa-facebook fa-2xl"></i></a></li>
            <li class="d-inline m-3 "><a class="text-decoration-none socialLinks text-dark  " href="#"><i class="fa-brands fa-instagram fa-2xl"></i></a></li>
            <li class="d-inline m-3 "><a class="text-decoration-none socialLinks text-dark  " href="#"><i class="fa-brands fa-tiktok fa-2xl"></i></a></li>
          </ul>
        </div>
      </div>


</div>    
<?php include('footer.php'); ?>
<script src="js/checkout.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="js/searchBar.js"></script>
</body>
</html>