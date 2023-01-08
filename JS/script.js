function InitModal(id){
    var modal = document.getElementById("Modal_"+id);

    var span = document.getElementById("Modalclose_"+id);

    span.onclick = function() {
        modal.style.display = "none";
    }


    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

}

function ShowModal(id, param){
    var modal = document.getElementById("Modal_"+id);
    modal.style.display = "block";
}
//------------------------------Copy de ludothèque
function ShowModalWith(param){
    var modal = document.getElementById("myModal");
    var Name =  document.getElementById("Modal_Name");

    console.log("ajax ?");
    $.ajax
    ({
        type: 'POST',
        url: './file/Mysql.php',
        data:{ cmd: "Search", id: param},
        dataType: 'json',
        success: function (data) {
            for (var key in data) {
                let fieldtxt = ['Name', 'Type', 'Age', 'Player', 'Time', 'Abstract'];
                if(fieldtxt.includes(key)){
                    document.getElementById('Modal_'+key).innerHTML=data[key];
                }
            }
            document.getElementById('Modal_Img').src = data['img'];
            document.getElementById('id-game').value = data['kGame'];

            if(data['Available']==0){
                document.getElementById('Modal_Stock').innerHTML = "Aucun n'est disponible à la location actuellement";
                document.getElementById('Modal_Stock').style.color = 'red';
                document.getElementById('Modal_Stock').style.fontWeight = 'bold';
                document.getElementById('Modal_button').disabled = true;
            }else if(data['Available']==1){
                document.getElementById('Modal_Stock').innerHTML = "Attention: Il n'en reste qu'un ! ";
                document.getElementById('Modal_Stock').style.color = 'orange';
                document.getElementById('Modal_Stock').style.fontWeight = 'bold';
                document.getElementById('Modal_button').disabled = false;
            }else{
                document.getElementById('Modal_Stock').innerHTML = "Ce jeu est disponible";
                document.getElementById('Modal_Stock').style.color = 'green';
                document.getElementById('Modal_Stock').style.fontWeight = 'bold';
                document.getElementById('Modal_button').disabled = false;
            }

            modal.style.display = "block";
        }
    });

}