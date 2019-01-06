<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/work/css/style.css">   
    <title>Site de Rencontre</title>

</head>
<body>
	<script type="text/javascript" src="/work/js/controlform.js"> </script>

	<form method="post" action="save_in_bdd.php?action=register" onsubmit="return CheckInput(this)">
		<p>
			<label for="pseudo">Votre Pseudo : </label>
			<input type="text" name="pseudo" id="pseudo" onblur="CheckBasicInput(this)"/>
			</br>
			<label for="pass">Votre mot de passe : </label>
			<input type="password" name="pass" id="pass" onblur="CheckBasicInput(this)"/>
			</br>
			<label for="email">Votre email : </label>
			<input type="text" name="email" id="email" onblur="CheckEmail(this)"/>
			</br>
			<input type="submit" value="Valider"/>
		</p>
	</form>

	
</body>
</html>
