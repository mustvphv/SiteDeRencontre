<!-- Fichier account ce fichier montre les informations du client.-->

<!-- Essaye de corrigé les soucis de indentations dans tes fonctions je sais pas si c'est la transition entre mes modifications
    et les tiennes qui cassent tout mais bon. J'ai rajouté une fonction Display pour afficher les informations du compte 
    du client qui est connecté. En php ensuite je fais des conditions en modifiant l'url avec certains variables pour bien
    séparé le moment où j'affiche le comtpe l'utilisateur et les résultats de l'algo de matching. Ensuite faut que tu enlèves
    le document write qui affiche la photo dans les résultats on s'en fou et cest pas important. Ensuite si tu peux, essaye de
    mettre une majuscule a sur la première lettre de tes fonctions pour bien qu'on sache que c'est une fonction et pas une
    variable voilà.-->  

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
                    <?php echo json_encode($valueClientLocalisation['departement']);      ?> ,
                    <?php echo json_encode($valueClientLocalisation['region']);           ?> ,
                    <?php echo json_encode($valueClientPhysique['clientgenre']);          ?> ,
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
                    
                    clientsMap.set(<?php echo json_encode($valueUser['pseudo']);        ?> , 
                        [<?php echo json_encode($valueUser['email']);                   ?> , 
                        <?php echo json_encode($valueLocalisation['departement']);      ?> ,
                        <?php echo json_encode($valueLocalisation['region']);           ?> ,
                        <?php echo json_encode($valuePhysique['clientgenre']);          ?> ,
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

        </script>

        
               
        <script type="text/javascript">                
                        
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



                            document.write('<div id="app"> <div id="bordureEtimage_polaroid"> <div id="bordure_polaroid"> <div id="image_polaroid"><img src="../img/img1.jpg" /> </div> <p id="info_principale_polaroid">' + pseudoCourant + ', ' + 25 + " ans" + '</p> </div> </div>');
                            
                            

                            //document.write('<p>' + "tableaux de comparaisons=" + pseudoclients[4] + "<br><br>" + '</p>');
                        }
        </script>
        
        <script type="text/javascript">                

        function Display(){
            var age_recup = 25; //âge à récupérer
             
                        
            document.write('<p>' + "Votre pseudo:" + pseudoCourant + '<br> Votre mail:' + clientCourrantMap.get(pseudoCourant)[0] + '</p>');

            document.write("<form method='post' action='account.php?action=matching'> <input type='submit' class = 'bouton1'>Trouver des personnes qui ont des affinités avec vous grâce à l'algorithme de matching</input></form>");

            document.write('<p>' + "Polaroïd: <br><br><br>" + '</p>');

            document.write('<p>' + pseudoCourant + ", " + age_recup + " ans<br><br>" + "Autres Infos: <br><br>" + '</p>');


            document.write('<div id="app"> <div id="bordureEtimage_polaroid"> <div id="bordure_polaroid"> <div id="image_polaroid"><img src="../img/img1.jpg"/> </div> <p id="info_principale_polaroid">' + pseudoCourant + ', ' + age_recup + " ans" + '</p> </div> </div>');

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
        
        <script type="text/javascript"> fonction1(); </script> 
        
        <?php    
            } 
        ?>



    </body>
</html>
