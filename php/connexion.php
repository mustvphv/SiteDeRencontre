<!-- Fichier de connection ici l'utilisateur se connecte avec un pseudo et un mot de passe on vérifie 
	 ensuite dans la base de données si les champs renseignés sont correcte -->

<!DOCTYPE html>
<html>
<head>
	
	<link rel="stylesheet" type="text/css" href="/work/css/style.css">
    <title>Site de Rencontre</title>

</head>
<body>
	

	<form method="post" action="/work/php/checkuserondb.php">
		<p>
			<label for="pseudo"> Votre Pseudo : </label>
			<input type="text" name="pseudo">
			</br>
			<label for="pass"> Votre mot de passe : </label>
			<input type="password" name="pass">
			</br>
			<input type="submit" value="Valider"/>
		</p>
	</form>

</body>

</html>
