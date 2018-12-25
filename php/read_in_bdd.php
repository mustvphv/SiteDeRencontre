<!DOCTYPE HTML>
<html>
<?php 
	
	$pseudo   = NULL;
	$password = NULL;

	if(isset($_POST['pseudo']) && empty($_POST['pseudo']) == false &&
	   isset($_POST['pass'])   && empty($_POST['pass'])   == false){
		$pseudo   = htmlspecialchars($_POST['pseudo']);
		$password = hash('sha256', htmlspecialchars($_POST['pass']));

	}else{
		echo "<script type=\"text/javascript\">alert(\"Champs incorrectes\"); location=\"connexion.php\"</script>";
			exit(1);
	} 
	
	$bdd    = new PDO('mysql:host=localhost;dbname=SiteDeRecontre;charset=utf8', 'root', '');
	$answer = $bdd->query('SELECT id, pseudo, password FROM User WHERE pseudo="'.$pseudo.'"');
	
	while($datadb = $answer->fetch()){
		if($datadb['password'] == $password){
			echo $datadb['id'];
            echo "Ok :)";
		}else{
			echo "<script type=\"text/javascript\">alert(\"Champs incorrectes\"); location=\"connexion.php\"</script>";
			exit(1);
		}
	}

	$answer->closeCursor();

?>
</html>	
