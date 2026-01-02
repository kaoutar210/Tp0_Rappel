<?php
require_once('../db.php');
require_once('../classes/Developer.php');

$developer = new Developer($pdo);
$liste = $developer->lister();
?>

<h2>Liste des Développeurs</h2>

<a href="ajouter.php" class="btn btn-primary mb-3">+ Ajouter un développeur</a>

<table class="table table-bordered">
    <tr>
        <th>Nom</th>
        <th>Email</th>
        <th>Image</th>
        <th>Actions</th>
    </tr>
    <?php foreach($liste as $d): ?>
        <tr>
            <td><?= htmlspecialchars($d['nom']) ?></td>
            <td><?= htmlspecialchars($d['email']) ?></td>
            <td>
                <?php if($d['image']): ?>
                    <img src="../uploads/<?= htmlspecialchars($d['image']) ?>" width="50">
                <?php endif; ?>
            </td>
            <td>
                <a href="details.php?id=<?= $d['id'] ?>">Détails</a> |
                <a href="modifier.php?id=<?= $d['id'] ?>">Modifier</a> |
                <a href="supprimer.php?id=<?= $d['id'] ?>" onclick="return confirm('Supprimer ce développeur ?')">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
