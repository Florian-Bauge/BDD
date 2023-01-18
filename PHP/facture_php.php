<?php
include 'global.php';
$arrayGlobal=array();
function getAllitem($id){
    $array=array();
    $mysqli = Connect();
    $sql="SELECT CONCAT(item.nom,' : ') as nom_produit,item.prixvente,envoie.Prix_remise,envoie.quantité,item.prixvente as PrixUnité,item.prixvente as PrixTotal  FROM item INNER JOIN envoie ON envoie.id_item=item.id_item WHERE envoie.id_commande='$id';";
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_assoc()){
            $array[] = $row;
        }


    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    $result->close();

    for($i=0;$i<count($array);$i++) {
        $array[$i]['prixvente']=  $array[$i]['prixvente'].'$';
    if($array[$i]['Prix_remise']==null){
       $array[$i]['Prix_remise']='';

        $array[$i]['PrixTotal']=$array[$i]['PrixUnité']*$array[$i]['quantité'];
        $array[$i]['PrixUnité']=$array[$i]['PrixUnité'].'$';

    }
    else{
        $array[$i]['PrixTotal']=$array[$i]['Prix_remise']*$array[$i]['quantité'];
        $array[$i]['PrixUnité']=$array[$i]['Prix_remise'].'$';
        $array[$i]['prixvente']= $array[$i]['prixvente'].'-->'.$array[$i]['Prix_remise'].'$';


    }

    }
    $arrayGlobal=$array;
    return $array;
}
function GetInfoClient($id){
    $array=array();
    $mysqli = Connect();
    $sql="SELECT client.code_client,client.Phone,client.name FROM client INNER JOIN commande ON commande.code_client=client.code_client WHERE commande.id_commande='$id';";
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_assoc()){
            $array[] = $row;
        }
        var_dump($array);

    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    $result->close();
    $sql="SELECT CONCAT(nrue,' ',typeRue,' ', rue ,' ', codepostal,' ',ville,', ',pays,' ',infoComp) AS adresse FROM `adresse` WHERE `code_client`=".$array[0]['code_client'].";";

    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_assoc()){
            $array[] = $row;
        }
        var_dump($array);

    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    $result->close();
    return $array;


}
function getInfoCommande($id){
    $array=array();
    $mysqli = Connect();
    $sql="SELECT CONCAT(nrue,' ',typeRue,' ', rue ,' ', codepostal,' ',ville,', ',pays,' ',infoComp) AS adresse FROM `adresse` WHERE `code_client`=".$array[0]['code_client'].";";

    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_assoc()){
            $array[] = $row;
        }
        var_dump($array);

    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    $result->close();
    return $array;
}