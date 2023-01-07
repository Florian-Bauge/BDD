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

    $sql = "SELECT * from commande 
    LEFT OUTER JOIN client ON commande.code_client=client.code_client 
    LEFT OUTER JOIN concierge ON concierge.id_con=commande.id_con   
    WHERE commande.id_commande = $id
;";
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