/*******************************************************************
 *@method CheckInput(): Fonction qui regarde si tous nos champs sont correctes.*
 *@param  f: correspond aux champs du formulaire en paramètre.          *   
 *@return : Renvoie un booléen	                                   *  
 *******************************************************************/	

function CheckInput(f){
    var pseudoOk   = CheckBasicInput(f.pseudo);
	var passwordOk = CheckBasicInput(f.pass);
	var emailOk    = CheckEmail(f.email); 

	if(pseudoOk && passwordOk && emailOk){
	    return true;
	}else{
		alert("Erreur");
		return false;
	}

}

/*********************************************************************
 *@method CheckBasicInput: Fonction qui regarde si un champ a une longueur correcte.* 
 *@param  champ: le champ du formulaire                              *
 *@return : Renvoie un booléen                                       *
 *********************************************************************/	

function CheckBasicInput(champ){
    if(champ.value.length < 2 || champ.value.length > 25){
	    Highlight(champ, true);
		return false;
	}else{
		Highlight(champ, false);
		return true;	
    }
}

/***************************************************************************************
 *@method CheckEmail: Fonction qui test si on viens de rentrer un email avec un format correcte.*
 *@param  champ: le champ du formulaire                                                *
 *@return : Renvoie un booléen                                                         *
 ***************************************************************************************/

function CheckEmail(champ){
    var regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$/;
    console.log(regex.test(champ.value));

	if(!regex.test(champ.value)){
	    Highlight(champ, true);
		return false;
	}else{
		Highlight(champ, false);
		return true;
	}
}

/***************************************************************************************
 *@method Highlight: Fonction qui surligne le background du champ en rouge si il y a une erreur.*
 *@param  champ: le champ du formulaire.                   *
 *@param erreur: un booléen                                       *
 *@return : Renvoie un void                                                            *
 ***************************************************************************************/
			
function Highlight(champ, erreur){
    if(erreur){
	    champ.style.backgroundColor = "#fba";
	}else{
		champ.style.backgroundColor = "";
	}
}
