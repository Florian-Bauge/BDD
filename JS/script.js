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
    var membershipSelect=document.querySelector("#Modal_NewCompte_Select_Membership");
    var id_membershipSelect=membershipSelect.options[membershipSelect.selectedIndex].getAttribute("value");
    var date_Membership=document.getElementById("Modal_NewCompte_DateMembership").value;
    var nom=document.getElementById("Modal_NewCompte_nom").value;
    var mail=document.getElementById("Modal_NewCompte_mail").value;
    var tel=document.getElementById("Modal_NewCompte_tel").value;
    var insta=document.getElementById("Modal_NewCompte_Insta").value;
    var facebook=document.getElementById("Modal_NewCompte_Facebook").value;
    var adresse=document.getElementsByName("Modal_temp_NewCompte_adress_").values();


}
function client_profil(id,param,bool){
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

 document.getElementById('Modal_client_span_code').contentEditable=bool;
    document.getElementById('Modal_client_span_email').contentEditable=bool;
    document.getElementById('Modal_client_span_phone').contentEditable=bool;
    document.getElementById('Modal_client_span_insta').contentEditable=bool;
    document.getElementById('Modal_client_span_facebook').contentEditable=bool;
    document.getElementById('Modal_client_span_nom').contentEditable=bool;


    if(bool=='true'){
        document.getElementById('Modal_client_button_add_adress').style.display='flex';

        document.getElementById('Modal_client_valid_edit').src='Img/button_validate.png';
       // document.getElementById('Modal_client_valid_edit').onclick=`client_profil_edit('false')`;
        document.getElementById('Modal_client_valid_edit').setAttribute('onclick',"client_profil_edit('false')");

    }
    else{
        document.getElementById('Modal_client_button_add_adress').style.display='none';
        document.getElementById('Modal_client_valid_edit').src='Img/button_edit.png';
     //  document.getElementById('Modal_client_valid_edit').onclick=`client_profil_edit('true')`;
        document.getElementById('Modal_client_valid_edit').setAttribute('onclick',"client_profil_edit('true')");



    }
    setTimeout(()=>{var add =document.getElementsByName('Modal_adresse');//setTimeout permet que toutes les adresses soit initialiser pour pouvoir modifier leurs paramètre
        console.log("??????");
        console.log(add.length);
        console.log(add);
        for(i=1;i<add.length;i++){
            add[i].contentEditable=bool;
            console.log(i);
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