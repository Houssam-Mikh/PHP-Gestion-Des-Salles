function utiliserAjax(method,url,data,zoneAffichage)
{ 
  

//*******************  afficher une Annimation  ********************************//***//

document.getElementById(zoneAffichage).innerHTML=  "<img src = 'public/images/ajax-loader.gif' />";      //***//

//****************************************************************************//***//


/**************** Créer un objet XMLHttpRequest /********************************
/********************************************************************************
*********************************************************************************/
 var xhr; 
    try {  xhr = new ActiveXObject('Msxml2.XMLHTTP');   }
    catch (e) 
    {
        try {   xhr = new ActiveXObject('Microsoft.XMLHTTP');    }
        catch (e2) 
        {
          try {  xhr = new XMLHttpRequest();      }
          catch (e3) {  xhr = false;   }
        }
     }




//*************************** Attendre la réception de la réponse,
//*************************** quand elle est prête (readyState = 4) 
//*************************** et sans erreurs (status = 200), 
//*************************** on consomme le texte reçu (responseText)
//***************************



 
    xhr.onreadystatechange  = function()

    { 
         if(xhr.readyState  == 4)
         {
              if(xhr.status  == 200) { 
				//alert(zoneAffichage);	
//alert(document.getElementById(zoneAffichage).innerHTML);				
                 document.getElementById(zoneAffichage).innerHTML= xhr.responseText;
				 //alert(document.getElementById(zoneAffichage).innerHTML);
              }else 
                 alert ("Error code " + xhr.status);
         }

    } 


/***** Ouverture et envoie de la requête  ****/

if (method== "GET"){
	xhr.open( "GET", url + "?" + data, true);
	xhr.send(null);
}
else if (method== "POST") {
	xhr.open("POST", url,  true);                               
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send(data);
}



 
} 
