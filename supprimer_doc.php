<?php
// Connexion à la base
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "medecine";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
  die("Erreur de connexion : " . $conn->connect_error);
}

// Vérification de l'ID
if (isset($_POST['doc_id'])) {
  $doc_id = intval($_POST['doc_id']);

  // Récupérer le fichier
  $stmt = $conn->prepare("SELECT chemin_fichier FROM dossier_medical WHERE id = ?");
  $stmt->bind_param("i", $doc_id);
  $stmt->execute();
  $stmt->bind_result($chemin);
  $stmt->fetch();
  $stmt->close();

  // Supprimer le fichier s'il existe
  if (!empty($chemin) && file_exists($chemin)) {
    unlink($chemin);
  }

  // Supprimer l'entrée dans la base
  $stmt = $conn->prepare("DELETE FROM dossier_medical WHERE id = ?");
  $stmt->bind_param("i", $doc_id);
  $stmt->execute();
  $stmt->close();
}

// Redirection
header("Location: dossier_medical.php");
exit();
?>
