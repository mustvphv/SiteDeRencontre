window.onload = main


function elementFactory(elementName, parent , x, y, width, height, styles, classes, text){
    var el = document.createElement(elementName);
    
    el.style.left = x + "px";
    el.style.top = y + "px";
    el.style.width = width + "px";
    el.style.height = height + "px";
    el.style.className = classes;

    texte1 = document.createTextNode(text);
    parent.appendChild(texte1);

    for(var property in styles) el.style[property] = styles[property];

    el.id = "q4";
    
    parent.appendChild(el);
}

class Localisation{
    creerRegion(region){
        var region = "Île-de-France";
        this.region = region;
        return this.region;
    }

    creerDepartement(departement){
        var departement = "Hauts-de-Seine";
        this.departement = departement;
        return this.departement;
    }

    creerVille(ville){
        var ville = "Courbevoie";
        this.ville = ville;
        return this.ville;
    }

}

class Physique{

    creerAge(age){
        var age = "28";

        this.age = age;
        return this.age;
    }

    creerTaille(taille){
        var taille = "1m85";
        this.taille = taille;
        return this.taille;
    }

    creerCheveux(cheveux){
        var cheveux = "brun";
        this.cheveux = cheveux;
        return this.cheveux;
    }

    creerDivers(divers){  //origine, signes particuliers...
        var divers = ["rien"];
        this.divers = divers;
        return this.divers;
    }

}

class Preferences{
    preferenceTrancheDAge(preference_tranche_d_age){
        var preference_tranche_d_age = ["25", "30"];
        this.preference_tranche_d_age = preference_tranche_d_age;
        return this.preference_tranche_d_age;
    }

    preferenceTrancheDeTaille(preference_tranche_de_taille){
        var preference_tranche_de_taille = ["1m60", "1m70"];
        this.preference_tranche_de_taille = preference_tranche_de_taille;
        return this.preference_tranche_de_taille;
    }

    /*preferencesPoids(){

    }*/

    preferenceCheveux(preference_cheveux){
        var preference_cheveux = ["brun","blond"];
        this.preference_cheveux = preference_cheveux;
        return this.preference_cheveux;
    }

    preferenceDivers(preference_divers){
        var preference_divers = ["rien"];
        this.preference_divers = preference_divers;
        return this.preference_divers;
    }

}

/*
class Polaroid{


}

class Message{


}
*/

class Client{
    creerPseudo(pseudo){
        var pseudo = "Jiji92"; //à la place de "Jiji92"(pseudo donné par défaut", on apellera une fonction qui va récupérer l'information à partir de la base de données
        this.pseudo = pseudo;
        return this.pseudo;
    }

    creerNumero(numero_client){
        var numero_client = "000001";
        this.numero_client = numero_client;
        return this.numero_client;

    }

    creerCentreDInterets(centre_d_interets){
        var centre_d_interets = ["le basket", "la boxe", "les jeux vidéos"];
        this.centre_d_interets = centre_d_interets;
        return this.centre_d_interets;
    }

    creerLocalisation(var_temoin, localisation){
        var localisation = new Localisation();
        var LocalisationInfo = "ERREUR";
        if (var_temoin == "Region"){
            var LocalisationRegion = localisation.creerRegion();
            LocalisationInfo = LocalisationRegion;            
        }

        if (var_temoin == "Departement"){
            var LocalisationDepartement = localisation.creerDepartement();
            LocalisationInfo = LocalisationDepartement;            
        }

        if (var_temoin == "Ville"){
            var LocalisationVille = localisation.creerVille();
            LocalisationInfo = LocalisationVille;            
        }
        
        return LocalisationInfo;
    }

    creerGenre(genre){
        var genre= "Homme";
        this.genre = genre;
        return this.genre;
    }

    creerActivitesProfessionnelles(){
        var activites_professionnelles = "développeur";
        this.activites_professionnelles = activites_professionnelles;
        return this.activites_professionnelles;
    }

