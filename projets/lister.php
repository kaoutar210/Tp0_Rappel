<?php
require_once('../db.php');
require_once('../classes/Projet.php');

$projet = new Projet($pdo);
$listeProjets = $projet->lister();
?>

<h2>Liste des projets</h2>

<a href="ajouter.php">+ Ajouter un projet</a>
<br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>Titre</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($listeProjets as $p): ?>
        <tr>
            <td><?= htmlspecialchars($p['titre']) ?></td>
            <td><?= htmlspecialchars($p['description']) ?></td>
            <td>
                <a href="details.php?id=<?= $p['id'] ?>">Détails</a> |
                <a href="modifier.php?id=<?= $p['id'] ?>">Modifier</a> |
                <a href="supprimer.php?id=<?= $p['id'] ?>" onclick="return confirm('Supprimer ce projet ?')">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
