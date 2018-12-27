<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
	function CheckNickname(){
		$bdd    = mysqli_connect("localhost", "root", "", "SiteDeRecontre");
		$anwser = mysqli_query($bdd, 'SELECT COUNT(*) AS existNickName FROM User WHERE pseudo="'.$_POST['pseudo'].'"');
		$data   = mysqli_fetch_array($anwser);

		if(!($data['existNickName'] == '0')){
			//echo "NickName already exist\n";
			echo "<script type=\"text/javascript\">alert(\"NickName already used\"); location=\"registration.php\"</script>";
			exit(1);
		}
	} 


	function RegisterClient(){
		session_start();
		$bdd = new PDO('mysql:host=localhost;dbname=SiteDeRecontre;charset=utf8', 'root', '');	


		if(isset($_POST['pseudo']) && empty($_POST['pseudo']) == false && 
		   isset($_POST['pass'])   && empty($_POST['pass'])   == false &&
		   isset($_POST['email'])  && empty($_POST['email'])  == false){
			$pseudo = htmlspecialchars($_POST['pseudo']);
			$pass   = hash('sha256', htmlspecialchars($_POST['pass']));
			$email  = htmlspecialchars($_POST['email']);	

			$req = $bdd->prepare('INSERT INTO User(pseudo, password, email) 
								  VALUES(:pseudo, :password, :email)');
			$req->execute(array(
				'pseudo'   => $pseudo,
				'password' => $pass,
				'email'    => $email 
			));

			$_SESSION['pseudo'] = $pseudo;	
			header('Location: /work/php/setaccount.php');
	?>	
	<!--<script type="text/javascript">
		var tmp = <?php //echo json_encode($_POST['pseudo']);?>;
		console.log(tmp);
	</script>-->	
	<?php
		}else{
			header('Location: /work/php/registration.php');
		}
	}


	function SetAccountClient(){
		session_start();
		$bdd = new PDO('mysql:host=localhost;dbname=SiteDeRecontre;charset=utf8', 'root', '');

		if(isset($_POST['region'])      && empty($_POST['region'])      == false &&
		   isset($_POST['departement']) && empty($_POST['departement']) == false){
			$pseudo      = $_SESSION['pseudo'];
			$region      = htmlspecialchars($_POST['region']);
			$departement = htmlspecialchars($_POST['departement']);

			$req = $bdd->prepare('INSERT INTO Localisation(pseudo, region, departement) 
								  VALUES(:pseudo, :region, :departement)');
			$req->execute(array(
				'pseudo'      => $pseudo,
				'region'      => $region,
				'departement' => $departement	 
			));
		}	
		
		if(isset($_POST['clientgenre'])         && empty($_POST['clientgenre'])         == false && 
		   isset($_POST['clientpoids'])         && empty($_POST['clientpoids'])         == false && 
		   isset($_POST['clientcouleurspeaux']) && empty($_POST['clientcouleurspeaux']) == false){
			$pseudo              = $_SESSION['pseudo'];
			$clientgenre         = htmlspecialchars($_POST['clientgenre']);
			$clientpoids         = htmlspecialchars($_POST['clientpoids']);
			$clientcouleurspeaux = htmlspecialchars($_POST['clientcouleurspeaux']);		
			
			$req = $bdd->prepare('INSERT INTO Physique(pseudo, clientgenre, clientpoids, clientcouleurspeaux)
								  VALUES(:pseudo, :clientgenre, :clientpoids, :clientcouleurspeaux)');
			$req->execute(array(
				'pseudo'              => $pseudo,
				'clientgenre'         => $clientgenre,
				'clientpoids'         => $clientpoids,
				'clientcouleurspeaux' => $clientcouleurspeaux
			));
		
		}

		if(isset($_POST['prefgenre'])         && empty($_POST['prefgenre'])         == false && 
		   isset($_POST['prefcouleurspeaux']) && empty($_POST['prefcouleurspeaux'])  == false &&
		   isset($_POST['prefpoids'])         && empty($_POST['prefpoids'])         == false &&
		   isset($_POST['prefcouleurschx'])   && empty($_POST['prefcouleurschx'])   == false){
			$pseudo            = $_SESSION['pseudo'];
			$prefgenre         = htmlspecialchars($_POST['prefgenre']);	
			$prefcouleurspeaux = htmlspecialchars($_POST['prefcouleurspeaux']);
			$prefpoids         = htmlspecialchars($_POST['prefpoids']);
			$prefcouleurschx   = htmlspecialchars($_POST['prefcouleurschx']);

			$req = $bdd->prepare('INSERT INTO Preferences(pseudo, prefgenre, prefcouleurspeaux, prefpoids, prefcouleurschx)
							      VALUES(:pseudo, :prefgenre, :prefcouleurspeaux, :prefpoids, :prefcouleurschx)');

			$req->execute(array(
				'pseudo'            => $pseudo,
				'prefgenre'         => $prefgenre,
				'prefcouleurspeaux' => $prefcouleurspeaux,
				'prefpoids'         => $prefpoids,
				'prefcouleurschx'   => $prefcouleurschx
			));

		}	
			
		
	}

	


	/**Appel des fonctions**/ 
	
	//dans le cas où l'action est enregistrer le compte 
	if(isset($_GET['action']) && htmlspecialchars($_GET['action']) == "register"){	
		CheckNickname();
		RegisterClient();
	}

	//dans le cas où l'action est de set un nouveau profile
	if(isset($_GET['action']) && htmlspecialchars($_GET['action']) == "setaccount"){
		SetAccountClient();
	}
	
	?>


</body>
</html>
