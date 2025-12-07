<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'patient') {
    header("Location: index.php");
    exit;
}

$sql = "SELECT * FROM utilisateurs WHERE role = 'medecin'";
$stmt = $pdo->query($sql);
$medecins = $stmt->fetchAll();
?>

<h2>Liste des Médecins</h2>
<ul>
<?php foreach ($medecins as $medecin): ?>
    <li>
        <?= htmlspecialchars($medecin['nom']) ?> - <?= $medecin['email'] ?>
        <a href="rdv.php?medecin_id=<?= $medecin['id'] ?>">Prendre RDV</a>
    </li>
<?php endforeach; ?>
</ul>
<a href="dashboard.php">Retour</a>
