<?php session_start(); ?>
<?php 
    include('connection.php');
    $id = $_GET['idArticle']; 
    $cookie= 'articleVue'.$id;
    $sqlQuery = "SELECT * FROM articles WHERE idArticle = :idArticle;";
    $articleStatement = $db->prepare($sqlQuery);
    $articleStatement->bindParam('idArticle', $id, PDO::PARAM_INT); 
    $articleStatement->execute();
    $article = $articleStatement->fetch(PDO::FETCH_ASSOC);
    if(!isset($_COOKIE[$cookie])){
        $Views = $article['vueArticle'] + 1;
        $insertQuery = "UPDATE articles SET vueArticle = :vueArticle WHERE idArticle = :idArticle";
        $insertView = $db->prepare($insertQuery);
        $insertView ->execute([
            'idArticle'=>$id,
            'vueArticle'=>$Views,
        ]);
        setcookie($cookie,1,time()+3600*24*30);
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo($article['titreArticle']); ?></title>
    <link rel="icon" href="assets/img/logo/LOGO_2.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body >

    <!--navbar debut-->
    
    <?php include('navbar.php'); ?>

    <!--navbar end-->


    <!--article and aside debut-->

    <div class="container-fluid ">
        <div class="row article">
            <div class="col-lg-8 col-12  article__container p-5">
                <h1 class="fw-bold fs-2 "><?php echo($article['titreArticle']); ?></h1>
                <img src="<?php echo($article['imgArticle']); ?>" class="w-100 article__container__img object-fit-cover mt-2 " alt="">
                <p class="fs-6 fw-lighter mt-2"><?php echo($article['dateArticle']); ?></p>
                <p class="fs-5 fw-normal ">
                <?php echo($article['contenuArticle']); ?>
                    </p>
            </div>
            <?php include('aside.php'); ?>
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