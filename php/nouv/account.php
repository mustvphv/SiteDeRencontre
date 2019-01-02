<!-- Fichier account.php, ce fichier montre les informations du client.-->

<!DOCTYPE HTML>
<html>
    <title>Site de Rencontre</title>
    <head><link rel="stylesheet" type="text/css" href="/work/css/style.css"></head>
    <body>




        <?php
			function DisplayProfile(){
         		session_start();
            	$id = htmlspecialchars($_SESSION['id']);
       			
       			$bdd    = new PDO('mysql:host=localhost;dbname=SiteDeRecontre;charset=utf8', 'root', '');
				$answer = $bdd->query('SELECT * FROM User WHERE id="'.$id.'"');
				$datadb = $answer->fetch();
		
				$pseudoclient = htmlspecialchars($datadb['pseudo']);
				//Réponses des informations du client courrant  connecté.
				$reponseClientUser         = $bdd->query('SELECT * FROM User WHERE pseudo="'.$pseudoclient.'"');
				$reponseClientLocalisation = $bdd->query('SELECT * FROM Localisation WHERE pseudo="'.$pseudoclient.'"'); 
				$reponseClientPhysique     = $bdd->query('SELECT * FROM Physique WHERE pseudo="'.$pseudoclient.'"');
				$reponseClientPreferences  = $bdd->query('SELECT * FROM Preferences WHERE pseudo="'.$pseudoclient.'"');	
				
				//on fetch les données directement car il y a qu'une ligne dans la table.
				$valueClientUser         = $reponseClientUser->fetch();
				$valueClientLocalisation = $reponseClientLocalisation->fetch();
				$valueClientPhysique     = $reponseClientPhysique->fetch();
				$valueClientPreferences  = $reponseClientPreferences->fetch();
				// Réponses des informations de tous les clients sauf le client courrant.
				$reponseUser         = $bdd->query('SELECT * FROM User WHERE pseudo!="'.$pseudoclient.'"');
				$reponseLocalisation = $bdd->query('SELECT * FROM Localisation WHERE pseudo!="'.$pseudoclient.'"'); 
				$reponsePhysique     = $bdd->query('SELECT * FROM Physique WHERE pseudo!="'.$pseudoclient.'"');
				$reponsePreferences  = $bdd->query('SELECT * FROM Preferences WHERE pseudo!="'.$pseudoclient.'"');	
		?>
		
		<script type="text/javascript">	
				var clientsMap = new Map;
				var pseudoclients = [];
				//Nouveau map 
				var clientCourrantMap    = new Map;
				var pseudoclientCourrant = <?php echo json_encode($pseudoclient);?> ;  
				//on set un map avec les informations du client courrant. 
				clientCourrantMap.set(pseudoclientCourrant                                   ,
					[<?php echo json_encode($valueClientUser['email']);                   ?> , 
					<?php echo json_encode($valueClientLocalisation['departement']); 	  ?> ,
					<?php echo json_encode($valueClientLocalisation['region']); 		  ?> ,
					<?php echo json_encode($valueClientPhysique['clientgenre']); 		  ?> ,
					<?php echo json_encode($valueClientPhysique['clientpoids']);          ?> ,
					<?php echo json_encode($valueClientPhysique['clientcouleurspeaux']);  ?> ,
					<?php echo json_encode($valueClientPreferences['prefgenre']);         ?> ,
					<?php echo json_encode($valueClientPreferences['prefcouleurspeaux']); ?> ,
					<?php echo json_encode($valueClientPreferences['prefpoids']);         ?> ,
					<?php echo json_encode($valueClientPreferences['prefcouleurschx']);   ?>
					]);
		</script>	
		
		<?php		
				// on set un map avec les informations des autres clients.
				while($valueUser = $reponseUser->fetch()){
					$valueLocalisation = $reponseLocalisation->fetch();		
					$valuePhysique     = $reponsePhysique->fetch();  
					$valuePreferences  = $reponsePreferences->fetch();
		?>		
					<script type="text/javascript">
					pseudoclients.push(<?php echo json_encode($valueUser['pseudo']);?>);
					
					clientsMap.set(<?php echo json_encode($valueUser['pseudo']); 	    ?> , 
						[<?php echo json_encode($valueUser['email']);                   ?> , 
						<?php echo json_encode($valueLocalisation['departement']); 	    ?> ,
						<?php echo json_encode($valueLocalisation['region']); 		    ?> ,
						<?php echo json_encode($valuePhysique['clientgenre']); 		    ?> ,
						<?php echo json_encode($valuePhysique['clientpoids']);          ?> ,
						<?php echo json_encode($valuePhysique['clientcouleurspeaux']);  ?> ,
						<?php echo json_encode($valuePreferences['prefgenre']);         ?> ,
						<?php echo json_encode($valuePreferences['prefcouleurspeaux']); ?> ,
						<?php echo json_encode($valuePreferences['prefpoids']);         ?> ,
						<?php echo json_encode($valuePreferences['prefcouleurschx']);   ?>
					]);
					
					</script>

		<?php
				}
			}
			DisplayProfile();
	
		?>

		<script type="text/javascript">
			// algo de matching
			console.log(clientCourrantMap);
			console.log(clientsMap);
