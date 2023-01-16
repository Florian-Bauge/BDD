var currentLocation = window.location.pathname;
currentLocation = currentLocation.split('/');
currentLocation = currentLocation[currentLocation.length-1];
console.log(currentLocation);


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

function InitModal(){
var modal = document.getElementById("myModal");

var span = document.getElementsByClassName("close")[0];

span.onclick = function() {
  modal.style.display = "none";
}


window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

}

// RESERVE
if(currentLocation=="Reserve.php"){
window.addEventListener("DOMContentLoaded", function(event) {
	var cart = parseInt(document.getElementsByClassName("item").length,10);
	var cpt = parseInt(document.getElementById("cpt").value,10);
	var cptItem = cart + cpt
	var msg = 3-cpt;
	
	if(cptItem > 3){
		document.getElementById("error_cart").innerHTML = "Vous ne pouvez pas réserver plus de 3 jeux en même temps.<br> Vous avez déjà "+cpt+" jeu(x) en votre possession.";
		document.getElementById("logo_error").style.display = "";
		document.getElementById("error_cart").style.display = "";
		document.getElementById("confirm").disabled = true;
	}else{
		document.getElementById("error_cart").style.display = "none";
		document.getElementById("logo_error").style.display = "none";
		document.getElementById("confirm").disabled = false;
	}
	
	
	var elementState = document.getElementsByName('itemstate');
	
	for(var i=0;i<elementState.length;i++){
	if(elementState[i].className == "Red"){
		document.getElementById("confirm").disabled = true;
	}
	}
});
}


//-----ADMIN ------
if(currentLocation=="Admin.php"){
function Update(evt, number) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById("d"+number).style.display = "block";
  evt.currentTarget.className += " active";
  window.sessionStorage.active = number;
}

window.addEventListener("DOMContentLoaded", function(event) {
var number = window.sessionStorage.active || '1';
document.getElementById("b"+number).className += " active";
 document.getElementById("d"+number).style.display = "block";
});

function UpdateSelect(obj){
	if(obj.value=="add"){
		document.getElementsByName(obj.id.toString()+"Add")[0].style.display = "inline-block";
	}else{
		document.getElementsByName(obj.id.toString()+"Add")[0].style.display = "none";
	}
		
	CheckFill();
}

function CheckFill(){

	var Name = document.getElementById("NameGames").value;
	var Publisher = document.getElementById("Publisher")
	Publisher = Publisher.options[Publisher.selectedIndex].value;

	var PublisherAdd = document.getElementsByName("PublisherAdd")[0].value;
	
	var inputs = document.getElementsByName('type[]');
	
    var flag = false;

    for(var i = 0; i < inputs.length; i++) {
        if(inputs[i].checked) {
            flag = true;
        }
    }
	
	var Age = document.getElementById("Age")
	Age = Age.options[Age.selectedIndex].value;
	var AgeAdd = document.getElementsByName("AgeAdd")[0].value;
	var Player = document.getElementById("Player")
	Player = Player.options[Player.selectedIndex].value;
	var PlayerAdd = document.getElementsByName("PlayerAdd")[0].value;
	var Time = document.getElementById("Time")
	Time = Time.options[Time.selectedIndex].value;
	var TimeAdd = document.getElementsByName("TimeAdd")[0].value;
	var img = document.getElementById("img").value;
	var Abstract = document.getElementById("Abstract").value;
	
	var flagGlobal = true;
	if(Name=="" || img == "" || Abstract==""){
		flagGlobal = false;
	}
	if(Publisher == "none" || Age == "none" || Player == "none" || Time == "none"){
		flagGlobal = false;
	}
	if(!flag){
		flagGlobal = false;
	}
	if(Publisher == "add"){
		if(PublisherAdd==""){
			flagGlobal = false;
		}
	}
	if(Age == "add"){
		if(AgeAdd==""){
			flagGlobal = false;
		}
	}
	if(Player == "add"){
		if(PlayerAdd==""){
			flagGlobal = false;
		}
	}
	if(Time == "add"){
		if(TimeAdd==""){
			flagGlobal = false;
		}
	}
	
	if(!flagGlobal){
		document.getElementById("add").disabled = true;
	}else{
		document.getElementById("add").disabled = false;
	}
	
	
}

