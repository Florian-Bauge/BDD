<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Client</title>
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
    <script src="JS/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <?php
            include 'PHP/client_php.php';
        ?>
</head>
<body>

<div class="header">
    <div class="search">
        <input class="search" id="search_text" type="text" placeholder="Recherche..." name="text" value=""/>
        <button type="submit" name="submit" id="search_button" class="search"><img class="search" id="search_img" src="Img/Search_button.png" alt="" /></button>
    </div>
</div>
<div class="page">
    <div class="nav">
        <div class="headNav">
            <img src="Img/Logo_entreprise.png" class="logoCompanies">
            <img src="Img/nom_entreprise.png" class="nameCompanies">
        </div>
        <button onclick="location.href='./index.html';" class="buttonMenu"><img src="Img/Model=tab, active=false.png"  class="imageMenu"  ></button></br>
        <button onclick="location.href='./commande.php';" class="buttonMenu"> <img src="Img/Model=order, active=false.png"class="imageMenu"  > </button></br>
        <button onclick="location.href='./client.php';" class="buttonMenu"> <img src="Img/Model=client, active=true.png" class="imageMenu"> </button></br>
    </div>
    <div class="other">
        <div class="content">
            <div class="panel">
            <table>

                    <tr>
                        <td class="title">Id Client</td>
                        <td class="title">Nom</td>
                        <td class="title">Mail</td>
                        <td class="title">Numéro</td>
                        <td class="title">Membership</td>
                        <td class="title">Action</td>
                        </tr>

                <?php
                foreach (getArrayClient() as $client) {
                    ?>
                <tr>
                    <td><?php echo $client['code_client']?></td>
                    <td><?php echo $client['name']?></td>
                    <td><?php echo $client['Email']?></td>
                    <td><?php echo $client['Phone']?></td>
                    <td><?php echo $client['nom']?></td>
                    <td>
                        <input type="image" src="Img/button_research.png" onclick="client_profil('account_client','<?php echo $client['code_client']?>','false')">
                        <input type="image" src="Img/button_edit.png" onclick="client_profil('account_client',<?php echo $client['code_client']?>,'true')">
                    </td>
                </tr>
                <?php
                }
                ?>
            </table>
            </div>
            <input type="image" src="Img/button_Creer.png" onclick="ShowModal('add_client')">
            <input type="image" src="Img/button_Export.png">
        </div>
    </div>
    <div id="Modal_add_client" class="modal">
        <div class="panel pmodal">
            <form name="ModalForm">
            <span id="Modalclose_add_client" class="close">&times;</span>

            <span class="title">Créer un compte</span>
            <p class="TitreNewCompte">Membership </p><br>
                <span> Ultimate </span><input type="checkbox" id="Modal_NewCompte_Ulti">
            <p class="TitreNewCompte">Nom </p>
            <input required id="Modal_NewCompte_nom">
            <p class="TitreNewCompte">Mail </p>
            <input required type="email" id="Modal_NewCompte_mail">
            <p class="TitreNewCompte">Téléphone </p>
            <input required type="tel" id="Modal_NewCompte_tel"><br>
            <img src="Img/logo_Insta.png">
            <input  type="text" id="Modal_NewCompte_Insta">
            <img src="Img/logo_Facebook.png">
            <input required type="text" id="Modal_NewCompte_Facebook">
            <p class="TitreNewCompte">Adresse </p>
            <input type="text" name="Modal_temp_NewCompte_adress_" placeholder="20 rue Jean Moulin 72000 Le mans, FRANCE" class="InputAdressModal"> <br>
            <input type="image" src="Img/buttonAddAdress.png" onclick="AddAdress('Modal_temp_NewCompte_adress_')"> <br>
            <input type="image" src="Img/buttonValiderCompte.png" onclick="CreateAccount()">
            </form>


        </div>
    </div>
    <script>InitModal("add_client");</script>
    <div id="Modal_account_client" class="modal">
        <div class="content">
            <span id="Modalclose_account_client" class="close">&times;</span> <br>
            <div class="panel_client">
            <input type="image" src="Img/button_edit.png"  id="Modal_client_valid_edit">
                <span class="titlePanel">Client</span>

                <p class="TitreNewCompte">Code</p>
                <span class="Client_span_info" name="Modal_code_client" id="Modal_client_span_code" contenteditable="false"></span> <br>
                <p class="TitreNewCompte">Nom </p>
                <span class="Client_span_info" name="Modal_name" id="Modal_client_span_nom"  contenteditable="false"></span> <br>


                <p class="TitreNewCompte">Mail </p>
                <span class="Client_span_info" name="Modal_Email" id="Modal_client_span_email" contenteditable="false"></span> <br>
                <p class="TitreNewCompte">Téléphone </p>
                <span class="Client_span_info" name="Modal_Phone" id="Modal_client_span_phone" contenteditable="false"></span> <br>
                <img src="Img/logo_Insta.png">
                <span class="Client_span_info" name="Modal_Instagram" id="Modal_client_span_insta" contenteditable="false"></span> <br>
                <img src="Img/logo_Facebook.png">
                <span class="Client_span_info" name="Modal_Facebook" id="Modal_client_span_facebook" contenteditable="false"></span> <br>
                <p class="TitreNewCompte">Adresse </p>
                <div id="adress" style="display:none;">  <!--Example for Copy-->
                            <span name='Modal_adresse' contenteditable="false"></span><br>

                        <br>
                </div>

                <input  id="Modal_client_button_add_adress" type="image" src="Img/buttonAddAdress.png" style="display: none" onclick="AddAdress('Modal_adresse')">



            </div>
            <div class="panel_membership">
                <span class="titlePanel">Membership</span> <br>
                <img id="Panel_Img_Membership" src="Img/Membership=0.png">
                <span name="Modal_nom"></span><br>
                <span name="Modal_id_membership" id="Modal_id_Membership"></span>
                <span name="Modal_point"> <span> points</span></span><br>
                <span name="Modal_dateExp"></span><br>


            </div>
            <div class="panel_historrique_paiments">
                <span> Historique de paiments </span>
                <div id="paiement" style="display:none;">  <!--Example for Copy-->
                    <span class="panel_historrique_paiments_date" name='Modal_date' > </span>
                    <span class="panel_historrique_paiments_moyen" name='Modal_moyen_nom'></span>
                    <div class="panel_historrique_paiments_cout">
                    <span  name='Modal_cout'></span> <span >€</span>
                    </div>

                    <br>
                </div>
            </div>


        <input type="image" src="Img/button_create_commande.png">
            <input type="image" src="Img/button_Export.png">
        </div>
    </div>
    <script>InitModal("account_client");</script>

</div>

</body>
</html>