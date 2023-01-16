<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Commande</title>
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="JS/script.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
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
            <img src="Img/Logo_entreprise.png" class="logoCompanies">
            <img src="Img/nom_entreprise.png" class="nameCompanies">
       </div>
       <button onclick="location.href='./index.html';" class="buttonMenu"><img src="Img/Model=tab, active=false.png"  class="imageMenu"  ></button></br>
       <button onclick="location.href='./commande.php';" class="buttonMenu"> <img src="Img/Model=order, active=true.png"class="imageMenu"  > </button></br>
       <button onclick="location.href='./client.php';" class="buttonMenu"> <img src="Img/Model=client, active=false.png" class="imageMenu" ></button></br>
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
                            <button type="button" onclick="ShowModalWith('commande', <?php echo $command['id_commande']?>)"> Voir </button>

                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
            <input type="image" src="Img/button_article.png" onclick="ShowModal('item')">
            <input type="image" src="Img/button_Export.png" onclick="">

        </div>
    </div>

    <div id="Modal_commande" class="modal">
        <div class="content">
            <span id="Modalclose_commande" class="close">&times;</span>
            <div class="inline">
            <div class="multi panel" style="width: 35%">
                <span>N°: </span><span name="Modal_id_commande"></span><br>
                <br>
                <span>Points Obtenus: </span><span name='Modal_total'></span><br>
                <span>Total: </span><span name='Modal_total'></span><br>
                <span>RAP: </span><span name='Modal_RAP'></span><br>
                <span>Géré par: </span><span name='Modal_cons'></span><br>
            </div>
                <div class="multi panel" style="width: 28%;">
                    <span class="title">Récaptulatif</span>
                    <div id="contenu" style="display:none;">  <!--Example for Copy-->
                        <span>• <span name="Modal_quantité">1</span>x <span name="Modal_nom">1</span></span><br>
                        <span>Prix : </span><span name="Modal_Prix_remise">1</span><br>
                        <span>Statut : </span><span name="Modal_statut">1</span><br>
                        <br>
                    </div>
                </div>
            <div class="multi panel" style="width: 28%">
                <span class="title">Client</span>
                <span name='Modal_name'></span><br>
                <span>Code: </span><span name='Modal_code_client'></span><br>
                <br>
                <span>Numéro: </span><span name='Modal_Phone'></span><br>
                <span>Membership: </span><span name='Modal_nom'></span><br>
            </div>
                <div class="multi panel" style="width: 30%">

                    <span class="title">Livraison</span>
                        <div id="livraison" style="display:none;">  <!--Example for Copy-->
                        <span>Dispatched Date: </span><span class="test" name='Modal_DateExpédié'>1</span><br>
                        <span>Parcel N°: </span><span name='Modal_numeroColis'>2</span><br>
                        <br>
                            <span>Arrival Date: </span><span name='Modal_dateLivrée'>3</span><br>
                        </div>
                        <br> --  <br>

                </div>
                <div style="display: flex;flex-direction: column;">
                <div class="multi panel" style="width: auto; height: -webkit-fill-available;">
                    <span class="title">Note</span>
                    <span name='Modal_note'></span>
                </div>
                <div class="multi panel" style="width: 18%;">
                    <form id="form_update" method="get" action="commande_update.php">
                    <input type="hidden" name ="id" id="form_update_id" value="null">
                    </form>
                    <button type="button" onclick="submitFormAndRedirect('form_update','Modal_id_commande');"> Modif </button>
                    <button type="button"> Suppr </button>
                    <p>Action</p>
                </div>
                </div>
                <div class="multi panel" style="width: 28%">
                    <span class="title">Paiement</span>
                    <div id="paiement" style="display:none;">  <!--Example for Copy-->
                    <span>Moyen: <span name='Modal_nom'></span><br>
                            <span>Date: <span name='Modal_date'></span><br>
                            <span>  Montant: <span name='Modal_cout'></span><br>
                        <br>
                </div>
                </div>


        </div>

    </div>
    </div>
    <script>InitModal("commande");</script>
    <div id="Modal_item" class="modal">
            <div class="panel pmodal">
            <span id="Modalclose_item" class="close">&times;</span>
                <form name="ModalForm">
        <span>Item</span><br>
            <input id="Panel_Modal_item_id" type="text" placeholder="Rechercher" onchange="UpdateItem(this.value)" style="display: flex" > <br>
            <input id="Panel_Modal_item_recherche" type="text" placeholder=" ">

                <input id="Panel_checkbox_item" type="checkbox" onchange="UpdateItemcheckbox()"> <span>Créer nouveau</span> <br>
            <span>Information item</span> <span name="Modal_id_item"<br>
            <span> Prix d'achat</span> <input type="text"id="Panel_Modal_item_prix_achat" name=""> <span>€</span> <br>
            <span> Prix de vente conseillé </span> <input type="text" id="Panel_Modal_item_prix_vente"> <span>€</span> <br>
            <span> Statuts</span>
            <select id="Panel_Modal_item_statuts">
                <option value=""> Select type</option>
                <option value="En stock">En stock</option>
                <option value="Vide">vide</option>
                <option value="Test">Test</option>
            </select> <br>
            <span> Stock </span> <input type="text" id="Panel_Modal_item_stock"> <span>€</span> <br>
            <div class="trait"></div>
            <input type="image" src="Img/buttonValiderCompte.png">


                </form>
            </div>


    </div>
    <script>InitModal("item");</script>
    <script>InitAutoComplete();</script>

</div>

</body>
</html>