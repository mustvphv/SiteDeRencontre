# SiteDeRencontre

1.Installation du serveur:

On utilise la base de données PHP/MyAdmin.

Selon le système que vous allez utiliser, vous devez choisir l'archive appropriée dans le lien suivant:
"https://www.apachefriends.org/download.html".

Une fois l'installation terminée, il faut allumer xampp:
-Pour linux:
il faut faire les commandes suivantes: "cd /opt/lampp/".
Puis: "sudo ./lampp start"
Puis: "cd htdocs"
Puis: "mkdir work"
Puis: "cd work"
Puis: "git clone https://github.com/CryTime/SiteDeRencontre"

Ensuite, vous devez également importer la base de données en vous connectant à "localhost/phpmyadmin/" 
en cliquant sur le boutton "Importer" puis "Parcourir..." avec le fichier "SiteDeRecontre.sql", à l'adresse:
"https://github.com/CryTime/SiteDeRencontre/tree/master/sql/".

Et ensuite vous pouvez tester le programme dans le navigateur en écrivant par exemple le lien suivant:
"http://localhost/work/php/registration.php"


2.Explication de l'architecture:

Brève explication des fichiers:
js/controlform.js: Teste si les champs du formulaire ont un format valides.
php/account.php: Fichier relatif au compte de l'utilisateur(où se trouvent, entre autres, 
les scripts important pour le fonctionnement du programme (affichage graphique, algorithmie...)).
php/connexion.php: Fichier où on effectue la connexion.
php/save_in_bdd.php: Fichier qui sauvegarde des données dans la base de données.
php/checkuserondb.php: Fichier qui vérifie si un utilisateur existe dans la base de données.
php/registration.php: Fichier où l'utilisateur procède à un début d'inscription.
php/set_account.php: Fichier où l'utilisateur complête son inscription.
css/style.css: feuille de style.
sql/SiteDeRecontre.sql: code sql pour la création de la base de données.
img/: Le dossier où se trouve les images qu'on a utilisé pour tester les Swipes etc.

Les technologies, languages utilisés sont Javascript (avec aussi l'utilisation de la librairie JQuery), 
HTML, CSS, PHP(MySQL/PhpMyAdmin).

Pour s'enregistrer , on va dans "http://localhost/work/php/registration.php", on remplit les champs.
Pour se connecter, on va dans "http://localhost/work/php/connexion.php".
Une fois connecté, on peut voir le polaroid avec des informations concernant le client connecté.
On peut ainsi appuyer sur le bouton "Envoyer", ce qui va retourner 
les résultats de l'algorithme de matching, et donc les clients sélectionnés en fonction de 
leurs préférences (genre, couleurs de cheveux...), et de leurs localisation.
Ensuite, on a la possibilité de swiper à gauche et à droite pour voir les profils (image et pseudo) 
des clients sélectionnés par l'algorithme de matching précédemment.
On peut aussi liker les profils en double-cliquant.




3.Problèmes rencontrés:

Le problème majeur dans notre projet, a été de faire communiquer le PHP et le Javascipt 
ensemble (notamment lors des transferts de variables du PHP au Javascript).













