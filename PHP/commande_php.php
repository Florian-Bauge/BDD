<?php
include 'global.php';

function getArrayRecapCommand($text){    //Recupération des données pour affichage sommaire

    $array = array();
	
	$mysqli = Connect();

	$sql = "SELECT id_commande, client.code_client, total, statut from commande INNER JOIN client ON commande.code_client=client.code_client;";
	$array = array();

	if ($result = $mysqli->query($sql)) {
		//echo "<br>New record created successfully<br>";
		while ($row = $result->fetch_assoc()){
            $array[] = $row;
		};
	} else {
		echo "Error: " . $sql . "<br>" . $mysqli->error;
	}
	$result->close();
	//echo $array[0]['Name'];

	return $array;

}

function deleteCommand($id){



}

function exportCommands(){
    
}

function getArrayAllCommand($id){   //Recupération des données pour affichage


    $array = array();

    $mysqli = Connect();

    //Récupération Information de Commande et de Client

    $sql = "SELECT note, id_commande, commande.total, total-coalesce((SELECT sum(cout) from paiement where id_commande = $id),0) AS RAP, concat(concierge.nom, concierge.prenom) AS cons, client.name, client.code_client, client.Phone, grillePoint.nom from commande 
    LEFT OUTER JOIN client ON commande.code_client=client.code_client 
    LEFT OUTER JOIN concierge ON concierge.id_con=commande.id_con
    LEFT OUTER JOIN GrillePoint ON client.id_membership=grillepoint.id_membership
    WHERE commande.id_commande = $id
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
    WHERE paiement.id_commande = $id
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
    WHERE envoie.id_commande = $id
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

    $sql = "SELECT envoie.id_item, item.nom, Prix_remise, envoie.statut, quantité, numeroColis from envoie 
    LEFT OUTER JOIN item ON envoie.id_item=item.id_item
    LEFT OUTER JOIN livraison ON envoie.id_livraison=livraison.id_delivery
    WHERE envoie.id_commande = $id
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
    var_dump($array);
    return $array;

}

function getAdresses($id){



    $mysqli = Connect();

    $sql = "SELECT id_adresse, CONCAT(nrue,' ',rue,' ',adresse.codepostal,' ',ville,' ',pays,' ',infoComp) AS adresse from adresse WHERE adresse.code_client=$id;";
    $array = array();

    if ($result = $mysqli->query($sql)) {
        //echo "<br>New record created successfully<br>";
        while ($row = $result->fetch_assoc()){
            $array[] = $row;
        };
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    $result->close();
    return $array;

}

function updateDeliveryDate($id){


}

function addPayment($id ){

    
}

function addItem($id){

    
}

function removeItem($id){

    
}

function addNewItem($id){
    createNewItem();
    addItem();   
}

function createNewItem(){

    
}

function updateItem($id){

    
}



?>