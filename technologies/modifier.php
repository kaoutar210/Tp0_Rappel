<?php
require_once('../db.php');
require_once('../classes/Technologie.php');

$techno = new Technologie($pdo);


if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: liste.php"); 
    exit();
}

$id = (int) $_GET['id'];
$data = $techno->obtenirParId($id);

if (!$data) {
    die("Technologie non trouvée.");
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? '';
    $description = $_POST['description'] ?? ''; 

    $techno->modifier($id, $nom, $description ?? null);

    header("Location: lister.php");
    exit();
}
?>

<h2>Modifier une technologie</h2>

<form action="" method="post">
    <div>
        <label>Nom :</label><br>
        <input type="text" name="nom" value="<?= htmlspecialchars($data['nom']) ?>" required>
    </div>
    <br>

    <?php if (isset($data['description'])): ?>
        <div>
            <label>Description :</label><br>
            <textarea name="description" rows="4"><?= htmlspecialchars($data['description']) ?></textarea>
        </div>
        <br>
    <?php endif; ?>

    <button type="submit" class="btn btn-success">Modifier</button>
    <a href="lister.php" class="btn btn-secondary">Annuler</a>
</form>
