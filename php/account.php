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

				echo "Ton pseudo : " .$datadb['pseudo']. "\n";
				
				echo "Ton email : "  .$datadb['email']. "\n";
			}

			DisplayProfile();
		?>    
    </body>
</html>