    creerDescriptionPhysique(var_temoin, description_physique){
        var description_physique = new Physique();
        var PhysiqueInfo = "ERREUR";
        if(var_temoin == "Age"){
            var PhysiqueAge = description_physique.creerAge();
            PhysiqueInfo = PhysiqueAge;    
        }
        if(var_temoin == "Taille"){
            var PhysiqueTaille = description_physique.creerTaille();
            PhysiqueInfo = PhysiqueTaille;    
        }
        if(var_temoin == "Cheveux"){
            var PhysiqueCheveux = description_physique.creerCheveux();
            PhysiqueInfo = PhysiqueCheveux;    
        }
        if(var_temoin == "Divers"){
            var PhysiqueDivers = description_physique.creerDivers();
            PhysiqueInfo = PhysiqueDivers;
        }
        
        return PhysiqueInfo;

    }

    creerPreferences(var_temoin, description_preferences){
//pourquoi pas rajouter preferences divers (état d'esprit)
        var description_preferences = new Preferences();
        var PreferencesInfo = "ERREUR";
        if(var_temoin == "Age"){
            var PreferencesAge = description_preferences.preferenceTrancheDAge();
            PreferencesInfo = PreferencesAge;
        }
        if(var_temoin == "Taille"){
            var PreferencesTaille = description_preferences.preferenceTrancheDeTaille();
            PreferencesInfo = PreferencesTaille;
        }
        if(var_temoin == "Cheveux"){
            var PreferencesCheveux = description_preferences.preferenceCheveux();
            PreferencesInfo = PreferencesCheveux;
        }
        if(var_temoin == "Divers"){
            var PreferencesDivers = description_preferences.preferenceDivers();
            PreferencesInfo = PreferencesDivers;
        }
        
        return PreferencesInfo;

    }




    /*creerMessage(){   //pas pour l'instant


    }*/


    /*creerPhoto(){ //pas pour l'instant


    }*/

}

var M = {}, V = {}, C = {};
var nouveau_client = new Client();

M = {
    donnees: {
        ClientPseudo : "nom_de_base",
        ClientNumero : "222222",
        ClientCentreDInterets : ["1","2"],
        ClientLocalisationRegion : "aaaaa",
        ClientLocalisationDepartement : "aaaaa",
        ClientLocalisationVille : "aaaaa",
        ClientGenre : "aaaaa",
        ClientActivitesProfessionnelles : "aaaaa",
        ClientPhysiqueAge : "30",
        ClientPhysiqueTaille : "1m70",
        ClientPhysiqueCheveux : "brun",
        ClientPhysiqueDivers : "rien",
        ClientPreferencesAge : ["30","40"],
        ClientPreferencesTaille : ["1m70", "1m80"],
        ClientPreferencesCheveux : ["brun", "blond"],
        ClientPreferencesDivers : ["rien"],

    }, 
    assigDonnees : function(info){
        /*this.data.ClientPseudo = info.ClientPseudo;
        this.data.ClientNumero = info.ClientNumero;
        this.data.ClientCentreDInterets = info.ClientCentreDInterets;
        this.data.ClientLocalisationRegion = info.ClientLocalisationRegion;
        this.data.ClientLocalisationRegion = info.ClientLocalisationDepartement;
        this.data.ClientLocalisationRegion = info.ClientLocalisationVille;*/
    },
    retourDonnees : function(){
        return donnees;
    }
}

