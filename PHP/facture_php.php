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
    $sql="SELECT client.code_client,client.Phone,client.name,commande.date FROM client INNER JOIN commande ON commande.code_client=client.code_client WHERE commande.id_commande='$id';";
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_assoc()){
            $array[] = $row;
        }


    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    $result->close();
    $sql="SELECT CONCAT(nrue,' ',typeRue,' ', rue ,' ', codepostal,' ',ville,', ',pays,' ',infoComp) AS adresse FROM `adresse` WHERE `code_client`=".$array[0]['code_client'].";";

    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_assoc()){
            $array[] = $row;
        }
        ;

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


    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    $result->close();
    return $array;
}
function AddInfoCommande($id){
    $array=array();
    $nbselect=0;
    $idFacture=array();

    $array[]=$id;
    $array[]=date('Y-m-d', time());
    $idFacture=str_split($id,6);

    $array[]=$idFacture[0].'-MAQ-F'.$idFacture[1];////Changer Ici si l'id de la commande change
    $mysqli = Connect();
    $sql="SELECT * FROM facture WHERE id_fact='$array[2]';";
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_assoc()){
            $nbselect++;
        }


    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    if($nbselect==0){
        $sql="INSERT INTO facture(id_fact,date,id_commande) VALUES('$array[2]','$array[1]','$array[0]'); ";
        if ($mysqli->query($sql) === FALSE) {
            echo "Error: " . $sql . "<br>" . $mysqli->error;}
    }

    $result->close();
    return $array;




}
function FraisService_livraison($id){
    $array=array();
    $mysqli = Connect();
    $sql="SELECT fservice,fdelivery FROM commande WHERE id_commande='$id'; ";

    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_assoc()){
            $array[] = $row;
        }


    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    var_dump($array);


    return $array;
}
function Promotion($id){
    $array=array();
    $mysqli = Connect();
    $sql="SELECT SUM(cout) as cout FROM paiement WHERE id_commande='$id' and id_regle!=0; ";

    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_assoc()){
            $array[] = $row;
        }


    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }



    return $array;

}

function PrixdepotTOT($id)
{
    $array = array();
    $mysqli = Connect();
    $sql = "SELECT SUM(cout) as coutDepot FROM paiement WHERE id_commande='$id' and id_regle=0; ";

    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_assoc()) {
            $array = $row;
        }


    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    return $array;
}
 function depot($id){
    $array=array();
     $mysqli = Connect();
    $sql="SELECT date,cout,moyen.nom FROM paiement INNER JOIN moyen ON paiement.id_transaction=moyen.id_transaction WHERE id_commande='$id' and id_regle=0; ";

    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_assoc()){
            $array[] = $row;
        }


    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }




    return $array;

}
