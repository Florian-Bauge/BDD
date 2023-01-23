# Site Conciergerie - BDD 4A ENSIM

<h1>Contexte</h1>

"Votre mission principale est de concevoir une base de données pour une petite entreprise spécialisée dans la conciergerie (vente de parfums et de produits cosmétiques aux particuliers).
Une copie de données brutes de l'entreprise vous a été communiquée."

Travail à réaliser:
<ol>
<li>Création du modèle EA</li>
<li>IHM et requête SQL</li>
</ol>

<h1>Description BDD</h1>
![BDD](https://user-images.githubusercontent.com/87482855/214006386-e071a494-328f-4176-98c0-96917c8b2b14.png)
<h3>Trigger</h3>

<ul>
<li>"tr_adresse_code_client": 



</li>
Permet quand un nouvelle est créer de mettre la bon code_client
<li>"auto_increment_code_client":


</li>
Créer le code client afin qu'il soit telle que dans l'énoncé

<li>"auto_Increment_Idcommande":


</li>
Créer l'id commande afin qu'il soit telle que dans l'énoncé


<li>"update_total_commande":


</li>
Ajoute  au total de la commandes, le prix des items qui sont ajoutés dans la commande



<li>"update_total_commande_onDelete":


</li>
<li>"ajout_point":


</li>
<li>"update_Membership":


</li>
<li>"update_Membership":


</li>
Soustrait au total de la commande, les prix des items qui sont retirés de la commande
<

</ul>



<h3>Event</h3>

<li>"check_exp_point":


</li>

