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
</head>
<body>
<div class="page" id="invoice">
<img src="Img/Logo_entreprise.png"> <br>
    <img src="Img/nom_entreprise.png">
<div class="infoClient">
    <span>No.Client : <span>19-SPR-0302</span></span>
    <span>Client : <span>Baptiste</span> </span>
    <span>Adress  : <span>20 rue des Augustins</span></span>
    <span>Phone  : <span>0620231625</span></span>
</div>
        <h1 class="titreFacture">Facture</h1>
<div class="infoCommande">
    <span>No.Commande : <span>19-SPR-0302</span></span>
    <span>Date de commande : <span>02-NOv-2022</span> </span>
    <span>Facture numéro : <span>02155545</span></span>
    <span>Date de facture : <span>05-Dec-2022</span></span>
    <span>Dernière mise à jour : <span>05-Dec-2022</span></span>
</div>
    <table class="TableProduits">
        <tr class="titreTableau">
            <th style="width: 1.5cm">No.</th>
            <th style="width: 9.6cm">Produit</th>
            <th style="width: 2.4cm;">Quantité</th>
            <th style="width: 2.4cm" >PrixUnité</th>
            <th style="width: 2.4cm">Prix Total</th>
        </tr>
        <tr class="Item">
            <td class="tableautd1">1</td>
            <td class="tableautd1">Caudalie Dio Levre Main : 13$</td>
            <td class="tableautd1">1</td>
            <td class="tableautd1">13.00 $</td>
            <td class="tableautd1">13.00 $</td>
        </tr>
        <tr class="Item">
            <td class="tableautd1">1</td>
            <td class="tableautd1">Caudalie Dio Levre Main : 13$</td>
            <td class="tableautd1">1</td>
            <td class="tableautd1">13.00 $</td>
            <td class="tableautd1">13.00 $</td>
        </tr>


        <tr>
            <td style="border-top: 2px solid black;"></td>
            <td  style="border-top: 2px solid black;"></td>
            <td colspan="2"  class="tableau2G">Montant de la commande</td>
            <td class="tableau2D">460.00 $</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan="2" class="tableau2G">Frais de service</td>

            <td class="tableau2D">0.00 $</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td  colspan="2" class="tableau2G">Frais de livraison</td>

            <td class="tableau2D">0.00 $</td>
        </tr>
        <tr>
            <td></td>
            <td class="tableau2Exterieur">Promotion to apply next purchase -10$</td>
            <td colspan="2"  class="tableau2G">Promotion/Remise</td>

            <td class="tableau2D">0.00 $</td>
        </tr>
        <tr>
            <td></td>
            <td class="tableau2Exterieur"><span>Bank deposit 06/12/2020 : 100$</span><br> <span> Cash deposit 06/12/2020:14$</span></td>
            <td colspan="2"  class="tableau2G">Dépôt</td>

            <td class="tableau2D">114.00 $</td>
        </tr>
        <tr>
            <td></td>
            <td class="tableau2Exterieur"></td>
            <td style="border-bottom: 2px solid black "  colspan="2"  class="tableau2G">Montant de la facture</td>

            <td style="border-bottom: 2px solid black " class="tableau2D">346.00 $</td>
        </tr>
    </table>





</div>
</body>
</html>