//################################################################
                        //console.log(pseudoclients[0]);
                        
                        var it = clientCourrantMap.entries();
                        console.log("it.next().value=");
                        var pseudoCourant = it.next().value[0];
                        console.log(pseudoCourant);
                        
                        //var value0_str = it.next().value[0];

                        console.log(clientCourrantMap.get(pseudoCourant));
                        console.log(clientCourrantMap.get(pseudoCourant)[0]);

                        console.log(clientsMap);
                         

                        /*var clients_array = new Array(clientsMap.get(pseudoclients[0]));
                        console.log(clients_array);
                        console.log("début info");

                        for (const [key, value] of Object.entries(clients_array)) {
                            console.log(key, value);
                            //break;
                        }

                        if(id_courant < 1){
                            console.log("ERREUR");
                        }
                        console.log("début id courant[0]");
                        console.log(id_courant);*/


                        function Algorithme_de_Matching(client1, client2){
                            var somme_affinites = 0;
                            if(client1[1] == client2[1]){//comparaison département
                                somme_affinites += 20;
                            }
                            if(client1[2] == client2[2]){//comparaison région
                                somme_affinites += 10;
                            }
                            if(client1[3] == client2[6] && client2[3] == client1[6]){//comparaison genre et prefgenre
                                somme_affinites += 5;
                            }
                            else{
                                somme_affinites -= 100;
                            }
                            if(client1[8] == client2[4]){//comparaison poids et prefpoids
                                somme_affinites += 5;
                            }
                            if(client1[7] == client2[5]){//comparaison couleurpeau et prefcouleurpeau
                                somme_affinites += 5;
                            }
                            return somme_affinites;
                        }

                        function comparer_valeurs(val1, val2) {
                            var nouv_val1_str = val1.split('|');
                            var nouv_val2_str = val2.split('|');
                            var nouv_val1 = nouv_val1_str[0];
                            var nouv_val2 = nouv_val2_str[0];
                            //document.write('<p>' + "nouv_val1=" + nouv_val1 + "<br><br>" + '</p>');
                            return nouv_val2 - nouv_val1;
                        }


                        
                        function fonction1(){
                            var resultatsComparaisonsTableau = [];
                            for (var i = 0; i < clientsMap.size; ++i){
                                var resultat = Algorithme_de_Matching(clientCourrantMap.get(pseudoCourant), clientsMap.get(pseudoclients[i]));
                                console.log("resultat=" + resultat);
                                document.write('<p>' + 'Résultat algo pour comparaison client "' + pseudoCourant + '" et client "' + pseudoclients[i] + '"=' + resultat + '</p>');
                                resultatsComparaisonsTableau.push(resultat+'|'+i);
                            }

                            resultatsComparaisonsTableau.sort(comparer_valeurs);
                            document.write('<p>' + "tableauxTAILLE=" + resultatsComparaisonsTableau.length + "<br><br>" + '</p>');

                            console.log("tableaux de comparaisons" + resultatsComparaisonsTableau);
                            
                            var longueur_population = resultatsComparaisonsTableau.length/2;
                            var iteratif_client_important = [];
                            for (var i2 = 0; i2 < longueur_population; ++i2){
                                var iteratif_str = resultatsComparaisonsTableau[i2].split('|');
                                var iteratif = iteratif_str[1];
                                iteratif_client_important.push(iteratif);
                                document.write('<p>' + "tableaux de comparaisons=" + pseudoclients[iteratif] + " a " + iteratif_str[0] +" points d'affinités avec vous." + "<br><br>" + '</p>');
                            }
                            document.write('<p>' + "ITERATIF=" + iteratif_client_important + "<br><br>" + '</p>');



                            document.write('<div id="app"> <div id="bordureEtimage_polaroid"> <div id="bordure_polaroid"> <div id="image_polaroid"><img src="../img/img1.jpg" /> </div> <p id="info_principale_polaroid">' + pseudoCourant + ', ' + age_recup + " ans" + '</p> </div> </div>');
                            
                            

                            //document.write('<p>' + "tableaux de comparaisons=" + pseudoclients[4] + "<br><br>" + '</p>');
                        }


                        var age_recup = 25; //âge à récupérer
             
                        
                        document.write('<p>' + "Votre pseudo:" + pseudoCourant + '<br> Votre mail:' + clientCourrantMap.get(pseudoCourant)[0] + '</p>');

                        document.write("<button type='submit' class = 'bouton1'>Trouver des personnes qui ont des affinités avec vous grâce à l'algorithme de matching</button>");

                        document.write('<p>' + "Polaroïd: <br><br><br>" + '</p>');

                        document.write('<p>' + pseudoCourant + ", " + age_recup + " ans<br><br>" + "Autres Infos: <br><br>" + '</p>');


                            document.write('<div id="app"> <div id="bordureEtimage_polaroid"> <div id="bordure_polaroid"> <div id="image_polaroid"><img src="../img/img1.jpg"/> </div> <p id="info_principale_polaroid">' + pseudoCourant + ', ' + age_recup + " ans" + '</p> </div> </div>');

                        document.querySelector(".bouton1").addEventListener("click", function(){
                            fonction1();
                            //location="/work/php/account.php";                      
                        });
		</script>


    </body>
</html>
