<?php
require_once('../db.php');
require_once('../classes/Technologie.php');

$techno = new Technologie($pdo);

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Identifiant non fourni.");
}

$id = (int) $_GET['id'];
$info = $techno->obtenirParId($id);

if (!$info) {
    die("Technologie introuvable.");
}

if (isset($_POST['confirm']) && $_POST['confirm'] === 'oui') {
    $techno->supprimer($id);
    header("Location: liste.php");
    exit();
}
?>

<h2>Supprimer la technologie</h2>

<p>Voulez-vous vraiment supprimer la technologie <strong><?= htmlspecialchars($info['nom']) ?></strong> ?</p>

<form method="post">
    <button type="submit" name="confirm" value="oui">Oui, supprimer</button>
    <a href="lister.php">Annuler</a>
</form>
