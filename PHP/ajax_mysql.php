<?php

include "global.php";

if (isset($_POST['cmd']) and $_POST['cmd']=='commande') {

    $array = array();

    $mysqli = Connect();

    //Récupération Information de Commande et de Client

    $sql = "SELECT note, id_commande, commande.total ,commande.total+commande.fdelivery+fservice AS totalCmd, fdelivery,fservice, total+commande.fdelivery+fservice-coalesce((SELECT sum(cout) from paiement where id_commande = ".$_POST['id']."),0) AS RAP, CONCAT(concierge.nom,' ',concierge.prenom) AS cons, client.name, client.code_client, client.Phone, grillePoint.nom from commande
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
        Sendlog("Error: " . $sql . "<br>" . $mysqli->error);
    }

    //Récupération Information de Livraison

    $sql = "SELECT numeroColis, dateLivrée, DateExpédié, CONCAT(nrue,' ',typeRue,' ',rue,' ',adresse.codepostal,' ',ville,' ',pays,' ',infoComp) AS adresse from livraison
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
        Sendlog("Error: " . $sql . "<br>" . $mysqli->error);
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
        Sendlog("Error: " . $sql . "<br>" . $mysqli->error);
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
        Sendlog("Error: " . $sql . "<br>" . $mysqli->error);
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
        Sendlog("Error: " . $sql . "<br>" . $mysqli->error);
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



    $sql="SELECT CONCAT(nrue,' ',typeRue,' ', rue ,' ', codepostal,' ',ville,', ',pays,' ',infoComp) AS adresse,id_adresse FROM `adresse` WHERE `code_client`=".$_POST['id'].";";
    $array['adress'] = array();
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_assoc()){
            $array['adress'][]= $row;
        };
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    $sql="SELECT
        client.point,
        grillepoint.nom,
        grillepoint.id_membership
    FROM
        grillepoint
    JOIN CLIENT ON CLIENT
        .id_membership = grillepoint.id_membership
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
//        $sql='INSERT INTO adresse (nrue,typeRue, rue, codepostal, ville, pays, infoComp, code_client) VALUES("'.$_POST['data'][7][0].'","'.$_POST['data'][7][1].'","'.$_POST['data'][7][2].'","'.$_POST['data'][7][3].'","'.$_POST['data'][7][4].'","'.$_POST['data'][7][5].'","'.$_POST['data'][7][6].'","'.$_POST['data'][7][0].'");';
//    if ($mysqli->query($sql) === FALSE) {
//        echo "Error: " . $sql . "<br>" . $mysqli->error;
//    }


    foreach ($_POST['data'][7] as $sendAdresse)
    {
        $sql='INSERT INTO adresse (nrue,typeRue, rue, codepostal, ville, pays, infoComp) VALUES("'.$sendAdresse[0].'","'.$sendAdresse[1].'","'.$sendAdresse[2].'","'.$sendAdresse[3].'","'.$sendAdresse[4].'","'.$sendAdresse[5].'","'.$sendAdresse[6].'");';
        if ($mysqli->query($sql) === FALSE) {
            echo "Error: " . $sql . "<br>" . $mysqli->error;}
        }
    echo  "Succes";







    Disconnect($mysqli);

    unset($_POST['cmd']);
}
if (isset($_POST['cmd']) and $_POST['cmd']=='updateaccountclient'){


    $mysqli = Connect();
    $sql='UPDATE client SET  Email= "'.$_POST['data'][0].'", Phone="'.$_POST['data'][1].'", Instagram="'.$_POST['data'][2].'", Facebook="'.$_POST['data'][3].'" WHERE client.code_client="'.$_POST['data'][4].'";';
    if ($mysqli->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $mysqli->error;}
    foreach ($_POST['data'][5] as $sendAdresse){
        if($sendAdresse[7]==0){
            $sql='INSERT INTO adresse (nrue,typeRue, rue, codepostal, ville, pays, infoComp) VALUES("'.$sendAdresse[0].'","'.$sendAdresse[1].'","'.$sendAdresse[2].'","'.$sendAdresse[3].'","'.$sendAdresse[4].'","'.$sendAdresse[5].'","'.$sendAdresse[6].'");';
            if ($mysqli->query($sql) === FALSE) {
                echo "Error: " . $sql . "<br>" . $mysqli->error;}
            $id_adresse = $mysqli->insert_id;
            $sql='UPDATE adresse SET code_client="'.$_POST['data'][4].'"WHERE id_adresse="'.$id_adresse.'";';
            if ($mysqli->query($sql) === FALSE) {
                echo "Error: " . $sql . "<br>" . $mysqli->error;}


        }
        else{
            $sql='UPDATE adresse SET nrue="'.$sendAdresse[0].'",typeRue="'.$sendAdresse[1].'",rue="'.$sendAdresse[2].'",codepostal="'.$sendAdresse[3].'",ville="'.$sendAdresse[4].'",pays="'.$sendAdresse[5].'",infoComp="'.$sendAdresse[6].'" WHERE id_adresse="'.$sendAdresse[7].'";';
            if ($mysqli->query($sql) === FALSE) {
                echo "Error: " . $sql . "<br>" . $mysqli->error;}
        }



    }

    Disconnect($mysqli);

    unset($_POST['cmd']);
}
if (isset($_POST['cmd']) and $_POST['cmd']=='AutoComplet'){
    $array = array();

    $mysqli = Connect();

    $sql='SELECT id_item,nom FROM item ;';

    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_assoc()){
            $array[]= $row;
        };
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    echo json_encode($array);
    Disconnect($mysqli);

    unset($_POST['cmd']);
}
if (isset($_POST['cmd']) and $_POST['cmd']=='GetItemInfo'){
    $array = array();

    $mysqli = Connect();

    $sql='SELECT nom,statut,stock,prixachat,prixvente,id_membership FROM item WHERE id_item="'.$_POST['id'].'" ;';

    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_assoc()){
            $array[]= $row;
        };
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    echo json_encode($array);
    Disconnect($mysqli);

    unset($_POST['cmd']);


}

