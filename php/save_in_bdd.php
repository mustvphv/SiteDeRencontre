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
		$bdd = new PDO('mysql:host=localhost;dbname=SiteDeRecontre;charset=utf8', 'root', '');	


		if(isset($_POST['pseudo']) && empty($_POST['pseudo']) == false && 
		   isset($_POST['pass'])   && empty($_POST['pass'])   == false &&
		   isset($_POST['email'])  && empty($_POST['email'])  == false){
			$pseudo = htmlspecialchars($_POST['pseudo']);
			$pass   = hash('sha256', htmlspecialchars($_POST['pass']));
			$email  = htmlspecialchars($_POST['email']);	

			$req = $bdd->prepare('INSERT INTO User(pseudo,password,email) VALUES(:pseudo, :password, :email)');
			$req->execute(array(
				'pseudo'   => $pseudo,
				'password' => $pass,
				'email'    => $email 
			));

			session_start();
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
		$bdd = new PDO('mysql:host=localhost;dbname=SiteDeRecontre;charset=utf8', 'root', '');
	}

	


	//Appel des fonctions 
	if(isset($_GET['action']) && htmlspecialchars($_GET['action']) == "register"){	
		CheckNickname();
		RegisterClient();
	}



	?>


</body>
</html>
