
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Client</title>
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
    <script src="JS/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

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

</div>