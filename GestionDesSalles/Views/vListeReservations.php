<h1>Liste des réservations actives</h1>

<hr />
<div align="right"><b><a href ="index.php">Réserver une salle</a> </b></div>
<table border="1" align = "center" width = "60%">
			<tr> 
				<th>id</th>
				<th>Email Createur </th>
				<th>Motif</th>
				<th>Salle</th>
				<th>Date</th>
				<th>Créneau</th>
				<th>Action</th>
			</tr>	
		 
	<?php foreach ($Reservations as $R) { ?>	 
			<tr>
				<td> <?= $R["id"] ?></td>
				<td> <?= $R["email"] ?> </td>
				<td> <?= $R["motif"] ?> </td>
				<td> <?php echo(getSalleById($R["idSalle"])) ?> </td>
				<td> <?= $R["date"] ?> </td>
				<td> <?= $R["creneau"] ?> </td>
				<td> <a href = "index.php?action=demandeSuppression&id=<?= $R["id"] ?>">Supprimer</a> </td>
			</tr>
			
	<?php }?>
	
	
</table>
<?php if(isAdmin($_SESSION["user"])){?>
			<a href="index.php?action=gestionSalles">gestion des salles</a>
			<?php }?>