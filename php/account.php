<!-- Fichier account.php, ce fichier montre les informations du client.-->

<!DOCTYPE HTML>
<html>
    <title>Site de Rencontre</title>
    <head></head>
    <body>




        <?php
			function DisplayProfile(){
         		session_start();
            	$id = htmlspecialchars($_SESSION['id']);
       			
       			

         		$bdd    = new PDO('mysql:host=localhost;dbname=SiteDeRecontre;charset=utf8', 'root', '');
				$answer = $bdd->query('SELECT * FROM User WHERE id="'.$id.'"');
				$datadb = $answer->fetch();
		
				$pseudoclient = htmlspecialchars($datadb['pseudo']);

				$reponseUser         = $bdd->query('SELECT * FROM User WHERE pseudo!="'.$pseudoclient.'"');
				$reponseLocalisation = $bdd->query('SELECT * FROM Localisation WHERE pseudo!="'.$pseudoclient.'"'); 
				$reponsePhysique     = $bdd->query('SELECT * FROM Physique WHERE pseudo!="'.$pseudoclient.'"');
				$reponsePreferences  = $bdd->query('SELECT * FROM Preferences WHERE pseudo!="'.$pseudoclient.'"');	
		?>
		
		<script type="text/javascript">	
				// je crée l'objet Map
				var clientsMap = new Map;
				var pseudoclients = [];
		</script>	
		
		<?php		
			
				while($valueUser = $reponseUser->fetch()){
					$valueLocalisation = $reponseLocalisation->fetch();		
					$valuePhysique     = $reponsePhysique->fetch();  
					$valuePreferences  = $reponsePreferences->fetch();
		?>		
					<script type="text/javascript">
					//je crée une liste où se trouvera les pseudos(clés) pour que tu évites de faire du php.
					pseudoclients.push(<?php echo json_encode($valueUser['pseudo']);?>);
					
					/* le premier champs est la clé ici c'est le pseudo.
					 * la clé pointe sur une liste où tu trouves tous les autres champs
					 * pour avoir la liste tu fais clientsMap.get(nomddupseudo)
					 * C'est pas très propre en vrai cette methode tu regarderas ce que ca fais dans le code
					 * source de la page mais bon...*/	
					clientsMap.set(<?php echo json_encode($valueUser['pseudo']); 	    ?> , 
						[<?php echo json_encode($valueUser['email']);                   ?> , 
						<?php echo json_encode($valueLocalisation['departement']); 	    ?> ,
						<?php echo json_encode($valueLocalisation['region']); 		    ?> ,
						<?php echo json_encode($valuePhysique['clientgenre']); 		    ?> ,
						<?php echo json_encode($valuePhysique['clientpoids']);          ?> ,
						<?php echo json_encode($valuePhysique['clientcouleurspeaux']);  ?> ,
						<?php echo json_encode($valuePreferences['prefgenre']);         ?> ,
						<?php echo json_encode($valuePreferences['prefcouleurspeaux']); ?> ,
						<?php echo json_encode($valuePreferences['prefpoids']);         ?> ,
						<?php echo json_encode($valuePreferences['prefcouleurschx']);   ?>
					]);
					
					</script>

		<?php
				}
			}

			DisplayProfile();

	
		?>

		<script type="text/javascript">
			// algo de matching

		</script>


    </body>
</html>
