<!DOCTYPE html>

<!DOCTYPE html>
<html>
<head>
	<title>Site de Rencontre</title>
</head>
<body>
	<script>

			/*******************************************************************
			 *@method : Fonction qui regarde si tous nos champs sont correctes.*
			 *@param  : Prends les champs du formulaire en paramètre.          *   
			 *@return : Renvoie un booléen	                                   *  
			 *******************************************************************/	

			function CheckInput(f){
				var pseudoOk   = CheckBasicInput(f.pseudo);
				var passwordOk = CheckBasicInput(f.pass);
				var emailOk    = CheckEmail(f.email); 

				if(pseudoOk && passwordOk && emailOk){
					return true;
				}else{
					alert("Erreur");
					return false;
				}

			}

			/*********************************************************************
			 *@method : Fonction qui regarde si un champ a une longueur correcte.* 
			 *@param  : Prend en parametre le champ                              *
			 *@return : Renvoie un booléen                                       *
			 *********************************************************************/	

			function CheckBasicInput(champ){
				if(champ.value.length < 2 || champ.value.length > 25){
					Highlight(champ, true);
					return false;
				}else{
					Highlight(champ, false);
					return true;
				}
			}

			/***************************************************************************************
			 *@method : Fonction qui test si on viens de rentrer une email avec un format correcte.*
			 *@param  : Prend en parametre le champ                                                *
			 *@return : Renvoie un booléen                                                         *
			 ***************************************************************************************/

			function CheckEmail(champ){
				var regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$/;

				console.log(regex.test(champ.value));

				if(!regex.test(champ.value)){
					Highlight(champ, true);
					return false;
				}else{
					Highlight(champ, false);
					return true;
				}
			}

			/***************************************************************************************
			 *@method : Fonction qui surligne le background du champ en rouge si il y a une erreur.*
			 *@param  : Prend en paramètre le champ et le booléen true or false.                   *
			 *@return : Renvoie un void 	                                                       *
        	 ***************************************************************************************/
			
			function Highlight(champ, erreur){
				if(erreur){
					champ.style.backgroundColor = "#fba";
				}else{
					champ.style.backgroundColor = "";
				}
			}
		</script>

	<form method="post" action="save_in_bdd.php" onsubmit="return CheckInput(this)">
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

	<a href="read_in_bdd.php"> id enregistrer </a>
	
</body>
</html>
