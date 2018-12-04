<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
	function Enregistre(){
		$bdd = new PDO('mysql:host=localhost;dbname=SiteDeRecontre;charset=utf8', 'root', '');	


		if(isset($_POST['pseudo']) && empty($_POST['pseudo']) == false && 
		   isset($_POST['pass'])   && empty($_POST['pass'])   == false &&
		   isset($_POST['email'])  && empty($_POST['email'])  == false){
			$req = $bdd->prepare('INSERT INTO User(pseudo,password,email) VALUES(:pseudo, :password, :email)');
			$req->execute(array(
				'pseudo'   => $_POST['pseudo'],
				'password' => $_POST['pass'],
				'email'    => $_POST['email'] 
			));

			echo "Ok !";
	?>	
	<!--<script type="text/javascript">
		var tmp = <?php //echo json_encode($_POST['pseudo']);?>;
		console.log(tmp);
	</script>-->	
	<?php
		}else{
			header('Location: /work/connexion.php');
		}
	}

	Enregistre();
	?>


</body>
</html>
