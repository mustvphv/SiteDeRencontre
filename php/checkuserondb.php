<!-- Fichier checkuserondb, qui regarde si les champs rentré par l'utilisateur  pour la connexion d'un client sont correctes -->

<!DOCTYPE HTML>
<html>
<?php 
        /***************************************************************************************
        *@method CheckDataIsCorrect: Fonction qui vérifie si il existe un client.              *
        *@param  void: void                                                                    *
        *@return : Renvoie un void                                                             *
        ***************************************************************************************/
	function CheckDataIsCorrect(){
		session_start();
        
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
		$datadb = $answer->fetch();
	
		if($datadb['password'] == $password){
			$_SESSION['id'] = $datadb['id'];
        	
        	//on redirige vers la page compte du client
        	header('location: /work/php/account.php?action=display');
    	}else{
			echo "<script type=\"text/javascript\">alert(\"Champs incorrectes\"); location=\"connexion.php\"</script>";
			exit(1);
		}
    
    	$answer->closeCursor();
    }
    CheckDataIsCorrect();
?>
</html> 
