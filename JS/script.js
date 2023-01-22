
function InitModal(id){
    var modal = document.getElementById("Modal_"+id);

    var span = document.getElementById("Modalclose_"+id);

    span.onmousedown = function() {
        modal.style.display = "none";

        document.getElementsByName("ModalForm").forEach(elm => {
            elm.reset();
        });
        //RESET
        while(document.getElementsByName("temp").length>0){
            document.getElementsByName("temp")[0].remove();
        };
    }


    window.onmousedown = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";

            document.getElementsByName("ModalForm").forEach(elm => {
                elm.reset();
            });

            //RESET
            while(document.getElementsByName("temp").length>0){
                console.log(document.getElementsByName("temp")[0]);
                document.getElementsByName("temp")[0].remove();
            };
        }
    }

}

function ShowModal(id, param){
    var modal = document.getElementById("Modal_"+id);
    modal.style.display = "flex";

}

function ShowModalWith(id, param){
    var modal = document.getElementById("Modal_"+id);

    //RESET
    /*
    while(document.getElementsByName("temp").length>0){
        console.log(document.getElementsByName("temp")[0]);
        document.getElementsByName("temp")[0].remove();
    };*/

    $.ajax
    ({
        type: 'POST',
        url: './PHP/ajax_mysql.php',
        data:{ cmd: id, id: param},
        dataType: 'json',
        success: function (data) {

            console.log(data);
            document.getElementById("Modal_ID_"+id)
            for(var key in data){
                for(var row in data[key]){
                    console.log(key + "->" + row + "->" + data[key][row] + " : " + document.getElementsByName('Modal_' + row).length)
                    if(isNaN(row)) {
                        //console.log(key + "->" + row + "->" + data[key][row] + " : " + document.getElementsByName('Modal_' + row).length);
                        document.getElementsByName('Modal_' + row).forEach(elm => {
                            elm.innerHTML = data[key][row];
                            //console.log(row + " Changed");
                        });
                    }else{
                       let n = row;

                        const ToCopy = document.getElementById(key);

                        if(ToCopy != null) {
                            let elm = ToCopy;
                            elm = ToCopy.cloneNode(true);
                            ToCopy.after(elm);
                            elm.setAttribute("id",key+"_"+n);
                            elm.setAttribute("name","temp");
                            elm.style.display = "block";

                            for(var row in data[key][n]) {

                                var text = "Modal_"+row;
                                elm.querySelectorAll("[name="+text).forEach(elm => {
                                        elm.innerHTML = data[key][n][row];
                                        //console.log(row + " Changed with "+data[key][n][row]);
                                    });
                            }
                        }
                    }
                }
            }
            /*for (var key in data) {
                let fieldtxt = ['Name', 'Type', 'Age', 'Player', 'Time', 'Abstract'];
                if(fieldtxt.includes(key)){
                    document.getElementById('Modal_'+key).innerHTML=data[key];
                }
                console.log(key);
            }*/
            /*document.getElementById('Modal_Img').src = data['img'];
            document.getElementById('id-game').value = data['kGame'];
*/

            modal.style.display = "flex";
        }
    });

}

