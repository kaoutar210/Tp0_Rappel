<?php
require_once('../db.php');
require_once('../classes/Technologie.php');

$techno = new Technologie($pdo);
$listeTechnologies = $techno->lister();
?>

<h2>Liste des Technologies</h2>

<a href="ajouter.php" class="btn btn-primary mb-3">+ Ajouter une technologie</a>

<table class="table table-bordered">
    <tr>
        <th>Nom</th>
        <th>Actions</th>
    </tr>

    <?php foreach($listeTechnologies as $t): ?>
        <tr>
            <td><?= htmlspecialchars($t['nom']) ?></td>
            <td>
                <a href="details.php?id=<?= $t['id'] ?>" class="btn btn-info btn-sm">Détails</a>
                <a href="modifier.php?id=<?= $t['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                <a href="supprimer.php?id=<?= $t['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer cette technologie ?')">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
