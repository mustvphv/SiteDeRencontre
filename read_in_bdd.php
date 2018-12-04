<!DOCTYPE HTML>
<html>
<?php 
	 
	$bdd = new PDO('mysql:host=localhost;dbname=SiteDeRecontre;charset=utf8', 'root', '');
		
	$answer = $bdd->query('SELECT * FROM User');

	while($datadb = $answer->fetch()){
		echo '<p>' . htmlspecialchars($datadb['pseudo']) . ' ' . htmlspecialchars($datadb['password']) . '</p>';
	}

	$answer->closeCursor();

?>
</html>	