function submitFormAndRedirect(form, id){
    //console.log(document.getElementsByName(id)[0].innerHTML);
    document.getElementById(form+"_id").setAttribute("value", document.getElementsByName(id)[0].innerHTML);
    document.getElementById(form).submit();
}
function  CreateAccount(){
    console.log("Function start");
    var id_membershipSelect=0;
    let resultAjax = false;
    var membershipSelect=document.querySelector("#Modal_NewCompte_Select_Membership");
    var iScheckmembershipSelect=document.getElementById("Modal_NewCompte_Ulti").checked;
    var nom=document.getElementById("Modal_NewCompte_nom").value;
    var mail=document.getElementById("Modal_NewCompte_mail").value;
    var tel=document.getElementById("Modal_NewCompte_tel").value;
    var insta=document.getElementById("Modal_NewCompte_Insta").value;
    var facebook=document.getElementById("Modal_NewCompte_Facebook").value;
    var adresse=document.getElementsByName("Modal_temp_NewCompte_adress_");
    console.log(isValidEmail(mail));
    console.log(isNotEmpty(nom));
    console.log(isNotEmpty(tel));
    console.log(verifieAlladress(adresse,0));
    if(iScheckmembershipSelect){
        id_membershipSelect=3;
    }


    if(isValidEmail(mail) && isNotEmpty(nom) && isNotEmpty(tel) && verifieAlladress(adresse,0)){
        console.log('debut');
            let arraydatadata=[nom,mail,tel,insta,facebook,id_membershipSelect,0,alladresspars(adresse,0)];
            console.log(arraydatadata);


        $.ajax
        ({
            type: 'POST',
            url: './PHP/ajax_mysql.php',
            data:{ cmd:'createaccountclient',data : arraydatadata},
            dataType: 'text',
            async:false,
            success: function (data) {
                console.log(data);
                if(data=='Succes'){
                    resultAjax=true;
                }



            }

        });



    }

    return resultAjax ;


}
function isValidEmail(email) {
    const emailRegex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return emailRegex.test(email);
}
function isNotEmpty(str) {
    return str.trim().length !== 0;
}
function  verifieAlladress(add,firstIterator){
    var verif= true;
    for(var i=firstIterator;i<add.length;i++){
        const parseAdress=parseAddress(add[i].value);
        if(parseAdress==null){
            verif=false;
        }
    }
    return verif;
}
function  Innerveririeadress(add,firstIterator){
    var verif= true;
    for(var i=firstIterator;i<add.length;i++){
        const parseAdress=parseAddress(add[i].innerHTML);
        if(parseAdress==null){
            verif=false;
        }
    }
    return verif;

}
function  alladresspars(add,firstIterator){
    var tabadress=[];
    for(var i=firstIterator;i<add.length;i++){
        tabadress.push(parseAddress(add[i].value));

    }
    return tabadress

}
function  adressparsAndId(add,id,firsIterator){//Ecris en brut
    var tabadressid=[];
    var tabadress=[];
    for(var i=firsIterator;i<add.length;i++){
        tabadress=(parseAddress(add[i].innerHTML));
        tabadress.push(id[i].innerHTML);
        tabadressid.push(tabadress);
        tabadress=[];
    }

return tabadressid;

}
function parseAddress(address) {
    const addressRegex = /^(\d+)\s(.+?\s)([\w\s]+)\s(\d{5})\s([\w\s]+),\s([\w\s]+)(?:\s(.+))?$/;
    const match = addressRegex.exec(address);
    if (match) {
        return [match[1], match[2], match[3], match[4], match[5], match[6], match[7] || ""];
    }
    return null;
}




function client_profil(id,param,bool){
    console.log(param);
    setTimeout(ShowModalWith(id,param),10);
    $.ajax
    ({
        type: 'POST',
        url: './PHP/ajax_mysql.php',
        data:{ cmd: id, id: param},
        dataType: 'json',
        success: function (data) {
           // console.log(data)
            document.getElementById("Panel_Img_Membership").src="Img/Membership="+data['Membership']['id_membership']+".png";

        }
    });
    client_profil_edit(bool);

}
function client_profil_edit(bool){

    var mail=document.getElementById('Modal_client_span_email');
    var tel =document.getElementById('Modal_client_span_phone');
    var insta= document.getElementById('Modal_client_span_insta');
    var facebook= document.getElementById('Modal_client_span_facebook');
    var code_client= document.getElementById('Modal_client_span_code');
    var adresse=document.getElementsByName("Modal_adresse");
    mail.contentEditable=bool;
    tel.contentEditable=bool;
    insta.contentEditable=bool;
    facebook.contentEditable=bool;

    if(bool=='true'){// Quand on veut pouvoir éditer le client
        document.getElementById('Modal_client_button_add_adress').style.display='flex';

        document.getElementById('Modif_image').src='Img/icon/check-small.png';
       // document.getElementById('Modal_client_valid_edit').onclick=`client_profil_edit('false')`;
        document.getElementById('Modal_client_valid_edit').setAttribute('onclick',"client_profil_edit('false')");

    }
    else{//quand on valide les modifications
        document.getElementById('Modal_client_button_add_adress').style.display='none';
        document.getElementById('Modif_image').src='Img/icon/edit.png';
     //  document.getElementById('Modal_client_valid_edit').onclick=`client_profil_edit('true')`;
        document.getElementById('Modal_client_valid_edit').setAttribute('onclick',"client_profil_edit('true')");
        if(isValidEmail(mail.innerHTML)&&isNotEmpty(tel.innerHTML)&& Innerveririeadress(adresse,1)) {
            var tableauadress = adressparsAndId(document.getElementsByName("Modal_adresse"), document.getElementsByName("Modal_id_adresse"), 1);
            console.log(tableauadress);


            let arraydatadata = [mail.innerHTML, tel.innerHTML, insta.innerHTML, facebook.innerHTML, code_client.innerHTML, tableauadress];

            console.log(arraydatadata);


            $.ajax
            ({
                type: 'POST',
                url: './PHP/ajax_mysql.php',
                data: {cmd: 'updateaccountclient', data: arraydatadata},
                dataType: 'json',
                success: function (data) {
                    console.log('succes');
                    return true;


                }

            });
        }
        else {
            console.log("Info incorecte");
        }





     }
    setTimeout(()=>{var add =document.getElementsByName('Modal_adresse');//setTimeout permet que toutes les adresses soit initialiser pour pouvoir modifier leurs paramètre

        for(var i=1;i<add.length;i++){
            add[i].contentEditable=bool;
        }},100);

}


