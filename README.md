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
<img src="https://user-images.githubusercontent.com/87482855/214006386-e071a494-328f-4176-98c0-96917c8b2b14.png"/>
<h3>Importation de la BDD</h3>
La bdd à utiliser est nommée bdd_ensim, elle est située à la racine du projet sous le nom : "bdd_ensimV9.sql".
Elle est encodée en UTF8
<h3>Trigger</h3>

<ul>
<li>"tr_adresse_code_client":
</li>
Permet de mettre dans la colonne code_client de la table adresse, le dernier code client créer lors d'une insertion de ligne
<br>
<li>"auto_increment_code_client":
</li>
Complète le code_client comme la syntaxe de l'énoncé à chaque insertion de ligne
<br>
<li>"auto_Increment_Idcommande":
</li>
Complète la colonne id_commande de la même manière que la syntaxe de l'énoncé <br>
<li>"update_total_commande":
</li>
Pour chaque envoie insert, ajoute le "cout" de l'"envoie" à la somme total de la commande.
Permet ainsi, que pour chaque item rajouté dans une commande, le total soit mise  à jour. <br>

<li>"update_total_commande_onDelete": 
</li>
Pour chaque envoie delete, soustrait le "cout" de l'"envoie" à la somme total de la commande.
Permet ainsi, que pour chaque item enlevé dans une commande, le total soit mise à jour.<br>

<li>"ajout_point":
</li>
Permet que chaque paiement effectué par l'utilisateur, ajoute des points dans la table points si le paiement n'est pas effectué avec des points. De plus, il prend en compte le multiplicateur du membership du client. Ajoute aussi des points dans la colonne point de la table client. <br>

<li>"update_Membership":
</li>
Si le total des points accumulé au cours d'une année est compris dans l'intervalle de point, alors le membership de cette personne évolue.
Cette méthode ne marche pas pour les utilisateurs possédant un rang ultimate, car il possède un grade spécial. <br>


</ul>
<h3>Event</h3>

<li>"check_exp_point":
</li>
Cet évènement vérifie chaque jour à minuit si les points d'un client sont périmés. Si c'est le cas, alors les points sont enlevés dans la table client afin que celui-ci ne puisse pas les utiliser.

