<?php
error_reporting(E_ALL);
if(!isset($_POST['nomClient']) || !isset($_POST['prenomClient']) || !isset($_POST['adresseClient']) || !isset($_POST['villeClient']) || !isset($_POST['codePostalClient']) || !isset($_POST['telephoneClient'])){
    header('Location: index');
    exit();
}else{
    session_start();
    $cookieValue = $_COOKIE['cartProducts'];
    // Decode the JSON string to get the array
    $orderRecapProducts = json_decode(urldecode($cookieValue), true);
    // Now $orderRecapProducts contains the array from the cookie
        // Retrieve form data
        $totalCommande = 0;
        foreach ($orderRecapProducts as $product) {
            $totalCommande += $product['price'] * $product['quantity'];
        }
        $nomClient = $_POST["nomClient"];
        $prenomClient = $_POST["prenomClient"];
        $adresseClient = $_POST["adresseClient"];
        $villeClient = $_POST["villeClient"];
        $codePostalClient = $_POST["codePostalClient"];
        $telephoneClient = $_POST["telephoneClient"];
        $noteCommandeClient = $_POST["noteCommandeClient"];

        // Create a PDO instance
        include('connection.php');

        // Prepare the SQL query using named placeholders
        $sqlQuery = 'INSERT INTO commandes (idUtulisateur, totalCommande,  nomClient, prenomClient, adresseClient, villeClient, codePostalClient, telephoneClient, noteCommandeClient)
                     VALUES (:idUtulisateur,:totalCommande , :nomClient, :prenomClient, :adresseClient, :villeClient, :codePostalClient, :telephoneClient, :noteCommandeClient)';

        $insertData = $db->prepare($sqlQuery);

        // Bind values to named placeholders
        $insertData->bindParam(':idUtulisateur', $_SESSION['idUtulisateur']);
        $insertData->bindParam(':totalCommande', $totalCommande);
        $insertData->bindParam(':nomClient', $nomClient);
        $insertData->bindParam(':prenomClient', $prenomClient);
        $insertData->bindParam(':adresseClient', $adresseClient);
        $insertData->bindParam(':villeClient', $villeClient);
        $insertData->bindParam(':codePostalClient', $codePostalClient);
        $insertData->bindParam(':telephoneClient', $telephoneClient);
        $insertData->bindParam(':noteCommandeClient', $noteCommandeClient);
        $insertData->execute();
        $numeroCommande = $db->lastInsertId();
        for($i=0 ; $i < count($orderRecapProducts) ; $i++){
        $id = $orderRecapProducts[$i]['id'];
        $quantite = $orderRecapProducts[$i]['quantity'];
        $sqlQueryProducts = "INSERT INTO `produitscommandés` (`numeroCommande`, `idProduit`, `quantiteCommandés`) VALUES ('$numeroCommande', '$id', '$quantite');";
        $db->exec($sqlQueryProducts);
        }
        $to = "fzoussama25@gmail.com";
        $subject = "Nouvelle Commande ";
        $txt = "Oussama fayz a commandé un ghasoul aux herbes";
        $txt = $nomClient + $prenomClient ."a effectué une commande !" ;
        mail($to,$subject,$txt);
        header("Location: thank-you");
        
}




