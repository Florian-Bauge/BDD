<?php
include 'global.php';

function getArrayClient($text){// Récupère les données nécessaire pour l'affichage de la page client
    $array=array();
    $mysqli = Connect();
    $sql ="SELECT `code_client`, `name`, `Email`, `Phone`, `nom`FROM `client` INNER JOIN `grillepoint` ON client.id_membership=grillepoint.id_membership WHERE client.code_client = '".$text."' OR client.name = '%".$text."%';";

    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_assoc()){
            $array[] = $row;
        };
       // var_dump($array);
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    $result->close();
    return $array;
}
function getAllInformationClient($id_client){
    $array=array();
    $mysqli = Connect();
    $sql="SELECT * FROM `client` WHERE `code_client` = $id_client;";
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_assoc()){
            $array[] = $row;
        };
         var_dump($array);
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    $result->close();
    return $array;


}
function createPDF(){
    $array=array();
    $mysqli = Connect();
    $sql ="SELECT `name`, `code_client`, `Facebook`,`Instagram`, `Email`, `Phone`,grillepoint.nom,`point`FROM `client` INNER JOIN `grillepoint` ON client.id_membership=grillepoint.id_membership;
";

    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_assoc()){
            $array[] = $row;
        };
         var_dump($array);
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    $result->close();
    return $array;

}
