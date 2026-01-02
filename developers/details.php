<?php
require_once('../db.php');
require_once('../classes/Developer.php');

if (!isset($_GET['id']) || empty($_GET['id'])) die("ID manquant");
$id = (int) $_GET['id'];

$developer = new Developer($pdo);
$data = $developer->obtenirParId($id);
if (!$data) die("Développeur introuvable");
?>

<h2>Détails du développeur</h2>

<p><strong>Nom :</strong> <?= htmlspecialchars($data['nom']) ?></p>
<p><strong>Email :</strong> <?= htmlspecialchars($data['email']) ?></p>

<?php if($data['image']): ?>
    <p><img src="../uploads/<?= htmlspecialchars($data['image']) ?>" width="150"></p>
<?php endif; ?>

<br>
<a href="lister.php" class="btn btn-secondary">← Retour</a> |
<a href="modifier.php?id=<?= $id ?>" class="btn btn-primary">Modifier</a> |
<a href="supprimer.php?id=<?= $id ?>" class="btn btn-danger">Supprimer</a>
