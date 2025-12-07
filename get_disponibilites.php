<?php
$pdo = new PDO("mysql:host=localhost;dbname=medecine", "root", "");

$medecin_id = $_GET['medecin_id'];
$jour = $_GET['jour'];

$stmt = $pdo->prepare("SELECT heure_debut, heure_fin FROM disponibilites WHERE medecin_id = ? AND jour = ?");
$stmt->execute([$medecin_id, $jour]);
$row = $stmt->fetch();

$dispos = [];

if ($row) {
  $start = strtotime($row['heure_debut']);
  $end = strtotime($row['heure_fin']);

  while ($start < $end) {
    $dispos[] = date("H:i", $start);
    $start = strtotime("+30 minutes", $start);
  }
}

echo json_encode($dispos);