function AddCheck(){
	var GlobalDiv = document.getElementById("Check");
         if(document.getElementById("Type").value!=""){  

			var div = document.createElement('div');
			
            var Echeckbox = document.createElement('input');
              
            Echeckbox.type = "checkbox";
            Echeckbox.name = "type[]";
            Echeckbox.value = document.getElementById("Type").value;
			Echeckbox.checked = true;
			Echeckbox.onchange = CheckFill;
              
            var label = document.createElement('label');
              
            label.htmlFor = "id";
              
            label.appendChild(document.createTextNode(" "+document.getElementById("Type").value));
              
            div.appendChild(Echeckbox);
            div.appendChild(label);
			GlobalDiv.appendChild(div);
			CheckFill();
			document.getElementById("Type").value = "";
		 }
}

function InitAutoComplete(){
	$( function() {
	let autocompleteArray = [];
$.ajax
    ({
        type: 'POST',
        url: './file/Mysql.php',
        data:{ cmd: "Specific", cats: 'Name,kGame'},
		dataType: 'json',
        success: function (data) {
			for (var key in data) {
				autocompleteArray.push({label:data[key]['Name'], value:data[key]['kGame']});
			}
        }
    });

$( "#Games" ).autocomplete({
      source: autocompleteArray
    });
	  } );
}

function AffStock(id){
	if(!isNaN(id)&&id != ""){
	$.ajax
    ({
        type: 'POST',
        url: './file/Mysql.php',
        data:{ cmd: "Search", id: id},
		dataType: 'json',
        success: function (data) {
			document.getElementById("StockName").innerHTML = "<b>"+data['Name']+"</b>";
			document.getElementById("Available").innerHTML = data['Available'];
			document.getElementById("All").innerHTML = data['Number'];
			Modif_Game(data, true);
        }
    });
		document.getElementById("Info").style.display = "inline-block";
		document.getElementById("DivStock").style.display = "inline-block";
	}else{
		document.getElementById("Info").style.display = "none";
		document.getElementById("DivStock").style.display = "none";
		Modif_Game(null, false);
	}
	
}

function Modif_Game(data, bool){
	
if(bool){
var select;
for (var key in data) {
select = document.getElementById(key);
if(select!=null){
	if(select.tagName=="SELECT"){
		select.value = data[key];
	}
}
}

const checks = data['Type'].split(', ');

for(var i=0;i<checks.length;i++){
	document.getElementById(checks[i]).checked = true;
}

document.getElementById('titleGame').innerHTML = "Modifier le Jeu:";
document.getElementById('NameGames').value = data['Name'];
document.getElementById('Div_stock').style.display = 'none';
document.getElementById('img').value = data['img'];
document.getElementById('Abstract').value = data['Abstract'];

//button
document.getElementById('add').innerHTML = "Modifier";
document.getElementById('img_tick').style.display = "inline-block";
document.getElementById('add').type = "button";
document.getElementById('add').onclick = function(){
	
var id = document.getElementById('Games').value;
var Name = document.getElementById('NameGames').value;
var Publisher = document.getElementById('Publisher').value;
var AllCheck = document.getElementsByName('type[]');
const typeArray = [];
for(var i=0;i<AllCheck.length;i++){
	if(AllCheck[i].checked){
	typeArray.push(AllCheck[i].value);
	}
}
var Type = typeArray.join(', ');
var Age = document.getElementById('Age').value;
var Player = document.getElementById('Player').value;
var Time = document.getElementById('Time').value;
var img = document.getElementById('img').value;
var Abstract = document.getElementById('Abstract').value;
$.ajax
		({
			type: 'POST',
			url: './file/Mysql.php',
			data:{ cmd: "sql", sql: 'UPDATE game SET Name = "'+Name+'", Publisher = "'+Publisher+'", Type = "'+Type+'", Age = "'+Age+'", Player = "'+Player+'", Time = "'+Time+'", img = "'+img+'", Abstract = "'+Abstract+'" WHERE kGame = '+id+';'},
			dataType: 'json',
		});
		document.getElementById('img_tick').src ="img/tick.gif";
		return false;
}
}else{

var AllCheck = document.getElementsByName('type[]');
for(var i=0;i<AllCheck.length;i++){
AllCheck[i].checked = false;
}

document.getElementById('titleGame').innerHTML = "Ajouter un Jeu:";

document.getElementById('Div_stock').style.display = 'block';

document.getElementById('NameGames').value = "";
document.getElementById('Publisher').value = "none";
document.getElementById('Age').value = "none";
document.getElementById('Player').value = "none";
document.getElementById('Time').value = "none";
document.getElementById('img').value = "";
document.getElementById('Abstract').value = "";

//button
document.getElementById('add').innerHTML = "Ajouter";
document.getElementById('img_tick').style.display = "none";
document.getElementById('img_tick').src ="img/tick-img";
document.getElementById('add').type = "submit";
document.getElementById('add').onclick = function(){}
	
}

	
}

