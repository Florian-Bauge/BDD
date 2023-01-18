<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Commande</title>
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
    <script src="JS/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

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
        <div class="headNav">
            <img src="Img/Logo_entreprise.png" class="logoCompanies">
            <img src="Img/nom_entreprise.png" class="nameCompanies">
        </div>
        <button onclick="location.href='./index.html';" class="buttonMenu"><img src="Img/Model=tab, active=false.png"  class="imageMenu"  ></button></br>
        <button onclick="location.href='./commande.php';" class="buttonMenu"> <img src="Img/Model=order, active=true.png"class="imageMenu"  > </button></br>
        <button onclick="location.href='./client.php';" class="buttonMenu"> <img src="Img/Model=client, active=false.png" class="imageMenu" ></button></br>
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
                <span>RAP: </span><span><?php echo $command['commande']['RAP'] ?></span><br>
                <span>Géré par: </span><span><?php echo $command['commande']['cons']; ?></span><br>
            </div>
            <div class="multi panel" style="width: 28%">
                <span><?php echo $command['commande']['name']; ?></span><br>
                <span>Code: </span><span><?php echo $command['commande']['code_client']; ?></span><br>
                <br>
                <span>Numéro: </span><span><?php echo $command['commande']['Phone']; ?></span><br>
                <span>Membership: </span><span><?php echo $command['commande']['nom']; ?></span><br>
            </div>
                <button class="button_panel" onclick="ShowModal('add_paiement');"> Ajouter </button>
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
                    foreach($command['contenu'] as $delivery){
                        ?>
                        <tr>
                            <td><?php echo $delivery['nom'] ?></td>
                            <td><?php echo $delivery['Prix_remise'] ?></td>
                            <td><?php echo $delivery['quantité'] ?></td>
                            <td><?php echo $delivery['statut'] ?></td>
                            <td>
                                <button > Suppr </button>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
                <button onclick="ShowModal('item')"> Ajouter </button>
            </div>
            <div class="multi panel" style="width: 40%">
                    <?php
                    foreach($command['livraison'] as $delivery){
                        ?>
                    <span>Dispatched Date: <span><?php echo $delivery['DateExpédié'] ?></span><br>
                            <span>Parcel N°: <span><?php echo $delivery['numeroColis'] ?></span><br>
                                <span>Adresse: <span><?php echo $delivery['adresse'] ?></span><br>
                        <br>
                                    <span>Arrival Date: </span><input type='date' <?php if($delivery['dateLivrée']!=null){echo 'disabled';} ?>
                                                                      value='<?php echo $delivery['dateLivrée'] ?>' oninput="UpdateArrivalDate(this, '<?php echo $delivery['id_delivery'] ?>');"/><br>
                        <br>
                        <?php
                    }
                    ?>
                                <button onclick="ShowModal('add_livraison');"> Ajouter </button>
            </div>
        </div>
    </div>
    <div id="Modal_add_livraison" class="modal">
        <div class="panel pmodal">
            <span id="Modalclose_add_livraison" class="close">&times;</span>
            <?php
            $address = getAdresses($command['commande']['code_client']);
            ?>
                    <span class="title">Livraison</span>
            <form name="ModalForm" action="javascript:void(0);" onsubmit="return ValidateLivraison()"> <!--javascript:void(0);-->
                        <span>Dispatched Date: </span><input required type='date' id="Modal_DateExpédié"/><br>
                        <span>Parcel N°: </span><input required id='Modal_numeroColis'/><br>
                        <span>Adresse: </span><br>
                        <select id="Modal_address">
                            <?php
                            foreach($address as $adr){
                            ?>
                            <option value=<?php echo $adr['id_adresse'] ?>><?php echo $adr['adresse'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                <br>
                        <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" />
                <br>
                <span>Article à livrer: </span><br>
                <?php
                foreach($command['contenu'] as $delivery){
                    if($delivery['numeroColis'] == null){
                    ?>
                        <input type="checkbox" name="Modal_items" value="<?php echo $delivery['id_item']?>"/>
                        <label for="Modal_items"><?php echo $delivery['nom']?></label>
                    <br>
                    <?php
                    }
                }
                ?><br>
                        <input type='submit' value="Valider"/>
            </form>

        </div>
    </div>
    <script>InitModal("add_livraison");</script>

    <div id="Modal_add_paiement" class="modal">
        <div class="panel pmodal">
            <span id="Modalclose_add_paiement" class="close">&times;</span>
            <span class="title">Paiement</span>
            <form name="ModalForm" action="" onsubmit="return ValidatePaiement(<?php echo $_GET['id'] ?>);"> <!--javascript:void(0);-->
                <span>Moyen de paiement: </span><br>
                <select id="Modal_paiement_Moyen" onchange="UpdatePaiementModal(this)">
                    <?php
                    foreach(getMoyen() as $moyen){
                        ?>
                        <option value=<?php echo $moyen['id_transaction'] ?>><?php echo $moyen['nom'] ?></option>
                        <?php
                    }
                    ?>
                </select>
                <br>
                <br>
                <div id="Modal_1"  name="Modal_paiement_content">
                <span>Montant: </span><input  type="number" required id='Modal_cout'/><br>
                <br>
                </div>
                <div id="Modal_2"  name="Modal_paiement_content" style="display:none">
                    <span><?php echo $command['commande']['point']; ?> points Disponibles</span><br>
                    <select id="Modal_paiement_Regle">
                        <?php
                        foreach(getRègles() as $regles){

                            if(strtotime($regles['dateExp']) > time() and $regles['id_membership'] == $command['commande']['id_membership']){
                                ?>
                                <option value=<?php echo $regles['id_regle'] ?>><?php echo $regles['intitule'] ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                    <br>
                </div>
                <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" />
                <br>
                <input type='submit' value="Valider"/>
            </form>

        </div>
    </div>
    <script>InitModal("add_paiement");</script>

    <div id="Modal_item" class="modal">
        <div class="panel pmodal">
            <span id="Modalclose_item" class="close">&times;</span>
            <form name="ModalForm">
                <span>Item</span><br>
                <div style="white-space: nowrap;margin-right: 25px;"><input id="Panel_Modal_item_id" type="text" placeholder="Rechercher" onchange="UpdateItemInterface(this.value)" >
                <input id="Panel_checkbox_item" type="checkbox" onchange="UpdateItemcheckbox()"> <span>Créer nouveau</span>
                </div><br>
                <input id="Panel_Modal_item_recherche" class="span" readonly onchange="resizeInput(this)" type="text" placeholder=" ">

                 <br>
                <span>Information item</span><br>
                <span> Prix d'achat (€):</span> <input class="span" readonly onchange="resizeInput(this)" type="number"id="Panel_Modal_item_prix_achat" name=""> <br>
                <span> Prix de vente conseillé (€):</span> <input class="span" readonly onchange="resizeInput(this)" type="number" id="Panel_Modal_item_prix_vente"> <br>
                <span> Statuts</span>
                <select  name="select" id="Panel_Modal_item_statuts" disabled>
                    <option value=""> Select type</option>
                    <option selected value="En stock">En stock</option>
                    <option value="Vide">vide</option>
                    <option value="Test">Test</option>
                </select> <br>
                <select name="select" id="Panel_Modal_item_Membership" disabled>
                    <?php
                    foreach(getArrayAllMembership() as $Membership){
                        ?>
                        <option value=<?php echo $Membership['id_membership'] ?>> <?php echo $Membership['nom'] ?></option>
                    <?php }?>
                </select> <br>
                <span> Stock: </span> <input class="span" readonly onchange="resizeInput(this)" type="text" id="Panel_Modal_item_stock"><br>
                <div class="trait"></div>
                <input type="image" src="Img/buttonValiderCompte.png" onclick="updateItemBDD()">


            </form>
        </div>


    </div>
    <script>InitModal("item");</script>
    <script>InitAutoComplete();</script>
</div>

</body>
</html>