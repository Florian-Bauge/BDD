<?php
include 'global.php';

function getArrayRecapCommand($text){

    $array = array();
	
	$mysqli = Connect();

	$sql = "SELECT id_commande, client.code_client, total, statut from commande INNER JOIN client ON commande.code_client=client.code_client;";
	$array = array();

	if ($result = $mysqli->query($sql)) {
		//echo "<br>New record created successfully<br>";
		while ($row = $result->fetch_assoc()){
            $array[] = $row;
		};
        var_dump($array);
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

function getArrayAllCommand($id){


    $array = array();

    $mysqli = Connect();

    $sql = "SELECT id_commande, commande.total, concierge.nom, concierge.prenom, client.name, client.code_client, client.Phone, grillePoint.nom from commande 
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
        var_dump($array);
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    $sql = "SELECT date, cout, nom, sum(cout) AS 'Total_paye' from paiement 
    LEFT OUTER JOIN moyen ON moyen.id_transaction = paiement.id_transaction
    WHERE paiement.id_commande = $id
;";
    $array['paiement'] = array();
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_assoc()){
            $array['paiement'][] = $row;
        };
        var_dump($array);
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    $sql = "SELECT item.nom, Prix_remise, envoie.statut, quantité, numeroColis, dateVoulu, dateLivrée, DateExpédié, livraison.status, nrue || ' ' || rue || ' ' || adresse.codepostal || ' ' || ville  || ' ' || pays  || ' ' || infoComp AS adresse from envoie 
    LEFT OUTER JOIN item ON envoie.id_item=item.id_item
    LEFT OUTER JOIN livraison ON envoie.id_livraison=livraison.id_delivery
    LEFT OUTER JOIN adresse on livraison.id_adresse = adresse.id_adresse
    WHERE envoie.id_commande = $id
;";
    $array['livraison'] = array();
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_assoc()){
            $array['livraison'][] = $row;
        };
        var_dump($array);
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }



    $result->close();

    //echo $array[0]['Name'];
    return $array;

}

function addDelivery($id){


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