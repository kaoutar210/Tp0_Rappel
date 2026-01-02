<?php
require_once('../db.php');
require_once('../classes/Projet.php');

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Identifiant du projet manquant.");
}

$id = (int) $_GET['id'];
$projet = new Projet($pdo);
$info = $projet->obtenirParId($id);

if (!$info) {
    die("Projet non trouvé.");
}
?>

<h2>Détails du projet</h2>

<p><strong>Titre :</strong> <?= htmlspecialchars($info['titre']) ?></p>
<p><strong>Description :</strong> <?= htmlspecialchars($info['description']) ?></p>

<br>
<a href="lister.php">← Retour</a> |
<a href="modifier.php?id=<?= $id ?>">Modifier</a> |
<a href="supprimer.php?id=<?= $id ?>" onclick="return confirm('Supprimer ce projet ?')">Supprimer</a>
