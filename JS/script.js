function InitModal(id){
    var modal = document.getElementById("Modal_"+id);

    var span = document.getElementById("Modalclose_"+id);

    span.onclick = function() {
        modal.style.display = "none";
        //RESET
        while(document.getElementsByName("temp").length>0){
            console.log(document.getElementsByName("temp")[0]);
            document.getElementsByName("temp")[0].remove();
        };
    }


    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
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

function ValidatePaiement(){

    const inputDate = document.getElementById('Modal_DateExpédié').value;
    const inputN = document.getElementById('Modal_numeroColis').value;

    if (isNaN(inputN.getTime()) {
        // the date is invalid
        console.log("invalid");
    } else {
        // the date is valid
        console.log("valid");
    }

}