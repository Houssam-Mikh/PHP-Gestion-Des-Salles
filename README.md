# PHP-Gestion-Des-Salles
Cette application développée en PHP permet aux utilisateurs de se connecter en utilisant soit leur e-mail académique, soit un token préalablement créé lié à leur e-mail. Une 
fois authentifié, un utilisateur normal peut vérifier si une réservation est possible pour une salle donnée. S'il est possible de réserver la salle, l'utilisateur peut 
effectuer la réservation. Sinon, il lui sera impossible de le faire. De plus, l'utilisateur peut consulter la liste des réservations de tous les utilisateurs, et il peut 
supprimer uniquement ses propres réservations.

En ce qui concerne l'administrateur, qui est spécifié dans le fichier Admins.php, il bénéficie des mêmes fonctionnalités qu'un utilisateur normal, mais avec des privilèges 
supplémentaires. L'administrateur a la capacité de supprimer toutes les réservations, même s'il n'est pas le propriétaire. De plus, il peut gérer les salles, ce qui implique 
d'ajouter de nouvelles salles ou de supprimer des salles existantes.
