<?php
require_once('../db.php');
require_once('../classes/Technologie.php');

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Identifiant de la technologie manquant.");
}

$id = (int) $_GET['id'];
$techno = new Technologie($pdo);
$info = $techno->obtenirParId($id);

if (!$info) {
    die("Technologie non trouvée.");
}
?>

<h2>Détails de la technologie</h2>

<p><strong>Nom :</strong> <?= htmlspecialchars($info['nom']) ?></p>

<br>
<a href="lister.php">← Retour</a> |
<a href="modifier.php?id=<?= $id ?>">Modifier</a> |
<a href="supprimer.php?id=<?= $id ?>" onclick="return confirm('Supprimer cette technologie ?')">Supprimer</a>
