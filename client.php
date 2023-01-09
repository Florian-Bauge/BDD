<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Client</title>
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
    <!--<script src="script.js"></script>-->
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
                    <td><?php echo $client['id_membership']?></td>
                    <td>
                        <button type="button">Search</button>
                        <button type="button">Edit</button>
                    </td>
                </tr>
                <?php
                }
                ?>
            </table>
            </div>

            <button >Créer</button>
            <button>Exporter</button>
        </div>
    </div>
</div>

</body>
</html>