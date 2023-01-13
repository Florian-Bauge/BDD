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
                        <input type="image" src="Img/button_research.png" onclick="ShowModalWith('account_client', <?php echo $client['code_client']?>)">
                        <input type="image" src="Img/button_edit.png">
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
            <select id="Modal_NewCompte_Select_Membership">
                <option value="1">Silver</option> //php à faire
                <option value="2">Gold</option>
            </select>
            <input required type='date' id="Modal_NewCompte_DateMembership"/><br>
            <p class="TitreNewCompte">Nom </p>
            <input required id="Modal_NewCompte_nom">
            <p class="TitreNewCompte">Mail </p>
            <input required type="email" id="Modal_NewCompte_mail">
            <p class="TitreNewCompte">Téléphone </p>
            <input required type="tel" id="Modal_NewCompte_tel"><br>
            <img src="Img/logo_Insta.png">
            <input  type="text" id="Modal_NewCompte_Insta">
            <img src="Img/logo_Facebook.png">
            <input type="text" id="Modal_NewCompte_Facebook">
            <p class="TitreNewCompte">Adresse </p>
            <input type="text" name="Modal_temp_NewCompte_adress_" placeholder="20 rue Jean Moulin 72000 Le mans, FRANCE" class="InputAdressModal"> <br>
            <input type="image" src="Img/buttonAddAdress.png" onclick="AddAdress()"> <br>
            <input type="image" src="Img/buttonValiderCompte.png" onclick="CreateAccount()">
            </form>


        </div>
    </div>
    <script>InitModal("add_client");</script>
    <div id="Modal_account_client" class="modal">
        <div class="panel pmodal">
            <div class="Modal_acount_client_panel">
            <input type="image" src="Img/button_edit.png">
                <span class="title">Client</span>
                <span id="Modalclose_account_client" class="close">&times;</span> <br>
                <p class="TitreNewCompte">Code</p>
                <input type="text" placeholder=""disabled id="Modal_account_client_code"> <br>
                <p class="TitreNewCompte">Nom </p>
                <input required id="Modal_account_cliente_nom" placeholder="" disabled>
                <p class="TitreNewCompte">Mail </p>
                <input required type="email" id="Modal_account_client_mail" placeholder="" disabled>
                <p class="TitreNewCompte">Téléphone </p>
                <input required type="tel" id="Modal_account_client_tel" placeholder="" disabled><br>
                <img src="Img/logo_Insta.png">
                <input  type="text" id="Modal_account_client_Insta" placeholder="" disabled>
                <img src="Img/logo_Facebook.png">
                <input type="text" id="Modal_account_client_Facebook" placeholder="" disabled>
                <p class="TitreNewCompte">Adresse </p>
                <input type="text" name="Modal_temp_NewCompte_adress_" placeholder="" disabled class="InputAdressModal"> <br>


            </div>
            <div class="Modal_Membership_panel">

            </div>
            <div class="Modal_Historique_panel">

            </div>


        </div>
    </div>
    <script>InitModal("account_client");</script>

</div>

</body>
</html>