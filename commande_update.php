<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Commande</title>
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
    <script src="JS/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
                                <button> Suppr </button>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
                <button> Ajouter </button>
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
            <?php
            $address = getAdresses($command['commande']['code_client']);
            ?>
            <span class="title">Livraison</span>
            <form name="ModalForm" action="javascript:void(0);" onsubmit="return ValidateLivraison()"> <!--javascript:void(0);-->
                <span>Moyen de paiement: </span><br>
                <select id="Modal_address" onchange="UpdatePaiementModal()">
                    <?php
                    foreach($address as $adr){
                        ?>
                        <option value=<?php echo $adr['id_adresse'] ?>><?php echo $adr['adresse'] ?></option>
                        <?php
                    }
                    ?>
                </select>
                <br>
                <div id="Montant">
                <span>Montant: </span><input  type="number" required id='Modal_numeroColis'/><br>
                <br>
                </div>
                <div id="Chèque-cadeaux">
                    <span>Montant: </span><input  type="number" required id='Modal_numeroColis'/><br>
                    <br>
                </div>
                <div id="Pourcentage">
                    <span>Montant: </span><input  type="number" required id='Modal_numeroColis'/><br>
                    <br>
                </div>
                <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" />
                <br>
                <br>
                <input type='submit' value="Valider"/>
            </form>

        </div>
    </div>
    <script>InitModal("add_paiement");</script>
</div>

</body>
</html>