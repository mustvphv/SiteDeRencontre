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

				//Réponses des informations du client courrant  connecté.
				$reponseClientUser         = $bdd->query('SELECT * FROM User WHERE pseudo="'.$pseudoclient.'"');
				$reponseClientLocalisation = $bdd->query('SELECT * FROM Localisation WHERE pseudo="'.$pseudoclient.'"'); 
				$reponseClientPhysique     = $bdd->query('SELECT * FROM Physique WHERE pseudo="'.$pseudoclient.'"');
				$reponseClientPreferences  = $bdd->query('SELECT * FROM Preferences WHERE pseudo="'.$pseudoclient.'"');	
				
				//on fetch les données directement car il y a qu'une ligne dans la table.
				$valueClientUser         = $reponseClientUser->fetch();
				$valueClientLocalisation = $reponseClientLocalisation->fetch();
				$valueClientPhysique     = $reponseClientPhysique->fetch();
				$valueClientPreferences  = $reponseClientPreferences->fetch();

				// Réponses des informations de tous les clients sauf le client courrant.
				$reponseUser         = $bdd->query('SELECT * FROM User WHERE pseudo!="'.$pseudoclient.'"');
				$reponseLocalisation = $bdd->query('SELECT * FROM Localisation WHERE pseudo!="'.$pseudoclient.'"'); 
				$reponsePhysique     = $bdd->query('SELECT * FROM Physique WHERE pseudo!="'.$pseudoclient.'"');
				$reponsePreferences  = $bdd->query('SELECT * FROM Preferences WHERE pseudo!="'.$pseudoclient.'"');	
		?>
		
		<script type="text/javascript">	
				var clientsMap = new Map;
				var pseudoclients = [];
				//Nouveau map 
				var clientCourrantMap    = new Map;
				var pseudoclientCourrant = <?php echo json_encode($pseudoclient);?> ;  

				//on set un map avec les informations du client courrant. 
				clientCourrantMap.set(pseudoclientCourrant                                   ,
					[<?php echo json_encode($valueClientUser['email']);                   ?> , 
					<?php echo json_encode($valueClientLocalisation['departement']); 	  ?> ,
					<?php echo json_encode($valueClientLocalisation['region']); 		  ?> ,
					<?php echo json_encode($valueClientPhysique['clientgenre']); 		  ?> ,
					<?php echo json_encode($valueClientPhysique['clientpoids']);          ?> ,
					<?php echo json_encode($valueClientPhysique['clientcouleurspeaux']);  ?> ,
					<?php echo json_encode($valueClientPreferences['prefgenre']);         ?> ,
					<?php echo json_encode($valueClientPreferences['prefcouleurspeaux']); ?> ,
					<?php echo json_encode($valueClientPreferences['prefpoids']);         ?> ,
					<?php echo json_encode($valueClientPreferences['prefcouleurschx']);   ?>
					]);


		</script>	
		
		<?php		
				// on set un map avec les informations des autres clients.
				while($valueUser = $reponseUser->fetch()){
					$valueLocalisation = $reponseLocalisation->fetch();		
					$valuePhysique     = $reponsePhysique->fetch();  
					$valuePreferences  = $reponsePreferences->fetch();
		?>		
					<script type="text/javascript">
					pseudoclients.push(<?php echo json_encode($valueUser['pseudo']);?>);
					
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
			console.log(clientCourrantMap);
			console.log(clientsMap);

		</script>


    </body>
</html>
