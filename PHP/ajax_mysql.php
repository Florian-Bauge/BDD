<?php

include "global.php";

if (isset($_POST['cmd']) and $_POST['cmd']=='commande') {

    $array = array();

    $mysqli = Connect();

    //Récupération Information de Commande et de Client

    $sql = "SELECT note, id_commande, commande.total, CONCAT(concierge.nom,' ',concierge.prenom) AS cons, client.name, client.code_client, client.Phone, grillePoint.nom from commande
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

    $sql = "SELECT date, cout, nom, sum(cout) AS 'Total_paye' from paiement 
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
?>