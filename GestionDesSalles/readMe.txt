cette application represente le dernier travail demander , une application web qui rassemble les deux examens dans la plateformes.
dans cette application j'ai réaliser les taches suivants : 
1- tous les pages sont protéger par une authentification soit avec token soit avec emailAcadémique(exemple@usmba.ac.ma)
2-on peut avoir deux types d'utilisateur soit utilisateur simple qui peut faire les taches suivants : 
	2-1: ajouter une reservation(si c'est possible) et activer cette reservation on utilison un token 
	2-2: supprimer une reservation si c'est lui le proprietaire sinon il ne peut pas 
	2-3: consulter la liste des reservation 
	2-4: se deconnecter 
3- les utilisateurs de cette application peuvent aussi etres des admins qui peut faire les mêmes taches des utilisateur simples et plus : 
	3-1: l'admin peut ajouter une classe si cette classe n'existe pas 
	3-2: l'admin peut supprimer tous les reservations(qui posséde ou non)

l'application utilise une base de données nommé collePHP avec les shémas suivants : 
	reservations(id,email,motif,idSalle,date,creneau,etat);
	salles(id,intituler);
	token(idReservation,token,expire); 
	usertokens(user,token,expire);