<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Commande</title>
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
    <script src="JS/script.js"></script>
    <?php
        include 'PHP/commande_php.php';
    ?>
</head>
<body>

<div class="header">
    <div class="search">
        <input class="search" id="search_text" type="text" placeholder="Recherche..." name="text" value=""/>
        <button type="submit" name="submit" id="search_button"class="search"><img class="search" id="search_img" src="Img/Search_button.png" alt="" /></button>
    </div>
</div>
<div class="page">
    <div class="nav">
       <div class="headNav">
            <img src="./img/Logo_entreprise" class="logoCompanies">
            <img src="./img/nom_entreprise" class="nameCompanies">
       </div>
       <button onclick="location.href='./index.html';" class="buttonMenu"><img src="./img/Model=tab, active=false"  class="imageMenu"  ></button></br>
       <button onclick="location.href='./commande.php';" class="buttonMenu"> <img src="./img/Model=order, active=true"class="imageMenu"  > </button></br>
       <button onclick="location.href='./client.php';" class="buttonMenu"> <img src="./img/Model=client, active=false" class="imageMenu" </button></br>
    </div>
    <div class="other">
        <div class="content">
            <div class="panel">
                <table>
                    <tr>
                        <td class="title">ID Commande</td>
                        <td class="title">Client</td>
                        <td class="title">Prix</td>
                        <td class="title">Statut</td>
                        <td class="title">Action</td>

                    </tr>
                    <tr>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                    </tr>
                    <?php
                    foreach(getArrayRecapCommand("11") as $command){
                    ?>
                    <tr>
                        <td><?php echo $command['id_commande'] ?></td>
                        <td><?php echo $command['code_client'] ?></td>
                        <td><?php echo $command['total'] ?></td>
                        <td><?php echo $command['statut'] ?></td>
                        <td>
                            <button type="button"> Suppr </button>
                            <button type="button" onclick="ShowModal('commande', <?php echo $command['id_commande']?>)"> Voir </button>
                            <form method="get"" action="commande_update.php">
                                <input type="submit" value="Modif">
                                <input type="hidden" name ="id" value=<?php echo $command['id_commande']?>>
                            </form>

                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
            <button onclick="location.href='./commande.php';"> Article </button></br>
            <button onclick="location.href='./commande.php';"> Exporter </button></br>
        </div>
    </div>

    <div id="Modal_commande" class="modal">
        <input type="hidden" name ="id">
        <?php
        $command = getArrayAllCommand(1);
        ?>
        <div class="content">
            <span id="Modalclose_commande" class="close">&times;</span>
            <div class="inline">
            <div class="multi panel" style="width: 35%">
                <span>N°: </span><span><?php echo $command['commande']['id_commande']; ?></span><br>
                <br>
                <span>Points Obtenus: </span><span><?php echo $command['commande']['total']; ?></span><br>
                <span>Total: </span><span><?php echo $command['commande']['total']; ?></span><br>
                <span>RAP: </span><span><?php echo $command['commande']['total']-$command['paiement'][0]['Total_paye']; ?></span><br>
                <span>Géré par: </span><span><?php echo $command['commande']['nom']." ".$command['commande']['prenom']; ?></span><br>
            </div>
                <div class="multi panel" style="width: 28%;">
                    <span class="title">Récaptulatif</span>
                        <?php
                        foreach($command['livraison'] as $delivery){
                            ?>
                            <span>• <?php echo $delivery['quantité'] ?>x <?php echo $delivery['nom'] ?></span><br>
                            <span>Prix : </span><span><?php echo $delivery['Prix_remise'] ?></span><br>
                            <span>Statut : </span><span><?php echo $delivery['statut'] ?></span><br>
                            <br>
                            <?php
                        }
                        ?>
                </div>
            <div class="multi panel" style="width: 28%">
                <span class="title">Client</span>
                <span><?php echo $command['commande']['name']; ?></span><br>
                <span>Code: </span><span><?php echo $command['commande']['code_client']; ?></span><br>
                <br>
                <span>Numéro: </span><span><?php echo $command['commande']['Phone']; ?></span><br>
                <span>Membership: </span><span><?php echo $command['commande']['nom']; ?></span><br>
            </div>
                <div class="multi panel" style="width: 30%">
                    <span class="title">Livraison</span>
                    <?php
                    foreach($command['livraison'] as $delivery){
                    ?>
                    <span>Dispatched Date: <span><?php echo $delivery['DateExpédié'] ?></span><br>
                            <span>Parcel N°: <span><?php echo $delivery['numeroColis'] ?></span><br>
                        <br>
                            <span>Arrival Date: <span><?php echo $delivery['dateLivrée'] ?></span><br>
                        <br> --  <br><br>
                        <?php
                        }
                        ?>
                </div>
                <div style="display: flex;flex-direction: column;">
                <div class="multi panel" style="width: auto; height: -webkit-fill-available;">
                    <span class="title">Note</span>
                    <span><?php echo $command['commande']['note'] ?></span>
                </div>
                <div class="multi panel" style="width: 18%;">
                    <button type="button"> Suppr </button>
                    <button type="button"> Suppr </button>
                    <p>Action</p>
                </div>
                </div>
                <div class="multi panel" style="width: 28%">
                    <span class="title">Paiement</span>
                    <?php
                    foreach($command['paiement'] as $paiement){
                    ?>
                    <span>Moyen: <span><?php echo $paiement['nom'] ?></span><br>
                            <span>Date: <span><?php echo $paiement['date'] ?></span><br>
                            <span>  Montant: <span><?php echo $paiement['cout'] ?></span><br>
                        <br>
                        <?php
                        }
                        ?>
                </div>


        </div>

    </div>
    </div>
    <script>InitModal("commande");</script>

</div>

</body>
</html>