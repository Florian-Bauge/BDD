<?php
include 'global.php';

function getAllitem($id){
    $array=array();
    $mysqli = Connect();
    $sql="SELECT CONCAT(item.nom,' : ') as nom_produit,CONCAT(item.prixvente),envoie.Prix_remise,envoie.quantité  FROM item INNER JOIN envoie ON envoie.id_item=item.id_item WHERE envoie.id_livraison='$id';";
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