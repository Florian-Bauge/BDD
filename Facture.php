<?php
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Commande</title>
    <link rel="stylesheet" type="text/css" href="CSS/Facture.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="JS/scriptFacture.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
    <?php
    include 'PHP/Facture_php.php';
    $id=211230002;
    $cpt=0;
    $client=getInfoclient($id);
    $commandeInfo=AddInfoCommande($id);
    $fraisServiceLivaison=FraisService_livraison($id);
    $promotion=Promotion($id)[0]['cout'];
    $prixdepot=PrixdepotTOT($id)['coutDepot'];

    $totalCommande=0;
    $montatFacture=0;
    ?>
</head>
<body>
<div class="page" id="invoice">
<img src="Img/Logo_entreprise.png"> <br>
    <img src="Img/nom_entreprise.png">
<div class="infoClient">
    <span>No.Client : <span><?php echo $client[0]['code_client']?></span></span>
    <span>Client : <span><?php echo $client[0]['name']?></span> </span>
    <span>Adress  : <span><?php echo $client[1]['adresse']?></span></span>
    <span>Phone  : <span><?php echo $client[0]['Phone']?></span></span>
</div>
        <h1 class="titreFacture">Facture</h1>
<div class="infoCommande">
    <span>No.Commande : <span><?php echo $commandeInfo[0]?></span></span>
    <span>Date de commande : <span><?php echo $client[0]['date']?></span> </span>
    <span>Facture numéro : <span><?php echo $commandeInfo[2]?></span></span>
    <span>Date de facture : <span><?php echo $commandeInfo[1]?></span></span>
    <span>Dernière mise à jour : <span><?php echo $commandeInfo[1]?></span></span>
</div>
    <table class="TableProduits">
        <tr class="titreTableau">
            <th style="width: 1.5cm">No.</th>
            <th style="width: 9.6cm">Produit</th>
            <th style="width: 2.4cm;">Quantité</th>
            <th style="width: 2.4cm" >PrixUnité</th>
            <th style="width: 2.4cm">Prix Total</th>
        </tr>
        <?php foreach (getAllitem($id) as $items){ ?>
            <tr class="Item">
                <td class="tableautd1"><?php echo $cpt?></td>
                <?php $cpt++?>
                <td class="tableautd1"><span><?php echo $items['nom_produit']?></span> <span><?php echo $items['prixvente']?></span> </td>
                <td class="tableautd1"><?php echo $items['quantité']?></td>
                <td class="tableautd1"><?php echo $items['PrixUnité']?></td>
                <td class="tableautd1"><?php echo $items['PrixTotal']?>$</td>
                <?php $totalCommande=$totalCommande+$items['PrixTotal']; ?>
            </tr>

        <?php } ?>



        <tr>
            <td style="border-top: 2px solid black;"></td>
            <td  style="border-top: 2px solid black;"></td>
            <td colspan="2"  class="tableau2G">Montant de la commande</td>
            <td class="tableau2D"><?php echo $totalCommande?>$</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan="2" class="tableau2G">Frais de service</td>

            <td class="tableau2D"><?php echo $fraisServiceLivaison[0]['fservice'] ?> $</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td  colspan="2" class="tableau2G">Frais de livraison</td>

            <td class="tableau2D"><?php echo $fraisServiceLivaison[0]['fdelivery'] ?>  $</td>
        </tr>
        <tr>
            <td></td>
            <td class="tableau2Exterieur"></td>
            <td colspan="2"  class="tableau2G"></td>

            <td class="tableau2D"><?php echo $promotion ?>$</td>
        </tr>
        <tr>
            <td></td>

            <td class="tableau2Exterieur">
                <?php foreach (depot($id) as $depot){?><span><?php echo $depot['nom'].' ' ?><?php echo $depot['date'] ?> :<?php echo ' '.$depot['cout'] ?>$</span> <br><?php } ?> </td>
            <td colspan="2"  class="tableau2G">Dépôt</td>

            <td class="tableau2D"><?php echo $prixdepot ?> $</td>
        </tr>
        <tr>
            <td></td>
            <td class="tableau2Exterieur"></td>
            <td style="border-bottom: 2px solid black "  colspan="2"  class="tableau2G">Montant de la facture</td>
            <?php $montatFacture=$fraisServiceLivaison[0]['fservice']+$fraisServiceLivaison[0]['fdelivery']+$totalCommande-$promotion-$prixdepot; ?>
            <td style="border-bottom: 2px solid black " class="tableau2D"><?php echo $montatFacture?> $</td>
        </tr>
    </table>
    <?php
    getAllitem(0)
    ?>




</div>
</body>
</html>
