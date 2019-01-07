<!DOCTYPE HTML>
<html>
    <title>Site de Rencontre</title>
    <head><link rel="stylesheet" type="text/css" href="/work/css/style.css"></head>
    <body>

        <?php
	      
          /***************************************************************************************
          *@method DisplayProfile: Affiche le profile d'un client.*
          *@param  void: void                                              *
          *@return : Renvoie un void                                                        *
          ***************************************************************************************/
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
                        
            var it = clientCourrantMap.entries();
            console.log("it.next().value=");
            var pseudoCourant = it.next().value[0];
            console.log(pseudoCourant);
                        
            console.log(clientCourrantMap.get(pseudoCourant));
            console.log(clientCourrantMap.get(pseudoCourant)[0]);
            console.log(clientsMap);
                
           /***************************************************************************************
           *@method AlgorithmeDeMatching: Fonction qui gère l'algorithme de matching (les affinités entre deux clients (les deux paramètres)).*
           *@param  client1: pseudo du client connecté (client courant)                                             *
           *@param  client2: pseudo d'un des autres clients                                             *
           *@return : Renvoie la valeur des points d'affinités (plus elle est élevée, plus il y a d'affinités entre les deux clients comparés                   *
           ***************************************************************************************/         
            function AlgorithmeDeMatching(client1, client2){
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

          /***************************************************************************************
          *@method ComparerValeurs: Permet de trier le tableau "resultatsComparaisonsTableau" dans l'ordre décroissant .*
          *@param  val1: première valeur à comparer                                         *
          *@param  val2: seconde valeur à comparer                                         *
          *@return : Renvoie la différence entre la deuxième valeur et la première valeur.                                                       *
          ***************************************************************************************/
            function ComparerValeurs(val1, val2) {
                var nouv_val1_str = val1.split('|');
                var nouv_val2_str = val2.split('|');
                var nouv_val1 = nouv_val1_str[0];
                var nouv_val2 = nouv_val2_str[0];
                //document.write('<p>' + "nouv_val1=" + nouv_val1 + "<br><br>" + '</p>');
                return nouv_val2 - nouv_val1;
            }
        </script>

        
               
        <script type="text/javascript">                
                        var iteratif_client_important = [];
                        /***************************************************************************************
                        *@method FonctionMatching(): Fonction qui va lancer tous le processus du matching, de l'algorithme du matching aux comparaisons des résultats d'affinités entre les clients et l'affichage graphique.*
                        *@param  void: void                                     *
                        *@return : void.                                                       *
                        ***************************************************************************************/
                        function FonctionMatching(){
                            
                            var resultatsComparaisonsTableau = [];
                            for (var i = 0; i < clientsMap.size; ++i){
                                var resultat = AlgorithmeDeMatching(clientCourrantMap.get(pseudoCourant), clientsMap.get(pseudoclients[i]));
                                console.log("resultat=" + resultat);
                                resultatsComparaisonsTableau.push(resultat+'|'+i);
                            }
                            resultatsComparaisonsTableau.sort(ComparerValeurs);
                            
                            console.log("tableaux de comparaisons" + resultatsComparaisonsTableau);
                            
                            var longueur_population = resultatsComparaisonsTableau.length/2;
                            iteratif_client_important = [];
                            for (var i2 = 0; i2 < longueur_population; ++i2){
                                var iteratif_str = resultatsComparaisonsTableau[i2].split('|');
                                var iteratif = iteratif_str[1];
                                iteratif_client_important.push(iteratif);
                                document.write('<p>' + "tableaux de comparaisons=" + pseudoclients[iteratif] + " a " + iteratif_str[0] +" points d'affinités avec vous." + "<br><br>" + '</p>');
                            }
                            //document.write('<div id="app"> <div id="bordureEtimage_polaroid"> <div id="bordure_polaroid"> <div id="image_polaroid"><img src="../img/img1.jpg" /> </div> <p id="info_principale_polaroid">' + pseudoCourant + ', ' + 25 + " ans" + '</p> </div> </div>');
                            
                            
                            //document.write('<p>' + "tableaux de comparaisons=" + pseudoclients[4] + "<br><br>" + '</p>');
                        }
		</script>
        
        <script type="text/javascript">     
          /***************************************************************************************
          *@method Display: affichage graphique des informations du client connecté .*
          *@param  void: void                                         *
          *@return : Renvoie un void                                                    *
          ***************************************************************************************/
        function Display(){
            var age_recup = 25; //âge à récupérer
             
                        
            document.write('<p>' + "Votre pseudo:" + pseudoCourant + '<br> Votre mail:' + clientCourrantMap.get(pseudoCourant)[0] + '</p>');
            document.write("<form method='post' action='account.php?action=matching'> <input type='submit' class = 'bouton1'>Trouver des personnes qui ont des affinités avec vous grâce à l'algorithme de matching</input></form>");
            document.write('<p>' + "Polaroïd: <br><br><br>" + '</p>');
            document.write('<p>' + pseudoCourant + ", " + age_recup + " ans<br><br>" + "Autres Infos: <br><br>" + '</p>');
            document.write('<div id="bordureEtimage_polaroid"> <div id="bordure_polaroid"> <div id="image_polaroid"><img src="../img/img2.jpg"/> </div> <p id="info_principale_polaroid">' + pseudoCourant + ', ' + age_recup + " ans" + '</p> </div>');
        }
        </script>

        

        <?php
        /*on ajoute les différentes conditions pour bien afficher : 
         *le compte connecté et le résultat de l'algo de matching*/
            if(isset($_GET['action']) && htmlspecialchars($_GET['action']) == "display"){
        
        ?>

        <script type="text/javascript"> Display(); </script>              
        
        <?php    
            }
        
            if(isset($_GET['action']) && htmlspecialchars($_GET['action']) == "matching"){
        ?>
        <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="https://code.jquery.com/mobile/1.4.4/jquery.mobile-1.4.4.min.js"></script>
        
        <script type="text/javascript"> 

        FonctionMatching();

        console.log("client important taille =" + iteratif_client_important.length);

        var div_clients_swipe = "";

        /*for(var ij = 0; ij < iteratif_client_important.length; ij++){
            div_clients_swipe += '<div class="composant_total"><div class="composant_total"></div></div>';
        }*/

        
        //document.write('<div class="composant_total"> <div class="composants_swipe"><div class="client"></div></div> <div class="composants_swipe"><div class="client"></div></div> <div class="composants_swipe"><div class="client"></div></div> <div class="composants_swipe"><div class="client"></div></div> <div class="composants_swipe"><div class="client"></div></div></div>')

        console.log("COMPOSANTS DU SWIPE0=", pseudoclients[iteratif_client_important[0]]);

        //document.write('<div class="composant_total">

        document.write('<style>');

        for(var ij = 0; ij < iteratif_client_important.length; ij++){
            document.write('.client' + ij + ':after{font-weight: bold;font-size:110%;margin: 350px;top:50px;color: blue;content: "' + pseudoclients[iteratif_client_important[ij]] + '";}.client' + ij + '{background: white;font-size:100%;width: 320px;height: 320px;display: block;title=' + ij +'margin-top: 15px;margin-left: 15px; background-image: url("../img/img1.jpg");background-repeat: no-repeat; background-size:cover; margin:0;}');

        }

        document.write('</style>   <div class="composant_total">');

        for(var ij = 0; ij < iteratif_client_important.length; ij++){
            document.write('<div class="composants_swipe"><div class="client' + ij + '"> </div></div>');
        }

        document.write('</div>');

          /***************************************************************************************
          *@method MettreClientLike: La fonction qui s'occupe de l'affichage graphique du like.*
          *@param  pseudo_client: le pseudo du client a liker                                         *
          *@return : Renvoie un void                                                    *
          ***************************************************************************************/
        function MettreClientLike(pseudo_client) {
            var pLike1 = document.createElement("p");

            var texteLike = document.createTextNode("Vous avez liké " + pseudo_client + "!");

            pLike1.appendChild(texteLike);

            var pLike2 = document.getElementById("pLike2");
            document.body.insertBefore(pLike1, pLike2);
        }


          /***************************************************************************************
          *@method FonctionSwipe: La fonction qui s'occupe du swipe de gauche à droite ou de droite à gauche, ainsi que du like, et à l'affichage des images et prénoms des clients.*
          *@param  void: void                                         *
          *@return : Renvoie un void                                                    *
          ***************************************************************************************/
        function FonctionSwipe(){
            var composants_swipe_c = document.getElementsByClassName("composants_swipe");
            var composants_nombre = composants_swipe_c.length;
            console.log("composants_swipeclenght =" + composants_swipe_c.length);
            console.log("dans la fonction2");


            /*document.querySelector(".client0").addEventListener("dblclick",function(){
                    MettreClientLike(pseudoclients[iteratif_client_important[0]]);
            });

            document.querySelector(".client1").addEventListener("dblclick",function(){
                    MettreClientLike(pseudoclients[iteratif_client_important[1]]);
            });

            document.querySelector(".client2").addEventListener("dblclick",function(){
                    MettreClientLike(pseudoclients[iteratif_client_important[2]]);
            });

            document.querySelector(".client3").addEventListener("dblclick",function(){
                    MettreClientLike(pseudoclients[iteratif_client_important[3]]);
            });*/

            
            for(var ic=0; ic<4 ;++ic){

            document.querySelector(".client" + ic).addEventListener("dblclick",function(){
                    MettreClientLike(pseudoclients[iteratif_client_important[ic]]);
            });

            }


           
            for (var i = 0; i < composants_nombre; i++) {
                console.log("dans le for1");
                composants_swipe_c[i].addEventListener("dblclick",function(){
                    console.log("DOUBLE CLICK = dans LIKE");
                    
                    $(this).addClass('like').delay(1000).fadeOut(1);

                    if ( $(this).is(':last-child') ) {
                        $('.composants_swipe:nth-child(1)').removeClass ('swipe_gauche swipe_droit like').fadeIn(300);
                    } else {
                        $(this).next().removeClass('swipe_gauche swipe_droit like').fadeIn(400);
                    }
                });
            }

            $(".composants_swipe").on("swiperight",function(){
                console.log("dans RIGHT");
                $(this).addClass('swipe_gauche').delay(1000).fadeOut(1);

                if ( $(this).is(':last-child') ) {
                    console.log("dans LAST");
                    $('.composants_swipe:nth-child(1)').removeClass ('swipe_gauche swipe_droit like').fadeIn(300);
                } else {
                    console.log("dans ELSE");
                    $(this).next().removeClass('swipe_gauche swipe_droit like').fadeIn(400);
                }
            });

            $(".composants_swipe").on("swipeleft",function(){
                $(this).addClass('swipe_droit').delay(1000).fadeOut(1);

                if ( $(this).is(':last-child') ) {
                    console.log("dans LAST");
                    $('.composants_swipe:nth-child(1)').removeClass ('swipe_gauche swipe_droit like').fadeIn(300);
                } else {
                    console.log("dans ELSE");
                    $(this).next().removeClass('swipe_gauche swipe_droit like').fadeIn(400);
                }
            });
        }

        FonctionSwipe();



        </script>
        
        <?php    
            } 
        ?>



    </body>
</html>
