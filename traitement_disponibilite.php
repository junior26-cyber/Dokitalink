<?php
// session_start();
// if (!isset($_SESSION['medecin_id'])) {
//   header("Location: index.php");
//   exit;
// }

$pdo = new PDO("mysql:host=localhost;dbname=medecine", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$medecin_id = $_SESSION['medecin_id'];
$jour = $_POST['jour'];
$heure_debut = $_POST['heure_debut'];
$heure_fin = $_POST['heure_fin'];

$sql = "INSERT INTO disponibilites (medecin_id, jour, heure_debut, heure_fin) VALUES (?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$medecin_id, $jour, $heure_debut, $heure_fin]);

header("Location: tableau.medecin.php?disponibilite=ok");
exit;
