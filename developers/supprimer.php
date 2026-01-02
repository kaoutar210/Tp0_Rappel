<?php
require_once('../db.php');
require_once('../classes/Developer.php');

$developer = new Developer($pdo);

if (!isset($_GET['id']) || empty($_GET['id'])) die("ID manquant");
$id = (int) $_GET['id'];
$data = $developer->obtenirParId($id);
if (!$data) die("Développeur introuvable");

if (isset($_POST['confirm']) && $_POST['confirm'] === 'oui') {
    $developer->supprimer($id);
    header("Location: lister.php");
    exit();
}
?>

<h2>Supprimer le développeur</h2>

<p>Voulez-vous vraiment supprimer <strong><?= htmlspecialchars($data['nom']) ?></strong> ?</p>

<form method="post">
    <button type="submit" name="confirm" value="oui" class="btn btn-danger">Oui, supprimer</button>
    <a href="lister.php" class="btn btn-secondary">Annuler</a>
</form>
