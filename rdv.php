<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'patient') {
    header("Location: index.php");
    exit;
}

$medecin_id = $_GET['medecin_id'];
?>

<h2>Prendre un Rendez-vous</h2>
<form action="process_rdv.php" method="post">
    <input type="hidden" name="medecin_id" value="<?= $medecin_id ?>">
    <input type="datetime-local" name="date_rdv" required>
    <textarea name="description" placeholder="Motif du rendez-vous" required></textarea>
    <button type="submit">Valider</button>
</form>
<a href="medecins.php">Retour</a>