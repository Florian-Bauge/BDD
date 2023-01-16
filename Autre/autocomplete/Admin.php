<!DOCTYPE html>
<?php
	session_start();
?>
<html>
	<head>
		<title>Ludothèque - Administration</title>
		<link rel="stylesheet" type="text/css" href="file/styleAdmin.css"/>
		<script type="text/javascript" src="file/js.js"></script>
		<?php 
		include 'file/Global.php';
		include 'file/Admin_php.php';
		if(!isset($_SESSION['Member'])){
			Redirect('Search.php');
		}
		?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script>InitAutoComplete();</script>
		
	</head>
	<body>
	<div id="page">  
		<div id="entete">
		<form id="form" method="get" action="Search.php">  
		<img class="accueil" src="img/accueil.png" alt="" onclick="window.location.assign('./Search.php')">
		<div class="search">
		<input class="search" id="search_text" type="text" placeholder="Recherche..." name="text" value="<?php echo $_SESSION['text'] ?? "";?>"/>
		<button form="form" type="submit" name="submit" id="search_button"class="search"><img class="search" id="search_img" src="img/Search_button.png" alt="" /></button>
		</div>
		<div id="right-NavBar">
		<?php 
		AccountButton($_SERVER['SCRIPT_NAME']);
		?>
			<button type="button" onclick="window.location.assign('./Reserve.php')">
				<i class="fa fa-shopping-cart"></i> <span id="cart">Panier</span>
			</button>
		
	</div>
		
		</form>
		</div>
<div id="contenu">
<h2>Administration</h2>
			<div class="tab">
  <button class="tablinks" id="b1" onclick="Update(event, '1')">Gestion Adhérent</button>
  <button class="tablinks" id="b2"onclick="Update(event, '2')">Adhésion</button>
  <button class="tablinks" id="b3"onclick="Update(event, '3')">Gestion Stock</button>
</div>

<div id="d1" class="tabcontent">
  <form id="form" class="adherentform" method="get">
    <label><b>N° Adhérent</b></label>
    <input type="text" id="id_member" value="<?php echo $_GET['N'] ?? ""?>" class="text" placeholder="Enter N°" name="N">
</form>
	<?php
CreateMemberInfo();
?>
<div class="Historique">
<?php
CreateTable();
?>
</div>

</div>

<div id="d2" class="tabcontent">
  <form id="form2" action="" class="login" method="post">

  <div class="container">
  	<label for="uname"><b>Nom</b></label>
    <input class="login" type="text" placeholder="Nom" name="FirstName" required>
	
	<label for="uname"><b>Prénom</b></label>
    <input class="login" type="text" placeholder="Prénom" name="Name" required>
	
	<label for="uname"><b>Adresse</b></label>
    <input class="login" type="text" placeholder="Adresse" name="Adress" required>
	
	<label for="uname"><b>Numéro</b></label>
    <input class="login" type="text" placeholder="Numéro" name="Number" required>
	
	<button class="login" name="signup" form="form2" type="submit">Inscrire</button>
</div>
</form>
<?php
if(isset($_POST['signup'])){
	CreateMemberInfo();
}
?>
</div>

<div id="d3" class="tabcontent">
 <fieldset>
	<legend>Stock:</legend>
	<div class="ui-widget">
	<label for="Games">ID: </label>
	<input id="Games" onchange="AffStock(this.value);" placeholder="Nom" style="width: 50px;">
	<div id = "Info" style="display:none">
	<span id="StockName"><b>Pas de Jeu trouvé</b></span>
	<div style="display:inline-block;margin-left: 30px;">
	<span>Disponible: </span><span id="Available">...</span><span> / </span><span id="All">...</span>
	</div>
	</div>
	</div>
	
	
<div id="DivStock">
<label for="Modifstock"><b>Action(s):<Br></b></label>

<button type="button" onclick="UpdateStock(1);" title="Ajouter 1 au stock">Ajouter</button>
<button type="button" onclick="UpdateStock(-1);" title="Enlever 1 au stock">Enlever</button>
<button type="button" onclick="UpdateStock(0);" title="Supprimer définitivement le jeu">Supprimer définitivement</button>

</div>
  <span id="errorStock">Vous ne pouvez pas enlever du stock un jeu qui n'est pas disponible.</span>
    </fieldset>
<br>

<form id="form3" action="" method="post">
 <fieldset>
  <legend id="titleGame" >Ajouter un Jeu:</legend>
  <input type="text" placeholder="Nom" onchange="CheckFill();" id="NameGames" name="Name">
    <div class="Block" id="Div_stock">
  <label for="stock"><b>Nombre d'exemplaires:</b></label>

<input type="number" id="stock" class="number" name="stock" value ="1" min="0" max="100">
</div>
  <div class="container">
  <div class="Block">
  <label for="uname"><b>Marque:</b></label>
  <select id="Publisher" name="Publisher" onchange="UpdateSelect(this)">
  <option value="none">Choisir</option>
  <option value="add">Ajouter</option>
  <?php
  AddItems("Publisher", "select");
  ?>
	</select>
	<input type="text" name="PublisherAdd" onchange="CheckFill();" style="display:none">
</div>
  <div class="Block">
  <div id="Check">
  <label for="uname"><b>Type(s):</b></label>
  <?php
  AddItems("Type", "checkbox");
  ?>
</div>
	<input type="text" placeholder="Ajouter un type" onchange="CheckFill();" id="Type">
	 <button type="button" onclick="AddCheck();">+</button>
</div>

  <div class="Block">
  <label for="uname"><b>Age:</b></label>
    <select id="Age" name="Age" onchange="UpdateSelect(this)">
  <option value="none">Choisir</option>
  <option value="add">Ajouter</option>
    <?php
  AddItems("Age", "select");
	?>
	</select>
  <input type="text" name="AgeAdd" onchange="CheckFill();" style="display:none">
  </div>
  <div class="Block">
  <label for="uname"><b>Nombre de joueur(s):</b></label>
    <select id="Player" name="Player" onchange="UpdateSelect(this)">
  <option value="none">Choisir</option>
  <option value="add">Ajouter</option>
     <?php
  AddItems("Player", "select");
	?>
	</select>
  <input type="text" name="PlayerAdd" onchange="CheckFill();" style="display:none">
  </div>
  <div class="Block">
  <label for="uname" ><b>Temps de Jeu:</b></label>
    <select id="Time" name="Time" onchange="UpdateSelect(this)">
  <option value="none">Choisir</option>
  <option value="add">Ajouter</option>
      <?php
  AddItems("Time", "select");
	?>
	</select>
  <input type="text" placeholder="Min" onchange="CheckFill();" name="TimeAdd" style="display:none">
  </div>
  <div class="Block">
  <label for="uname"><b>Image:</b></label>
  <input type="text" placeholder="img/*" onchange="CheckFill();" id="img" name="img">
  </div>
  <label for="uname"><b>Court Résumé:</b></label>
  <textarea onchange="CheckFill();" name="Abstract" id="Abstract" rows="4"></textarea>
  <?php
	$rand=rand();
	$_SESSION["rand3"]=$rand;
  ?>
  <input type="hidden" value="<?php echo($rand); ?>" name="randcheck3" />
  <button name="add" id="add" form="form3" type="submit" disabled>Ajouter</button>
  <img src="img/tick-img" id="img_tick">
  </div>
  </fieldset>
  </form>
 
  
  
</div>

			
	 </div>

</div>
	
	
	</body>
</html>
