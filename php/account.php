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
		
				$pseudoclient = $datadb['pseudo'];

				$reponseUser         = $bdd->query('SELECT * FROM User WHERE pseudo!="'.$pseudoclient.'"');
				$reponseLocalisation = $bdd->query('SELECT * FROM Localisation WHERE pseudo!="'.$pseudoclient.'"'); 
				$reponsePhysique     = $bdd->query('SELECT * FROM Physique WHERE pseudo!="'.$pseudoclient.'"');
				while($valueUser = $reponseUser->fetch()){
					$valueLocalisation = $reponseLocalisation->fetch();		
					$valuePhysique     = $reponsePhysique->fetch();  
		?>		

				<script  type="text/javascript"> 
					var clientsMap = new Map();
					clientsMap.set(<?php echo json_encode($valueUser['pseudo']); ?>              , 
						         [<?php echo json_encode($valueUser['email']);  ?>              , 
						          <?php echo json_encode($valueLocalisation['departement']); ?> ,
						          <?php echo json_encode($valueLocalisation['region']); ?>      ,
						          <?php echo json_encode($valuePhysique['clientgenre']); ?>     ,
						          <?php echo json_encode($valuePhysique['clientpoids']); ?>	    ,
						          <?php echo json_encode($valuePhysique['clientcouleurspeaux']); ?>
						          ]);
					
				
					console.log(clientMap)

				</script>

		
		<?php		
				}
		?>		
	
		
		<script type="text/javascript">
			
			var pseudo = <?php echo json_encode($datadb['pseudo']); ?>;
			var email  = <?php echo json_encode($datadb['email']);  ?>;
			//console.log(pseudo, email); (Ok)
			document.write('<p>' + pseudo + ' ' + email + '</p>');

		</script>

		


		<?php		
				//echo "Ton pseudo : " .$datadb['pseudo']. "\n";
				//echo "Ton email : "  .$datadb['email']. "\n";
			}

			DisplayProfile();
		?>    
    </body>
</html>
