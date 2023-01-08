<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Commande</title>
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
    <!--<script src="script.js"></script>-->
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
        <button onclick="location.href='./index.html';"> Dashboard </button></br>
        <button onclick="location.href='./commande.php';"> Commande </button></br>
        <button onclick="location.href='./client.html';"> Client </button></br>
    </div>
    <div class="other">
        <div class="content inline">
            <div class="panel title" style="width: 90%; height: 40px;">
                <span> MODIFIER
                    <?php
                        echo $_GET['id'];
                    $command = getArrayAllCommand($_GET['id']);
                    ?>
                </span>
            </div>
            <div class="multi panel" style="width: 35%">
                <span>N°: </span><span><?php echo $command['commande']['id_commande']; ?></span><br>
                <br>
                <span>Points Obtenus: </span><span><?php echo $command['commande']['total']; ?></span><br>
                <span>Total: </span><span><?php echo $command['commande']['total']; ?></span><br>
                <span>RAP: </span><span><?php echo $command['commande']['total']-$command['paiement'][0]['Total_paye']; ?></span><br>
                <span>Géré par: </span><span><?php echo $command['commande']['nom']." ".$command['commande']['prenom']; ?></span><br>
            </div>
            <div class="multi panel" style="width: 28%">
                <span><?php echo $command['commande']['name']; ?></span><br>
                <span>Code: </span><span><?php echo $command['commande']['code_client']; ?></span><br>
                <br>
                <span>Numéro: </span><span><?php echo $command['commande']['Phone']; ?></span><br>
                <span>Membership: </span><span><?php echo $command['commande']['nom']; ?></span><br>
            </div>
            <div class="multi panel" style="width: 28%">
                <span>test</span>
            </div>
            <div class="multi panel" style="width: 45%;">
                <table>
                    <tr>
                        <td class="title">Item</td>
                        <td class="title">Prix</td>
                        <td class="title">Quantité</td>
                        <td class="title">Statut</td>
                        <td class="title">Action</td>

                    </tr>
                    <?php
                    foreach($command['livraison'] as $delivery){
                        ?>
                        <tr>
                            <td><?php echo $delivery['nom'] ?></td>
                            <td><?php echo $delivery['Prix_remise'] ?></td>
                            <td><?php echo $delivery['quantité'] ?></td>
                            <td><?php echo $delivery['statut'] ?></td>
                            <td>
                                <button> Suppr </button>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
            <div class="multi panel" style="width: 40%">
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
        </div>
    </div>
</div>

</body>
</html>