<body>
    

<h1>Gestio des Salles </h1> 


    <?php foreach($salles as $s){?>

        <p>salle : <?= $s['intituler'] ?>  <a href="index.php?action=suprimerSalles&id=<?= $s['id'] ?>">delete</a> </p>

    <?php }?>


    <a href="index.php?action=ajouterSalle">ajouter salle</a>


</body>