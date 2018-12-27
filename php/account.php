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