if (isset($_POST['cmd']) and $_POST['cmd']=='ItemUpdate'){
    $array = array();

    $mysqli = Connect();

    $sql='UPDATE item SET  nom= "'.$_POST['data'][0].'", prixachat="'.$_POST['data'][1].'", prixvente="'.$_POST['data'][2].'", stock="'.$_POST['data'][3].'", statut="'.$_POST['data'][4].'",id_membership="'.$_POST['data'][5].'" WHERE item.id_item="'.$_POST['data'][6].'";';
    if ($mysqli->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $mysqli->error;}
    echo json_encode($array);
    Disconnect($mysqli);

    unset($_POST['cmd']);
}
if (isset($_POST['cmd']) and $_POST['cmd']=='CreateCommande') {
    $array = array();

    $mysqli = Connect();

    $sql = 'INSERT INTO commande (code_client, commande.date, fdelivery, fservice )VALUES ("' . $_POST['data'][0] . '","' .date('Y-m-d', time()). '",50,10);';
    if ($mysqli->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    $sql='SELECT CONCAT(DATE_FORMAT(commande.date,"%d%m%y"),COALESCE(MAX(SUBSTRING(id_commande, 7, 4)), 0)) as idCommande FROM commande WHERE DATE(date) = CURDATE();';
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_assoc()){
            $array[]= $row;
        };
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    echo json_encode($array);
    Disconnect($mysqli);

    unset($_POST['cmd']);

}
if (isset($_POST['cmd']) and $_POST['cmd']=='AddItem') {
    $array = array();

    $mysqli = Connect();

    $sql = 'INSERT INTO item (id_item, prixachat, prixvente, nom, statut, id_membership, stock) VALUES (NULL, "' . $_POST['data'][1] . '","' . $_POST['data'][2] . '","' . $_POST['data'][0] . '","' . $_POST['data'][4] . '","' . $_POST['data'][5] . '","' . $_POST['data'][3] . '");';
    if ($mysqli->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    Disconnect($mysqli);

    unset($_POST['cmd']);
}


if (isset($_POST['cmd']) and $_POST['cmd']=='AddItemCommandAndBDD') {
    $array = array();

    $mysqli = Connect();

    $sql = 'INSERT INTO item (id_item, prixachat, prixvente, nom, statut, id_membership, stock) VALUES (NULL, "' . $_POST['data'][1] . '","' . $_POST['data'][2] . '","' . $_POST['data'][0] . '","' . $_POST['data'][4] . '","' . $_POST['data'][5] . '","' . $_POST['data'][3] . '");';
    Sendlog("<br>Error: " . $sql);
    if ($mysqli->query($sql) === FALSE) {
        Sendlog("Error: " . $sql . "<br>" . $mysqli->error);
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    $_POST['data'][6] = $mysqli->insert_id;
    Sendlog("New: " . $_POST['data'][6] );
    Disconnect($mysqli);

}

if (isset($_POST['cmd']) and ($_POST['cmd']=='AddItemCommandOnly' or $_POST['cmd']=='AddItemCommandAndBDD')){
    $array = array();

    $mysqli = Connect();

    $sql = 'INSERT INTO envoie (id_item, id_commande, statut, Prix_remise, quantité) VALUES ('.$_POST['data'][6].', "' . $_POST['data'][9] . '","' . $_POST['data'][4] . '","' . $_POST['data'][7] . '","' . $_POST['data'][8] . '");';
    if ($mysqli->query($sql) === FALSE) {
        Sendlog("Error: " . $sql . "<br>" . $mysqli->error);
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    Disconnect($mysqli);
    echo "Success";

    unset($_POST['cmd']);
}

if (isset($_POST['cmd']) and $_POST['cmd']=='UpdateNote') {
    $mysqli = Connect();

    $sql = 'UPDATE commande SET note = "' . $_POST['note'] . '" WHERE commande.id_commande =' . $_POST['id'] . ';';
    Sendlog($sql);
    if ($mysqli->query($sql) === FALSE) {
        Sendlog("Error: " . $sql . "<br>" . $mysqli->error);
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    Disconnect($mysqli);
    unset($_POST['cmd']);
}

if (isset($_POST['cmd']) and $_POST['cmd']=='GetXLSclient'){
    $array = array();

    $mysqli = Connect();

    $sql ='SELECT name, code_client, Facebook,Instagram, Email, Phone,grillepoint.nom as Membership,point FROM client INNER JOIN grillepoint ON client.id_membership=grillepoint.id_membership;';

    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_assoc()){
            $array[]= $row;
        };
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    echo json_encode($array);
    Disconnect($mysqli);

    unset($_POST['cmd']);
}
if (isset($_POST['cmd']) and $_POST['cmd']=='GetXLScommande'){
    $array = array();

    $mysqli = Connect();

    $sql ='SELECT id_commande as No_Order,date,total as Total_Order,statut,client.code_client,name,Instagram, Email, Phone,grillepoint.nom as Membership,point FROM client INNER JOIN grillepoint ON client.id_membership=grillepoint.id_membership INNER JOIN commande ON client.code_client =commande.code_client ;';

    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_assoc()){
            $array[]= $row;
        };
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    echo json_encode($array);
    Disconnect($mysqli);

    unset($_POST['cmd']);
}


//data = [selectRègle.value, commande, selectMoyen.value, cout.value];
if (isset($_POST['cmd']) and $_POST['cmd']=='insertPaiement') {

    $mysqli = Connect();

    $sql = 'SELECT * from grilleregle where id_regle='.$_POST['data'][0].';';

    $cout = $_POST['data'][3];
    if($_POST['data'][0] != "NULL") {
        $array = array();
        if ($result = $mysqli->query($sql)) {
            while ($row = $result->fetch_assoc()) {
                $array = $row;
            };
        } else {
            Sendlog("Error: " . $sql . "<br>" . $mysqli->error);
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
        if ($array['type'] == "Pourcentage") {

            $sql = 'SELECT total from commande where id_commande='.$_POST['data'][1].';';
            $array2 = array();
            if ($result = $mysqli->query($sql)) {
                while ($row = $result->fetch_assoc()) {
                    $array2 = $row;
                };
            } else {
                Sendlog("Error: " . $sql . "<br>" . $mysqli->error);
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }

            //Pourcentage sur total ou RAP ?
            $cout = $array2['total']  * $array['valeur']/100;

        } else if ($array['type'] == "Réduction") {
            $cout = $array['valeur'];
        }



    }

       $sql = "INSERT INTO paiement (date, cout, id_transaction, id_commande, id_regle) VALUES ('".date('Y-m-d', time())."',".$cout.",".$_POST['data'][2].",".$_POST['data'][1].",".$_POST['data'][0].");";
   //date('Y-m-d', time())

       if ($mysqli->query($sql) === FALSE) {
           Sendlog("Error: " . $sql . "<br>" . $mysqli->error);
           echo "Error: " . $sql . "<br>" . $mysqli->error;
       }

    echo "Success";

    unset($_POST['cmd']);
}

if (isset($_POST['cmd']) and $_POST['cmd']=='deleteItem') {

    $mysqli = Connect();

    $sql = 'DELETE FROM `envoie` WHERE `envoie`.`id_item` = '.$_POST['id'].' AND `envoie`.`id_commande` = '.$_POST['commande'].';';
    if ($mysqli->query($sql) === FALSE) {
        Sendlog("Error: " . $sql . "<br>" . $mysqli->error);
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    Disconnect($mysqli);
    unset($_POST['cmd']);
}

function Sendlog($message){
    error_log($message, 3, "./errors.log");
}



?>