function AddAdress(parm){

    var adr=document.getElementsByName(parm);
    var elm =adr[0].cloneNode(true);
    elm.value="";

    var br=document.createElement("br");
    adr[adr.length-1].after(br);
    br.after(elm);
    if(parm=="Modal_adresse"){
        client_profil_edit("true");
    }


}
function  addSpanAdresse(parm){
    var divadr=document.getElementsByName(parm);
    var elm= divadr[0].cloneNode(true);
    elm.style="";
    divadr[divadr.length-1].after(elm);
    client_profil_edit("true");
}

function ValidateLivraison(){

    const date = document.getElementById("Modal_DateExpédié");
    const parcel = document.getElementById("Modal_numeroColis");
    const adr = document.getElementById("Modal_address");


    const checkbox = document.getElementsByName("Modal_items");
    var hasOneChecked = false;
    var checkArray = new Array();
    checkbox.forEach(element => {
        if(element.checked) {
            hasOneChecked = true;
            checkArray.push(element.value);
        }
    });
    if(!hasOneChecked)
        return false;

    var arrayData = [date.value, parcel.value, adr.value, checkArray];

    let resultAjax = false;
    $.ajax
    ({
        type: 'POST',
        url: './PHP/ajax_mysql.php',
        data:{ cmd: "insertAndUpdateLivraison", data:arrayData},
        async: false,
        dataType: 'text',
        success: function (result) {
            console.log(result);
            if(result=="Success") {
                resultAjax = true;
            }
        }
    });

    return resultAjax;
}

function UpdateArrivalDate(date, id){
    $.ajax
    ({
        type: 'POST',
        url: './PHP/ajax_mysql.php',
        data:{ cmd: "UpdateArrivalDate", date:date.value, id:id},
        dataType: 'json',
        success: function () {
            return true;
        }
    });
}

function UpdatePaiementModal(elm){

    const div = document.getElementsByName("Modal_paiement_content");
    div.forEach(elm => {
        elm.style.display="none";
        for (let i = 0; i < elm.children.length; i++) {
            elm.children.item(i).removeAttribute("required");
        }
    });

    //document.getElementById("Modal_"+elm.value).style.display = "block";
    let child;
    switch(elm.value){
        case '1':  case '2':
            document.getElementById("Modal_1").style.display = "block";
            child = document.getElementById("Modal_1").children;
            break
        case '3':
            document.getElementById("Modal_2").style.display = "block";
            child = document.getElementById("Modal_2").children;
            break;

    }

    for (let i = 0; i < child.length; i++) {
        child.item(i).setAttribute("required","");
    }

}

function ValidatePaiement(commande){

    const selectMoyen = document.getElementById("Modal_paiement_Moyen");
    const selectRègle = document.getElementById("Modal_paiement_Regle");

    var cout = document.getElementById("Modal_cout");
    var regle = selectRègle.value;

    if(document.getElementById("Modal_2").style.display =="none"){
        regle = "NULL";
    }

    var arrayData = [regle, commande, selectMoyen.value, cout.value];

    let resultAjax = false;
    $.ajax
    ({
        type: 'POST',
        url: './PHP/ajax_mysql.php',
        data:{ cmd: "insertPaiement", data: arrayData},
        async: false,
        dataType: 'text',
        success: function (result) {
            console.log(result);
            if(result=="Success"){
                resultAjax = true;
            }else{
                return false;
            }
        }
    });
    return resultAjax;

}
function  UpdateItemcheckbox(){
    var checked=document.getElementById("Panel_checkbox_item").checked;
    console.log(checked);
    var prix_achat=document.getElementById("Panel_Modal_item_prix_achat");
    var prix_vente=document.getElementById("Panel_Modal_item_prix_vente");
    var status=document.getElementById("Panel_Modal_item_statuts");
    var member=document.getElementById("Panel_Modal_item_Membership");
    var stock=document.getElementById("Panel_Modal_item_stock");
    var recherche=document.getElementById("Panel_Modal_item_recherche");
    var id=document.getElementById("Panel_Modal_item_id");
    var form=document.getElementById("ModalForm");

    var spans = document.getElementsByClassName("span");
    spans = [...spans];

    if(checked){

         prix_achat.value="";
         prix_vente.value="";
         status.value="";
         recherche.placeholder="Nouveau nom...";
         recherche.value="";
         id.style.display="none";
         stock.value="";

        spans.forEach(elm => {
            elm.removeAttribute("readonly");
        });
        member.removeAttribute("disabled");
        status.removeAttribute("disabled");

    }
    else{

        id.style.display="inline-block";


        spans.forEach(elm => {
            elm.setAttribute("readonly", "");
        });
        member.setAttribute("disabled", "");
        status.setAttribute("disabled", "");
    }


}