function UpdateStock(number){
	
	var All = parseInt(document.getElementById("All").innerHTML, 10);
	var Available = parseInt(document.getElementById("Available").innerHTML, 10);
	var id = document.getElementById("Games").value;
	
	document.getElementById("errorStock").style.display =  "none";
	
	if(number!=0){
		if(Available>0 || number > 0){
			All = All + number;
			Available = Available + number;
		$.ajax
		({
			type: 'POST',
			url: './file/Mysql.php',
			data:{ cmd: "sql", sql: "UPDATE stock SET Number = "+All+", Available = "+Available+" WHERE fkGame = "+id+";"},
			dataType: 'json',
		});

		document.getElementById("All").innerHTML = All;
		document.getElementById("Available").innerHTML = Available;
		}else{
			
			document.getElementById("errorStock").style.display =  "block";
		}
	}else{
		$.ajax
		({
			type: 'POST',
			url: './file/Mysql.php',
			data:{ cmd: "sql", sql: "DELETE FROM stock WHERE fkGame = "+id},
			dataType: 'json',
		});
		$.ajax
		({
			type: 'POST',
			url: './file/Mysql.php',
			data:{ cmd: "sql", sql: "DELETE FROM game WHERE kGame = "+id},
			dataType: 'json',
		});
		document.getElementById('Games').value = "";
		AffStock("")
	}
	
}

function Modif_Member(ebutton){
	inputs = document.getElementsByClassName("modif_member");
	txt = document.getElementsByName("txt");
	img = document.getElementById("img_edit");
	
	if(ebutton.value==0){
		for (var i=0;i<txt.length;i++) {
			txt[i].contentEditable = true;
		}
		img.src = "img/tick";
		ebutton.value = 1;
		
	}else{
		for (var i=0;i<txt.length;i++) {
			txt[i].removeAttribute("contentEditable");
		}
		img.src = "img/edit";
		ebutton.value = 0;
		var text = document.getElementById('Name').innerHTML;
		const Names = text.split(" ");
		var FName = Names[1];
		var Name = Names[0];
		var Adress = document.getElementById("Adress").innerHTML;
		var number = document.getElementById("Number").innerHTML;
		var id = document.getElementById("id_member").value;
		$.ajax
		({
			type: 'POST',
			url: './file/Mysql.php',
			data:{ cmd: "sql", sql: 'UPDATE member SET FirstName = "'+FName+'", Name = "'+Name+'", Adress = "'+Adress+'", Number = "'+number+'" WHERE kMember = '+id+';'},
			dataType: 'json',
		});
		
	}
	
	
}

}