<?php session_start(); ?>
<?php   
        include('connection.php');
        $id = $_SESSION['idUtulisateur'];
        $sqlQuery = "SELECT * FROM commandes WHERE idUtulisateur = :id ORDER BY `commandes`.`dateCommande` DESC ;";
        $commandesStatement = $db->prepare($sqlQuery);
        $commandesStatement->bindParam(':id', $id, PDO::PARAM_STR);
        $commandesStatement->execute();
        $commandes = $commandesStatement->fetchAll(PDO::FETCH_ASSOC);
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
<body  >
    <?php include('navbar.php'); ?>

    <div class="container min-vh-100">
            <div class="row mt-5 mb-5 p-1">
                    <h2 class="fw-bold fs-3">Mes commandes</h2>
                    <?php if(count($commandes) <=0 ){ ?>
                           <div class="text-center mt-5 fs-5">Vous n'avez aucune commande</div> 
                    <?php }else{ ?>
                    <table class="table mt-3  p-3 fs-6">
                        <thead>
                        <tr class="border-primary ">
                            <th scope="col ">Numero de commande</th>
                            <th scope="col">Date</th>
                            <th scope="col">Commande</th>
                            <th scope="col">Prix</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($commandes as $commande){ ?>
                        <tr class="border-primary align-items-center" >
                            <th scope="row "><?php echo($commande['numeroCommande']); ?></th>
                            <td><?php echo($commande['dateCommande']); ?></td>
                            <td>
                                <?php 
                                    include('connection.php');
                                    $id = $_SESSION['idUtulisateur'];
                                    $sqlQuery = "SELECT * FROM produitsCommandés WHERE numeroCommande = :numeroCommande;";
                                    $produitsIdStatement = $db->prepare($sqlQuery);
                                    $produitsIdStatement->bindParam(':numeroCommande', $commande['numeroCommande'], PDO::PARAM_STR);
                                    $produitsIdStatement->execute();
                                    $produitsId = $produitsIdStatement->fetchAll(PDO::FETCH_ASSOC);
                                    $prixTotal = 0;
                                    foreach($produitsId as $id){
                                        $sqlQuery = "SELECT nomProduit, prixProduit FROM produit WHERE idProduit = :id;";
                                        $produitStatement = $db->prepare($sqlQuery);
                                        $produitStatement->bindParam(':id', $id['idProduit'], PDO::PARAM_STR);
                                        $produitStatement->execute();
                                        $produit = $produitStatement->fetch(PDO::FETCH_ASSOC);
                                        $prixTotal += ($produit['prixProduit'] * $id['quantiteCommandés']);
                                        echo($produit['nomProduit'].'<br>');
                                    }
                                ?>
                            </td>
                            <td><?php echo($prixTotal); ?> dh</td>
                        </tr>
                        <?php } }?>
                        </tbody>
                    </table>
                </div>
            </div>
    </div>

    <?php include('footer.php'); ?>

    <script src="js/scrollReveal.js"></script>
  <script src="js/cart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
  </html>