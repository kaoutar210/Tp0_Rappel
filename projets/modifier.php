<?php
require_once('../db.php');
require_once('../classes/Projet.php');

$projet = new Projet($pdo);

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Identifiant manquant.");
}

$id = (int) $_GET['id'];
$data = $projet->obtenirParId($id);

if (!$data) {
    die("Projet non trouvé.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'] ?? '';
    $description = $_POST['description'] ?? '';

    $projet->modifier($id, $titre, $description);
    header("Location: lister.php");
    exit();
}
?>

<h2>Modifier un projet</h2>

<form action="" method="post">
    <label>Titre:</label><br>
    <input type="text" name="titre" value="<?= htmlspecialchars($data['titre']) ?>" required><br><br>

    <label>Description:</label><br>
    <textarea name="description"><?= htmlspecialchars($data['description']) ?></textarea><br><br>

    <button type="submit">Modifier</button>
    <a href="lister.php">Annuler</a>
</form>
