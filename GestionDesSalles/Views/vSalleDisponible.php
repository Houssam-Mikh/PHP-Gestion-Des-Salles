<h1>Cette salle est disponible</h1>
<hr />

<form action="index.php?action=reserver" method="post">

<pre>
Salle: <?= $salle ?> <input type = "hidden" name="salle" value ="<?= $salle ?>" /><br />
Date: <?=  $date  ?> <input type = "hidden" name="date"  value ="<?= $date ?>" /><br />
Créneau: <?= $creneau   ?> <input type = "hidden" name="creneau"  value ="<?= $creneau ?>" /><br />

</p>
<input type ="submit" value="reserver"/>
<input type ="button" onclick="javascript:history.go(-1)" value="Retour à la page précédente" />
<div align = "right"><a href ="index.php?action=listeReservations">Voir la liste des réservations</a></div>
</pre>