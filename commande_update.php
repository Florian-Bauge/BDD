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
                    <tr>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
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
                            <form method="post" action="commande_update.php">
                                <button type="submit"> Modif </button>
                            </form>
                            <button> Suppr </button>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
            <button onclick="location.href='./commande.php';"> Article </button></br>
            <button onclick="location.href='./commande.php';"> Exporter </button></br>
        </div>
    </div>
</div>

</body>
</html>