V = {
    ClientPseudo : nouveau_client.creerPseudo(),
    ClientNumero : nouveau_client.creerNumero(),
    ClientCentreDInterets : nouveau_client.creerCentreDInterets(),
    ClientLocalisationRegion : nouveau_client.creerLocalisation("Region"),
    ClientLocalisationDepartement : nouveau_client.creerLocalisation("Departement"),
    ClientLocalisationVille : nouveau_client.creerLocalisation("Ville"),
    ClientGenre : nouveau_client.creerGenre(),
    ClientActivitesProfessionnelles : nouveau_client.creerActivitesProfessionnelles(),
    ClientPhysiqueAge : nouveau_client.creerDescriptionPhysique("Age"),
    ClientPhysiqueTaille : nouveau_client.creerDescriptionPhysique("Taille"),
    ClientPhysiqueCheveux : nouveau_client.creerDescriptionPhysique("Cheveux"),
    ClientPhysiqueDivers : nouveau_client.creerDescriptionPhysique("Divers"),
    ClientPreferencesAge : nouveau_client.creerPreferences("Age"),
    ClientPreferencesTaille : nouveau_client.creerPreferences("Taille"),
    ClientPreferencesCheveux : nouveau_client.creerPreferences("Cheveux"),
    ClientPreferencesDivers : nouveau_client.creerPreferences("Divers"),
    nouv: function(M){
        this.ClientPseudo.value = M.donnees.ClientPseudo;
        this.ClientNumero.value = M.donnees.ClientNumero;
        this.ClientCentreDInterets.value = M.donnees.ClientCentreDInterets;
        this.ClientLocalisationRegion.value = M.donnees.ClientLocalisationRegion;
        this.ClientLocalisationDepartement.value = M.donnees.ClientLocalisationDepartement;
        this.ClientLocalisationVille.value = M.donnees.ClientLocalisationVille;
        this.ClientGenre.value = M.donnees.ClientGenre;
        this.ClientActivitesProfessionnelles.value = M.donnees.ClientActivitesProfessionnnelles;
        this.ClientPhysiqueAge.value = M.donnees.ClientPhysiqueAge;
        this.ClientPhysiqueTaille.value = M.donnees.ClientPhysiqueTaille;
        this.ClientPhysiqueCheveux.value = M.donnees.ClientPhysiqueCheveux;
        this.ClientPhysiqueDivers.value = M.donnees.ClientPhysiqueDivers;
        this.ClientPreferencesAge.value = M.donnees.ClientPreferencesAge;
        this.ClientPreferencesTaille.value = M.donnees.ClientPreferencesTaille;
        this.ClientPreferencesCheveux.value = M.donnees.ClientPreferencesCheveux;
        this.ClientPreferencesDivers.value = M.donnees.ClientPreferencesDivers;
    }
}

C = {
    modele: M,
    vue: V,
    controlleur: function(){
        this.vue.nouv(this.modele);
        
        
        this.element = elementFactory("p", document.body, 200, 100, this.width, this.height, {"backgroundColor": "red", "margin": "15px", "border": "4px solid red", "border-radius": "25px"}, "class1 class2", "Le pseudo du premier client est " + C.vue.ClientPseudo + "son numéro ID est " + C.vue.ClientNumero + ", ses centres d'intérêts sont " + C.vue.ClientCentreDInterets + "sa localisation est " + C.vue.ClientLocalisationRegion + "," + C.vue.ClientLocalisationDepartement + "," + C.vue.ClientLocalisationVille + " son genre est " + C.vue.ClientGenre + "son activité professionnelle est " + C.vue.ClientActivitesProfessionnelles + " description physique : " + "-" + C.vue.ClientPhysiqueAge + " ans -" + C.vue.ClientPhysiqueTaille + " -" + C.vue.ClientPhysiqueCheveux + " -" + C.vue.ClientPhysiqueDivers + " ses préférences sont [" + C.vue.ClientPreferencesAge + "] et [" + C.vue.ClientPreferencesTaille + "] et [" + C.vue.ClientPreferencesCheveux + "] et [" + C.vue.ClientPreferencesDivers + "]");

        console.log("dans handler");
    }
}

function fonction_principale_mvc(){
    document.querySelector(".bouton1").addEventListener("click", function(){
    C.controlleur.call(C);

    console.log(C.vue.ClientPseudo);
});

}


function main(){

    fonction_principale_mvc();
}














