<?php

include "global.php";

if (isset($_POST['cmd']) and $_POST['cmd']=='commande') {

    $array = array();

    $mysqli = Connect();

    //Récupération Information de Commande et de Client

    $sql = "SELECT note, id_commande, commande.total, total-coalesce((SELECT sum(cout) from paiement where id_commande = ".$_POST['id']."),0) AS RAP, CONCAT(concierge.nom,' ',concierge.prenom) AS cons, client.name, client.code_client, client.Phone, grillePoint.nom from commande
    LEFT OUTER JOIN client ON commande.code_client=client.code_client 
    LEFT OUTER JOIN concierge ON concierge.id_con=commande.id_con
    LEFT OUTER JOIN GrillePoint ON client.id_membership=grillepoint.id_membership
    WHERE commande.id_commande = ".$_POST['id']."
;";
    $array['commande'] = array();
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_assoc()){
            $array['commande'] = $row;
        };
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    //Récupération Information de Paiement

    $sql = "SELECT date, cout, nom from paiement 
    LEFT OUTER JOIN moyen ON moyen.id_transaction = paiement.id_transaction
    WHERE paiement.id_commande = ".$_POST['id']."
;";
    $array['paiement'] = array();
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_assoc()){
            $array['paiement'][] = $row;
        };
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    //Récupération Information de Livraison

    $sql = "SELECT numeroColis, dateVoulu, dateLivrée, DateExpédié, livraison.status, nrue || ' ' || rue || ' ' || adresse.codepostal || ' ' || ville  || ' ' || pays  || ' ' || infoComp AS adresse from livraison
    LEFT OUTER JOIN adresse on livraison.id_adresse = adresse.id_adresse
    LEFT OUTER JOIN envoie on livraison.id_delivery = envoie.id_livraison                                                                                                                                                                              
    WHERE envoie.id_commande = ".$_POST['id']."
;";
    $array['livraison'] = array();
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_assoc()){
            $array['livraison'][] = $row;
        };
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    //Récupération Information de contenu de commande

    $sql = "SELECT item.nom, Prix_remise, envoie.statut, quantité, numeroColis from envoie 
    LEFT OUTER JOIN item ON envoie.id_item=item.id_item
    LEFT OUTER JOIN livraison ON envoie.id_livraison=livraison.id_delivery
    WHERE envoie.id_commande = ".$_POST['id']."
;";
    $array['contenu'] = array();
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_assoc()){
            $array['contenu'][] = $row;
        };
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }


    $result->close();
    //echo $array[0]['Name'];
   echo json_encode($array);


    //echo json_encode(array('success' => $_POST['id']));
    unset($_POST['cmd']);


}

if (isset($_POST['cmd']) and $_POST['cmd']=='insertAndUpdateLivraison') {
    $mysqli = Connect();

    $sql = 'INSERT INTO livraison (DateExpédié, numeroColis, id_adresse) VALUES ("'.$_POST['data'][0].'","'.$_POST['data'][1].'","'.$_POST['data'][2].'");';


    if ($mysqli->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    $id_livraison = $mysqli->insert_id;

    $sql = 'UPDATE envoie SET id_livraison = '.$id_livraison.' WHERE envoie.id_item IN(';

    foreach ($_POST['data'][3] as $id_envoie){
        $sql = $sql.$id_envoie.',';
    }

    $sql = rtrim($sql, ",");
    $sql = $sql.');';


    if ($mysqli->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }


    Disconnect($mysqli);

    unset($_POST['cmd']);
}

if (isset($_POST['cmd']) and $_POST['cmd']=='UpdateArrivalDate') {
    $mysqli = Connect();


    $sql = 'UPDATE livraison SET dateLivrée = "'.$_POST['date'].'" WHERE livraison.id_delivery = '.$_POST['id'].';';

    if ($mysqli->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    Disconnect($mysqli);

    unset($_POST['cmd']);
}


if (isset($_POST['cmd']) and $_POST['cmd']=='account_client'){
    $array = array();

    $mysqli = Connect();

    $sql="SELECT `code_client`,`name`,`Email`,`Phone`,`Instagram`,`Facebook` FROM `client` WHERE `code_client`=".$_POST['id'].";";
    $array['account_client'] = array();
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_assoc()){
            $array['account_client']= $row;
        };
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }



    $sql="SELECT CONCAT(nrue,' ', rue ,' ', codepostal,' ',ville,', ',pays,' ',infoComp) AS adresse FROM `adresse` WHERE `code_client`=".$_POST['id'].";";
    $array['adress'] = array();
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_assoc()){
            $array['adress'][]= $row;
        };
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    $sql="SELECT
        points.point,
        points.dateExp,
        grillepoint.nom,
        grillepoint.id_membership
    FROM
        grillepoint
    JOIN CLIENT ON CLIENT
        .id_membership = grillepoint.id_membership
    JOIN points ON points.code_client = CLIENT.code_client
    WHERE CLIENT.code_client=".$_POST['id'].";";
    $array['Membership'] = array();
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_assoc()){
            $array['Membership']= $row;
        };
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    $sql = "SELECT
    paiement.date,
    paiement.cout,
    moyen.nom AS moyen_nom
FROM
    paiement
LEFT OUTER JOIN moyen ON moyen.id_transaction = paiement.id_transaction
LEFT OUTER JOIN commande ON commande.id_commande = paiement.id_commande
LEFT OUTER JOIN CLIENT ON CLIENT
    .code_client = commande.code_client
WHERE CLIENT
    .code_client = ".$_POST['id']."
;";
    $array['paiement'] = array();
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_assoc()){
            $array['paiement'][] = $row;
        };
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }


    $result->close();


    echo json_encode($array);

    Disconnect($mysqli);

    unset($_POST['cmd']);
}
if (isset($_POST['cmd']) and $_POST['cmd']=='createaccountclient'){


    $mysqli = Connect();
    $sql='INSERT INTO client (name, Email, Phone, Instagram, Facebook, id_membership, point) VALUES("'.$_POST['data'][0].'","'.$_POST['data'][1].'","'.$_POST['data'][2].'","'.$_POST['data'][3].'","'.$_POST['data'][4].'","'.$_POST['data'][5].'","'.$_POST['data'][6].'");';
    if ($mysqli->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    $id_client=$mysqli->insert_id;
    echo 'console.log('.$id_client.');';
    foreach ($_POST['data'][7] as $sendAdresse)
    {
        $sql='INSERT INTO adresse (nrue,typeRue, rue, codepostal, ville, pays, infoComp, code_client) VALUES("'.$sendAdresse[0].'","'.$sendAdresse[1].'","'.$sendAdresse[2].'","'.$sendAdresse[3].'","'.$sendAdresse[4].'","'.$sendAdresse[5].'","'.$sendAdresse[6].'","'.$id_client.'");';
        if ($mysqli->query($sql) === FALSE) {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    }






    Disconnect($mysqli);

    unset($_POST['cmd']);
}


?>