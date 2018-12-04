<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
	function CheckNickname(){
		$bdd = mysqli_connect("localhost", "root", "", "SiteDeRecontre");
		$anwser = mysqli_query($bdd, 'SELECT COUNT(*) AS existNickName FROM User WHERE pseudo="'.$_POST['pseudo'].'"');
		$data = mysqli_fetch_array($anwser);

		if(!($data['existNickName'] == '0')){
			//echo "NickName already exist\n";
			echo "<script type=\"text/javascript\">alert(\"NickName already used\"); location=\"connexion.php\"</script>";
			exit(1);
		}
	} 


	function Save(){
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

	CheckNickname();
	Save();
	?>


</body>
</html>
