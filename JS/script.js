function InitModal(id){
    var modal = document.getElementById("Modal_"+id);

    var span = document.getElementById("Modalclose_"+id);

    span.onclick = function() {
        modal.style.display = "none";

        document.getElementsByName("ModalForm").forEach(elm => {
            elm.reset();
        });
        //RESET
        while(document.getElementsByName("temp").length>0){
            document.getElementsByName("temp")[0].remove();
        };
    }


    window.onclick = function(event) {
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

    console.log("ajax ?"+id);
    console.log(param);
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
                            console.log(row + " Changed");
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
                                        console.log(row + " Changed with "+data[key][n][row]);
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
    console.log("??");

}

function submitFormAndRedirect(form, id){
    console.log(document.getElementsByName(id)[0].innerHTML);
    document.getElementById(form+"_id").setAttribute("value", document.getElementsByName(id)[0].innerHTML);
    document.getElementById(form).submit();
}
function  CreateAccount(){
    console.log("Function start");
    var id_membershipSelect=0;
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
            dataType: 'json',
            success: function (data) {
                console.log('succes');
                return true;


            }

        });



    }
    else{
        console.log("mauvais");
    }


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
    for(i=firstIterator;i<add.length;i++){
        const parseAdress=parseAddress(add[i].value);
        if(parseAdress==null){
            verif=false;
        }
    }
    return verif;
}
function  Innerveririeadress(add,firstIterator){
    var verif= true;
    for(i=firstIterator;i<add.length;i++){
        const parseAdress=parseAddress(add[i].innerHTML);
        if(parseAdress==null){
            verif=false;
        }
    }
    return verif;

}
function  alladresspars(add,firstIterator){
    var tabadress=[];
    for(i=firstIterator;i<add.length;i++){
        tabadress.push(parseAddress(add[i].value));

    }
    return tabadress

}
function  adressparsAndId(add,id,firsIterator){//Ecris en brut
    var tabadressid=[];
    var tabadress=[];
    for(i=firsIterator;i<add.length;i++){
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

        document.getElementById('Modal_client_valid_edit').src='Img/button_validate.png';
       // document.getElementById('Modal_client_valid_edit').onclick=`client_profil_edit('false')`;
        document.getElementById('Modal_client_valid_edit').setAttribute('onclick',"client_profil_edit('false')");

    }
    else{//quand on valide les modifications
        document.getElementById('Modal_client_button_add_adress').style.display='none';
        document.getElementById('Modal_client_valid_edit').src='Img/button_edit.png';
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

        for(i=1;i<add.length;i++){
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

    console.log("FUNCTION");
    var arrayData = [date.value, parcel.value, adr.value, checkArray];
    console.log(arrayData);
    $.ajax
    ({
        type: 'POST',
        url: './PHP/ajax_mysql.php',
        data:{ cmd: "insertAndUpdateLivraison", data:arrayData},
        dataType: 'json',
        success: function () {
            return true;
        }
    });

    return false;
}

function UpdateArrivalDate(date, id){
    console.log(date.value);
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

    console.log("Updated !");
    const div = document.getElementsByName("Modal_paiement_content");
    div.forEach(elm => {
        elm.style.display="none";
    });

    document.getElementById("Modal_"+elm.value).style.display = "block";

}