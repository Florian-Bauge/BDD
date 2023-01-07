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
            <div class="multi panel" style="width: 35%; height: 200px;">
                <span>N°: </span><span><?php echo $command[0]['id_commande']; ?></span><br>
                <br>
                <span>Points Obtenus: </span><span><?php echo $command[0]['point']; ?></span><br>
                <span>Total: </span><span><?php echo $command[0]['total']; ?></span><br>
                <span>RAP: </span><span>N°</span><br>
                <span>Géré par: </span><span><?php echo $command[0]['nom']." ".$command[0]['prenom']; ?></span><br>
            </div>
            <div class="multi panel" style="width: 28%; height: 200px;">
                <span>test</span>
            </div>
            <div class="multi panel" style="width: 28%; height: 200px;">
                <span>test</span>
            </div>
            <div class="multi panel" style="width: 45%; height: 200px;">
                <span>test</span>
            </div>
            <div class="multi panel" style="width: 40%; height: 200px;">
                <span>test</span>
            </div>
        </div>
    </div>
</div>

</body>
</html>