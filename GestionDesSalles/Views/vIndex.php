<h1>Vérifier la disponibilité d'une salle </h1>
<hr />

<b>
<form name = "myForm" action = "" method = "post">
<pre>
Sélectionnez la salle voulue: <span class="Err"><?= $erreur["salle"] ?? "" ?></span>
<select name = "idSalle">
		<option value="" length = "50">------------------------</option>

		<?php foreach ($salles as $salle) { ?>
			
		<option value="<?= $salle["id"] ?>" <?= ($salle["id"]==$reservation["idSalle"])?"selected": "" ?>><?= $salle["intituler"] ?></option>	
			
		
		<?php } ?>

		
</select>

Entrez la date prévue (format: yyyy-mm-jj): <span class="Err"><?= $erreur["date"]  ?? "" ?></span>
<input type="text" name="date" value="<?= $reservation["date"] ?>" /> 

Sélectionnez un créneau: <span class="Err"><?= $erreur["creneau"]  ?? ""  ?></span>
<input  type="radio" name ="creneau" value="Matin" /> Matin
<input  type="radio" name ="creneau" value="Soir" /> Soir

<input  type = 'submit'  value =  'Vérifier la disponibilité' />
</pre>


</form>
<div align = "right"><a href ="index.php?action=listeReservations">Voir la liste des réservations</a></div>