function UpdateItemInterface(id){
    if(!isNaN(id)&&id != ""){
        $.ajax
        ({
            type: 'POST',
            url: './PHP/ajax_mysql.php',
            data:{ cmd: "GetItemInfo", id: id},
            dataType: 'json',
            success: function (data) {
                console.log(data);
                document.getElementById("Panel_Modal_item_recherche").value=data[0]['nom'];
                document.getElementById("Panel_Modal_item_prix_achat").value=data[0]['prixachat'];
                document.getElementById("Panel_Modal_item_prix_vente").value=data[0]['prixvente'];
                document.getElementById("Panel_Modal_item_stock").value=data[0]['stock'];
                const selectstatut = document.querySelector('#Panel_Modal_item_statuts');
                selectstatut.value = data[0]['statut'];
                const selectMemb = document.querySelector('#Panel_Modal_item_Membership');
                selectMemb.value = data[0]['id_membership'];

                console.log("Resize !");
                resizeInput();
            }
        });

    }else{

    }



}
function updateItemBDD(){
    var tab=[];

    tab.push(document.getElementById("Panel_Modal_item_recherche").value);
    tab.push(document.getElementById("Panel_Modal_item_prix_achat").value);
    tab.push(document.getElementById("Panel_Modal_item_prix_vente").value);
    tab.push(document.getElementById("Panel_Modal_item_stock").value);
    tab.push(document.querySelector('#Panel_Modal_item_statuts').value);
    tab.push(document.querySelector('#Panel_Modal_item_Membership').value);
    tab.push(document.getElementById("Panel_Modal_item_id").value);
    if(!document.getElementById("Panel_checkbox_item").checked) {
        $.ajax
        ({
            type: 'POST',
            url: './PHP/ajax_mysql.php',
            data: {cmd: 'ItemUpdate', data: tab},
            dataType: 'json',
            success: function (data) {
                console.log('succes');
                return true;


            }

        });
    }
    else {
        $.ajax
        ({
            type: 'POST',
            url: './PHP/ajax_mysql.php',
            data: {cmd: 'AddItem', data: tab},
            dataType: 'json',
            success: function (data) {
                console.log('succes');
                return true;


            }

        });
    }




}

function updateCommandeBDD(commande){

    var tab=[];

    tab.push(document.getElementById("Panel_Modal_item_recherche").value);
    tab.push(document.getElementById("Panel_Modal_item_prix_achat").value);
    tab.push(document.getElementById("Panel_Modal_item_prix_vente").value);
    tab.push(document.getElementById("Panel_Modal_item_stock").value);
    tab.push(document.querySelector('#Panel_Modal_item_statuts').value);
    tab.push(document.querySelector('#Panel_Modal_item_Membership').value);
    tab.push(document.getElementById("Panel_Modal_item_id").value);
    tab.push(document.getElementById("Panel_Modal_item_prix_remise").value);
    tab.push(document.getElementById("Panel_Modal_item_quantité").value);
    tab.push(commande);

    let cmd = 'AddItemCommandAndBDD';
    if(!document.getElementById("Panel_checkbox_item").checked) {
        cmd = 'AddItemCommandOnly';
    }
    let resultAjax = false;
    $.ajax
    ({
        type: 'POST',
        url: './PHP/ajax_mysql.php',
        data: {cmd: cmd, data: tab},
        async: false,
        dataType: 'text',
        success: function (result) {
            console.log(result);
            if(result=="Success"){
                resultAjax = true;
            }
        }

    });
    return resultAjax;
}

function resizeInput(){
    var spans = document.getElementsByClassName("span");
    spans = [...spans];
    console.log(spans);
    spans.forEach(elm => {
        console.log(elm);
        console.log(elm.style.width);
        elm.style.width = (elm.value.length * 8)+30 + "px";
        console.log(elm.style.width);
    });

}

