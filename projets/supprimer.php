<?php
require_once('../db.php');
require_once('../classes/Projet.php');

$projet = new Projet($pdo);

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Identifiant non fourni.");
}

$id = (int) $_GET['id'];
$info = $projet->obtenirParId($id);

if (!$info) {
    die("Projet introuvable.");
}

if (isset($_POST['confirm']) && $_POST['confirm'] === 'oui') {
    $projet->supprimer($id);
    header("Location: lister.php");
    exit();
}
?>

<h2>Supprimer le projet</h2>

<p>Voulez-vous vraiment supprimer le projet <strong><?= htmlspecialchars($info['titre']) ?></strong> ?</p>

<form method="post">
    <button type="submit" name="confirm" value="oui">Oui, supprimer</button>
    <a href="lister.php">Annuler</a>
</form>