function deleteItem(id, commande){
    $.ajax
    ({
        type: 'POST',
        url: './PHP/ajax_mysql.php',
        data: {cmd: 'deleteItem', id: id, commande: commande}
    });
    document.getElementById("Modal_item_"+id).remove();
}

function deleteCmd(id){
    $.ajax
    ({
        type: 'POST',
        url: './PHP/ajax_mysql.php',
        data: {cmd: 'deleteCmd', id: id}
    });
    document.getElementById("Modal_cmd_"+id).remove();
}
/*
document.addEventListener('keypress', function (e) {
    if (e.keyCode === 13 || e.which === 13) {
        e.preventDefault();
        return false;
    }

});
*/




function InitAutoComplete(){
    $( function() {
        console.log("Salut")
        let autocompleteArray = [];
        $.ajax
        ({
            type: 'POST',
            url: './PHP/ajax_mysql.php',
            data:{ cmd: "AutoComplet"},
            dataType: 'json',
            success: function (data) {
                console.log("Success00");
                for (var key in data) {
                    autocompleteArray.push({label:data[key]['nom'], value:data[key]['id_item']});
                }
                console.log(autocompleteArray);
            }
        });

        $( "#Panel_Modal_item_id" ).autocomplete({
            source: autocompleteArray
        });
    } );
}

function UpdateNote(){
    let id = document.getElementsByName("Modal_id_commande")[0].innerHTML;
    let note = document.getElementsByName("Modal_note")[0].innerHTML;
    $.ajax
    ({
        type: 'POST',
        url: './PHP/ajax_mysql.php',
        data:{ cmd: "UpdateNote", note: note ,id:id},
        dataType: 'json',
        success: function () {
            return true;
        }
    });
}

function  CreateNewCommande(){
    var id_client=document.getElementById("Modal_client_span_code");
    var tabInfo=[];

    tabInfo.push(id_client.innerHTML);
    console.log(tabInfo)
    $.ajax
    ({
        type: 'POST',
        url: './PHP/ajax_mysql.php',
        data: {cmd: 'CreateCommande',data :tabInfo },
        dataType: 'json',
        success: function (data) {
                console.log(data);
                var adressehtml=document.location.href;
                adressehtml=adressehtml.substring(0,adressehtml.lastIndexOf("/")+1);
                adressehtml=adressehtml+"commande_update.php?id="+data[0]['idCommande'];
                document.location.href=adressehtml;

        }});

}
function  CreateFacture(id){
    var adressehtml=document.location.href;
    adressehtml=adressehtml.substring(0,adressehtml.lastIndexOf("/")+1);
    adressehtml=adressehtml+"Facture.php?id="+id;
    window.open(adressehtml);
}
function CreateXLSclient(){
    $.ajax
    ({
        type: 'POST',
        url: './PHP/ajax_mysql.php',
        data: {cmd: 'GetXLSclient' },
        dataType: 'json',
        success: function (data) {
            console.log(data);
            const date = new Date();
            data.forEach((row)=>{
                row.code_client=formatToclientCode(row.code_client);
            });

            workbook = XLSX.utils.book_new();
            worksheet = XLSX.utils.json_to_sheet(data);
            workbook.SheetNames.push("First");
            workbook.Sheets["First"] = worksheet;
            XLSX.writeFile(workbook, `Clients_${date.toLocaleDateString()}.xlsx`);


        }});
}
function CreateXLScommandes(){
    $.ajax
    ({
        type: 'POST',
        url: './PHP/ajax_mysql.php',
        data: {cmd: 'GetXLScommande' },
        dataType: 'json',
        success: function (data) {
            console.log(data);
            const date = new Date();
            data.forEach((row)=>{
                row.code_client=formatToclientCode(row.code_client);
            });

            workbook = XLSX.utils.book_new();
            worksheet = XLSX.utils.json_to_sheet(data);
            workbook.SheetNames.push("First");
            workbook.Sheets["First"] = worksheet;
            XLSX.writeFile(workbook, `Commandes_${date.toLocaleDateString()}.xlsx`);


        }});
}
function formatToclientCode(str){
    return str.slice(0, 2) + '-SPR-' + str.slice(2);
}
function commandeToPdf(){
    console.log('Salut');
    $.ajax
    ({
        type: 'POST',
        url: './PHP/ajax_mysql.php',
        data: {cmd: 'functionPDFCommande'},
        dataType: 'json',
        success: function (data) {
            console.log('succes');
            return true;


        }

    });

}

function Search(url){
    location.href='./'+url+'.php?txt='+document.getElementById('search_text').value;
}
